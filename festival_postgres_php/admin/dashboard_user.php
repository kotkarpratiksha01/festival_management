<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Event Planning</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
:root{
  --primary-color: #0b0bf1;
  --secondary-color: #ff4fa3;
  --hero-overlay: rgba(0,0,0,0.45);
  --font-color: #111;
  --light-bg: #f5f7ff;
}

/* RESET */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', Arial, sans-serif;
}

html {
  scroll-behavior: smooth;
}

/* NAVBAR */
nav{
 background: #c22fcdff;
  padding:18px 50px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  position:sticky;
  top:0;
  z-index:100;
}

nav .logo{
  color:#fff;
  font-size:22px;
  font-weight:700;
}

nav ul{
  list-style:none;
  display:flex;
  gap:25px;
}

nav ul li a{
  text-decoration:none;
  color:#fff;
  font-weight:500;
  transition:.3s;
}

nav ul li a:hover{
  color:var(--secondary-color);
}

.menu-toggle{
  display:none;
  font-size:28px;
  color:#fff;
  cursor:pointer;
}
.logo-wrap{
  display:flex;
  align-items:center;
  gap:10px;
  font-weight:700;
  color:#fff;
}

.logo-wrap span{
  font-size:18px;
}

.logo-icon{
  width:38px;
  height:38px;
  background:linear-gradient(135deg,#ff9800,#ff2f92);
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  font-size:16px;
}


/* HERO SECTION */
.hero{
  height:90vh;
  background:
    linear-gradient(var(--hero-overlay), var(--hero-overlay)),
    url("event-management.jpg") center/cover no-repeat;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  color:#fff;
  flex-direction:column;
}

.hero h4{
  color:yellow;
  letter-spacing:2px;
  margin-bottom:10px;
  font-size:20px;
}

.hero h1{
  font-size:48px;
  font-weight:800;
  margin-bottom:25px;
}

.hero span{
  color:#ff3;
}

.hero a{
  display:inline-block;
  padding:14px 40px;
  background:#fff;
  color:var(--font-color);
  border-radius:30px;
  font-weight:600;
  text-decoration:none;
  transition:.3s;
}

.hero a:hover{
  background:var(--secondary-color);
  color:#fff;
}

/* INFO SECTION */
.info-section{
  padding:80px 60px;
  background:var(--light-bg);
  text-align:center;
}

.info-section h2{
  font-size:36px;
  margin-bottom:15px;
}

.info-section p{
  max-width:700px;
  margin:0 auto 50px;
  color:#555;
  line-height:1.7;
}

/* INFO CARDS */
.info-cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:35px;
}

.info-card{
  background:#fff;
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 20px 40px rgba(0,0,0,0.15);
  transition:.3s;
}

.info-card:hover{
  transform:translateY(-12px);
}

.info-card img{
  width:100%;
  height:220px;
  object-fit:cover;
}

.info-card .text{
  padding:25px;
}

.info-card h3{
  margin-bottom:10px;
  color:var(--primary-color);
}

.info-card p{
  font-size:15px;
  color:#555;
  line-height:1.6;
}

.info-card a{
  display:inline-block;
  margin-top:15px;
  text-decoration:none;
  background:var(--primary-color);
  color:#fff;
  padding:10px 22px;
  border-radius:25px;
  font-size:14px;
  transition:.3s;
}

.info-card a:hover{
  background:var(--secondary-color);
}

/* PRICE SECTION */
.price-section{
  background:var(--light-bg);
  padding:80px 50px;
  text-align:center;
}

.price-section h2{
  font-size:36px;
  margin-bottom:15px;
  color:var(--font-color);
}

.price-section p{
  max-width:700px;
  margin:0 auto 50px;
  color:#555;
  line-height:1.6;
}

/* PRICE CARDS */
.price-cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:30px;
}

.price-card{
  background:#fff;
  border-radius:20px;
  padding:30px 20px;
  box-shadow:0 20px 40px rgba(0,0,0,0.1);
  transition:.3s;
}

.price-card:hover{
  transform:translateY(-10px);
}

.price-card.popular{
  border:2px solid var(--secondary-color);
}

.price-card h3{
  font-size:22px;
  margin-bottom:15px;
  color:var(--primary-color);
}

.price-card .price{
  font-size:28px;
  font-weight:700;
  margin-bottom:20px;
  color:var(--primary-color);
}

.price-card ul{
  list-style:none;
  padding:0;
  margin:0 0 25px 0;
}

.price-card ul li{
  margin:12px 0;
  color:#555;
}

