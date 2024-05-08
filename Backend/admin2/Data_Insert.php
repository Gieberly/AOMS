<?php

include ("admin_cover.php");

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

            // Query to count number of applicants with "NOA" in Personnel_Result
            $screenedSql = "SELECT COUNT(*) AS screened_applicants FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Personnel_Result = 'NOA'";
            $screenedResult = $conn->query($screenedSql);
            $screenedRow = $screenedResult->fetch_assoc();
            $row['screened_applicants'] = $screenedRow['screened_applicants'];

            // Calculate slots after screening
            $row['slots_after_screening'] = ($row['No_of_Sections'] * $row['No_of_Students_Per_Section']) - $row['screened_applicants'];

                  // Query to count number of admitted qualified applicants for this program
            $admittedQualifiedSql = "SELECT COUNT(*) AS admitted_qualified FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Admission_Result = 'NOA'";
            $admittedQualifiedResult = $conn->query($admittedQualifiedSql);
            $admittedQualifiedRow = $admittedQualifiedResult->fetch_assoc();
            $row['admitted_qualified'] = $admittedQualifiedRow['admitted_qualified'];

            // Query to count number of admitted not qualified applicants for this program
            $admittedNotQualifiedSql = "SELECT COUNT(*) AS admitted_not_qualified FROM admission_data WHERE degree_applied = '" . $row['Courses'] . "' AND Admission_Result = 'NOR'";
            $admittedNotQualifiedResult = $conn->query($admittedNotQualifiedSql);
            $admittedNotQualifiedRow = $admittedNotQualifiedResult->fetch_assoc();
            $row['admitted_not_qualified'] = $admittedNotQualifiedRow['admitted_not_qualified'];

            // Calculate total
            $row['total'] = $row['admitted_qualified'] + $row['admitted_not_qualified'];


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

     

        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Data inserting</h1>
                        <ul class="breadcrumb">
                            <li><a >Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active"href="../admin/dashboard_admin.php">Home</a></li>
                        </ul>
                    </div>
                </div>

             
            </div>
            <br>
            <style>
                            #programsContainers {
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
                       

                        <div id="programsContaines">

                        <h3 style="position: sticky; top: 0; background-color: white; z-index: 1;">Monitoring Table</h3>
                            <!-- Add this input field for date filtering -->

                         <br>

                          
                                <table>
                                    <thead id="thead">
                                        
                                        <tr>
                                            <th>#</th>
                                            
                                            <th>College</th>
                                            <th>Courses</th>
                                            <th>Nature of Degree</th>
                                            <th>No of Sections</th>
                                            <th>No of Students Per Section</th>
                                            <th>Qouta</th>
                                            <th>Number of Applicants As of Date</th>
                                            <th>Remaining Slots</th>
                                            <th>SLOTS After Screening</th>
                                            <th>Admitted Qualified</th>
                                            <th>Admitted Not Qualified</th>
                                            <th>Total</th>
                                            <th>NOR(PQ-B)</th>
                                            <th>PQ(NB)</th>
                                            <th>(NOR) Not Qualified</th>
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
                                            echo "<td>" . ($program['No_of_Sections'] * $program['No_of_Students_Per_Section']) . "</td>";
                                            echo "<td>" . $program['num_applicants'] . "</td>"; // Display number of applicants
                                            echo "<td>" . ($program['No_of_Sections'] * $program['No_of_Students_Per_Section'] - $program['num_applicants']) . "</td>"; // Display remaining slots
                                            echo "<td>" . $program['slots_after_screening'] . "</td>"; // Display slots after screening
                                            // Add other table data as needed
                                            echo "<td>" . $program['admitted_qualified'] . "</td>"; // Display admitted qualified applicants count
                                            echo "<td>" . $program['admitted_not_qualified'] . "</td>"; // Display admitted not qualified applicants count
                                            echo "<td>" . $program['total'] . "</td>";
                                            
                                            
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                      <br><br>
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

