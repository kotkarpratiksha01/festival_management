<?php
require_once __DIR__ . "/../includes/config.php";
$id = $_GET['id'];

$total = $conn->query("
  SELECT total_amount FROM bookings WHERE id=$id
")->fetchColumn();

$paid = $conn->query("
  SELECT COALESCE(SUM(paid_amount),0)
  FROM payments WHERE booking_id=$id
")->fetchColumn();

$remain = $total - $paid;
?>

<h3>Remaining Amount: ₹<?= $remain ?></h3>

<a href="pay.php?id=<?= $id ?>&amt=<?= $remain ?>&type=remaining">
<button>Pay Remaining</button>
</a>
