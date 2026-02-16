<?php
require_once __DIR__ . "/../includes/config.php";

$name = $_POST['event_name'];
$date = $_POST['event_date'];
$time = $_POST['event_time'];
$location = $_POST['location'];
$price = $_POST['price'];
$seats = $_POST['total_seats'];

$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);

$stmt = $pdo->prepare(
  "INSERT INTO events (event_name,event_date,event_time,location,price,total_seats,image)
   VALUES (?,?,?,?,?,?,?)"
);

$stmt->execute([$name,$date,$time,$location,$price,$seats,$image]);

header("Location: add_event.php");
