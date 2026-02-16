<?php
require_once __DIR__ . '/../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get POST values safely
    $user_name = $_POST['user_name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $mobile    = $_POST['mobile'] ?? '';
    $event_id  = $_POST['event_id'] ?? '';   // NOTE: matches your form's 'name'
    $tickets   = $_POST['tickets'] ?? 0;
    $total     = $_POST['total_amount'] ?? 0;

    $stmt = $pdo->prepare("
    
        INSERT INTO tickets
        (user_name,email,mobile,event_id,tickets,total_amount)
        VALUES (?,?,?,?,?,?)
    ");

    $stmt->execute([
      $user_name,
      $email,
      $mobile,
      $event_id,
      $tickets,
      $total
    ]);

    header("Location: event_book.php?success=1");
    exit;
}
?>
