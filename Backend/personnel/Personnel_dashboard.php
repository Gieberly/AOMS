<?php

include("Personnel_Cover.php");

// Fetch distinct courses from the programs table
$sqlCourses = "SELECT DISTINCT Courses FROM programs";
$resultCourses = $conn->query($sqlCourses);

$courses = [];
$applicantsCounts = [];
$totalAvailableSlots = [];
$qualifiedApplicantsCounts = [];
$reapplicationApplicantsCounts = [];
$remainingSlots = [];

if ($resultCourses->num_rows > 0) {
    while ($row = $resultCourses->fetch_assoc()) {
        $course = $row['Courses'];

        // Count applicants with non-null appointment dates for the current course
        $sqlCount = "SELECT COUNT(*) AS total_applicants FROM admission_data WHERE degree_applied = '$course' AND appointment_date IS NOT NULL";
        $resultCount = $conn->query($sqlCount);
        $count = $resultCount->fetch_assoc()['total_applicants'];

        // Fetch total available slots for the current course
        $sqlAvailableSlots = "SELECT SUM(Number_of_Available_Slots) AS total_available_slots FROM programs WHERE Courses = '$course'";
        $resultAvailableSlots = $conn->query($sqlAvailableSlots);
        $totalSlots = $resultAvailableSlots->fetch_assoc()['total_available_slots'];

        // Count qualified applicants for the current course
        $sqlQualifiedCount = "SELECT COUNT(*) AS total_qualified FROM admission_data WHERE degree_applied = '$course' AND Admission_Result = 'NOA'";
        $resultQualifiedCount = $conn->query($sqlQualifiedCount);
        $qualifiedCount = $resultQualifiedCount->fetch_assoc()['total_qualified'];
        // Count reapplication applicants for the current course
        $sqlReapplicationCount = "SELECT COUNT(*) AS total_reapplication FROM admission_data WHERE degree_applied = '$course' AND (Personnel_Result = 'NOR(Possible Qualifier-Non-Board)' OR Personnel_Result = 'NOR(Possible Qualifier)')";
        $resultReapplicationCount = $conn->query($sqlReapplicationCount);
        $reapplicationCount = $resultReapplicationCount->fetch_assoc()['total_reapplication'];

        // Calculate remaining slots
        $remaining = $totalSlots - $qualifiedCount;

        $courses[] = $course;
        $applicantsCounts[] = $count;
        $totalAvailableSlots[] = $totalSlots;
        $qualifiedApplicantsCounts[] = $qualifiedCount;
        $reapplicationApplicantsCounts[] = $reapplicationCount;
        $remainingSlots[] = $remaining;
    }
}

// Encode data into JSON format
$chartData = [
    'courses' => $courses,
    'applicantsCounts' => $applicantsCounts,
    'totalAvailableSlots' => $totalAvailableSlots,
    'qualifiedApplicantsCounts' => $qualifiedApplicantsCounts,
    'reapplicationApplicantsCounts' => $reapplicationApplicantsCounts,
    'remainingSlots' => $remainingSlots

];
// Fetch the number of available slots from the 'programs' table
$sql = "SELECT SUM(Number_of_Available_Slots) AS total_available_slots FROM programs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $availableSlots = $row["total_available_slots"];
} else {
    $availableSlots = 0; // Set default value if no rows found
}

// Fetch the count of applicants with appointment_date from the 'admission_data' table
$sql = "SELECT COUNT(*) AS total_applicants FROM admission_data WHERE appointment_date IS NOT NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalApplicants = $row["total_applicants"];
} else {
    $totalApplicants = 0; // Set default value if no rows found
}

// Count admitted applicants meeting specified conditions
$sql = "SELECT COUNT(*) AS total_admitted_applicants FROM admission_data WHERE Admission_Result = 'NOA' AND Personnel_Message = 'sent'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalAdmittedApplicants = $row["total_admitted_applicants"];
} else {
    $totalAdmittedApplicants = 0; // Set default value if no rows found
}

// Count readmitted applicants meeting specified conditions
$sql = "SELECT COUNT(*) AS total_readmitted_applicants 
        FROM admission_data 
        WHERE (Personnel_Result = 'NOR(Possible Qualifier-Non-Board)' OR Personnel_Result = 'NOR(Possible Qualifier)') 
        AND Personnel_Message = 'sent'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalReadmittedApplicants = $row["total_readmitted_applicants"];
} else {
    $totalReadmittedApplicants = 0; // Set default value if no rows found
}
// Function to fetch programs data from the database

