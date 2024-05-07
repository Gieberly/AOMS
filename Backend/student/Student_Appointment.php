<?php

date_default_timezone_set('Asia/Manila');
include("Student_Cover.php");

// Retrieve the student's information from the users table
$userEmail = $_SESSION['user_email'];


// Check if the user has already set an appointment and the appointment status is not "Cancelled" or "Incomplete"
$sqlCheckAppointment = "SELECT appointment_status FROM admission_data WHERE email = ? AND appointment_date IS NOT NULL AND (appointment_status IS NULL OR appointment_status NOT IN ('Cancelled', 'Incomplete'))";
$stmtCheckAppointment = $conn->prepare($sqlCheckAppointment);
$stmtCheckAppointment->bind_param("s", $userEmail);
$stmtCheckAppointment->execute();
$resultCheckAppointment = $stmtCheckAppointment->get_result();

if ($resultCheckAppointment->num_rows > 0) {
    // Redirect the user to another page
    echo '<script>
            setTimeout(function() {
                window.location.href = "Student_Transaction_page.php";
            }, 1000); // Redirect after 1 second (1000 milliseconds)
          </script>';
    exit();
}


// Prepare and execute the SQL query to fetch admission data based on the user's email
$sql = "SELECT * FROM admission_data WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

// Retrieve the student's information from the users table
$studentId = $_SESSION['user_id'];
$stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->bind_param("i", $studentId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$studentData = $resultUser->fetch_assoc();

// Cleanup: Remove data for past dates in appointmentdate table
$currentDate = date('Y-m-d');
$cleanupSql = "DELETE FROM appointmentdate WHERE appointment_date < ?";
$stmtCleanup = $conn->prepare($cleanupSql);
$stmtCleanup->bind_param("s", $currentDate);
$stmtCleanup->execute();
$stmtCleanup->close();

// Retrieve existing slots from the database for future dates only
$sql = "SELECT * FROM appointmentdate WHERE appointment_date >= CURDATE()";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $startDateTime = $row['appointment_date'] . ' ' . $row['appointment_time'];
        $events[] = array(
            'title' => 'Slots' . $row['available_slots'],
            'start' => $startDateTime,
            'end' => $startDateTime, // Assuming the event duration is one hour, adjust as needed
            'color' => '#4CAF50', // Set your desired color here
        );
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected date and time from the form
    $selectedDate = $_POST['selectedDate'];
    $selectedTime = $_POST['selectedTime'];

    // Update the admission_data table with the selected appointment date and time for the logged-in user
    $stmtUpdate = $conn->prepare("UPDATE admission_data SET appointment_date = ?, appointment_time = ?, appointment_status = NULL WHERE email = ?");
    $stmtUpdate->bind_param("sss", $selectedDate, $selectedTime, $userEmail);

    if ($stmtUpdate->execute()) {
        // Successful update
        $successMessage = "Appointment successfully set!";

               // Log the activity when the appointment is set
               $action = "Submitted an Appointment date";
               $description = "User with email $userEmail has set an appointment on $selectedDate at $selectedTime.";
               $currentDate = date('Y-m-d H:i:s'); // This is now in Philippine Standard Time (PST)
               $ip_address = $_SERVER['REMOTE_ADDR'];
       
               $logSql = "INSERT INTO activity_log (user_id, email, userType, action, description, created_at, ip_address) 
                          VALUES (?, ?, 'Student', ?, ?, ?, ?)";
               $stmtLog = $conn->prepare($logSql);
               $stmtLog->bind_param("isssss", $userId, $userEmail, $action, $description, $currentDate, $ip_address);
       
               if (!$stmtLog->execute()) {
                   echo "Error logging activity: " . $stmtLog->error; // Optional error handling
               }
        
        // Update available slots in the appointmentdate table
        $stmtUpdateSlots = $conn->prepare("UPDATE appointmentdate SET available_slots = available_slots - 1 WHERE appointment_date = ? AND appointment_time = ?");
        $stmtUpdateSlots->bind_param("ss", $selectedDate, $selectedTime);
        $stmtUpdateSlots->execute();

        // Check if there are no slots left for the selected date and time
        $checkSlotsSql = "SELECT available_slots FROM appointmentdate WHERE appointment_date = ? AND appointment_time = ?";
        $stmtCheckSlots = $conn->prepare($checkSlotsSql);
        $stmtCheckSlots->bind_param("ss", $selectedDate, $selectedTime);
        $stmtCheckSlots->execute();
        $resultSlots = $stmtCheckSlots->get_result();
        $slotsRow = $resultSlots->fetch_assoc();

        if ($slotsRow['available_slots'] <= 0) {
            // If no slots left, remove the record from the database
            $stmtRemoveSlots = $conn->prepare("DELETE FROM appointmentdate WHERE appointment_date = ? AND appointment_time = ?");
            $stmtRemoveSlots->bind_param("ss", $selectedDate, $selectedTime);
            $stmtRemoveSlots->execute();
        }

        // Add JavaScript code to redirect after 2 seconds
        echo '<script>
                setTimeout(function() {
                    location.reload();
                    window.location.href = "Student_Transaction_page.php";
                }, 1000);
              </script>';
    } else {
        // Error in the update
        $errorMessage = "Error setting appointment.";
    }

    $stmtUpdate->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Student Appointment</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- Include FullCalendar and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<style>
    /* Add your styles specific to StudentSetAppointment.php here */
</style>

<body>
    <!-- Success and error messages -->
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success alert-message" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="alert alert-danger alert-message" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>


    <section id="content">
        <main>
            <div class="calendar-background">
                <br>
                <h2>Set Appointment Date</h2>

                <form action="" id="slotForm" method="post" style="display: none;">
                    <button type="button" id="hideFormButton" onclick="toggleFormVisibility()"
                        style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
                        <i class='bx bx-x'></i>
                    </button>


                    <label for="selectedDate">Appointment Date</label>
                    <input type="text" id="selectedDate" name="selectedDate" readonly required>


                    <label for="availableTimeSlots">Select Time</label>
                    <select id="availableTimeSlots" name="selectedTime" required>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>



                    <input type="submit" value="Set Appointment"
                        onclick="openPopup('Are you sure you want to set your appointment on ' + selectedDate + ' at ' + selectedTime + '?'); return false;">


                </form>

                <div id='calendar'></div>
            </div>
            <!-- Add this div for the pop-up message -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()"></span>
                    <p id="popup-message"></p>
                    <button class="confirm" onclick="confirmAppointment()">Confirm</button>
                    <button class="cancel" onclick="cancelAppointment()">Cancel</button>
                </div>
            </div>

            <style>
                .alert-success {
                    background-color: #4CAF50;
                    /* Green background color */
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    /* Border radius */
                    margin-bottom: 10px;
                    /* Add margin bottom for spacing */
                }


                #popup {
                    display: none;
                    position: fixed;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 1000;
                }

                .popup-content {
                    background-color: #fefefe;
                    position: absolute;
                    /* Change position to absolute */
                    left: 50%;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    padding: 20px;
                    border: 1px solid #888;
                    max-width: 80%;
                    /* Adjust maximum width as needed */
                    max-height: 80%;
                    /* Adjust maximum height as needed */
                    overflow-y: auto;
                    /* Enable vertical scrolling if content exceeds height */
                    border-radius: 10px;
                    text-align: center;
                }

                .close {
                    color: #aaa;
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 28px;
                    font-weight: bold;
                    cursor: pointer;
                }

                .confirm {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    padding: 10px 20px;
                    margin-right: 10px;
                    cursor: pointer;

                    margin: 10px;
                }

                .confirm:hover {
                    background-color: #45a049;
                }

                .cancel {
                    background-color: #f44336;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    padding: 10px 20px;
                    margin-left: 10px;
                    cursor: pointer;
                    margin: 10px;
                }

                .cancel:hover {
                    background-color: #d32f2f;
                }

                .has-events {
                    background-color: #4CAF50;
                    /* Set your desired background color here */
                    color: white;
                    /* Set the text color if needed */
                }

                .alert-message {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 1000;
                    /* Adjust the z-index value as needed to ensure it appears in front */
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                #calendar {
                    max-width: 600px;
                    margin: 0 auto;
                }



                label {
                    display: block;
                    margin-bottom: 8px;
                    color: #555;
                }

                input,
                select {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 16px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                input[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }

                #slotForm {
                    display: none;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    padding: 15px;
                    border-radius: 5px;
                    border: 2px solid #000;
                    width: 70%;
                    background-color: #F9F9F9;
                    z-index: 2;
                }

                .calendar-background {
                    position: relative;
                    border: 2px solid #000;
                    width: 100%;
                    border-radius: 5px;
                    background-color: #F9F9F9;
                    z-index: 1;
                    margin-bottom: 20px;
                }

                #hideFormButton {
                    position: fixed;
                    top: 10px;
                    right: 10px;
                }

                #hideFormButton i {
                    color: red;
                    transition: color 0.3s ease;
                }

                #hideFormButton:hover i {
                    color: blue;
                }

                .available-day {
                    position: relative;
                }

                .available-day:hover::after {
                    content: "Available";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    color: white;
                }

                .available-day:hover {
                    cursor: pointer;
                    position: relative;
                }

                .not-available-day:hover::after {
                    content: "NOT AVAILABLE";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    color: black;
                }
            </style>
            <script>
                  function toggleFormVisibility() {
        var form = document.getElementById('slotForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
    $(document).ready(function () {
    // Initialize FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        selectable: true,
        select: function (start) {
            // Display the selected date in the form
            var selectedDate = moment(start).format('YYYY-MM-DD');
            $('#selectedDate').val(selectedDate);

            // Check if the selected date has available slots
            if (hasEventsForDate(selectedDate)) {
                // Fetch and populate available time slots for the selected date
                fetchAvailableTimeSlots(selectedDate);
                $('#slotForm').show(); // Show the form
            } else {
                $('#slotForm').hide(); // Hide the form if no available slots
            }
        },
        // Remove the 'events' option to hide the time slots
        // events: <?php echo json_encode($events); ?>,
        dayRender: function (date, cell) {
            // Highlight days with available slots
            var dateString = moment(date).format('YYYY-MM-DD');
            if (hasEventsForDate(dateString)) {
                cell.addClass('available-day'); // Add class for hover effect
                cell.css('background-color', '#4CAF50'); // Set your desired background color here
                cell.css('color', 'white'); // Set the text color if needed
                cell.find('.fc-day-number').text(''); // Remove the day number
            } else {
                cell.addClass('not-available-day'); // Add class for hover effect
            }
        },
    });

    // Function to fetch and populate available time slots
    function fetchAvailableTimeSlots(selectedDate) {
        // Assuming you have a PHP script to fetch available time slots for the selected date
        $.ajax({
            type: 'POST',
            url: 'fetch_time_slots.php', // Replace with your actual PHP script
            data: { selectedDate: selectedDate },
            success: function (response) {
                // Update the options of the time select element
                $('#availableTimeSlots').html(response);
            },
            error: function () {
                console.error('Error fetching time slots');
            }
        });
    }
});

function hasEventsForDate(date) {
    // Check if there are events for the specified date
    var events = <?php echo json_encode($events); ?>;
    for (var i = 0; i < events.length; i++) {
        if (moment(events[i].start).format('YYYY-MM-DD') === date) {
            return true;
        }
    }
    return false;
}

            </script>
        </main>


    </section>
</body>

</html>