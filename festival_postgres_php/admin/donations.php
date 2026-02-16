<?php
session_start();
require_once __DIR__ . "/../includes/config.php";

if (empty($_SESSION['admin_id'])) { 
    header('Location: login.php'); 
    exit; 
}

// CSV export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="donations.csv"');

    $out = fopen('php://output', 'w');

    // Header row
    fputcsv($out, ['ID', 'Donor Name', 'Amount', 'Mode', 'Note', 'Created At']);

    $stmt = $pdo->query("SELECT id, donor_name, amount, mode, note, created_at FROM donations ORDER BY created_at DESC");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($out, $row);
    }

    fclose($out);
    exit;
}

// Fetch donations
$stmt = $pdo->query("SELECT id, donor_name, amount, mode, note, created_at FROM donations ORDER BY created_at DESC");
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <div class="d-flex justify-content-between mb-3">
    <h4>Donations</h4>
    <a class="btn btn-outline-secondary" href="donations.php?export=csv">Export CSV</a>
  </div>

  <table class="table table-striped">
    <a class="btn btn-primary" href="add_donation.php">+ Add Donation</a>

    <thead>
      <tr>
        <th>ID</th>
        <th>Donor</th>
        <th>Amount</th>
        <th>Mode</th>
        <th>Note</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($donations as $d): ?>
        <tr>
          <td><?= htmlspecialchars($d['id']) ?></td>
          <td><?= htmlspecialchars($d['donor_name']) ?></td>
          <td>₹<?= htmlspecialchars($d['amount']) ?></td>
          <td><?= htmlspecialchars($d['mode']) ?></td>
          <td><?= htmlspecialchars($d['note']) ?></td>
          <td><?= htmlspecialchars($d['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/_footer.php'; ?>
