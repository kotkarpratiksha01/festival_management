<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

/* ================= THEME VARIABLES ================= */
:root{
  --bg: linear-gradient(135deg,#ffe6f0,#fff0f5);
  --card:#ffffff;
  --text:#333;
  --subtext:#555;
  --service-bg:#fff3e8;
  --primary:#ff2f92;
}

body.dark{
  --bg:#0f0f14;
  --card:#1a1a25;
  --text:#f1f1f1;
  --subtext:#c7c7c7;
  --service-bg:#14141f;
}

/* ================= BODY ================= */
body{
  background:var(--bg);
  min-height:100vh;
  color:var(--text);
  transition:.3s;
}

.navbar{
  background: #cf3ae9ff;;
  padding:15px 40px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  color:#fff;
}

body.dark .navbar{
  background:linear-gradient(135deg,#111,#1f1f2e);
}

.logo{
  font-size:22px;
  font-weight:700;
}

.menu{
  display:flex;
  align-items:center;
}

.menu a{
  color:#fff;
  text-decoration:none;
  margin-left:25px;
  font-weight:500;
}

.menu a:hover{
  text-decoration:underline;
}

.dark-btn{
  margin-left:20px;
  background:rgba(255,255,255,.2);
  border:none;
  color:#fff;
  padding:8px 12px;
  border-radius:8px;
  cursor:pointer;
}

/* ================= SERVICES ================= */
.services{
  padding:60px 0;
  background:var(--service-bg);
  text-align:center;
}

.services h2{
  font-size:36px;
  color:var(--primary);
  margin-bottom:40px;
}

.slider{
  overflow:hidden;
}

.slide-track{
  display:flex;
  width:calc(300px * 10);
  animation:scroll 20s linear infinite;
}

.slider:hover .slide-track{
  animation-play-state:paused;
}

@keyframes scroll{
  0%{transform:translateX(0);}
  100%{transform:translateX(-50%);}
}

.slide-card,
.card{
  width:280px;
  margin:0 15px;
  background:var(--card);
  border-radius:18px;
  box-shadow:0 15px 30px rgba(0,0,0,.15);
  transition:.4s;
}

.slide-card:hover,
.card:hover{
  transform:scale(1.05);
}

.slide-card img,
.card img{
  width:100%;
  height:200px;
  object-fit:cover;
  border-radius:18px 18px 0 0;
}

.slide-card h3,
.card h3{
  padding:15px;
  color:var(--text);
}

/* ================= WELCOME CARD ================= */
.welcome-container{
  display:flex;
  justify-content:center;
  padding:60px 20px;
}

.welcome-card{
  background:var(--card);
  padding:30px 40px;
  border-radius:20px;
  box-shadow:0 15px 35px rgba(0,0,0,.2);
  max-width:400px;
  text-align:center;
  transition:.3s;
}

.welcome-card p{
  color:var(--subtext);
  margin-bottom:25px;
}

.welcome-card .btn{
  background:#6366f1;
  color:#fff;
  padding:12px 25px;
  border-radius:12px;
  text-decoration:none;
  font-weight:600;
}

/* ================= FORM ================= */
.form-box{
  background:var(--card);
  padding:50px 40px;
  border-radius:25px;
  box-shadow:0 20px 50px rgba(255,47,146,.25);
  max-width:950px;
  margin:60px auto;
}

.form-box h2{
  text-align:center;
  color:var(--primary);
  margin-bottom:30px;
}

.form-box form{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:25px;
}

.form-box input,
.form-box textarea,
.form-box select{
  padding:15px 18px;
  border:2px solid #ffc0cb;
  border-radius:15px;
  font-size:15px;
}

.form-box textarea,
.form-box select{
  grid-column:1/-1;
}

.form-box button{
  grid-column:1/-1;
  padding:16px;
  background:linear-gradient(135deg,#ff6fb1,#ff2f92);
  color:#fff;
  border:none;
  border-radius:18px;
  font-size:18px;
  cursor:pointer;
}

/* ================= DARK MODE FIXES ================= */
body.dark h1,
body.dark h2,
body.dark h3,
body.dark p,
body.dark label{
  color:#fff;
}

body.dark .services{
  background:#14141f;
}

body.dark .slide-card,
body.dark .card,
body.dark .welcome-card,
body.dark .form-box{
  background:#1a1a25;
}

body.dark input,
body.dark textarea,
body.dark select{
  background:#0f0f14;
  color:#fff;
  border-color:#333;
}

body.dark option{
  background:#1a1a25;
}

@media(max-width:900px){
  .form-box form{
    grid-template-columns:1fr;
  }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
  <div class="logo">🎉 EventHub</div>
  <div class="menu">
    <a href="dashboard_user.php">Dashboard</a>
    <a href="#">Events</a>
    <a href="event_book.php">My Tickets</a>
    <a href="">Logout</a>
        <button class="dark-btn" onclick="toggleDark()">🌙</button>
  </div>
</div>

<!-- SERVICES / SLIDER -->
<section class="services">
  <h2>Our Services</h2>
  <div class="slider">
    <div class="slide-track">

      <div class="slide-card">
        <img src="m.jpg">
        <h3>Marriage Reception</h3>
      </div>

      <div class="slide-card">
        <img src="birthday_party.jpg">
        <h3>Birthday Party</h3>
      </div>

      <div class="slide-card">
        <img src="https://images.unsplash.com/photo-1504805572947-34fad45aed93">
        <h3>Corporate Event</h3>
      </div>

      <div class="slide-card">
        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622">
        <h3>Festival Event</h3>
      </div>

      <!-- duplicate for smooth loop -->
      <div class="slide-card">
        <img src="luxery_gu.jpg">
        <h3>Marriage Reception</h3>
      </div>
<div class="card">
  <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf">
  <h3>Engagement Ceremony</h3>
</div>

<div class="card">
  <img src="baby.webp">
  <h3>Baby Shower</h3>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4">
  <h3>Corporate Meeting</h3>
</div>

<div class="card">
  <img src="dj.jpg">
  <h3>DJ Night</h3>
</div>

<div class="card">
  <img src="a2.webp">
  <h3>Haldi Function</h3>
</div>

    </div>
  </div>
</section>

<!-- WELCOME CARD BELOW SLIDER -->
<div class="welcome-container">
  <div class="welcome-card">
    <h2>Welcome User 👋</h2>
    <p>
      You can explore upcoming events, view ticket details and book events easily.
      Enjoy a smooth event management experience.
    </p>
    <a href="event_book.php" class="btn">View Tickets</a>
  </div>
</div>
<div class="form-box">
<h2>📩 Inquiry Form</h2>

<form action="inquiry_save.php" method="POST">
  <input type="text" name="full_name" placeholder="Full Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="text" name="mobile" placeholder="Mobile" required>

  <label>Preferred Contact</label>
  <select name="contact_preference">
    <option>Email</option>
    <option>Mobile</option>
  </select>

  <label>Event Type</label>
  <select name="event_type">
    <option>Wedding</option>
    <option>Birthday</option>
    <option>Corporate</option>
    <option>Festival</option>
  </select>

  <textarea name="message" placeholder="Your Message"></textarea>

  <button type="submit">Submit Inquiry</button>
  <script>
function toggleDark(){
  document.body.classList.toggle("dark");
}
</script>

</form>
</div>

</body>
</html>
