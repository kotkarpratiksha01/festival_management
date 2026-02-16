<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$id]); $user = $stmt->fetch();
if (!$user) { echo 'User not found'; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'user';
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?');
        $stmt->execute([$name, $email, $password, $role, $id]);
    } else {
        $stmt = $pdo->prepare('UPDATE users SET name=?, email=?, role=? WHERE id=?');
        $stmt->execute([$name, $email, $role, $id]);
    }
    header('Location: users.php'); exit;
}
require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <h4>Edit User</h4>
  <form method="post">
    <input class="form-control mb-2" name="name" value="<?=htmlspecialchars($user['name'])?>" required>
    <input class="form-control mb-2" name="email" value="<?=htmlspecialchars($user['email'])?>" type="email" required>
    <input class="form-control mb-2" name="password" placeholder="Leave blank to keep current password">
    <select class="form-control mb-3" name="role">
      <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
      <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
      <option value="volunteer" <?= $user['role']=='volunteer'?'selected':'' ?>>Volunteer</option>
    </select>
    <button class="btn btn-primary" type="submit">Save</button>
    <a class="btn btn-link" href="users.php">Cancel</a>
  </form>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
