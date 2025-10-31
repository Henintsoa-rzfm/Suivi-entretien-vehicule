<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link rel="stylesheet" href="{{asset('v2/css/style.css')}}">
<title>Dashboard - FiaraTrack</title>
</head>
<body>
<div class="wrap">
  <aside class="sidebar"> 
    <div class="brand">FiaraTrack</div>
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
        <tbody id="rows">          
          @foreach ($vehicles as $vehicle)
            <tr>
              <td>{{$vehicle->PlaqueImmatric}}</td>
              <td>{{$vehicle->AnneeMenCirc}}</td>
              <td>{{$vehicle->Energie}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </main>
</div>

{{-- 
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
</script> --}}
</body>
</html>