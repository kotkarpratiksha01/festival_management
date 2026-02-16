<?php
require_once __DIR__ . "/../includes/config.php";

/* ADD EVENT */
if (isset($_POST['add_event'])) {
    $sql = "INSERT INTO events 
    (festival_id,name,event_date,venue,entry_fee,max_participants)
    VALUES (?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['festival_id'],
        $_POST['name'],
        $_POST['event_date'],
        $_POST['venue'],
        $_POST['entry_fee'],
        $_POST['max_participants']
    ]);
}

/* FETCH EVENTS */
$events = $pdo->query("
 SELECT e.*, f.name AS festival 
 FROM events e
 JOIN festivals f ON f.id=e.festival_id
")->fetchAll();

/* FETCH FESTIVALS */
$festivals = $pdo->query("SELECT * FROM festivals")->fetchAll();
?>

<h3>Add Event</h3>
<form method="post">
<select name="festival_id" required>
<?php foreach($festivals as $f): ?>
<option value="<?= $f['id'] ?>"><?= $f['name'] ?></option>
<?php endforeach; ?>
</select>

<input name="name" placeholder="Event Name" required>
<input type="datetime-local" name="event_date" required>
<input name="venue" placeholder="Venue">
<input name="entry_fee" placeholder="Fee">
<input name="max_participants" placeholder="Max Participants">
<button name="add_event">Add Event</button>
</form>

<hr>

<h3>All Events</h3>
<?php foreach($events as $e): ?>
<p>
<b><?= $e['name'] ?></b> | <?= $e['festival'] ?> |
₹<?= $e['entry_fee'] ?>
</p>
<?php endforeach; ?>