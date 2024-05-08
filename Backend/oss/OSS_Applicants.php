<?php

include ("OSS_Cover.php");

// Query to retrieve the last entered Applicant number
$lastApplicantNoQuery = "SELECT OSS_Applicant_no FROM admission_data ORDER BY OSS_Applicant_no DESC LIMIT 1";
$lastApplicantNoResult = $conn->query($lastApplicantNoQuery);
$last_OSS_Applicant_no = '';
if ($lastApplicantNoResult->num_rows > 0) {
    $row = $lastApplicantNoResult->fetch_assoc();
    $last_OSS_Applicant_no = $row['OSS_Applicant_no'];
}

// Fetch courses from the programs table
$courses_query = "SELECT DISTINCT Courses FROM programs";
$courses_result = $conn->query($courses_query);

$courses = array();
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row['Courses'];
}



// Store the search query in a session variable if it's set
if (isset($_GET['search'])) {
    $_SESSION['search'] = $_GET['search'];
}
if (isset($_GET['filter'])) {
    $_SESSION['filter'] = $_GET['filter'];
}

// Retrieve the stored search query and filter from session if they exist
$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';
$filter = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';



if ($filter == 'finished_test') {
    $query = "SELECT * FROM admission_data 
              WHERE oss_Message = 'sent'
              AND (`Name` LIKE '%$search%' OR 
                   `Middle_Name` LIKE '%$search%' OR 
                   `Last_Name` LIKE '%$search%' OR 
                   `academic_classification` LIKE '%$search%' OR 
                   TRIM(`nature_of_degree`) = '$search' OR 
                   TRIM(`Personnel_Result`) = '$search' OR 
                   TRIM(`Admission_Result`) = '$search' OR 
                   `degree_applied` LIKE '%$search%' OR
                   `applicant_number`LIKE '%$search%' OR
                   `OSS_Applicant_no` = '$search')  /* Added OSS_Applicant_no here */
              AND (`OSS_Admission_Test_Score` IS NOT NULL AND `OSS_Admission_Test_Score` != '')
              ORDER BY applicant_number ASC";
} elseif ($filter == 'unfinished_test') {
    $query = "SELECT * FROM admission_data 
              WHERE oss_Message = 'sent'
              AND (`Name` LIKE '%$search%' OR 
                   `Middle_Name` LIKE '%$search%' OR 
                   `Last_Name` LIKE '%$search%' OR 
                   `academic_classification` LIKE '%$search%' OR 
                   TRIM(`nature_of_degree`) = '$search' OR 
                   TRIM(`Personnel_Result`) = '$search' OR 
                   TRIM(`Admission_Result`) = '$search%' OR 
                   `degree_applied` LIKE '%$search%' OR
                    `applicant_number`LIKE '%$search%' OR
                   `OSS_Applicant_no` = '$search')  
                   AND (`OSS_Admission_Test_Score` IS NULL OR `OSS_Admission_Test_Score` = '')
              ORDER BY applicant_number ASC";
} else {
    $query = "SELECT * FROM admission_data 
              WHERE oss_Message = 'sent'
              AND (`Name` LIKE '%$search%' OR 
                   `Middle_Name` LIKE '%$search%' OR 
                   `Last_Name` LIKE '%$search%' OR 
                   `academic_classification` LIKE '%$search%' OR 
                   TRIM(`nature_of_degree`) = '$search' OR 
                   TRIM(`Personnel_Result`) = '$search' OR 
                   TRIM(`Admission_Result`) = '$search%' OR 
                   `degree_applied` LIKE '%$search%' OR
                    `applicant_number`LIKE '%$search%' OR 
                   `OSS_Applicant_no` = '$search') 
              ORDER BY applicant_number ASC";
}


$result = $conn->query($query);

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

// Close statement
$stmt->close();

?>

<head>
    <meta charset="UTF-8">

    <title>BSU OSS Admission Test Unit</title>

</head>

