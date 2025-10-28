<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard - Light Pro</title>
<style>
  :root{
    --bg:#f8fafc;
    --card:#ffffff;
    --border:#e2e8f0;
    --text:#0f172a;
    --muted:#64748b;
    --accent:#2563eb;
    --radius:10px;
    --gap:16px;
    font-family: "Inter", system-ui, sans-serif;
  }

  *{box-sizing:border-box; margin:0; padding:0;}
  body{
    background:var(--bg);
    color:var(--text);
    display:flex;
    justify-content:center;
    padding:24px;
  }

  .wrap{
    width:100%;
    max-width:1200px;
    display:grid;
    grid-template-columns:240px 1fr;
    gap:var(--gap);
  }

  /* Sidebar */
  .sidebar{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:18px;
    height:calc(100vh - 48px);
    position:sticky;
    top:24px;
    display:flex;
    flex-direction:column;
  }
  .brand{font-weight:700; font-size:18px; color:var(--accent); margin-bottom:20px; letter-spacing:-0.3px;}
  nav{display:flex; flex-direction:column; gap:8px;}
  nav a{
    text-decoration:none;
    color:var(--text);
    padding:10px 12px;
    border-radius:var(--radius);
    transition:0.2s;
    font-weight:500;
  }
  nav a:hover{
    background:#eff6ff;
    color:var(--accent);
  }
  nav a.active{
    background:var(--accent);
    color:white;
  }

  /* Main */
  main{
    min-height:calc(100vh - 48px);
    display:flex;
    flex-direction:column;
    gap:var(--gap);
  }

  header.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:12px 16px;
  }

  .search{
    display:flex;
    align-items:center;
    gap:8px;
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:6px 10px;
    background:white;
  }
  .search input{
    border:none;
    outline:none;
    background:transparent;
    color:var(--text);
    min-width:200px;
  }

  .btn{
    background:var(--accent);
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:var(--radius);
    cursor:pointer;
    font-weight:600;
    transition:0.2s;
  }
  .btn:hover{
    background:#1d4ed8;
  }

  .grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:var(--gap);
  }
  .card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius);
    padding:16px;
  }
  .muted{color:var(--muted); font-size:14px;}
  .value{font-size:22px; font-weight:700; margin-top:4px;}

  /* Chart */
  canvas{width:100%; height:160px;}

  /* Table */
  table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
    margin-top:10px;
  }
  thead{
    background:#f1f5f9;
  }
  th, td{
    padding:10px 8px;
    text-align:left;
  }
  th{
    color:var(--muted);
    font-weight:600;
  }
  tbody tr{
    border-bottom:1px solid var(--border);
  }

  .status{
    padding:4px 8px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
  }
  .status.ok{background:#dcfce7; color:#166534;}
  .status.warn{background:#fef9c3; color:#854d0e;}
  .status.bad{background:#fee2e2; color:#991b1b;}

  @media (max-width:900px){
    .wrap{grid-template-columns:1fr;}
    .sidebar{position:relative; height:auto;}
    .grid{grid-template-columns:repeat(2,1fr);}
  }
  @media (max-width:600px){
    .grid{grid-template-columns:1fr;}
  }
</style>
</head>
<body>
<div class="wrap">
  <aside class="sidebar">
    <div class="brand">FleetTrack</div>
    <nav>
      <a href="#" class="active">Dashboard</a>
      <a href="#">Véhicules</a>
      <a href="#">Entretiens</a>
      <a href="#">Techniciens</a>
      <a href="#">Paramètres</a>
    </nav>
    <div style="margin-top:auto; font-size:13px; color:var(--muted);">
      <hr style="margin:12px 0; border:0; border-top:1px solid var(--border)">
      <div>Connecté : <strong>Admin</strong></div>
      <div>Version 1.0</div>
    </div>
  </aside>

  <main>
    <header class="topbar">
      <div class="search">
        🔍 <input placeholder="Rechercher...">
      </div>
      <button class="btn">+ Nouvelle fiche</button>
    </header>

    <section class="grid">
      <div class="card">
        <div class="muted">Interventions</div>
        <div class="value">1 245</div>
        <div class="muted">+4% vs semaine dernière</div>
      </div>
      <div class="card">
        <div class="muted">Véhicules actifs</div>
        <div class="value">{{$vehiclesCount}}</div>
        <div class="muted">Stabilité</div>
      </div>
      <div class="card">
        <div class="muted">Alertes critiques</div>
        <div class="value">3</div>
        <div class="muted">À traiter</div>
      </div>
    </section>

    <section class="card">
      <div class="muted" style="margin-bottom:8px;">Interventions sur 30 jours</div>
      <canvas id="chart"></canvas>
    </section>

    <section class="card">
      <div class="muted" style="margin-bottom:8px;">Dernières interventions</div>
      <table>
        <thead>
          <tr>
            <th>Véhicule</th>
            <th>Date</th>
            <th>Technicien</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody id="rows"></tbody>
      </table>
    </section>
  </main>
</div>

<script>
// Mini graphique (canvas pur)
const ctx = document.getElementById('chart').getContext('2d');
function drawLine(){
  const W = ctx.canvas.clientWidth;
  const H = ctx.canvas.clientHeight;
  ctx.canvas.width = W * devicePixelRatio;
  ctx.canvas.height = H * devicePixelRatio;
  ctx.scale(devicePixelRatio, devicePixelRatio);
  const data = Array.from({length:30},()=>80+Math.random()*50);
  const max = Math.max(...data);
  const min = Math.min(...data);
  const range = max-min;
  const stepX = W / (data.length-1);

  ctx.clearRect(0,0,W,H);
  ctx.beginPath();
  data.forEach((v,i)=>{
    const x = i*stepX;
    const y = H - ((v-min)/range)*H;
    i===0?ctx.moveTo(x,y):ctx.lineTo(x,y);
  });
  ctx.strokeStyle = '#2563eb';
  ctx.lineWidth = 2;
  ctx.stroke();
}
drawLine();
window.addEventListener('resize', drawLine);

// Table
const rows=[
  {veh:'Peugeot 208',date:'2025-10-12',tech:'Rasoa',status:'ok'},
  {veh:'Toyota Hilux',date:'2025-10-10',tech:'Miguel',status:'warn'},
  {veh:'Renault Clio',date:'2025-10-07',tech:'Lina',status:'bad'},
  {veh:'Ford Transit',date:'2025-10-05',tech:'Faly',status:'ok'}
];
document.getElementById('rows').innerHTML = rows.map(r=>`
  <tr>
    <td>${r.veh}</td>
    <td>${r.date}</td>
    <td>${r.tech}</td>
    <td><span class="status ${r.status}">${r.status.toUpperCase()}</span></td>
  </tr>
`).join('');
</script>
</body>
</html>