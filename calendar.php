<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Calendar</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../slidebar.php'; ?>

        <!-- Main Dashboard -->
        <div class="main-content">
            <?php include '../header.php'; ?>

            <h1>Calendar</h1>
            <div class="calendar">

                <?php
                // Get the current month and year from URL parameters (default to current month/year)
                $month = isset($_GET['month']) ? $_GET['month'] : date('m');
                $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

                // Include the calendar.php file
                include_once 'calendar.php';

                // Display the calendar
                echo build_calendar($month, $year);
                ?>
            </div>

            <!-- Navigation for Previous/Next Months -->
            <div class="calendar-navigation">
                <?php
                // Calculate previous month and year
                $prevMonth = $month - 1;
                $prevYear = $year;
                if ($prevMonth == 0) {
                    $prevMonth = 12;
                    $prevYear--;
                }

                // Calculate next month and year
                $nextMonth = $month + 1;
                $nextYear = $year;
                if ($nextMonth == 13) {
                    $nextMonth = 1;
                    $nextYear++;
                }
                ?>
                <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">Previous Month</a> |
                <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">Next Month</a>
            </div>

            <!-- Form to schedule an event -->
            <form action="schedule.php" method="post">
                <label for="date">Select Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="event">Event:</label>
                <input type="text" id="event" name="event" required>
                <button type="submit">Schedule</button>
            </form>
        </div>
    </div>

    <?php
    // Function to build the calendar
    function build_calendar($month, $year) {
        $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];

        // Get scheduled events (fetch from a database or file)
        $scheduled_events = get_scheduled_events();

        // Create the table HTML
        $calendar = "<table>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";

        foreach ($daysOfWeek as $day) {
            $calendar .= "<th>$day</th>";
        }

        $calendar .= "</tr><tr>";

        if ($dayOfWeek > 0) {
            $calendar .= str_repeat('<td></td>', $dayOfWeek);
        }

        $currentDay = 1;

        while ($currentDay <= $numberDays) {
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $date = "$year-$month-" . str_pad($currentDay, 2, '0', STR_PAD_LEFT);

            // Check if there's an event scheduled for the current date
            if (isset($scheduled_events[$date])) {
                $eventDetails = $scheduled_events[$date];
                $calendar .= "<td class='scheduled'><strong>$currentDay</strong><br>{$eventDetails}</td>";
            } else {
                $calendar .= "<td>$currentDay</td>";
            }

            $currentDay++;
            $dayOfWeek++;
        }

        if ($dayOfWeek != 7) {
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= str_repeat('<td></td>', $remainingDays);
        }

        $calendar .= "</tr></table>";
        return $calendar;
    }

    // Function to get scheduled events from a JSON file
    function get_scheduled_events() {
        $events = [];
        if (file_exists('events.json')) {
            $eventData = json_decode(file_get_contents('events.json'), true);
            foreach ($eventData as $event) {
                $events[$event['date']] = $event['event'];
            }
        }
        return $events;
    }
    ?>
</body>

</html>
