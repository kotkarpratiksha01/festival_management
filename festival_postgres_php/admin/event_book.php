<?php
require_once __DIR__ . '/../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Event</title>
<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

/* ================= BODY BACKGROUND ================= */
body{
  min-height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  padding:20px;

  background:
    radial-gradient(circle at top left, #ff2f92 0%, transparent 35%),
    radial-gradient(circle at bottom right, #6366f1 0%, transparent 40%),
    linear-gradient(135deg,#0f0f14,#1a1a25);
 background-size:cover;
  color:var(--text);
  background-size:cover;
  color:var(--text);
  background-position:center;
  background-repeat:no-repeat;
}

/* ================= MAIN BOX ================= */
.box{
  background:rgba(255,255,255,0.95);
  width:500px;
  padding:50px 45px;
  border-radius:22px;
  box-shadow:0 25px 60px rgba(0,0,0,.25);
  backdrop-filter:blur(8px);
  animation:fadeUp .6s ease;
}

@keyframes fadeUp{
  from{
    opacity:0;
    transform:translateY(30px);
  }
  to{
    opacity:1;
    transform:translateY(0);
  }
}

.box h3{
  text-align:center;
  font-size:26px;
  margin-bottom:25px;
  color:#111827;
}

/* ================= FORM ELEMENTS ================= */
label{
  display:block;
  margin-top:14px;
  font-size:14px;
  font-weight:600;
  color:#374151;
}

input,
select{
  width:100%;
  padding:12px 14px;
  margin-top:6px;
  font-size:14px;
  border-radius:10px;
  border:2px solid #e5e7eb;
  outline:none;
  transition:.3s;
}

input:focus,
select:focus{
  border-color:#6366f1;
  box-shadow:0 0 0 3px rgba(99,102,241,.25);
}

/* ================= TOTAL BOX ================= */
.total{
  background:#111827;
  color:#fff;
  padding:14px 18px;
  border-radius:14px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-top:18px;
  font-weight:600;
  font-size:15px;
}

/* ================= BUTTONS ================= */
button{
  width:100%;
  padding:14px;
  margin-top:15px;
  font-size:16px;
  font-weight:700;
  border:none;
  border-radius:14px;
  cursor:pointer;
  transition:.3s;
}

/* Submit */
button[type="submit"]{
  background:linear-gradient(135deg,#6366f1,#4f46e5);
  color:#fff;
}

button[type="submit"]:hover{
  transform:translateY(-2px);
  box-shadow:0 12px 30px rgba(79,70,229,.5);
}

/* Reset */
.reset{
  background:#ef4444;
  color:#fff;
}

.reset:hover{
  background:#dc2626;
  box-shadow:0 10px 25px rgba(239,68,68,.45);
}

/* ================= RESPONSIVE ================= */
@media(max-width:600px){
  .box{
    width:100%;
    padding:40px 25px;
  }
}


 
</style>
</head>

<body>
<div class="box">
<h3>🎫 Event Booking</h3>

<form action="book_event.php" method="POST">

<label>User Name</label>
<input type="text" name="user_name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Mobile</label>
<input type="text" name="mobile" required>

<label>Event</label>
<select name="event_id" id="eventSelect" required>
<option value="">Select Event</option>
<option value="1" data-price="500">Music Night (₹500)</option>
<option value="2" data-price="300">Birthday Party (₹300)</option>
<option value="3" data-price="400">Wedding Night (₹400)</option>
<option value="4" data-price="400">Corporate Event (₹400)</option>
<option value="5" data-price="200">New Year Party (₹200)</option>
<option value="6" data-price="100">Family Gathering (₹100)</option>
</select>

<label>Tickets</label>
<input type="number" name="tickets" id="tickets" value="1" min="1" required>

<div class="total">
  <span>Total</span>
  <span>₹ <span id="total">0</span></span>
</div>

<input type="hidden" name="total_amount" id="total_amount" value="0">

<button type="submit">Submit Booking</button>
<button type="reset" class="reset">Reject</button>

</form>
</div>

<script>
const eventSelect = document.getElementById('eventSelect');
const ticketsInput = document.getElementById("tickets");
const totalSpan = document.getElementById("total");
const totalAmountInput = document.getElementById("total_amount");

function calc() {
  let selectedOption = eventSelect.selectedOptions[0];
  let price = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
  let tickets = parseInt(ticketsInput.value) || 0;
  let total = price * tickets;

  totalSpan.innerText = total ? total : 0;
  totalAmountInput.value = total ? total : 0;
}

// Update total when tickets or event changes
ticketsInput.addEventListener('input', calc);
eventSelect.addEventListener('change', calc);

// Initialize total on page load
calc();
</script>

</body>
</html>
