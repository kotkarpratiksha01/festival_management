<?php
session_start();
require_once __DIR__ . "/../includes/config.php";
if (!empty($_SESSION['admin_id'])) { header('Location: dashboard.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND role = ? LIMIT 1');
    $stmt->execute([$username, 'admin']);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $token = bin2hex(random_bytes(16));
        $t = $pdo->prepare('INSERT INTO api_tokens (user_id, token) VALUES (?, ?)');
        $t->execute([$admin['id'], $token]);
        $_SESSION['api_token'] = $token;
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/festival_postgres_php/assets/css/style.css">
<style>body{
  min-height:100vh;
  background: linear-gradient(135deg, #7c3aed, #ff4fa3);
  display:flex;
  align-items:center;
  justify-content:center;
  font-family: 'Segoe UI', sans-serif;
}

.card{
  border:none;
  border-radius:18px;
  background:#fff;
}

.card h4{
  text-align:center;
  font-weight:700;
  color:#7c3aed;
}

.form-control{
  border-radius:10px;
  padding:12px;
}

.form-control:focus{
  border-color:#7c3aed;
  box-shadow:0 0 0 .2rem rgba(124,58,237,.25);
}

.btn-primary{
  background:linear-gradient(135deg,#7c3aed,#ff4fa3);
  border:none;
  border-radius:30px;
  padding:12px;
  font-weight:600;
}

.btn-primary:hover{
  opacity:0.9;
}
</style>
</head><body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Admin Login</h4>
        <?php if(!empty($error)) echo '<div class="alert alert-danger">'.htmlspecialchars($error).'</div>'; ?>
        <form method="post">
          <div class="mb-2"><label>Email</label><input class="form-control" name="username" required></div>
          <div class="mb-3"><label>Password</label><input class="form-control" type="password" name="password" required></div>
          <button class="btn btn-primary w-100" type="submit">Login</button>
        </form>
      
    </div>
  </div>
</div>
</body></html>