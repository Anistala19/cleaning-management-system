<?php
if (isset($_GET['date']) && file_exists('events.json')) {
    $date = $_GET['date'];

    // Load existing events
    $events = json_decode(file_get_contents('events.json'), true);

    // Check if an event exists for this date
    if (isset($events[$date])) {
        // Remove the event from the array
        unset($events[$date]);

        // Save updated events to the JSON file
        file_put_contents('events.json', json_encode($events[$date]));

        // Redirect back to the calendar
        header('Location: calendar.php');
        exit();
    } else {
        echo "Event not found!";
    }
} else {
    echo "No date provided or events file not found!";
}
?>
