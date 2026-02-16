<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
  background: linear-gradient(135deg,#a1c4fd,#c2e9fb,#fbc2eb,#ffd6a5);
  background-attachment: fixed;
  margin:0;
}

.sidebar{
  width:250px;
  position:fixed;
  left:0;
  top:0;
  padding:22px 18px;
  background: linear-gradient(180deg,#0f172a,#0b5ed7,#06b6d4);
  color:#fff;
}

.sidebar a{
  display:block;
  padding:12px 16px;
  margin-bottom:40px;
  border-radius:10px;
  color:#fff;
  text-decoration:none;
  font-weight:600;
}

.sidebar a:hover,
.sidebar a.active{
  background: rgba(255,255,255,0.15);
}

.content{
  margin-left:260px;
  padding:25px;
}

.topbar{
  background:#fff;
  padding:15px 25px;
  border-radius:12px;
  display:flex;
  justify-content:space-between;
}
</style>
</head>

<body>

<div class="sidebar">
  <h4 class="mb-4">🎵 Festival Admin</h4>

  <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF'])=='dashboard.php'?'active':'' ?>">
    <i class="bi bi-speedometer2 me-2"></i> Dashboard
  </a>

  <a href="users.php" class="<?= basename($_SERVER['PHP_SELF'])=='users.php'?'active':'' ?>">
    <i class="bi bi-people me-2"></i> Users
  </a>

  <a href="tickets.php" class="<?= basename($_SERVER['PHP_SELF'])=='tickets.php'?'active':'' ?>">
    <i class="bi bi-ticket-perforated me-2"></i> Tickets
  </a>
<!-- ✅ ADD THIS -->
<a href="inquiries.php" class="<?= basename($_SERVER['PHP_SELF'])=='inquiries.php'?'active':'' ?>">
  <i class="bi bi-chat-dots me-2"></i> Inquiries
</a>
  <a href="volunteers.php" class="<?= basename($_SERVER['PHP_SELF'])=='volunteers.php'?'active':'' ?>">
    <i class="bi bi-person-hearts me-2"></i> Volunteers
  </a>

  <a href="donations.php" class="<?= basename($_SERVER['PHP_SELF'])=='donations.php'?'active':'' ?>">
    <i class="bi bi-cash-stack me-2"></i> Donations
  </a>

  <a href="logout.php" class="mt-4">
    <i class="bi bi-box-arrow-right"></i> Logout
  </a>
</div>

<div class="content">
  <div class="topbar mb-4">
    <h3><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')) ?></h3>
    <span>Admin</span>
  </div>
