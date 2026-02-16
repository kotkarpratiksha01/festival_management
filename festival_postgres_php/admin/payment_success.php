<?php
require_once __DIR__ . "/../includes/config.php";

$id = $_POST['id'];
$amt = $_POST['amt'];
$type = $_POST['type'];
$method = $_POST['method'];

$txn = "TXN".rand(100000,999999);

$status = ($type == 'advance') ? 'partial' : 'paid';

$conn->prepare("
INSERT INTO payments
(booking_id,paid_amount,payment_type,payment_method,payment_status,transaction_id)
VALUES (?,?,?,?,?,?)
")->execute([$id,$amt,$type,$method,$status,$txn]);

if ($type == 'advance') {
  $conn->prepare("
    UPDATE bookings SET booking_status='confirmed' WHERE id=?
  ")->execute([$id]);
}

echo "<h2>Payment Success ✅</h2>";
echo "Transaction: $txn <br>";
echo "Status: $status <br>";

if ($type == 'advance') {
  echo "<a href='remaining_payment.php?id=$id'>Pay Remaining</a>";
}
?>
