<?php
// Check if date and event data are provided
if (isset($_GET['date']) && file_exists('events.json')) {
    $date = $_GET['date'];

    // Load existing events
    $events = json_decode(file_get_contents('events.json'), true);

    // Check if an event exists for this date
    if (isset($events[$date])) {
        $currentEvent = $events[$date];
    }

    // If the form is submitted, update the event
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updatedEvent = $_POST['event'];

        // Update the event in the JSON data
        $events[$date] = $updatedEvent;
        file_put_contents('events.json', json_encode($events));

        // Redirect back to the calendar
        header('Location: calendar.php');
        exit();
    }
} else {
    echo "Event not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event for <?php echo $date; ?></h1>

    <form action="edit.php?date=<?php echo $date; ?>" method="post">
        <label for="event">Event:</label>
        <input type="text" id="event" name="event" value="<?php echo htmlspecialchars($currentEvent); ?>" required>
        <button type="submit">Update Event</button>
    </form>
</body>
</html>
