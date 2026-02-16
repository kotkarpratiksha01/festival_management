<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare('DELETE FROM volunteers WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: volunteers.php'); exit;
}
$stmt = $pdo->query('SELECT v.*, u.name AS added_by_name FROM volunteers v LEFT JOIN users u ON v.added_by = u.id ORDER BY v.id DESC');
$volunteers = $stmt->fetchAll();
require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <div class="d-flex justify-content-between mb-3">
    <h4>Volunteers</h4>
    <a class="btn btn-success" href="add_volunteer.php">Add Volunteer</a>
  </div>
  <table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Task</th><th>Status</th><th>Added By</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($volunteers as $v): ?>
      <tr>
        <td><?=htmlspecialchars($v['id'])?></td>
        <td><?=htmlspecialchars($v['name'])?></td>
        <td><?=htmlspecialchars($v['task'])?></td>
        <td><?=htmlspecialchars($v['status'])?></td>
        <td><?=htmlspecialchars($v['added_by_name'] ?? '-')?></td>
        <td><a class="btn btn-sm btn-primary" href="edit_volunteer.php?id=<?= $v['id'] ?>">Edit</a>
            <a class="btn btn-sm btn-danger" href="volunteers.php?delete=<?= $v['id'] ?>" onclick="return confirm('Delete?')">Delete</a></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
