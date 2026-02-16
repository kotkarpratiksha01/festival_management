<?php
require_once __DIR__ . "/../includes/config.php";

$q = "
SELECT b.id,b.user_name,b.total_amount,b.booking_status,
COALESCE(SUM(p.paid_amount),0) AS paid,
(b.total_amount - COALESCE(SUM(p.paid_amount),0)) AS remaining
FROM bookings b
LEFT JOIN payments p ON b.id=p.booking_id
GROUP BY b.id
";

foreach ($conn->query($q) as $r) {
  echo "
  Booking #{$r['id']} |
  {$r['user_name']} |
  Paid: ₹{$r['paid']} |
  Remaining: ₹{$r['remaining']} |
  Status: {$r['booking_status']} <br>
  ";
}
