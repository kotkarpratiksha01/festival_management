<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Festival Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:"Segoe UI", Arial, sans-serif;
}

body{
  background:#f8fafc;
  color:#0f172a;
}

/* ================= NAVBAR ================= */
.navbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:16px 60px;
  background:#020617;
  color:white;
}

.logo{
  font-size:22px;
  font-weight:bold;
}

.nav-links{
  display:flex;
  gap:25px;
}

.nav-links a{
  color:#cbd5f5;
  text-decoration:none;
  font-size:14px;
}

.nav-actions a{
  margin-left:15px;
  padding:8px 16px;
  border-radius:6px;
  text-decoration:none;
  font-size:14px;
}

.admin-btn{
  background:#ef4444;
  color:white;
}

.user-btn{
  background:#2563eb;
  color:white;
}

/* ================= HERO ================= */
.hero{
  display:flex;
  padding:70px 60px;
  align-items:center;
  gap:60px;
  background:linear-gradient(135deg,#020617,#020617cc);
  color:white;
}

.hero-text{
  flex:1;
}

.hero-text h1{
  font-size:48px;
  margin-bottom:20px;
}

.hero-text h1 span{
  color:#fb923c;
}

.hero-text p{
  font-size:17px;
  max-width:480px;
  opacity:0.9;
  margin-bottom:30px;
}

.hero-buttons a{
  display:inline-block;
  margin-right:15px;
  padding:12px 24px;
  border-radius:8px;
  text-decoration:none;
  color:white;
  font-weight:bold;
}

.hero-buttons .admin-btn{
  background:#ef4444;
}

.hero-buttons .user-btn{
  background:#2563eb;
}

.hero-img{
  flex:1;
}

.hero-img img{
  width:100%;
  border-radius:16px;
  box-shadow:0 30px 80px rgba(0,0,0,0.6);
}

/* ================= CONTENT ================= */
.section{
  padding:70px 60px;
  background:white;
}

.section h2{
  text-align:center;
  margin-bottom:40px;
  font-size:32px;
}

.cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
  gap:30px;
}

.card{
  background:#f1f5f9;
  padding:25px;
  border-radius:14px;
  text-align:center;
}

.card img{
  width:100%;
  border-radius:12px;
  margin-bottom:15px;
}

.card h3{
  margin-bottom:10px;
}

/* ================= CONTACT ================= */
.contact{
  background:#020617;
  color:white;
  padding:50px;
  text-align:center;
}

.contact h3{
  margin-bottom:15px;
}

.contact p{
  opacity:0.85;
}

/* ================= FOOTER ================= */
.footer{
  background:#020617;
  color:#94a3b8;
  text-align:center;
  padding:15px;
  font-size:14px;
}

/* ================= RESPONSIVE ================= */
@media(max-width:900px){
  .hero{
    flex-direction:column;
    text-align:center;
  }
  .navbar{
    flex-direction:column;
    gap:15px;
  }
}
</style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
  <div class="logo">FestivalSys</div>

  <div class="nav-links">
    <a href="#">Home</a>
    <a href="#">Events</a>
    <a href="#">Gallery</a>
    <a href="#">Contact</a>
  </div>

  <div class="nav-actions">
    <a href="admin/admin_login.php" class="admin-btn">Admin Login</a>
    <a href="user/user_login.php" class="user-btn">User Login</a>
  </div>
</div>

<!-- ================= HERO ================= -->
<div class="hero">
  <div class="hero-text">
    <h1><span>Craft</span> event experiences<br>your audience will love</h1>
    <p>
      Organize festivals, manage events, sell tickets,
      and track everything from one powerful platform.
    </p>

    <div class="hero-buttons">
      <a href="admin/admin_login.php" class="admin-btn">Admin Sign In</a>
      <a href="user/user_login.php" class="user-btn">User Sign In</a>
    </div>
  </div>

  <div class="hero-img">
    <!-- EVENT IMAGE -->
    <img src="assets/images/event.jpg" alt="Event Image">
  </div>
</div>

<!-- ================= CONTENT ================= -->
<div class="section">
  <h2>Our Events</h2>

  <div class="cards">
    <div class="card">
      <img src="assets/images/event1.jpg">
      <h3>Music Festival</h3>
      <p>Live concerts and DJ nights.</p>
    </div>

    <div class="card">
      <img src="assets/images/event2.jpg">
      <h3>Cultural Event</h3>
      <p>Traditional dance and programs.</p>
    </div>

    <div class="card">
      <img src="assets/images/event3.jpg">
      <h3>Food Carnival</h3>
      <p>Street food & live cooking shows.</p>
    </div>
  </div>
</div>

<!-- ================= CONTACT ================= -->
<div class="contact">
  <h3>Contact Us</h3>
  <p>Email: support@festival.com | Phone: +91 99999 99999</p>
</div>

<!-- ================= FOOTER ================= -->
<div class="footer">
  © 2026 Festival Management System | All Rights Reserved
</div>

</body>
</html>
