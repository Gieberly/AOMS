<?php

include ("admin_cover.php");

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

$conn->close();
?>

<head>
    <title>BSU OUR Admission Admin</title>
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
                            <li><a class="active" href="admin_dashboard.php">Home</a></li>
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
                        <a href="admin_Applicants.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $totalApplicants; ?></h3>
                            <p>Applicants For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="admin_Masterlist.php?filter=toadmit">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                            <h3><?php echo $totalAdmittedApplicants; ?></h3>
                            <p>Qualified Applicants for Admission</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="admin_Masterlist.php?filter=reapplication">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                            <h3><?php echo $totalReadmittedApplicants; ?></h3>
                            <p>Applicants For Reapplication</p>
                        </span>
                    </li>
                </ul>


            </div>
            <br>
            <style>
                            #programsContainer {
                                max-height: 400px;
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
                            #programsContainer::-webkit-scrollbar {
                                width: 10px;
                            }

                            #programsContainer::-webkit-scrollbar-thumb {
                                background-color: #4CAF50;
                                border-radius: 5px;
                            }
                        </style>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                       

                        <div id="programsContainer">

                        <h3 style="position: sticky; top: 0; background-color: white; z-index: 1;">Monitoring Table</h3>
                            <!-- Add this input field for date filtering -->

                         <br>

                          
                                <table>
                                    <thead id="thead">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Program ID</th>
                                            <th>College</th>
                                            <th>Courses</th>
                                            <th>Nature of Degree</th>
                                            <th>No of Sections</th>
                                            <th>No of Students Per Section</th>
                                            <th>Number of Available Slots</th>
                                            <th>Number of Applicants As of Date</th>
                                            <th>Remaining Slots</th>
                                            <th>SLOTS After Screening</th>
                                            <th>Admitted Qualified</th>
                                            <th>Admitted Not Qualified</th>
                                            <th>Admitted Total</th>
                                            <th>Not Admitted Possible Qualifier</th>
                                            <th>PQ NB</th>
                                            <th>Not Admitted Not Qualified</th>
                                            <th>Not Admitted Total</th>
                                            <th>Overall Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <?php
                                        // Loop through each program and display its data in table rows
                                        foreach ($programs as $key => $program) {
                                            echo "<tr>";
                                           
                                            echo "<td>" . $program['ProgramID'] . "</td>";
                                            echo "<td>" . $program['College'] . "</td>";
                                            echo "<td>" . $program['Courses'] . "</td>";
                                            echo "<td>" . $program['Nature_of_Degree'] . "</td>";
                                            echo "<td>" . $program['No_of_Sections'] . "</td>";
                                            echo "<td>" . $program['No_of_Students_Per_Section'] . "</td>";
                                            echo "<td>" . $program['Number_of_Available_Slots'] . "</td>";
                                            echo "<td>" . $program['Number_of_Applicants_As_of_Date'] . "</td>";
                                            echo "<td>" . $program['Remaining_Slots'] . "</td>";
                                            echo "<td>" . $program['SLOTS_After_Screening'] . "</td>";
                                            echo "<td>" . $program['Admitted_Qualified'] . "</td>";
                                            echo "<td>" . $program['Admitted_Not_Qualified'] . "</td>";
                                            echo "<td>" . $program['Admitted_Total'] . "</td>";
                                            echo "<td>" . $program['Not_Admitted_Possible_Qualifier'] . "</td>";
                                            echo "<td>" . $program['PQ_NB'] . "</td>";
                                            echo "<td>" . $program['Not_Admitted_Not_Qualified'] . "</td>";
                                            echo "<td>" . $program['Not_Admitted_Total'] . "</td>";
                                            echo "<td>" . $program['Overall_Total'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                      <br><br>
                        </div>

                        <div id="graph">

                            <h3>Monitoring Graph</h3>
                            <!-- Add this input field for date filtering -->

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

        document.addEventListener('DOMContentLoaded', function () {
            // Get the availableBox element
            var availableBox = document.getElementById('available-box');

            // Get the programsContainer
            var programsContainer = document.getElementById('programsContainer');

            // Add click event listener to the availableBox
            availableBox.addEventListener('click', function (e) {
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
                datasets: [
                    {
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
                    }
                ]
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
                    datasets: [
                        {
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
                        }
                    ]
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