function fetchPrograms($conn)
{
    // Prepare SQL query to select all columns from the programs table
    $sql = "SELECT * FROM programs";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Initialize an array to store fetched data
        $programs = array();

        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Query to count number of applicants for this program
            $countSql = "SELECT COUNT(*) AS num_applicants FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "'";
            $countResult = $conn->query($countSql);
            $countRow = $countResult->fetch_assoc();
            $row['num_applicants'] = $countRow['num_applicants'];

            // Count Possible Qualifier applicants
            $pqSql = "SELECT COUNT(*) AS pq_count FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Personnel_Result = 'NOR(Possible Qualifier)'";
            $pqResult = $conn->query($pqSql);
            $pqRow = $pqResult->fetch_assoc();
            $row['pq_count'] = $pqRow['pq_count'];

            // Count PQ(NB) applicants
            $pqnSql = "SELECT COUNT(*) AS pqn_count FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Personnel_Result = 'NOR(Possible Qualifier-Non-Board)'";
            $pqnResult = $conn->query($pqnSql);
            $pqnRow = $pqnResult->fetch_assoc();
            $row['pqn_count'] = $pqnRow['pqn_count'];

            // Count Not Qualified applicants
            $nqSql = "SELECT COUNT(*) AS nq_count FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Personnel_Result = 'NOR(Not-Qualified)'";
            $nqResult = $conn->query($nqSql);
            $nqRow = $nqResult->fetch_assoc();
            $row['nq_count'] = $nqRow['nq_count'];

            // Count Admitted Qualified applicants
            $aqSql = "SELECT COUNT(*) AS aq_count FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Admission_Result = 'NOA(Admitted-Qualified)'";
            $aqResult = $conn->query($aqSql);
            $aqRow = $aqResult->fetch_assoc();
            $row['aq_count'] = $aqRow['aq_count'];

            // Count Admitted Not Qualified applicants
            $anqSql = "SELECT COUNT(*) AS anq_count FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
            $anqResult = $conn->query($anqSql);
            $anqRow = $anqResult->fetch_assoc();
            $row['anq_count'] = $anqRow['anq_count'];

            // Add the row data to the programs array
            $programs[] = $row;
        }

        // Return the array of programs data
        return $programs;
    } else {
        // If no rows are returned, return an empty array
        return array();
    }
}

// Call the fetchPrograms function to get programs data
$programs = fetchPrograms($conn);

// Count not qualified applicants meeting specified conditions
$sql = "SELECT COUNT(*) AS total_not_qualified_applicants FROM admission_data WHERE Personnel_Result = 'NOR(Not Qualified)'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalNotQualApplicants = $row["total_not_qualified_applicants"];
} else {
    $totalNotQualApplicants = 0; // Set default value if no rows found
}
$conn->close();
?>

