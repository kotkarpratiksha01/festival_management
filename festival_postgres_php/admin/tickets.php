<?php
require_once '_header.php';
require_once __DIR__ . '/../includes/config.php';

$stmt = $pdo->query("
SELECT 
 t.user_name,
 e.name AS event_name,
 t.tickets,
 t.total_amount,
 t.created_at
FROM tickets t
JOIN events e ON e.id = t.event_id
ORDER BY t.created_at DESC
");


$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.table-card{
  background:#ffffff;
  border-radius:16px;
  padding:20px;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
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

.badge-ticket{
  background:#e0e7ff;
  color:#3730a3;
  font-weight:600;
  padding:6px 10px;
  border-radius:10px;
}

.amount{
  font-weight:700;
  color:#059669;
}

.date{
  font-size:13px;
  color:#6b7280;
}
</style>

<div class="table-card">
  <h4 class="mb-4">🎟 Ticket Bookings</h4>

  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>User</th>
        <th>Event</th>
        <th>Tickets</th>
        <th>Total ₹</th>
        <th>Date</th>
      </tr>
    </thead>

    <tbody>
    <?php if(!$tickets): ?>
      <tr>
        <td colspan="6" class="text-center text-muted">No bookings found</td>
      </tr>
    <?php endif; ?>

    <?php foreach($tickets as $i=>$t): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><strong><?= htmlspecialchars($t['user_name']) ?></strong></td>
        <td><?= htmlspecialchars($t['event_name']) ?></td>
        <td>
          <span class="badge-ticket">
            <?= $t['tickets'] ?>
          </span>
        </td>
        <td class="amount">
          ₹<?= number_format($t['total_amount'],2) ?>
        </td>
        <td class="date">
          <?= date("d M Y, h:i A", strtotime($t['created_at'])) ?>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
