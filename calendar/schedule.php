<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $event = $_POST['event'];

    // Load existing events
    $events = [];
    if (file_exists('events.json')) {
        $events = json_decode(file_get_contents('events.json'), true);
    }

    // Add the new event
    $events[$date] = $event;

    // Save events back to the JSON file
    file_put_contents('events.json', json_encode($events));

    // Redirect back to the calendar
    header('Location: calendar.php');
    exit();
}
?>