<body>


    <style>
        .data-container1 {
            display: grid;
            grid-template-columns: 20% 23% 23% 23%;
            gap: 2%;
        }

        .data-container2 {
            display: grid;
            grid-template-columns: 44% 19% 33%;
            gap: 2%;
        }

        .data-container3 {
            display: grid;
            grid-template-columns: 65% 33%;
            gap: 2%;
        }

        .data-container4 {
            display: grid;
            grid-template-columns: 100%;
            gap: 10px;
        }

        .data-container5 {
            display: grid;
            grid-template-columns: 45%;
            gap: 10px;
        }

        .button-container {
            position: relative;
        }

        .button.inc-btn,
        .button.check-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .button.inc-btn i,
        .button.check-btn i {
            font-size: 13px;
        }

        .button.inc-btn:hover i {
            color: orange;
        }

        .button.check-btn:hover i {
            color: green;
        }

        .button-container .button::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 5px);
            /* Position the tooltip above the button with some spacing */
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            /* Use ease transition for smooth appearance */
            z-index: 999;
            pointer-events: none;
        }

        .button-container .button:hover::after {
            opacity: 1;
        }


        #sendButton {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        #sendButton i {
            font-size: 14px;
            color: black;
        }

        #sendButton:hover i {
            color: green;
            transform: scale(1.2);
        }

        .sendmodal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;

        }

        .sendmodal-content {
            position: fixed;
            top: 15%;
            right: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            z-index: 9;
            animation: slideInUp 0.3s ease-in-out, fadeOut 2s ease-in-out 0.3s forwards;
        }

        .modala {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-contenta {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 20%;
            font-size: 18px;
        }


        #toast {
            position: fixed;
            top: 10%;
            right: 10%;
            width: 300px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        #toast.show {
            opacity: 1;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .modal,

        .confirmation-dialoga {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Modal Content/Box */
        .modal-content,
        .dialoga-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            /* Could be more or less, depending on screen size */
            border-radius: 10px;
        }

        .exit {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .exit:hover,
        .exit:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        .cancel {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            background-color: #ff5757;
            color: white;
            /* Float the "Cancel" button to the right */
        }

        .confirm {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            /* Float the "Cancel" button to the right */
        }

        .confirm:hover,
        .cancel:hover {
            opacity: 0.8;
        }

        .confirmation-message {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        #deleteConfirmationModal,
        #errorModal,
        #selectRowModal,
        #sendSuccessModal {
            display: none;
        }

        .field-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .field-group>* {
            flex-basis: calc(25% - 10px);
            margin-bottom: 10px;
        }

        .success-message {
            position: fixed;
            top: 15%;
            right: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            z-index: 999;
            animation: slideInUp 0.3s ease-in-out;
            display: none;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        #calendarFilterForm button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font-size: 0;
            color: #000;
        }

        #calendarFilterForm button i {
            font-size: 18px;
        }

        #calendarFilterForm input[type="date"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        #toast {
            position: fixed;
            top: 10%;
            right: 10%;
            width: 300px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        #toast.show {
            opacity: 1;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .close-form {
            transition: background-color 0.3s, transform 0.3s;
            border-radius: 50%;
        }

        .close-form:hover {
            background-color: rgba(255, 0, 0, 0.2);
        }

        .form-container1 {
            display: grid;
            grid-template-columns: 50% 23% 23%;
            gap: 2%;
        }

        .form-container2 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2%;
        }

        .form-container7 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2%;
        }

        .form-container7 .form-group {
            display: grid;
            grid-template-columns: 1fr;
            align-items: start;
            /* Align items to the start of the grid cell */
        }

        .form-container7 .form-group .small-label {
            margin-bottom: 10px;
            white-space: normal;
            text-align: left;
            word-wrap: break-word;
        }

        .form-container7 .form-group input {
            width: 100%;
            /* Take up full width of the grid cell */
        }



        .form-container8 {
            display: grid;
            grid-template-columns: 20% 10% 20% 10% 20% 10%;

            gap: 2%;
        }

        .form-container8 .form-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .form-container9 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* evenly distribute columns */
            gap: 2%;
        }

        .form-container9 .form-group {
            display: flex;
            flex-direction: column;

        }

        .form-container9 .form-group .small-label {
            margin-bottom: 10px;
            max-height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: left;
        }

        .form-container8 .form-group .small-label {
            margin-bottom: 10px;
            max-height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: left;
        }

        .form-container3 {
            display: grid;
            grid-template-columns: 18% 18% 18% 18% 18%;
            gap: 2%;
        }

        .form-container4 {
            display: grid;
            grid-template-columns: 100%;
            gap: 10px;
        }

        input[readonly],
        select[disabled],
        textarea[readonly] {
            background-color: #f2f2f2;
            /* Light gray background color */
        }

        .form-container5 {
            display: grid;
            grid-template-columns: 70% 20%;
            gap: 10px;
        }

        .form-container6 {
            display: grid;
            grid-template-columns: 35% 15%;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .small-label {
            display: block;
            font-size: .9vw;
            margin-bottom: 5px;
        }

        .input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: .8vw;
        }

        .submit {
            background-color: #4CAF50;
            color: white;
            padding: 2% 4%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1vw;
        }

        .submit:hover {
            opacity: 0.8;
        }

        .personal_information {
            font-size: 1vw;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #updateProfileForm {
            max-width: 800px;
            margin: 0 auto;
        }



        @media screen and (max-width: 881px) {
            .form-group {
                width: 100%;
            }
        }

        #update_success {
            position: fixed;
            top: 75px;
            /* Adjust the distance from the top */
            right: 20px;
            /* Adjust the distance from the right */
            padding: 10px 20px;
            background-color: green;
            color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            animation: slideUp 0.5s ease forwards, fadeOut 0.5s 2.5s forwards;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(100%);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auto-expand {
            min-height: 50px;
            /* Set a minimum height for the textarea */
        }

        #toggleSubjects {
            background-color: green;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
            /* Set width to auto */
            float: right;
            /* Float it to the right */
        }

        #toggleSubjects:hover {
            background-color: darkgreen;
        }

        .other_subject {
            display: none;
        }

        /* Add this CSS to your existing styles */
        .confirmation-dialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-radius: 5px;
        }

        .confirmation-dialog p {
            margin-bottom: 15px;
        }


        .confirmation-dialog-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #applicantPicture {
            width: 100%;
            /* Adjust width as a percentage of the container */
            max-width: 192px;
            min-width: 20px;
            height: auto;
            border-radius: 2%;
            float: right;
        }

        /* Styles for Custom Alert */
