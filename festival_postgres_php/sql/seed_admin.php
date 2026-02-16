<?php
// sql/seed_admin.php
require_once __DIR__ . "/../includes/config.php";

$name = 'Admin';
$email = 'admin@example.com';
$plain = 'admin123';
$hashed = password_hash($plain, PASSWORD_DEFAULT);
$role = 'admin';

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo "Admin already exists.\n";
    exit;
}
$stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$name, $email, $hashed, $role])) {
    echo "Admin created: {$email} / {$plain}\n";
} else {
    echo "Insert failed.\n";
}
?>