.price-card a{
  display:inline-block;
  padding:12px 25px;
  background:var(--primary-color);
  color:#fff;
  text-decoration:none;
  border-radius:30px;
  font-weight:600;
  transition:.3s;
}

.price-card a:hover{
  background:var(--secondary-color);
}

/* REVIEW SECTION */
.review-section{
  padding:80px 60px;
  background:#fff;
  text-align:center;
}

.review-section h2{
  font-size:36px;
  margin-bottom:15px;
  color:var(--primary-color);
}

.review-section p{
  max-width:700px;
  margin:0 auto 50px;
  color:#555;
  line-height:1.6;
}

.review-cards{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:30px;
}

.review-card{
  background:var(--light-bg);
  padding:25px 20px;
  border-radius:20px;
  box-shadow:0 15px 30px rgba(0,0,0,0.1);
  transition:.3s;
}

.review-card:hover{
  transform:translateY(-8px);
}

.review-card img{
  width:80px;
  height:80px;
  border-radius:50%;
  object-fit:cover;
  margin-bottom:15px;
}

.review-card h3{
  font-size:18px;
  color:var(--primary-color);
  margin-bottom:10px;
}

.review-card p{
  font-size:15px;
  color:#555;
  line-height:1.6;
}

/* CONTACT SECTION */
.contact-section{
  padding:80px 60px;
  background:var(--light-bg);
  text-align:center;
}

.contact-section h2{
  font-size:36px;
  margin-bottom:15px;
  color:var(--primary-color);
}

.contact-section p{
  max-width:700px;
  margin:0 auto 50px;
  color:#555;
  line-height:1.6;
}

.contact-container{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:40px;
  max-width:1000px;
  margin:0 auto;
}

.contact-info{
  display:flex;
  flex-direction:column;
  gap:25px;
}

.contact-info .info-box h3{
  font-size:18px;
  margin-bottom:8px;
  color:var(--primary-color);
}

.contact-info .info-box p{
  font-size:15px;
  color:#555;
}

.contact-form{
  display:flex;
  flex-direction:column;
  gap:20px;
}

.contact-form input,
.contact-form textarea{
  padding:15px 20px;
  border-radius:10px;
  border:1px solid #ccc;
  font-size:15px;
  resize:none;
}

.contact-form input:focus,
.contact-form textarea:focus{
  outline:none;
  border-color:var(--primary-color);
  box-shadow:0 0 8px rgba(11,11,241,0.2);
}

.contact-form button{
  padding:14px 30px;
  background:var(--primary-color);
  color:#fff;
  border:none;
  border-radius:30px;
  font-size:16px;
  font-weight:600;
  cursor:pointer;
  transition:.3s;
}

.contact-form button:hover{
  background:var(--secondary-color);
}



*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

body{
  background:#000;
  color:#fff;
}

/* ===== CONTACT SECTION ===== */
.contact-section{
  min-height:100vh;
  background:
    linear-gradient(rgba(0,0,0,.85), rgba(0,0,0,.85)),
    url("assets/img/contact-bg.jpg") center/cover no-repeat;
  display:flex;
  justify-content:center;
  align-items:center;
  padding:60px 20px;
}

/* CARD */
.contact-card{
  max-width:900px;
  width:100%;
  text-align:center;
}

/* TITLE */
.contact-card h1{
  font-size:42px;
  margin-bottom:15px;
  color:#ff4fa3;
}

.contact-card p{
  color:#ccc;
  max-width:600px;
  margin:0 auto 35px;
  font-size:15px;
}

/* EMAIL BOX */
.subscribe-box{
  display:flex;
  justify-content:center;
  margin-bottom:40px;
}

.subscribe-box input{
  width:60%;
  max-width:400px;
  padding:14px 18px;
  border:none;
  border-radius:30px 0 0 30px;
  outline:none;
}

.subscribe-box button{
  padding:14px 22px;
  border:none;
  background:#4f8cff;
  color:#fff;
  border-radius:0 30px 30px 0;
  cursor:pointer;
  font-size:16px;
}

.subscribe-box button:hover{
  opacity:.9;
}

/* SOCIAL */
.social{
  margin-top:30px;
}

.social span{
  display:block;
  margin-bottom:15px;
  font-size:14px;
  color:#aaa;
}

.social a{
  display:inline-block;
  margin:0 10px;
  color:#fff;
  font-size:18px;
  width:42px;
  height:42px;
  line-height:42px;
  border-radius:50%;
  background:rgba(255,255,255,.08);
  transition:.3s;
}