.custom-alert_OSS {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f44336;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    transition: opacity 0.5s;
    z-index: 1000;
  }
  
  .hidden {
    opacity: 0;
    visibility: hidden;
  }
  
  .show {
    opacity: 1;
    visibility: visible;
  }
  
  /* End of Custom alert Styles */

    </style>

    <div class="confirmation-dialog-overlay"></div>
    <div class="confirmation-dialog">
        <p></p>
        <div class="confirmation-buttons">
            <button data-confirmed="true">Confirm</button>
            <button data-confirmed="false">Cancel</button>
        </div>
    </div>

    <section id="content">
        <?php

        // Check if the success message session variable is set
        if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
            // Display success message with animation
            echo '<div class="success-message" id="successMessage">Data successfully updated!</div>';

            // Unset the session variable to avoid displaying the message again on page refresh
            unset($_SESSION['update_success']);
        }
        ?>


        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Applicants</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Applicants</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                        <li><a class="active" href="OSS_Dashboard.php">Home</a></li>
                        </li>
                    </ul>
                </div>
                <div class="button-container">
                    <a href="Oss_export.php?search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>"
                        class="btn-download">
                        <i class='bx bxs-file-export'></i>
                        <span class="text">Excel Export</span>
                    </a>

                </div>
            </div>

            <div id="custom-alert_OSS" class="custom-alert_OSS hidden">
            <span id="alert-message_OSS"></span>
        </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of Applicants</h3>
                        <!-- Add this input field for date filtering -->
                        <div class="headfornaturetosort">
                            <!--<form method="GET" action="" id="calendarFilterForm">-->
                            <!--    <label for="appointment_date"></label>-->
                            <!--    <input type="date" name="appointment_date" id="appointment_date">-->
                            <!--    <button type="submit"><i class='bx bx-filter'></i></button>-->
                            <!--</form>-->
                            <button type="button" id="toggleSelection" >
                                <i class='bx bx-select-multiple'></i> Toggle Selection
                            </button>

                            <button type="button" id="sendButton" data-tooltip="Send" style="display: none;">
                                <i class='bx bx-send'></i>
                            </button>
                        </div>
                    </div>
                    <style>
                        .table-container {
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
                                    <th>#</th>
                                    <th>Applicant #</th>
                                    <!-- <th>OSS Applicant #</th> -->
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>

                                    <th>Nature of Degree</th>
                                    <th>Program</th>
                                    <th>Academic Classification</th>
                                    <th>Admission Test Score</th>

                                    <th style="display: none;" id="selectColumn">
                                        <input type="checkbox" id="selectAllCheckbox">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                $counter = 1; // Initialize the counter before the loop
                                
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row['applicant_number'] . "</td>";
                                    // echo "<td>" . $row['OSS_Applicant_no'] . "</td>";
                                    echo "<td>" . $row['Last_Name'] . "</td>";
                                    echo "<td>" . $row['Name'] . "</td>";
                                    echo "<td>" . $row['Middle_Name'] . "</td>";

                                    echo "<td>" . $row['nature_of_degree'] . "</td>";
                                    echo "<td>" . $row['degree_applied'] . "</td>";
                                    echo "<td>" . $row['academic_classification'] . "</td>";
                                    echo "<td>" . $row['OSS_Admission_Test_Score'] . "</td>";
                                    echo "<td id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
                                    echo "</tr>";
                                    echo "</tr>";
                                    $counter++; // Increment the counter for the next row
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

                    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="mr-auto">Success!</strong>

                        </div>
                        <div class="toast-body" id="toast-body"></div>
                    </div>
                    <div id="confirmationModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <p>Are you sure you want to send these applicants to the Faculty?</p>
                            <button class="confirm" id="confirmSend">Confirm</button>
                            <button class="cancel">Cancel</button>
                        </div>
                    </div>
                    <div id="alertModal" class="sendmodal" style="display: none;">
                        <div class="sendmodal-content">
                            <p id="alertMessage"></p>
                        </div>
                    </div>

                    <div id="noSelectionModal" class="modal">
                        <div class="modal-content">
                            <span class="exit">&times;</span>
                            <br>
                            <p>Please select at least one applicant.</p>
                        </div>
                    </div>


                    <div id="alertModal" class="sendmodal">
                        <div class="sendmodal-content">
                            <p id="alertMessage"></p>
                        </div>
                    </div>


                </div>

                <div class="todo" style="display: none;">
                    <i class="bx bx-x close-form" style="float: right;font-size: 24px;"></i>

                    <!--<input type="radio" id="tab1" name="tabGroup1" class="tab" checked>-->
                    <!--<label class="tab-label" for="tab1">Applicant Data</label>-->
                    <input type="radio" id="tab1" name="tabGroup1" class="tab">
                    <label class="tab-label" for="tab1">Applicant Grades</label>
                    <div class="tab-content" id="content1" style="max-height: 400px; overflow-y: auto;">

                        <form id="updateProfileForm" class="tab1-content" method="post"
                            action="OSS_SubmitForm.php?filter=<?php echo urlencode($filter); ?>&search=<?php echo urlencode($search); ?>">


                            <input type="hidden" name="academic_classification" class="input"
                                id="academic_classification"
                                value="<?php echo $admissionData['academic_classification']; ?>" readonly>
                            <h2>Admission Test Score</h2>
                            <div class="form-container2">
                                <div class="form-group">
                                    <label class="small-label" for="OSS_Admission_Test_Score">Score</label>
                                    <input name="OSS_Admission_Test_Score" class="input" id="OSS_Admission_Test_Score"
                                        placeholder="Score"
                                        maxlength="6" oninput="validateScore(this)" value="<?php echo $admissionData['OSS_Admission_Test_Score']; ?>">
                                </div>
                            </div>
                            <!-- <h2>Remarks</h2>
                            <div class="form-container4">
                                <div class="form-group">
                                    <label class="small-label" for="OSS_Applicant_no">Admission test Applicant
                                        Number</label>
                                    <input name="OSS_Applicant_no" class="input" id="OSS_Applicant_no"
                                        placeholder="Enter Applicant Number"
                                        value="<?php echo $admissionData['OSS_Applicant_no']; ?>"
                                        oninput="formatApplicantNumber(this);" onclick="showLastApplicantNoModal();">
                                </div>
                                <div class="form-group">
                                    <label class="small-label" for="OSS_Endorsement_Slip">Received Endorsement slip from
                                        OUR Personnel </label>
                                    <select name="OSS_Endorsement_Slip" class="input" id="OSS_Endorsement_Slip">
                                        <option value="" disabled selected>Select </option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="small-label" for="OSS_Degree">Degree applied for as appearing in
                                        Admission Test Permit</label>
                                    <select name="OSS_Degree" class="input" id="OSS_Degree">
                                        <option value="" disabled selected>Select degree program</option>
                                        <?php
                                        // Fetch distinct colleges from programs table
                                        $distinct_colleges_query = "SELECT DISTINCT College FROM programs";
                                        $distinct_colleges_result = $conn->query($distinct_colleges_query);

                                        while ($college_row = $distinct_colleges_result->fetch_assoc()) {
                                            $college_name = $college_row['College'];
                                            ?>
                                            <optgroup label="<?php echo $college_name; ?>">
                                                <?php
                                                // Fetch courses associated with this college
                                                $courses_for_college_query = "SELECT Courses FROM programs WHERE College = ?";
                                                $stmt = $conn->prepare($courses_for_college_query);
                                                $stmt->bind_param("s", $college_name);
                                                $stmt->execute();
                                                $courses_for_college_result = $stmt->get_result();
                                                $stmt->close();

                                                // Display courses
                                                while ($course_row = $courses_for_college_result->fetch_assoc()) {
                                                    $course_name = $course_row['Courses'];
                                                    ?>
                                                    <option value="<?php echo $course_name; ?>"><?php echo $course_name; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </optgroup>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div> -->
                            <label class="small-label" for="Requirements_Remarks" style="white-space: nowrap;">Remarks
                                from the OSS</label>
                            <textarea name="OSS_Remarks" placeholder="Enter remarks..." class="input auto-expand"
                                id="OSS_Remarks"><?php echo $admissionData['OSS_Remarks']; ?></textarea>
                            <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">


                            <label class="small-label" for="OSS_Remarks" style="white-space: nowrap;">Remarks from OUR
                                Personnel</label>
                            <textarea name="Requirements_Remarks" placeholder="Enter remarks..."
                                class="input auto-expand" id="Requirements_Remarks"
                                readonly><?php echo $admissionData['Requirements_Remarks']; ?></textarea>
                            <button type="button" class="submit" onclick="confirmSubmission()">Submit</button>
                        </form>

                    </div>


                </div>
            </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>

    <div class="confirmation-dialoga" id="confirmationDialoga">
        <div class="dialoga-content">
            <p>Are you sure you want to submit the form?</p>
            <button class="confirm" onclick="submitForm()">Confirm</button>
            <button class="cancel" onclick="cancelSubmit()">Cancel</button>
        </div>
    </div>



    <div id="applicantNoModal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>Last entered applicant number: <?php echo $last_OSS_Applicant_no; ?></p>
            <button id="modalCloseBtn" class="confirm" onclick="hideLastApplicantNoModal();">OK</button>
        </div>
    </div>

    <script>
        // Function to format applicant number as per the given format
        function formatApplicantNumber(input) {
            var formatted = input.value.replace(/[^0-9]/g, '');

            // Check if the first group of digits (first four digits) is complete
            if (formatted.length >= 4) {
                if (formatted.charAt(4) !== '-') {
                    formatted = formatted.slice(0, 4) + '-' + formatted.slice(4);

                }

                // Check if the second group of digits (fifth digit) is complete
                if (formatted.length >= 6) {
                    if (formatted.charAt(6) !== '-') {
                        formatted = formatted.slice(0, 6) + '-' + formatted.slice(6);
                    }


                    // Check if the third group of digits (next five digits) is complete
                    if (formatted.length > 12) {
                        formatted = formatted.slice(0, 12);
                    }
                }
            }
            input.value = formatted;
        }

        var lastClickedValue = '';



// Check if the modal has been shown before
var modalShown = false;

function showLastApplicantNoModal() {
    // Only show the modal if it has not been shown before
    if (!modalShown) {
        var modal = document.getElementById("applicantNoModal");
        modal.style.display = "block";
        modalShown = true; // Set modalShown to true to indicate that the modal has been shown
    }
}

function hideLastApplicantNoModal() {
    var modal = document.getElementById("applicantNoModal");
    modal.style.display = "none";
}




        function confirmSubmission() {
            document.getElementById("confirmationDialoga").style.display = "block";
            document.getElementById("confirmationDialoga").dataset.formId = "updateProfileForm";
        }

        function confirmSubmission2() {
            document.getElementById("confirmationDialoga").style.display = "block";
            document.getElementById("confirmationDialoga").dataset.formId = "updateProfileForm2";
        }

        function submitForm() {
            var formId = document.getElementById("confirmationDialoga").dataset.formId;
            document.getElementById("confirmationDialoga").style.display = "none";
            document.getElementById(formId).submit();
        }

        function cancelSubmit() {
            document.getElementById("confirmationDialoga").style.display = "none";
        }
        $(document).ready(function () {

            // Check if there is a selected tab stored in local storage
            var masterlistTab = localStorage.getItem('masterlistTab');

            // If a tab was previously selected, show its content
            if (masterlistTab) {
                $('#' + masterlistTab).prop('checked', true); // Check the radio button corresponding to the selected tab
                $('.tab-content').hide(); // Hide all tab contents
                $('#content' + masterlistTab.substr(3)).show(); // Show the content of the selected tab
            } else {
                // If no tab was previously selected, default to the first tab
                $('#tab1').prop('checked', true);
                $('#content1').show();
            }

            // Store the ID of the selected tab in localStorage when a tab is clicked
            $('.tab').click(function () {
                var masterlistTabId = $(this).attr('id');
                localStorage.setItem('masterlistTab', masterlistTabId);

                // Hide all tab contents and show the content of the selected tab
                $('.tab-content').hide();
                $('#content' + masterlistTabId.substr(3)).show();
            });
            // Check if there is a selected row stored in local storage
            var selectedIdApplicants = localStorage.getItem('selectedIdApplicants');
            if (selectedIdApplicants) {

                // Highlight the selected row
                $('tr[data-id="' + selectedIdApplicants + '"]').addClass('selected');

                // Populate form fields with data corresponding to the selected row
                populateForm(selectedIdApplicants);

                // Show the todo div
                $('.todo').show();
            }

            $('.editRow').click(function (event) {
                // Check if the click target is not a button, checkbox, or its child elements
                if (!$(event.target).is('button') && !$(event.target).is('i') && !$(event.target).is(':checkbox')) {
                    // Get the 'data-id' attribute from the clicked row
                    var userId = $(this).data('id');

                    // Highlight the clicked row
                    $('.editRow').removeClass('selected');
                    $(this).addClass('selected');

                    // Populate form fields with data corresponding to the clicked row
                    populateForm(userId);

                    // Show the todo div
                    $('.todo').show();

                    // Store the selected row ID in local storage
                    localStorage.setItem('selectedIdApplicants', userId);
                }
            });

            // Click event handler for the close button
            $('.close-form').click(function () {
                // Hide the todo div
                $('.todo').hide();
                // Remove the selected class from all table rows
                $('.editRow').removeClass('selected');

                // Clear the selected row ID from local storage
                localStorage.removeItem('selectedIdApplicants');
            });

            function populateForm(userId) {
                // Send an AJAX request to fetch the user data based on the user ID
                $.ajax({
                    url: '../personnel/Personnel_fetchStudentdata.php', // replace with the actual URL for fetching user data
                    type: 'POST',
                    data: {
                        userId: userId
                    },
                    dataType: 'json',
                    success: function (response) {

                        $('#updateProfileForm input[name="id"]').val(response.id);

                        $('#updateProfileForm input[name="OSS_Applicant_no"]').val(response
                            .OSS_Applicant_no);
                        $('#updateProfileForm select[name="OSS_Endorsement_Slip"]').val(response
                            .OSS_Endorsement_Slip);
                        $('#updateProfileForm select[name="OSS_Degree"]').val(response.OSS_Degree);
                        $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response
                            .OSS_Admission_Test_Score);
                        $('#updateProfileForm textarea[name="OSS_Remarks"]').val(response.OSS_Remarks);
                        $('#updateProfileForm textarea[name="Requirements_Remarks"]').val(response
                            .Requirements_Remarks);
                        $('#updateProfileForm input[name="OSS_Schedule"]').val(response.OSS_Schedule);
                        $('#updateProfileForm input[name="OSS_From"]').val(response.OSS_From);
                        $('#updateProfileForm input[name="OSS_To"]').val(response.OSS_To);
                        $('#updateProfileForm input[name="Final_Remarks"]').val(response.Final_Remarks);


                        // Add similar logic for other form fields
                        // Display the form for editing
                        $('.todo').show();
                    },
                    error: function (error) {
                        console.error('Error fetching user data: ', error);
                    }
                });
            }
        });


        function showAlert_OSS(message) {
      var alertElement = document.getElementById("custom-alert_OSS");
      alertElement.classList.add("show");
      alertElement.classList.remove("hidden");
      document.getElementById("alert-message_OSS").innerText = message;
    
      setTimeout(function() {
        alertElement.classList.remove("show");
        alertElement.classList.add("hidden");
      }, 3000);
    }

        // Click event handler for the close button
        $('.close-form').click(function () {
            // Hide the form
            $('.todo').hide();
        });


        function validateScore(input) {
    var score = input.value.trim();
    var scoreRegex = /^[1-9]\d{0,3}$/;
    if (!scoreRegex.test(score)) {
        showAlert_OSS('Score must be a number, start with a non-zero digit, and have a maximum length of 4.');
        input.value = ''; // Clear the input field
    }
}




        function showToast(message, type) {
            // Display a toast message
            $('#toast-body').text(message);
            $('#toast').removeClass().addClass('toast').addClass(type).addClass('show');

            // Hide the toast after a few seconds
            setTimeout(function () {
                $('#toast').removeClass('show');
            }, 3000);
        }
        document.addEventListener('DOMContentLoaded', function () {
            var successMessage = document.getElementById('successMessage');

            if (successMessage) {
                successMessage.style.display = 'block';

                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            // Add click event listener to each row
            var rows = document.querySelectorAll('.editRow');
            rows.forEach(function (row) {
                row.addEventListener('click', function () {
                    // Remove 'selected' class from all rows
                    rows.forEach(function (r) {
                        r.classList.remove('selected');
                    });

                    // Add 'selected' class to the clicked row
                    this.classList.add('selected');
                });
            });
        });
        document.getElementById('toggleSelection').addEventListener('click', function () {
            var sendButton = document.getElementById('sendButton');
            var selectColumn = document.getElementById('selectColumn');
            var checkboxes = document.querySelectorAll('.select-checkbox');

            // Toggle the visibility of sendButton, selectColumn, and checkboxes
            sendButton.style.display = sendButton.style.display === 'none' ? 'block' : 'none';
            selectColumn.style.display = selectColumn.style.display === 'none' ? 'table-cell' : 'none';

            checkboxes.forEach(function (checkbox) {
                checkbox.style.display = checkbox.style.display === 'none' ? 'block' : 'none';
            });
        });

        document.getElementById('selectAllCheckbox').addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('.select-checkbox');

            // Iterate through all checkboxes and set their checked property accordingly
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById('selectAllCheckbox').checked;
            });
        });
        function hideModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        document.getElementById('sendButton').addEventListener('click', function () {
            // Check if any checkboxes are checked
            var checkboxes = document.querySelectorAll('.select-checkbox:checked');
            if (checkboxes.length === 0) {
                // Show the noSelectionModal if no checkboxes are checked
                document.getElementById('noSelectionModal').style.display = 'block';
                return; // Exit the function to prevent showing the confirmation modal
            }

            // Show confirmation modal
            document.getElementById('confirmationModal').style.display = 'block';
        });

        document.getElementById('confirmSend').addEventListener('click', function () {
            // Close confirmation modal
            document.getElementById('confirmationModal').style.display = 'none';

            // Get the selected row IDs
            var selectedRowIds = [];
            var checkboxes = document.querySelectorAll('.select-checkbox:checked');
            checkboxes.forEach(function (checkbox) {
                selectedRowIds.push(checkbox.parentNode.parentNode.dataset.id);
            });

            // AJAX call to send_selected_applicants.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Show success alert
                        document.getElementById('alertMessage').innerText = 'Sent Successfully to the Faculty!';
                        document.getElementById('alertModal').style.display = 'block';
                        // Hide success message after 3 seconds
                        setTimeout(function () {
                            document.getElementById('alertModal').style.display = 'none';
                        }, 3000);
                    } else {
                        // Show error alert
                        document.getElementById('alertMessage').innerText = 'Failed to send to the Faculty. Please try again later.';
                        document.getElementById('alertModal').style.display = 'block';
                    }
                }
            };
            xhr.open('POST', 'Oss_send.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ selectedRowIds: selectedRowIds }));
        });
        var cancelButtons = document.querySelectorAll('.cancel');
        cancelButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                document.getElementById('confirmationModal').style.display = 'none';
                document.getElementById('alertModal').style.display = 'none';
            });
        });



        // Close modals on close button click
        var closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                document.getElementById('noSelectionModal').style.display = 'none';
                document.getElementById('confirmationModal').style.display = 'none';
                document.getElementById('alertModal').style.display = 'none';
            });
        });

        // Close modals when clicking on the exit button
        var exitButtons = document.querySelectorAll('.exit');
        exitButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                hideModal(button.closest('.modal').id);
            });
        });


    </script>



    </div>

    </div>
    </div>
    </div>
    </div>



    </main>
    <!-- MAIN -->


    </section>
</body>

</html>