<?php
require_once __DIR__ . '/../includes/config.php';

// Fetch inquiries from database
$stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.table-card{
  background:#ffffff;
  border-radius:16px;
  padding:20px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  max-width:1000px;
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

<div class="table-card">
  <h4 class="mb-4">📋 Inquiries</h4>

  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>

    <tbody>
    <?php if(!$inquiries): ?>
      <tr>
        <td colspan="5" class="text-center text-muted">No inquiries found</td>
      </tr>
    <?php endif; ?>

    <?php foreach($inquiries as $i=>$inq): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><strong><?= htmlspecialchars($inq['name'] ?? '') ?></strong></td>
        <td><?= htmlspecialchars($inq['email'] ?? '') ?></td>
        <td>
          <span class="badge-message">
            <?= htmlspecialchars($inq['message'] ?? '') ?>
          </span>
        </td>
        <td class="date">
          <?= date("d M Y, h:i A", strtotime($inq['created_at'] ?? '')) ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
