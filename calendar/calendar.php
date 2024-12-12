<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Calendar</title>
    <link rel="stylesheet" href="../includes/css/styles.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../includes/slidebar/slidebar.php'; ?>

        <!-- Main Dashboard -->
        <div class="main-content">
            <?php include '../includes/header.php'; ?>

            <div class="calendar">

                <h1>Calendar</h1>
                <div>

                    <?php
                // Get the current month and year from URL parameters, or default to current month/year
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
    </div>
    <?php include '../includes/footer.php'; ?>

    <?php
    // Function to build the calendar
    function build_calendar($month, $year) {
        $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];

        // Get scheduled events
        $scheduled_events = get_scheduled_events();

        // Start calendar table
        $calendar = "<table>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";

        // Create table headers for days of the week
        foreach ($daysOfWeek as $day) {
            $calendar .= "<th>$day</th>";
        }

        $calendar .= "</tr><tr>";

        // Fill in the blank days at the beginning of the month
        if ($dayOfWeek > 0) {
            $calendar .= str_repeat('<td></td>', $dayOfWeek);
        }

        // Initialize day counter
        $currentDay = 1;

        while ($currentDay <= $numberDays) {
            // Start a new row every week (after 7 days)
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $date = "$year-$month-" . str_pad($currentDay, 2, '0', STR_PAD_LEFT);

            // Check for scheduled events on this date
            if (isset($scheduled_events[$date])) {
                $eventDetails = $scheduled_events[$date];
                $calendar .= "<td class='scheduled'><strong>$currentDay</strong><br>{$eventDetails}";
                $calendar .= "<br><a href='edit.php?date=$date'>Edit</a> | <a href='delete.php?date=$date'>Delete</a>";
                $calendar .= "</td>";
            } else {
                $calendar .= "<td>$currentDay</td>";
            }

            // Move to the next day
            $currentDay++;
            $dayOfWeek++;
        }

        // Fill in the blank days at the end of the month
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
        
        // Check if the JSON file exists and is readable
        if (file_exists('events.json')) {
            // Get the content of the JSON file
            $eventData = file_get_contents('events.json');
            
            // Decode JSON data into an array
            $eventData = json_decode($eventData, true);
            
            // Check if the data was decoded properly
            if (json_last_error() === JSON_ERROR_NONE) {
                // Loop through the events if valid JSON
                foreach ($eventData as $event) {
                    if (isset($event['date']) && isset($event['event'])) {
                        $events[$event['date']] = $event['event'];

                    }
                }
            } else {
                echo "Error decoding JSON: " . json_last_error_msg();
            }
        } else {
            echo "Events file not found.";
        }
        
        return $events;
    }
    
    ?>


</body>

</html>