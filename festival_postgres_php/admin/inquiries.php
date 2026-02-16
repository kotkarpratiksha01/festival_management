<?php
require_once '_header.php';
require_once __DIR__ . '/../includes/config.php';
// Fetch inquiries
$stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
  background: linear-gradient(135deg,#a1c4fd,#c2e9fb,#fbc2eb,#ffd6a5);
  margin:0;
  font-family:Segoe UI;
}
.table-card{
  background:#ffffff;
  border-radius:16px;
  padding:20px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  max-width:1100px;
  margin:40px auto;
}
.table thead{
  background:linear-gradient(135deg,#4f46e5,#6366f1);
  color:#fff;
}
.table th{
  font-weight:600;
  border:none;
}
.table td{
  vertical-align:middle;
}
.badge-message{
  background:#f0f9ff;
  color:#1d4ed8;
  font-weight:600;
  padding:6px 10px;
  border-radius:10px;
  display:inline-block;
  max-width:250px;
  overflow:hidden;
  text-overflow:ellipsis;
  white-space:nowrap;
}
.date{
  font-size:13px;
  color:#6b7280;
}
</style>
</head>
<body>

<div class="table-card">
  <h4 class="mb-4">📋 Inquiries</h4>

  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Contact Pref</th>
        <th>Event Type</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!$inquiries): ?>
        <tr>
          <td colspan="8" class="text-center text-muted">No inquiries found</td>
        </tr>
      <?php endif; ?>

      <?php foreach($inquiries as $i=>$inq): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><strong><?= htmlspecialchars($inq['full_name'] ?? '') ?></strong></td>
        <td><?= htmlspecialchars($inq['email'] ?? '') ?></td>
        <td><?= htmlspecialchars($inq['mobile'] ?? '') ?></td>
        <td><?= htmlspecialchars($inq['contact_preference'] ?? '') ?></td>
        <td><?= htmlspecialchars($inq['event_type'] ?? '') ?></td>
        <td><span class="badge-message"><?= htmlspecialchars($inq['message'] ?? '') ?></span></td>
        <td class="date"><?= date("d M Y, h:i A", strtotime($inq['created_at'] ?? '')) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</body>
</html>