<head>
    <title>BSU OUR Admission Unit Personnel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <section id="content">

        <div class="overlay1"></div>
        <div class="box">
            <div class="close">&times;</div>
            <div class="registration-box">
                <p>Personnel User Manual</p>
                <!-- Add images here -->
                <img src="assets/images/personnel/1.png" alt="User's Manual">
                <img src="assets/images/personnel/2.png" alt="User's Manual">
                <img src="assets/images/personnel/3.png" alt="User's Manual">
                <img src="assets/images/personnel/4.png" alt="User's Manual">
                <img src="assets/images/personnel/5.png" alt="User's Manual">
                <img src="assets/images/personnel/6.png" alt="User's Manual">
                <img src="assets/images/personnel/7.png" alt="User's Manual">
                <img src="assets/images/personnel/8.png" alt="User's Manual">
                <!-- Add more images if needed -->
            </div>
        </div>

        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="Personnel_dashboard.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <a href="#">
                            <i class='bx bx-clipboard'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $availableSlots; ?></h3>
                            <p>Quota</p>
                        </span>
                    </li>
                    <li>
                        <a href="Personnel_Applicants.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $totalApplicants; ?></h3>
                            <p>Applicants For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="Personnel_Masterlist.php?filter=toadmit">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                            <h3><?php echo $totalAdmittedApplicants; ?></h3>
                            <p>Qualified Applicants for Admission</p>
                        </span>
                    </li>


                    <li id="readmitted-box">
                        <a href="Personnel_Masterlist.php?filter=reapplication">
                            <i class='bx bxs-group'></i></a>
                        <span class="text">
                            <h3><?php echo $totalReadmittedApplicants; ?></h3>
                            <p>Possible Qualifier</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="Personnel_Masterlist.php?filter=notqualified">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                            <h3><?php echo $totalNotQualApplicants; ?></h3>
                            <p>Not Qualified Applicants</p>
                        </span>
                    </li>
                </ul>


            </div>
            <br>


            <div class="table-data">
                <div class="order" id="programsContainer">
                    <div class="head">
                        <h3>Monitoring table</h3>
                        <!-- Add this input field for date filtering -->

                        <div class="headfornaturetosort">
                            <!-- <form method="GET" action="" id="calendarFilterForm">
                                <label for="appointment_date"></label>
                                <input type="date" name="appointment_date" id="appointment_date">
                                <button type="submit"><i class='bx bx-filter'></i></button>
                            </form>
                            <button type="button" id="toggleSelection">
                                <i class='bx bx-select-multiple'></i> Toggle Selection
                            </button>

                            <button type="button" id="sendButton" style="display: none;">
                                <i class='bx bx-send'></i>
                            </button> -->
                        </div>
                    </div>
                    <style>
                        .table-container {
                            max-height: 500px;
                            overflow-y: auto;
                            max-width: 100%;
                            /* Set maximum width to adjust to the end of the screen */
                            margin: 0 auto;
                            /* Center the table horizontally */
                        }

                        #thead {
                            position: sticky;
                            top: 0;
                            z-index: 1;
                            background-color: white;
                        }

                        /* Table scrollbar */
                        .table-container::-webkit-scrollbar {
                            width: 10px;
                        }

                        .table-container::-webkit-scrollbar-thumb {
                            background-color: #4CAF50;
                            border-radius: 5px;
                        }
                    </style>

                    <div class="table-container">
                        <table>
                            <thead id="thead">
                                <tr>
                                    <th colspan="10" style="text-align: center;"></th>
                                    <th style="background-color: #C9DAF8;text-align: center;" class="Board_only" colspan="2">Admitted as per College submission</th>
                                    <th></th>

                                    <th style="background-color: #F4CCCC;text-align: center;" class="Board_only" colspan="3">Not Admitted</th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <th>#</th>

                                    <th>College</th>
                                    <th>Courses</th>
                                    <th>Nature of Degree</th>
                                    <th>No of Sections</th>
                                    <th>No of Students Per Section</th>
                                    <th>Qouta</th>
                                    <th>Number of Applicants As of Date</th>
                                    <th style="background-color:#FFFF00;text-align: center;">Remaining Slots</th>
                                    <th style="background-color:#FFFF00;text-align: center;">SLOTS After Screening</th>
                                    <th style="background-color: #C9DAF8;text-align: center;">Admitted Qualified</th>
                                    <th style="background-color: #C9DAF8;text-align: center;">Not Qualified</th>
                                    <th>Total</th>
                                    <th style="background-color: #F4CCCC;text-align: center;">Possible Qualifier</th>
                                    <th style="background-color: #F4CCCC;text-align: center;">PQ(NB)</th>
                                    <th style="background-color: #F4CCCC;text-align: center;">Not Qualified</th>
                                    <th>Total</th>
                                    <th style="background-color: #FFE599;text-align: center;">Overall Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                // Loop through each program and display its data in table rows
                                foreach ($programs as $key => $program) {
                                    echo "<tr>";
                                    $total_count = $program['aq_count'] + $program['anq_count'];
                                    $total_slots = $program['No_of_Sections'] * $program['No_of_Students_Per_Section'];

                                    echo "<td>" . $program['ProgramID'] . "</td>";
                                    echo "<td>" . $program['College'] . "</td>";
                                    echo "<td>" . $program['Courses'] . "</td>";
                                    echo "<td>" . $program['Nature_of_Degree'] . "</td>";
                                    echo "<td>" . $program['No_of_Sections'] . "</td>";
                                    echo "<td>" . $program['No_of_Students_Per_Section'] . "</td>";
                                    echo "<td>" .  $total_slots . "</td>"; // Display total 

                                    echo "<td>" . $program['num_applicants'] . "</td>"; // Display number of applicant
                                    $total_remaining = $program['No_of_Sections'] * $program['No_of_Students_Per_Section'] - $program['num_applicants'];

                                    echo "<td>" .  $total_remaining . "</td>"; // Display remaining slots
                                    echo '<td style="background-color: #FFFF00; text-align: center;">' . ($total_slots - $total_count) . '</td>'; // Display total
                                    echo '<td style="background-color: #C9DAF8; text-align: center;">' . $program['aq_count'] . '</td>'; // Display Admitted Qualified count
                                    echo '<td style="background-color: #C9DAF8; text-align: center;">' . $program['anq_count'] . '</td>'; // Display Admitted Not Qualified count
                                    
                                    echo "<td>" . $total_count . "</td>"; // Display Total count

                                    echo '<td style="background-color: #F4CCCC; text-align: center;">' . $program['pq_count'] . '</td>'; // Display Possible Qualifier count
                                    echo '<td style="background-color: #F4CCCC; text-align: center;">' . $program['pqn_count'] . '</td>'; // Display PQ(NB) count
                                    echo '<td style="background-color: #F4CCCC; text-align: center;">' . $program['nq_count'] . '</td>'; // Display NQ count
                                    
                                    $total_counts = $program['pq_count'] + $program['pqn_count'] + $program['nq_count'];
                                    echo "<td>" . $total_counts . "</td>";
                                    echo '<td style="background-color: #FFE599; text-align: center;">' . ($total_counts + $total_count) . '</td>'; // Display total
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                    <style>
                        /* Scrollbar styling for content areas */
                        #content1,
                        #content2 {
                            max-height: 400px;
                            overflow-y: auto;
                            padding-right: 20px;
                            /* Adjust this value based on the scrollbar width */
                            box-sizing: border-box;
                            /* Include padding and border in the total width/height */
                        }

                        #content1::-webkit-scrollbar,
                        #content2::-webkit-scrollbar {
                            width: 10px;
                        }

                        #content1::-webkit-scrollbar-thumb,
                        #content2::-webkit-scrollbar-thumb {
                            background-color: #4CAF50;
                            /* green thumb color */
                            border-radius: 5px;
                        }

                        #content1::-webkit-scrollbar-track,
                        #content2::-webkit-scrollbar-track {
                            background-color: #f4f4f4;
                        }
                    </style>


                </div>


            </div>
            <br>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <div id="graph">
                            <h3>Monitoring Graph</h3>
                            <div class="headfornaturetosort">
                                <div class="button-container">

                                    <label for="remaining-slots"></label>
                                    <button class="toggle-button" onclick="toggleChartType()">Switch Chart Type</button>
                                </div>
                            </div>

                            <br> <br>

                            <canvas id="applicantsAndSlotsChart"></canvas>

                        </div>
                    </div>
                </div>
            </div>

        </main>
    </section>
    <style>
        #programsContainer {
            display: none;
            /* Hide by default */
        }

        .button-container {
            display: flex;
            /* Use flexbox */
            align-items: center;
            /* Align items vertically */
        }

        .toggle-button {
            margin-left: 10px;
            /* Add margin to separate from label */
        }

        .box {
            position: fixed;
            width: 60%;
            top: 50%;
            left: 50%;
            text-align: center;
            padding: 10px;
            background-color: #E6F7F0;
            display: none;
            transform: translate(-50%, -50%);
            z-index: 1000;
            overflow: auto;
            height: 80%;
            margin-top: 2%;
        }

        .overlay1 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .close {
            display: block;
            position: sticky;
            width: 40px;
            height: 40px;
            top: 0;
            right: 0;
            color: tomato;
            font-size: 34px;
            z-index: 1001;
        }

        .close:hover {
            background-color: red;
            color: #fcfcfc;
            cursor: pointer;
        }

        .registration-box {
            margin-top: 50px;
            margin-bottom: 50px;
            overflow-y: auto;
        }

        .registration-box img {
            width: 90%;
            margin-bottom: 10px;
        }

        .registration-box p {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the availableBox element
            var availableBox = document.getElementById('available-box');

            // Get the programsContainer
            var programsContainer = document.getElementById('programsContainer');

            // Add click event listener to the availableBox
            availableBox.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default link behavior
                if (programsContainer.style.display === 'none') {
                    programsContainer.style.display = 'block'; // Show programsContainer
                } else {
                    programsContainer.style.display = 'none'; // Hide programsContainer
                }
            });
        });



        var chartData = <?php echo json_encode($chartData); ?>;
        var ctx = document.getElementById('applicantsAndSlotsChart').getContext('2d');
        var chartType = 'bar'; // Default chart type

        var chart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: chartData.courses,
                datasets: [{
                    label: 'Qouta',
                    data: chartData.totalAvailableSlots,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Applicants for Admission',
                    data: chartData.applicantsCounts,
                    backgroundColor: '#a6fda6',
                    borderColor: '#008000',
                    borderWidth: 1
                }, {
                    label: 'Qualified Applicants',
                    data: chartData.qualifiedApplicantsCounts,
                    backgroundColor: '#CFE8FF',
                    borderColor: '#3C91E6',
                    borderWidth: 1
                }, {
                    label: 'Reapplication Applicants',
                    data: chartData.reapplicationApplicantsCounts,
                    backgroundColor: ' #ffaaa7',
                    borderColor: '#f00',
                    borderWidth: 1
                }, {
                    label: 'Remaining Slots',
                    data: chartData.remainingSlots,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function toggleChartType() {
            chartType = chartType === 'bar' ? 'line' : 'bar'; // Toggle between bar and line
            chart.destroy(); // Destroy the existing chart
            chart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: chartData.courses,
                    datasets: [{
                        label: 'Qouta',
                        data: chartData.totalAvailableSlots,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Applicants for Admission',
                        data: chartData.applicantsCounts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Qualified Applicants',
                        data: chartData.qualifiedApplicantsCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Reapplication Applicants',
                        data: chartData.reapplicationApplicantsCounts,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Remaining Slots',
                        data: chartData.remainingSlots,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>


</html>