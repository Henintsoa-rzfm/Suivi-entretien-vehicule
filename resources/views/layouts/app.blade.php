<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>FiaraTrack</title>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="wrap">
  <aside class="sidebar">
    <div class="brand">FiaraTrack</div>
    <nav>
      <a href="{{ route('dash') }}" class="nav-link"><i class="fas fa-tachometer-alt me-2"></i> Tableau de bord</a>
            @if (Auth::user()->admin)
            <a href="{{ route('personnel') }}" class="nav-link"><i class="fas fa-user-plus me-2"></i> Personnel</a>
            <a href="{{ route('papier') }}" class="nav-link"><i class="fas fa-book me-2"></i> Papier</a>
            @endif
            <a href="{{ route('principal') }}" class="nav-link"><i class="fas fa-car me-2"></i> Véhicule</a>
            <a href="{{ route('dpannes') }}" class="nav-link"><i class="fas fa-car-crash me-2"></i> Pannes</a>
            <a href="{{ route('interventions') }}" class="nav-link"><i class="fas fa-tools me-2"></i> Interventions</a>
            <a href="{{ route('contenirs') }}" class="nav-link"><i class="fas fa-car-wash me-2"></i> Entretien</a>
    </nav>
    <div style="margin-top:auto; font-size:13px; color:var(--muted);">
      <hr style="margin:12px 0; border:0; border-top:1px solid var(--border)">
      <div>Connecté : <strong>Admin</strong></div>
      <div>Version 1.0</div>
    </div>
  </aside>

  {{-- Main --}}
  <main>

    @yield('content')

    <section class="card">
      <div class="muted" style="margin-bottom:8px;">Interventions sur 30 jours</div>
      <canvas id="chart"></canvas>
    </section>
  </main>

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

