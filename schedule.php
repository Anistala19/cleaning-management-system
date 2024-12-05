<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $event = $_POST['event'];

    $events = [];

    if (file_exists('events.json')) {
        $events = json_decode(file_get_contents('events.json'), true);
    }

    $events[] = ['date' => $date, 'event' => $event];
    file_put_contents('events.json', json_encode($events));

    header('Location: calendar.php');
}
