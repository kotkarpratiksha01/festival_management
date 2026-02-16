<?php
require_once "../includes/config.php";
$error = "";

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND role='user'");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if($user && password_verify($password,$user['password'])){
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header("Location: dashboard_user.php");
    exit;
  }else{
    $error = "Invalid email or password";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Login</title>

<style>
*{
  box-sizing:border-box;
}

body{
  min-height:100vh;
  background:
    linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
    url("https://wallpapercave.com/wp/wp10715816.jpg");
  background-size: cover;
  background-position: center;
  display:flex;
  justify-content:center;
  align-items:center;
  font-family: "Segoe UI", sans-serif;
}

/* Login Card */
.login-box{
  width:360px;
  background: rgba(0,0,0,0.55);
  backdrop-filter: blur(12px);
  border-radius: 14px;
  padding: 30px;
  color:#fff;
  box-shadow: 0 20px 40px rgba(0,0,0,0.6);
}

/* Heading */
.login-box h2{
  text-align:center;
  margin-bottom:25px;
  font-weight:500;
  letter-spacing:1px;
}

/* Error */
.error{
  background:#dc2626;
  padding:10px;
  border-radius:6px;
  margin-bottom:15px;
  text-align:center;
  font-size:14px;
}

/* Inputs */
.login-box input{
  width:100%;
  background: transparent;
  border:none;
  border-bottom:1px solid #aaa;
  color:#fff;
  padding:10px 5px;
  margin-bottom:22px;
  outline:none;
}

/* Button */
.login-box button{
  width:100%;
  background: linear-gradient(135deg,#a855f7,#ec4899);
  border:none;
  padding:12px;
  border-radius:25px;
  color:#fff;
  font-size:16px;
  cursor:pointer;
}

.login-box button:hover{
  opacity:0.9;
}

/* Links */
.link{
  text-align:center;
  margin-top:15px;
  font-size:13px;
}

.login-box a{
  color:#d8b4fe;
  text-decoration:none;
}
.login-box a:hover{
  text-decoration:underline;
}
</style>
</head>

<body>

<div class="login-box">
  <h2>Event Login</h2>

  <?php if($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
  </form>

  <div class="link">
    New user? <a href="user_register.php">Create account</a>
  </div>
</div>

</body>
</html>
