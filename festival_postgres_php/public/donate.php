<?php
require_once __DIR__ . "/../includes/config.php";
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor = trim($_POST['donor_name'] ?? '');
    $amount = floatval($_POST['amount'] ?? 0);
    $mode = $_POST['mode'] ?? 'offline';
    $note = trim($_POST['note'] ?? '');
    $stmt = $pdo->prepare('INSERT INTO donations (donor_name, amount, mode, note) VALUES (?, ?, ?, ?)');
    $stmt->execute([$donor, $amount, $mode, $note]);
    $msg = 'Thank you for your donation!';
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Donate</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/festival_postgres_php/assets/css/style.css">
</head><body>
<div class="container py-4">
  <div class="card p-4">
    <h3>Make a Donation</h3>
    <?php if($msg) echo "<div class='alert alert-success'>".htmlspecialchars($msg)."</div>"; ?>
    <form method="post">
      <input class="form-control mb-2" name="donor_name" placeholder="Your name">
      <input class="form-control mb-2" name="amount" type="number" step="0.01" placeholder="Amount" required>
      <select class="form-control mb-2" name="mode"><option value="offline">Offline</option><option value="online">Online</option></select>
      <textarea class="form-control mb-2" name="note" placeholder="Note (optional)"></textarea>
      <button class="btn btn-primary" type="submit">Donate</button>
    </form>
  </div>
</div>
</body></html>
