<?php
require_once "../includes/config.php";
$msg="";

if(isset($_POST['register'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

  try{
    $stmt=$pdo->prepare(
      "INSERT INTO users(name,email,password,role)
       VALUES(?,?,?,'user')"
    );
    $stmt->execute([$name,$email,$password]);
    $msg="Account created successfully!";
  }catch(PDOException $e){
    $msg="Email already exists!";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Signup</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI'}
body{

  min-height:100vh;
  background:
    linear-gradient(
      rgba(0,0,0,0.65),
      rgba(14, 14, 14, 0.65)
    ),
    url("https://wallpapercave.com/wp/wp10715816.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  display:flex;
  justify-content:center;
  align-items:center;
}

.box{
  width:400px;
  background:rgba(0,0,0,.6);
  padding:35px;
  color:#fff;
  box-shadow:0 30px 60px rgba(0,0,0,.8);
}
h2{text-align:center;margin-bottom:20px}
input{
  width:100%;
  padding:12px;
  background:transparent;
  border:none;
  border-bottom:1px solid #aaa;
  color:#fff;
  margin-bottom:18px;
}
input:focus{outline:none;border-color:#c76bff}
button{
  width:100%;
  padding:12px;
  border:none;
  background:#9b4dcc;
  color:#fff;
  cursor:pointer;
}
button:hover{opacity:.9}
.msg{text-align:center;margin-bottom:10px;color:#9dff9d}
.link{text-align:center;margin-top:15px}
.link a{color:#c76bff;text-decoration:none}
</style>
</head>
<body>

<div class="box">

<h2>Event Signup</h2>

<?php if($msg): ?><div class="msg"><?= $msg ?></div><?php endif; ?>

<form method="post">
  <input type="text" name="name" placeholder="Full Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button name="register">Create Account</button>
</form>

<div class="link">
  Already registered? <a href="user_login.php">Login</a>
</div>
</div>

</body>
</html>
