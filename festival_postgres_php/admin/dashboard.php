<?php
// Load config (must create $pdo) and start session
require_once __DIR__ . '/../includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
// Auth
if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
// Totals
try {
    $totalUsers = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $totalVols = (int) $pdo->query('SELECT COUNT(*) FROM volunteers')->fetchColumn();
    $totalDon = (float) $pdo->query('SELECT COALESCE(SUM(amount),0) FROM donations')->fetchColumn();
    $totalDonationsCount = (int) $pdo->query('SELECT COUNT(*) FROM donations')->fetchColumn();
    $todayDon = (float) $pdo->query("SELECT COALESCE(SUM(amount),0) FROM donations WHERE DATE(created_at)=CURRENT_DATE")->fetchColumn();
    $monthDon = (float) $pdo->query("SELECT COALESCE(SUM(amount),0) FROM donations WHERE DATE_TRUNC('month', created_at)=DATE_TRUNC('month', CURRENT_DATE)")->fetchColumn();
    $ticketCount = $pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn();
    $ticketChart = $pdo->query("
  SELECT DATE(created_at) AS day, COUNT(*) AS total
  FROM tickets
  GROUP BY DATE(created_at)
  ORDER BY day
")->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$values = [];
foreach ($ticketChart as $row) {
  $labels[] = $row['day'];
  $values[] = $row['total'];
}
} catch (Exception $e) {
    $totalUsers = $totalVols = $totalDonationsCount = 0;
    $totalDon = $todayDon = $monthDon = 0.0;
}
//7-day amount series
// ===== Monthly Donations (2025–2026) =====
try {
    $monthlyStmt = $pdo->query("
      SELECT 
        TO_CHAR(created_at, 'YYYY-MM') AS ym,
        SUM(amount) AS total
      FROM donations
      WHERE EXTRACT(YEAR FROM created_at) IN (2025, 2026)
      GROUP BY ym
      ORDER BY ym
    ");

    $series = $monthlyStmt->fetchAll(PDO::FETCH_ASSOC);
    $chartLabels = array_column($series, 'ym'); // 2025-01, 2025-02 ...
    $chartData   = array_map(function($r){ 
      return (float)$r['total']; }, $series);

} catch (Exception $e) {
    $chartLabels = [];
    $chartData = [];
}

//7-day count series
try {
    $stmt2 = $pdo->prepare("
      SELECT to_char(d::date,'YYYY-MM-DD') AS day,
             COALESCE(COUNT(don.id),0) AS cnt
      FROM generate_series(current_date - interval '6 days', current_date, interval '1 day') AS d
      LEFT JOIN donations don ON don.created_at::date = d::date
      GROUP BY d
      ORDER BY d
    ");
    $stmt2->execute();
    $seriesCnt = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $chartCountData = array_map(function($r){ return (int)$r['cnt']; }, $seriesCnt);
} catch (Exception $e) {
    $chartCountData = [];
}
// include header (layout)
require_once __DIR__ . '/_header.php';
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-bottom:18px}
.stat-card{border-radius:12px;padding:18px;color:#fff;display:flex;justify-content:space-between;align-items:center;min-height:100px;box-shadow:0 10px 30px rgba(16,24,40,.06)}
.stat-card .label{opacity:.9;font-weight:600;margin-bottom:6px}
.stat-card .value{font-size:1.6rem;font-weight:700}
.stat-icon{font-size:1.9rem;opacity:.95}
.section-box{background:#fff;padding:16px;border-radius:10px;box-shadow:0 6px 20px rgba(16,24,40,.04);margin-top:18px}
.row-charts{display:flex;gap:16px;flex-wrap:wrap}
.chart-large{flex:1 1 60%;min-height:260px;background:#fff;border-radius:10px;padding:12px}
.chart-small{flex:1 1 36%;min-height:260px;background:#fff;border-radius:10px;padding:12px}
@media(max-width:900px){ .row-charts{flex-direction:column} .chart-large,.chart-small{flex:1 1 100%} }
</style>
<div class="page-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Admin Dashboard</h1>
  </div>
  <div class="stats-grid">
    <div class="stat-card" style="background:linear-gradient(135deg,#4c6ef5,#3b82f6)">
      <div><div class="label">Total Users</div><div class="value"><?= (int)$totalUsers ?></div></div>
      <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
    </div>

    <div class="stat-card" style="background:linear-gradient(135deg,#2f9e44,#38d39f)">
      <div><div class="label">Volunteers</div><div class="value"><?= (int)$totalVols ?></div></div>
      <div class="stat-icon"><i class="bi bi-person-badge-fill"></i></div>
    </div>
    <div class="stat-card" style="background:linear-gradient(135deg,#d6336c,#ef476f)">
      <div><div class="label">Total Donations</div><div class="value">₹<?= number_format((float)$totalDon,2) ?></div></div>
      <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
    </div>
    
    <div class="stat-card" style="background:linear-gradient(135deg,#845ef7,#9b6cff)">
      <div><div class="label">Donation Entries</div><div class="value"><?= (int)$totalDonationsCount ?></div></div>
      <div class="stat-icon"><i class="bi bi-clipboard-data"></i></div>
    </div>
    <div class="stat-card" style="background:linear-gradient(135deg,#0ca678,#2dd4bf)">
      <div><div class="label">Today's Donations</div><div class="value">₹<?= number_format((float)$todayDon,2) ?></div></div>
      <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
    </div>
    <div class="stat-card" style="background:linear-gradient(135deg,#ff922b,#ffb454)">
      <div><div class="label">This Month</div><div class="value">₹<?= number_format((float)$monthDon,2) ?></div></div>
      <div class="stat-icon"><i class="bi"></i></div>
    </div>
  </div>
  <div class="row g-4">

  <!-- Tickets Card -->
  <div class="col-md-4">
     <div class="card shadow-sm border-0"
         style="border-radius:16px;
                background:linear-gradient(135deg,#6366f1,#8b5cf6);
                color:white;">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-uppercase opacity-75">Tickets</h6>
          <h2 class="fw-bold"><?= $ticketCount ?></h2>
        </div>
        <i class="bi bi-ticket-perforated fs-1 opacity-75"></i>
      </div>
    </div>
  </div>
  <div class="section-box">
    <h5 class="mb-3">Donations — Last 7 days</h5>
    <div class="row-charts">
      <div class="chart-large">
        <canvas id="donationsChart" style="width:100%;height:100%"></canvas>
      </div>
      <div class="chart-small">
        <canvas id="donationsCountChart" style="width:100%;height:100%"></canvas>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function(){
  const labels = <?= json_encode($chartLabels) ?>;
  const amounts = <?= json_encode($chartData) ?>;
  const counts = <?= json_encode($chartCountData ?? []) ?>;
  // Line chart: amounts
  const el1 = document.getElementById('donationsChart');
  if (el1) {
    const ctx1 = el1.getContext('2d');
    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Donations (₹)',
          data: amounts,
          borderColor: 'rgba(59,130,246,0.95)',
          backgroundColor: 'rgba(9, 58, 136, 0.12)',
          fill: true,
          tension: 0.35,
          pointRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins:{legend:{display:false}},
        scales:{ x:{grid:{display:false}}, y:{beginAtZero:true, ticks:{callback: v => '₹' + v}} }
      }
    });
  }
  // Bar chart: counts
  const el2 = document.getElementById('donationsCountChart');
  if (el2) {
    const ctx2 = el2.getContext('2d');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Donation entries',
          data: counts,
          backgroundColor: 'rgba(133,94,247,0.9)',
          borderRadius: 8,
          barThickness: 'flex'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins:{legend:{display:false}},
        scales:{ x:{grid:{display:false}}, y:{beginAtZero:true, precision:0} }
      }
    });
  }
})()
new Chart(document.getElementById('ticketChart'), {
  type: 'line',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [{
      label: 'Tickets Booked',
      data: <?= json_encode($values) ?>,
      fill: true,
      tension: 0.4
    }]
  }
});
</script>
<?php require_once __DIR__ . '/_footer.php'; ?>