.social a:hover{
  background:#ff4fa3;
  transform:translateY(-4px);
}


/* RESPONSIVE */
@media(max-width:768px){
  .contact-card h1{font-size:32px}
  .subscribe-box{
    flex-direction:column;
  }
  .subscribe-box input,
  .subscribe-box button{
    width:100%;
    border-radius:30px;
  }
  .subscribe-box button{
    margin-top:10px;
  }
}

/* LOGO & HEADER */
.header {
  text-align:center;
  padding:60px 20px 20px 20px;
}

.header h1 {
  font-size:50px;
  font-weight:700;
  background: linear-gradient(90deg, #ff2f92, #7c3aed, #6366f1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* NAV MENU */
.nav {
  display:flex;
  justify-content:center;
  gap:40px;
  margin-bottom:50px;
}

.nav a {
  text-decoration:none;
  color:#fff;
  font-weight:500;
}

.nav a:hover {
  color:#7c3aed;
}

/* EMAIL SUBSCRIBE INPUT */
.subscribe {
  display:flex;
  justify-content:center;
  margin-bottom:50px;
}

.subscribe input {
  padding:15px 20px;
  width:350px;
  border-radius:50px 0 0 50px;
  border:none;
  outline:none;
  font-size:16px;
}

.subscribe button {
  padding:15px 20px;
  border:none;
  background:#6366f1;
  color:#fff;
  border-radius:0 50px 50px 0;
  cursor:pointer;
  font-size:18px;
}

.subscribe button:hover {
  background:#7c3aed;
}

/* DESCRIPTION */
.description {
  max-width:600px;
  text-align:center;
  margin-bottom:50px;
  font-size:16px;
  line-height:1.6;
  color:#ddd;
}

/* SOCIAL ICONS */
.social {
    justify-content:center; 
  display:flex;
  gap:20px;
  margin-bottom:50px;
}

.social a {
  color:#fff;
  font-size:24px;
  transition:0.3s;
}

.social a:hover {
  color:#7c3aed;
}

</style>
<!-- NAVBAR -->
<nav>
 <div class="logo-wrap">
  <div class="logo-icon">E</div>
  <span>EVENT.COM</span>
</div>
  <div class="menu-toggle" onclick="toggleMenu()">☰</div>
  <ul id="nav-links">
    <li><a href="#home">HOME</a></li>
    <li><a href="#services">SERVICES</a></li>
    <li><a href="#price">PRICE</a></li>
    <li><a href="#review">REVIEW</a></li>
    <li><a href="#contact">CONTACT</a></li>
    <li><a href="user_tickets_info.php">TICKETS</a></li>
  <li><a href="user_login.php">LOGIN</a></li>
     <li><a href="login.php">ADMIN</a></li>
  </ul>
</nav>

<!-- HERO -->
<section id="home" class="hero">
  <h4>LET'S PLAN EVENT</h4>
  <h1>LET'S ORGANIZE EVENTS WITH US <span>❤</span></h1>
  <a href="user_tickets_info.php">CONTACT US</a>
</section>

<!-- INFO SECTION -->
<section id="services" class="info-section">
  <h2>Our Event Services</h2>
  <p>We provide complete event management solutions in Pune with professional planning, decoration, and execution.</p>
  <div class="info-cards">
    <div class="info-card">
      <img src="wedding-planner-events.jpeg" alt="Wedding Event">
      <div class="text">
        <h3>Wedding Events</h3>
        <p>Elegant weddings with full decoration, catering, and entertainment.</p>
        <a href="#">View More</a>
      </div>
    </div>
     <div class="info-card">
      <img src="birthday_party.jpg" alt="Birthday Party">
      <div class="text">
        <h3>Birthday Parties</h3>
        <p>Fun-filled birthday celebrations with colorful themes and activities</p>
        <a href="#">View More</a>
      </div>
    </div>
       <div class="info-card">
      <img src="c.jpeg" alt="Birthday Party">
      <div class="text">
        <h3>Corporate Events</h3>
        <p>Professional corporate events, meetings, and team-building solutions.</p>
        <a href="#">View More</a>
      </div>
    </div>
    <div class="info-card">
      <img src="luxery_gu.jpg" alt="Luxury Gathering">
      <div class="text">
        <h3>Marriage Reception</h3>
        <p>Celebrate festivals with vibrant decor and memorable experiences.</p>
        <a href="#">View More</a>
      </div>
    </div>
      <div class="info-card">
      <img src="a1.jpeg" alt="Birthday Party">
      <div class="text">
        <h3>Engagement & Special Ceremonies</h3>
        <p>Personalized engagement parties and ceremonies with complete planning.</p>
        <a href="#">View More</a>
      </div>
    </div>
      <div class="info-card">
      <img src="night.jpg" alt="Night Wedding">
      <div class="text">
        <h3>Night Wedding</h3>
        <p>Under the stars and glowing lights, join us for a magical night wedding celebration.</p>
        <a href="#">View More</a>
      </div>
    </div>
      <div class="info-card">
      <img src="a2.webp" alt="Birthday Party">
      <div class="text">
        <h3>Haldi Ceremony</h3>
        <p>The Haldi ceremony is a vibrant pre-wedding ritual filled with color, joy, and blessings..</p>
        <a href="#">View More</a>
      </div>
    </div>
    <div class="info-card">
      <img src="event.webp" alt="Party Event">
      <div class="text">
        <h3>Party Event 🎉</h3>
        <p>Fun, music, dance, and the joyful tradition of turmeric blessings..</p>
        <a href="#">View More</a>
      </div>
    </div>
</section>

<!-- PRICE / PACKAGES SECTION -->
<section id="price" class="price-section">
  <h2>Our Event Packages</h2>
  <p>Choose a package that fits your event needs. Transparent pricing, no hidden charges.</p>
  <div class="price-cards">
    <div class="price-card">
      <h3>Basic</h3>
      <p class="price">$299</p>
      <ul>
        <li>Venue Decoration</li>
        <li>Basic Catering</li>
        <li>Event Planning</li>
      </ul>
      <a href="#">Book Now</a>
    </div>
    <div class="price-card popular">
      <h3>Standard</h3>
      <p class="price">$599</p>
      <ul>
        <li>Venue Decoration</li>
        <li>Premium Catering</li>
        <li>Photography & Planning</li>
      </ul>
      <a href="#">Book Now</a>
    </div>
    <div class="price-card">
      <h3>Premium</h3>
      <p class="price">$999</p>
      <ul>
        <li>Luxury Decoration</li>
        <li>Gourmet Catering</li>
        <li>Full Event Management</li>
      </ul>
      <a href="#">Book Now</a>
    </div>
  </div>
</section>

<!-- REVIEW SECTION -->
<section id="review" class="review-section">
  <h2>What Our Clients Say</h2>
  <p>Hear from our satisfied clients and see why they choose us for their events.</p>
  <div class="review-cards">
    <div class="review-card">
      <img src="client1.jpg" alt="Client 1">
      <h3>Priya Sharma</h3>
      <p>"The wedding planning was perfect! Every detail was handled professionally."</p>
    </div>
    <div class="review-card">
      <img src="client2.jpg" alt="Client 2">
      <h3>Rohit Verma</h3>
      <p>"Corporate event was flawless. Excellent coordination and decoration."</p>
    </div>
    <div class="review-card">
      <img src="client3.jpg" alt="Client 3">
      <h3>Meera Joshi</h3>
      <p>"Birthday party for my daughter was amazing! Highly recommend their team."</p>
    </div>
  </div>
</section>

<!-- CONTACT SECTION -->

<div id="contact" class="header">
  <h1>Event</h1>
</div>

<div class="nav">
  <a href="#">Home</a>
  <a href="#">Contact</a>
  <a href="#">Pages</a>
  <a href="#">Blog</a>
  <a href="#">Event</a>
  <a href="#">About</a>
</div>

<div class="subscribe">
  <input type="email" placeholder="Email Address">
  <button><i class="fas fa-paper-plane"></i></button>
</div>

<center><div class="description">
  Phosfluorescently foster distributed leadership skills and covalent catalysts for change. Holistically myocardinate installed base methods of empowerment before quality best practices.
</div></center>

<center><div class="social">
  <a href="#"><i class="fab fa-facebook-f"></i></a>
  <a href="#"><i class="fab fa-twitter"></i></a>
  <a href="#"><i class="fab fa-instagram"></i></a>
  <a href="#"><i class="fab fa-linkedin-in"></i></a>
  <a href="#"><i class="fab fa-youtube"></i></a>
</div></center>
</section>

<!-- FOOTER -->

<script>
  const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

  function contactClick(){
    if(isLoggedIn){
      // login आहे → contact / tickets page
      window.location.href = "user_tickets_info.php";
    }else{
      // login नाही → login page
      alert("Please login first to contact us!");
      window.location.href = "user_login.php";
    }
  }
function toggleMenu(){
  document.getElementById('nav-links').classList.toggle('active');
}
</script>
</body>
</html>
