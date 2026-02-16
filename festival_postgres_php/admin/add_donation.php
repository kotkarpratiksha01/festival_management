<?php
session_start();
require_once "../includes/config.php";

if (empty($_SESSION['admin_id'])) { 
    header('Location: login.php'); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor = $_POST['donor_name'];
    $amount = $_POST['amount'];
    $mode = $_POST['mode'];
    $note = $_POST['note'];

    $stmt = $pdo->prepare("INSERT INTO donations (donor_name, amount, mode, note) VALUES (?,?,?,?)");
    $stmt->execute([$donor, $amount, $mode, $note]);

    header("Location: donations.php");
    exit;
}

require "_header.php";
?>

<div class="card p-3">
  <h3>Add Donation</h3>
  <form method="post">

    <label>Donor Name</label>
    <input class="form-control" name="donor_name">

    <label>Amount (₹)</label>
    <input class="form-control" name="amount" type="number" required>

    <label>Mode</label>
    <select name="mode" class="form-control">
      <option>Cash</option>
      <option>Online</option>
      <option>Bank Transfer</option>
      <option>Other</option>
    </select>

    <label>Note</label>
    <textarea class="form-control" name="note"></textarea>

    <br>
    <button class="btn btn-primary">Save Donation</button>
  </form>
</div>

<?php require "_footer.php"; ?>
