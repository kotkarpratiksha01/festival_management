<?php
require_once __DIR__ . "/../includes/config.php";
$events = $pdo->query("SELECT * FROM events")->fetchAll();
?>

<h2>Available Events</h2>

<?php foreach($events as $e){ ?>
<div style="border:1px solid #ccc;padding:15px;margin:15px;">
  <img src="../uploads/<?= $e['image'] ?>" width="200"><br>
  <h3><?= $e['event_name'] ?></h3>
  <p><?= $e['location'] ?></p>
  <p>₹<?= $e['price'] ?></p>

  <form action="book_ticket.php" method="POST">
    <input type="hidden" name="event_id" value="<?= $e['id'] ?>">
    <input type="number" name="tickets" value="1" min="1">
    <button>Book</button>
  </form>
</div>
<?php } ?>
