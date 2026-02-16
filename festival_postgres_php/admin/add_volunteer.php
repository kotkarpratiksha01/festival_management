<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $task = trim($_POST['task'] ?? '');
    $stmt = $pdo->prepare('INSERT INTO volunteers (name, phone, task, added_by) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $phone, $task, $_SESSION['admin_id']]);
    header('Location: volunteers.php'); exit;
}
require __DIR__ . '/_header.php';
?>
<div class="card p-3">
  <h4>Add Volunteer</h4>
  <form method="post">
    <input class="form-control mb-2" name="name" placeholder="Name" required>
    <input class="form-control mb-2" name="phone" placeholder="Phone">
    <input class="form-control mb-2" name="task" placeholder="Task (e.g., Stage, DJ)">
    <button class="btn btn-success" type="submit">Add</button>
    <a class="btn btn-link" href="volunteers.php">Cancel</a>
  </form>
</div>
<?php require __DIR__ . '/_footer.php'; ?>

