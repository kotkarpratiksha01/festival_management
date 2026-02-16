<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }

// Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: users.php'); exit;
}

// Search / pagination simple
$q = $_GET['q'] ?? '';
if ($q) {
    $stmt = $pdo->prepare("SELECT id,name,email,role,created_at FROM users WHERE name ILIKE ? OR email ILIKE ? ORDER BY id DESC");
    $stmt->execute(["%$q%","%$q%"]);
} else {
    $stmt = $pdo->query('SELECT id,name,email,role,created_at FROM users ORDER BY id DESC');
}
$users = $stmt->fetchAll();

require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <div class="d-flex justify-content-between mb-3">
    <h4>Users</h4>
    <a class="btn btn-success" href="add_user.php">Add User</a>
  </div>

  <form class="mb-3" method="get">
    <div class="input-group">
      <input class="form-control" name="q" placeholder="Search name or email" value="<?=htmlspecialchars($q)?>">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </form>

  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr>
        <td><?=htmlspecialchars($u['id'])?></td>
        <td><?=htmlspecialchars($u['name'])?></td>
        <td><?=htmlspecialchars($u['email'])?></td>
        <td><?=htmlspecialchars($u['role'])?></td>
        <td><?=htmlspecialchars($u['created_at'])?></td>
        <td class="table-actions">
          <a class="btn btn-sm btn-primary" href="edit_user.php?id=<?= $u['id'] ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/_footer.php'; ?>