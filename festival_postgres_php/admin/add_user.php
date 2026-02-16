<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '123456', PASSWORD_DEFAULT);
    $role = $_POST['role'] ?? 'user';
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $email, $password, $role]);
    header('Location: users.php');
     exit;
}
require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <h4>Add User</h4>
  <form method="post">
    <input class="form-control mb-2" name="name" placeholder="Name" required>
    <input class="form-control mb-2" name="email" placeholder="Email" type="email" required>
    <input class="form-control mb-2" name="password" placeholder="Password" type="password" required>
    <select class="form-control mb-3" name="role"><option value="user">User</option><option value="admin">Admin</option><option value="volunteer">Volunteer</option></select>
    <button class="btn btn-success" type="submit">Add</button>
    <a class="btn btn-link" href="users.php">Cancel</a>
  </form>
</div>
<?php require __DIR__ . '/_footer.php'; ?>