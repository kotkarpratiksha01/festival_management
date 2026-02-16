<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM volunteers WHERE id = ?');
$stmt->execute([$id]); $v = $stmt->fetch();
if (!$v) { echo 'Not found'; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $task = trim($_POST['task'] ?? '');
    $status = $_POST['status'] ?? 'assigned';
    $stmt = $pdo->prepare('UPDATE volunteers SET name=?, phone=?, task=?, status=? WHERE id=?');
    $stmt->execute([$name, $phone, $task, $status, $id]);
    header('Location: volunteers.php'); exit;
}
require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <h4>Edit Volunteer</h4>
  <form method="post">
    <input class="form-control mb-2" name="name" value="<?=htmlspecialchars($v['name'])?>" required>
    <input class="form-control mb-2" name="phone" value="<?=htmlspecialchars($v['phone'])?>">
    <input class="form-control mb-2" name="task" value="<?=htmlspecialchars($v['task'])?>">
    <select class="form-control mb-2" name="status">
      <option value="assigned" <?= $v['status']=='assigned'?'selected':'' ?>>Assigned</option>
      <option value="in_progress" <?= $v['status']=='in_progress'?'selected':'' ?>>In Progress</option>
      <option value="completed" <?= $v['status']=='completed'?'selected':'' ?>>Completed</option>
    </select>
    <button class="btn btn-primary" type="submit">Save</button>
    <a class="btn btn-link" href="volunteers.php">Cancel</a>
  </form>
</div>
<?php require __DIR__ . '/_footer.php'; ?>
