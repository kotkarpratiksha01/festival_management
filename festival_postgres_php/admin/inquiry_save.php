<?php
require_once __DIR__ . '/../includes/config.php';

$stmt = $pdo->prepare("
INSERT INTO inquiries
(full_name,email,mobile,contact_preference,event_type,message)
VALUES (?,?,?,?,?,?)
");

$stmt->execute([
  $_POST['full_name'],
  $_POST['email'],
  $_POST['mobile'],
  $_POST['contact_preference'],
  $_POST['event_type'],
  $_POST['message']
]);

header("Location: inquiry.php?success=1");
