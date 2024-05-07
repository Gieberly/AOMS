<?php
include ("admin_cover.php");

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



// Construct query based on filter
if ($filter == 'toadmit') {
    $query = "SELECT * FROM admission_data 
              WHERE Admission_Result = 'NOA' 
              AND Personnel_Message = 'sent'
              AND (`Name` LIKE '%$search%' OR 
                   `Middle_Name` LIKE '%$search%' OR 
                   `Last_Name` LIKE '%$search%' OR 
                   `academic_classification` LIKE '%$search%' OR 
                   TRIM(`nature_of_degree`) = '$search' OR 
                   TRIM(`Personnel_Result`) = '$search' OR 
                    TRIM(`Admission_Result`) = '$search' OR 
                   `degree_applied` LIKE '%$search%')
              ORDER BY applicant_number ASC";
} elseif ($filter == 'reapplication') {
    $query = "SELECT * FROM admission_data 
              WHERE (Personnel_Result = 'NOR(Possible Qualifier-Non-Board)' OR 
                     Personnel_Result = 'NOR(Possible Qualifier)') 
              AND Personnel_Message = 'sent'
              AND (`Name` LIKE '%$search%' OR 
                   `Middle_Name` LIKE '%$search%' OR 
                   `Last_Name` LIKE '%$search%' OR 
                   `academic_classification` LIKE '%$search%' OR 
                   `email` LIKE '%$search%' OR 
                   TRIM(`nature_of_degree`) = '$search' OR 
                   TRIM(`Personnel_Result`) = '$search' OR 
                    TRIM(`Admission_Result`) = '$search' OR 
                   `degree_applied` LIKE '%$search%')
              ORDER BY applicant_number ASC";

              } elseif ($filter == 'notqualified') {
                $query = "SELECT * FROM admission_data 
                          WHERE (Personnel_Result = 'NOR(Not Qualified)') 
                          AND Personnel_Message = 'sent'
                          AND (`Name` LIKE '%$search%' OR 
                               `Middle_Name` LIKE '%$search%' OR 
                               `Last_Name` LIKE '%$search%' OR 
                               `academic_classification` LIKE '%$search%' OR 
                               `email` LIKE '%$search%' OR 
                               TRIM(`nature_of_degree`) = '$search' OR 
                               TRIM(`Personnel_Result`) = '$search' OR 
                                TRIM(`Admission_Result`) = '$search' OR 
                               `degree_applied` LIKE '%$search%')
                          ORDER BY applicant_number ASC";
} else {
    // Default query without filter
    $query = "SELECT * FROM admission_data WHERE 
              (`Name` LIKE '%$search%' OR 
              `Middle_Name` LIKE '%$search%' OR 
              `Last_Name` LIKE '%$search%' OR 
              `academic_classification` LIKE '%$search%' OR 
              `email` LIKE '%$search%' OR 
              TRIM(`nature_of_degree`) = '$search' OR 
              `degree_applied` LIKE '%$search%' OR
              `Name` LIKE '%$search%' OR 
              `Middle_Name` LIKE '%$search%' OR 
              TRIM(`Personnel_Result`) = '$search' OR 
               TRIM(`Admission_Result`) = '$search' OR 
              `Last_Name` LIKE '%$search%')
              AND Personnel_Message = 'sent'
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

    <title>BSU OUR Admission Admin</title>
    <?php include('../template/header_admin.php') ?>

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
        <style>
    /* CSS to style the buttons */
    .btn, .btn-Export {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px;
        text-decoration: none;
        color: #fff;
        background-color: green;
        border: none;
        border-radius: 20px; /* More curved border radius */
    }

    .btn:hover, .btn-Export:hover {
        background-color: darkgreen; /* Dark green with 70% opacity */
        color: white; /* Change text color to white */
    }
    /* CSS to style the icons and text */
    .btn .calendar-icon, .btn-Export .bx-file-export {
        margin-right: 5px;
    }

    /* Hide the default underline on hover */
    .btn:hover, .btn-Export:hover {
        text-decoration: none;
    }
</style>
            <div class="head-title">
                <div class="left">
                    <h1>Applicants</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Applicants</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                        <li><a class="active" href="admin_Dashboard.php">Home</a></li>
                        </li>
                    </ul>
                </div>
                <div class="button-container">
                    <a class="btn-Export" href="Personnel_Masterlist_Excel.php?search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>"
                        class="btn-download">
                        <i class='bx bxs-file-export'></i>
                        <span class="text">Excel Export</span>
                    </a>

                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of Applicants</h3>
                        <!-- Add this input field for date filtering -->
                        <div class="headfornaturetosort">
                            <form method="GET" action="" id="calendarFilterForm">
                               <label for="appointment_date"></label>
                               <input type="date" name="appointment_date" id="appointment_date">
                               <button type="submit"><i class='bx bx-filter'></i></button>
                            </form>
                            <button type="button" id="toggleSelection">
                                <i class='bx bx-select-multiple'></i> Toggle Selection
                            </button>

                            <button type="button" id="sendButton" style="display: none;">
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
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Nature of degree</th>
                                    <th>Program</th>
                                    <th>Classification</th>
                                    <th>Result</th>
                                    <th>Result as per admission policy</th>
                                    <th style="display: none;" id="selectColumn">
                                        <input type="checkbox" id="selectAllCheckbox">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <?php
                                $counter = 1; // Initialize the counter before the loop
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr id='selectedRow' class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row['applicant_number'] . "</td>";
                                    echo "<td>" . $row['Last_Name'] . "</td>";
                                    echo "<td>" . $row['Name'] . "</td>";
                                    echo "<td>" . $row['Middle_Name'] . "</td>";
                                    echo "<td>" . $row['nature_of_degree'] . "</td>";
                                    echo "<td>" . $row['degree_applied'] . "</td>";
                                    echo "<td>" . $row['academic_classification'] . "</td>";
                                    echo "<td>" . $row['Admission_Result'] . "</td>";
                                    echo "<td>" . $row['Personnel_Result'] . "</td>";

                                    echo "<td id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
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
                            <p>Are you sure you want to send the results to the applicants?</p>
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
                            action="Personnel_UpdateResult.php?filter=<?php echo urlencode($filter); ?>&search=<?php echo urlencode($search); ?>">


                            <input type="hidden" name="academic_classification" class="input"
                                id="academic_classification"
                                value="<?php echo $admissionData['academic_classification']; ?>" readonly>
                            <!-- Senior High School Graduates -->
                            <div class="SHS Average" style="display:none;">
                                <h2>Currently Enrolled as Grade 12<< /h2>

                                        <p class="personal_information"> Grade 11 Average</p>
                                        <div class="form-container2">

                                            <div class="form-group">
                                                <!-- Gr11_A1 -->
                                                <label class="small-label" for="Gr11_A1">1st SEM</label>
                                                <input name="Gr11_A1" class="input numeric-input" id="Gr11_A1"
                                                    placeholder="Enter Grade"
                                                    value="<?php echo $admissionData['Gr11_A1']; ?>" readonly>
                                                <!-- Gr11_A2 -->
                                            </div>
                                            <div class="form-group">
                                                <label class="small-label" for="Gr11_A2">2nd SEM</label>
                                                <input name="Gr11_A2" class="input numeric-input" autocomplete="off"
                                                    id="Gr11_A2" placeholder="Enter Grade"
                                                    value="<?php echo $admissionData['Gr11_A2']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <!-- Gr11_A3 -->
                                                <label class="small-label" for="Gr11_A3">3rd SEM</label>
                                                <input name="Gr11_A3" class="input numeric-input" autocomplete="off"
                                                    id="Gr11_A3" placeholder="Enter Grade"
                                                    value="<?php echo $admissionData['Gr11_A3']; ?>" readonly>
                                            </div>
                                            <div class="form-group"> <!-- Gr11_GWA -->
                                                <label class="small-label" for="Gr11_GWA">GWA</label>
                                                <input name="Gr11_GWA" class="input numeric-input" autocomplete="off"
                                                    id="Gr11_GWA" placeholder="Enter Grade"
                                                    value="<?php echo $admissionData['Gr11_GWA']; ?>" readonly>
                                            </div>

                                        </div>
                            </div>
                            <div class="Gr-12-Average" style="display: none;">
                                <h2>Senior High School Graduate </h2>
                                <p class="personal_information">Grade 12 Average</p>
                                <div class="form-container2">
                                    <div class="form-group">
                                        <!-- Gr12_A1 -->
                                        <label class="small-label" for="Gr12_A1">1st SEM</label>
                                        <input name="Gr12_A1" class="input numeric-input" id="Gr12_A1"
                                            placeholder="Enter Grade" value="<?php echo $admissionData['Gr12_A1']; ?>"
                                            readonly>

                                    </div>
                                    <div class="form-group"> <!-- Gr12_A2 -->
                                        <label class="small-label" for="Gr12_A2">2nd SEM</label>
                                        <input name="Gr12_A2" class="input numeric-input" autocomplete="off"
                                            id="Gr12_A2" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Gr12_A2']; ?>" readonly>
                                    </div>
                                    <div class="form-group"> <!-- Gr12_A3 -->
                                        <label class="small-label" for="Gr12_A3">3rd SEM</label>
                                        <input name="Gr12_A3" class="input numeric-input" autocomplete="off"
                                            id="Gr12_A3" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Gr12_A3']; ?>" readonly>

                                    </div>
                                    <div class="form-group"> <!-- Gr12_GWA -->
                                        <label class="small-label" for="Gr12_GWA">GWA</label>
                                        <input name="Gr12_GWA" class="input numeric-input" autocomplete="off"
                                            id="Gr12_GWA" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Gr12_GWA']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="Subjects" style="display: none;">
                                <p id="toggleSubjects">Other Subjects</p>
                                <br>
                                <div class="core_subject">
                                    <p class="personal_information">Grade in English</p>

                                    <div class="form-container7">
                                        <div class="form-group">
                                            <!-- English_Oral_Communication_Grade -->
                                            <label class="small-label" for="English_Oral_Communication_Grade">Oral
                                                Communication in Context
                                            </label>
                                            <input name="English_Oral_Communication_Grade" class="input numeric-input"
                                                autocomplete="off" id="English_Oral_Communication_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['English_Oral_Communication_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group"> <!-- English_Reading_Writing_Grade -->
                                            <label class="small-label" for="English_Reading_Writing_Grade">Reading and
                                                Writing Skills</label>
                                            <input name="English_Reading_Writing_Grade" class="input numeric-input"
                                                autocomplete="off" id="English_Reading_Writing_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['English_Reading_Writing_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group"> <!-- English_Academic_Grade -->
                                            <label class="small-label" for="English_Academic_Grade">Academic and
                                                Professional Purposes</label>
                                            <input name="English_Academic_Grade" class="input numeric-input"
                                                autocomplete="off" id="English_Academic_Grade" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['English_Academic_Grade']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="other_subject" style="display: none;">
                                    <p class="personal_information">OTHER ENGLISH COURSES (INDICATE COURSE AND GRADE
                                        ONLY IF THERE IS NO CORE ENGLISH COURSE)</p>

                                    <div class="form-container8">
                                        <div class="form-group">
                                            <!-- English_Subject_1 -->
                                            <label class="small-label" for="English_Subject_1">Course</label>
                                            <input name="English_Subject_1" class="input numeric-input"
                                                autocomplete="off" id="English_Subject_1" placeholder="Course"
                                                value="<?php echo $admissionData['English_Subject_1']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- English_Other_Courses_Grade -->
                                            <label class="small-label" for="English_Other_Courses_Grade">&nbsp;</label>
                                            <input name="English_Other_Courses_Grade" class="input numeric-input"
                                                autocomplete="off" id="English_Other_Courses_Grade" placeholder="Grade"
                                                value="<?php echo $admissionData['English_Other_Courses_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- English_Subject_2 -->
                                            <label class="small-label" for="English_Subject_2">Course</label>
                                            <input name="English_Subject_2" class="input numeric-input"
                                                autocomplete="off" id="English_Subject_2" placeholder="Course"
                                                value="<?php echo $admissionData['English_Subject_2']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="English_Other_Courses_Grade_2">&nbsp;
                                            </label>
                                            <input name="English_Other_Courses_Grade_2" class="input numeric-input"
                                                autocomplete="off" id="English_Other_Courses_Grade_2"
                                                placeholder="Grade"
                                                value="<?php echo $admissionData['English_Other_Courses_Grade_2']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="English_Subject_3">Course</label>
                                            <input name="English_Subject_3" class="input numeric-input"
                                                autocomplete="off" id="English_Subject_3" placeholder="Course"
                                                value="<?php echo $admissionData['English_Subject_3']; ?>" readonly>

                                        </div>


                                        <div class="form-group">
                                            <label class="small-label" for="English_Other_Courses_Grade_3">&nbsp;
                                            </label>
                                            <input name="English_Other_Courses_Grade_3" class="input numeric-input"
                                                autocomplete="off" id="English_Other_Courses_Grade_3"
                                                placeholder="Grade"
                                                value="<?php echo $admissionData['English_Other_Courses_Grade_3']; ?>"
                                                readonly>

                                        </div>

                                    </div>
                                </div>
                                <div class="core_subject">

                                    <p class="personal_information">Grade in Science</p>

                                    <div class="form-container9">
                                        <div class="form-group">
                                            <!-- Science_Earth_Science_Grade -->
                                            <label class="small-label"
                                                for="Science_Earth_Science_Grade">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Earth Science</label>
                                            <input name="Science_Earth_Science_Grade" class="input numeric-input"
                                                autocomplete="off" id="Science_Earth_Science_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Earth_Science_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group"> <!-- Science_Earth_and_Life_Science_Grade -->
                                            <label class="small-label" for="Science_Earth_and_Life_Science_Grade">Earth
                                                and Life Science</label>
                                            <input name="Science_Earth_and_Life_Science_Grade"
                                                class="input numeric-input" autocomplete="off"
                                                id="Science_Earth_and_Life_Science_Grade" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Earth_and_Life_Science_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group"> <!-- Science_Physical_Science_Grade -->
                                            <label class="small-label"
                                                for="Science_Physical_Science_Grade">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                Physical Science</label>
                                            <input name="Science_Physical_Science_Grade" class="input numeric-input"
                                                autocomplete="off" id="Science_Physical_Science_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Physical_Science_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group"> <!-- Science_Disaster_Readiness_Grade -->
                                            <label class="small-label" for="Science_Disaster_Readiness_Grade">DRRR for
                                                STEM and GAS strands</label>
                                            <input name="Science_Disaster_Readiness_Grade" class="input numeric-input"
                                                autocomplete="off" id="Science_Disaster_Readiness_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Disaster_Readiness_Grade']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="other_subject" style="display: none;">
                                    <p class="personal_information">OTHER SCIENCE COURSES (INDICATE COURSE AND GRADE
                                        ONLY IF THERE IS NO CORE ENGLISH COURSE)</p>
                                    <div class="form-container8">
                                        <div class="form-group">
                                            <!-- Science_Other_Courses_Grade -->
                                            <label class="small-label" for="Science_Subject_1">Course</label>
                                            <input name="Science_Subject_1" class="input numeric-input"
                                                autocomplete="off" id="Science_Subject_1" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Subject_1']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="Science_Other_Courses_Grade">&nbsp; </label>
                                            <input name="Science_Other_Courses_Grade" class="input numeric-input"
                                                autocomplete="off" id="Science_Other_Courses_Grade" placeholder="Grade"
                                                value="<?php echo $admissionData['Science_Other_Courses_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- Science_Other_Courses_Grade -->
                                            <label class="small-label" for="Science_Subject_2">Course</label>
                                            <input name="Science_Subject_2" class="input numeric-input"
                                                autocomplete="off" id="Science_Subject_2" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Subject_2']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="Science_Other_Courses_Grade_2">&nbsp;
                                            </label>
                                            <input name="Science_Other_Courses_Grade_2" class="input numeric-input"
                                                autocomplete="off" id="Science_Other_Courses_Grade_2"
                                                placeholder="Grade"
                                                value="<?php echo $admissionData['Science_Other_Courses_Grade_2']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- Science_Other_Courses_Grade -->
                                            <label class="small-label" for="Science_Subject_3">Course</label>
                                            <input name="Science_Subject_3" class="input numeric-input"
                                                autocomplete="off" id="Science_Subject_3" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Science_Subject_3']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="Science_Other_Courses_Grade_3">&nbsp;
                                            </label>
                                            <input name="Science_Other_Courses_Grade_3" class="input numeric-input"
                                                autocomplete="off" id="Science_Other_Courses_Grade_3"
                                                placeholder="Grade"
                                                value="<?php echo $admissionData['Science_Other_Courses_Grade_3']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="core_subject">
                                    <p class="personal_information">Grade in Math</p>
                                    <div class="form-container2">
                                        <div class="form-group">
                                            <!-- Math_General_Mathematics_Grade -->
                                            <label class="small-label" for="Math_General_Mathematics_Grade">General
                                                Mathematics</label>
                                            <input name="Math_General_Mathematics_Grade" class="input numeric-input"
                                                autocomplete="off" id="Math_General_Mathematics_Grade"
                                                placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Math_General_Mathematics_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- Math_Statistics_and_Probability_Grade -->
                                            <label class="small-label"
                                                for="Math_Statistics_and_Probability_Grade">Statistics and
                                                Probability</label>
                                            <input name="Math_Statistics_and_Probability_Grade"
                                                class="input numeric-input" autocomplete="off"
                                                id="Math_Statistics_and_Probability_Grade" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Math_Statistics_and_Probability_Grade']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="other_subject" style="display: none;">
                                    <p class="personal_information">OTHER Math COURSES (INDICATE COURSE AND GRADE ONLY
                                        IF THERE IS NO CORE ENGLISH COURSE)</p>

                                    <div class="form-container8">
                                        <div class="form-group">
                                            <!-- Math_Other_Courses_Grade -->
                                            <label class="small-label" for="Math_Subject_1">Course</label>
                                            <input name="Math_Subject_1" class="input numeric-input" autocomplete="off"
                                                id="Math_Subject_1" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Math_Subject_1']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="Math_Other_Courses_Grade">&nbsp; </label>
                                            <input name="Math_Other_Courses_Grade" class="input numeric-input"
                                                autocomplete="off" id="Math_Other_Courses_Grade" placeholder="Grade"
                                                value="<?php echo $admissionData['Math_Other_Courses_Grade']; ?>"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <!-- Math_Other_Courses_Grade -->
                                            <label class="small-label" for="Math_Subject_2">Course</label>
                                            <input name="Math_Subject_2" class="input numeric-input" autocomplete="off"
                                                id="Math_Subject_2" placeholder="Enter Grade"
                                                value="<?php echo $admissionData['Math_Subject_2']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="small-label" for="Math_Other_Courses_Grade_2">&nbsp; </label>
                                            <input name="Math_Other_Courses_Grade_2" class="input numeric-input"
                                                autocomplete="off" id="Math_Other_Courses_Grade_2" placeholder="Grade"
                                                value="<?php echo $admissionData['Math_Other_Courses_Grade_2']; ?>"
                                                readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="Transferee" style="display: none;">
                                <h2> Transferee</h2>
                            </div>


                            <div class="ALS" style="display: none;">
                                <h2> ALS/PEPT Completer </h2>
                                <p class="personal_information">STANDARD SCORE OF 95% OR HIGHER</p>
                                <div class="form-container2">
                                    <div class="form-group">
                                        <!-- ALS_English -->
                                        <label class="small-label" for="ALS_English">English</label>
                                        <input name="ALS_English" class="input numeric-input" autocomplete="off"
                                            id="ALS_English" placeholder="Enter Subject"
                                            value="<?php echo $admissionData['ALS_English']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <!-- ALS_English -->
                                        <label class="small-label" for="ALS_Math">Math</label>
                                        <input name="ALS_Math" class="input numeric-input" autocomplete="off"
                                            id="ALS_Math" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['ALS_Math']; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="HS-Graduate" style="display: none;">
                                <h2> School (Old Curriculum) Graduate </h2>
                                <p class="personal_information">At Least 86% for Board Program, No grade requirement for
                                    Non-Board Program</p>
                                <div class="form-container2">
                                    <div class="form-group">
                                        <!-- Old_HS_English_Grade -->
                                        <label class="small-label" for="Old_HS_English_Grade">English</label>
                                        <input name="Old_HS_English_Grade" class="input numeric-input"
                                            autocomplete="off" id="Old_HS_English_Grade" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Old_HS_English_Grade']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <!-- Old_HS_Math_Grade -->
                                        <label class="small-label" for="Old_HS_Math_Grade">Math</label>
                                        <input name="Old_HS_Math_Grade" class="input numeric-input" autocomplete="off"
                                            id="Old_HS_Math_Grade" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Old_HS_Math_Grade']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <!-- Old_HS_Science_Grade -->
                                        <label class="small-label" for="Old_HS_Science_Grade">Science</label>
                                        <input name="Old_HS_Science_Grade" class="input numeric-input"
                                            autocomplete="off" id="Old_HS_Science_Grade" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['Old_HS_Science_Grade']; ?>" readonly>
                                    </div>

                                </div>
                            </div>

                            <div class="2nd-degree" style="display: none;">
                                <h2> Second Degree</h2>

                            </div>
                            <div class="GWA-OTAS" style="display: none;">
                                <div class="form-container2">
                                    <div class="form-group"> <!-- GWA_OTAS -->
                                        <label class="small-label" for="GWA_OTAS">Average</label>
                                        <input name="GWA_OTAS" class="input numeric-input" autocomplete="off"
                                            id="GWA_OTAS" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['GWA_OTAS']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="test">
                                <h2>Admission Test Score</h2>
                                <div class="form-container2">
                                    <div class="form-group"> <!-- OSS_Admission_Test_Score -->
                                        <label class="small-label" for="OSS_Admission_Test_Score">Admission Test
                                            Score</label>
                                        <input name="OSS_Admission_Test_Score" class="input numeric-input"
                                            autocomplete="off" id="OSS_Admission_Test_Score" placeholder="Enter Grade"
                                            value="<?php echo $admissionData['OSS_Admission_Test_Score']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="Remarks">
                                <h2>Remarks</h2>

                                <div class="form-container6">
                                    <div class="form-group">

                                        <label class="small-label" for="nature_qualification"
                                            style="white-space: nowrap;">Qualification</label>
                                        <select name="nature_qualification" class="input" id="nature_qualification"
                                            disabled>
                                            <option value="" disabled selected>Select qualification</option>
                                            <option value="Non-Board/Board">Non-Board/Board</option>
                                            <option value="Non-Board">Non-Board</option>
                                            <option value="Not qualified as per policy">Not qualified as per policy
                                            </option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="small-label" for="Degree_Remarks"
                                            style="white-space: nowrap;">Degree meets admission policy</label>
                                        <select name="Degree_Remarks" class="input" id="Degree_Remarks" disabled>
                                            <option value="" disabled selected>Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <label class="small-label" for="Personnel_Result"
                                            style="white-space: nowrap;">Result as per admission policy</label>
                                        <select name="Personnel_Result" class="input" id="Personnel_Result">
                                            <option value="" disabled selected>Select qualification</option>
                                            <option value="NOA">NOA</option>
                                            <option value="NOR(Possible Qualifier)">NOR(Possible Qualifier)</option>
                                            <option value="NOR(Possible Qualifier-Non-Board)">NOR(PQ-NB)</option>

                                            <option value="NOR(Not Qualified)">NOR(Not Qualified)</option>

                                        </select>
                                    </div>
                                </div>

                                <label class="small-label" for="Requirements_Remarks"
                                    style="white-space: nowrap;">Remarks From the Personnel</label>
                                <textarea name="Requirements_Remarks" placeholder="Enter remarks..."
                                    class="input auto-expand"
                                    id="Requirements_Remarks"><?php echo $admissionData['Requirements_Remarks']; ?></textarea>
                                <label class="small-label" for="OSS_Remarks" style="white-space: nowrap;">Remarks From
                                    the
                                    OSS</label>
                                <textarea name="OSS_Remarks" placeholder="Enter remarks..." class="input auto-expand"
                                    id="OSS_Remarks" readonly><?php echo $admissionData['OSS_Remarks']; ?></textarea>
                                <div class="form-group">
                                    <label class="small-label" for="Final_Remarks" style="white-space: nowrap;">Remarks
                                        from the staff/faculty</label>
                                    <textarea name="Final_Remarks" placeholder="Enter remarks..."
                                        class="input auto-expand" id="Final_Remarks"
                                        readonly><?php echo $admissionData['Final_Remarks']; ?></textarea>
                                </div>

                            </div>


                            <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>" readonly>
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



    <script>


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
                        $('#applicantPicture').attr('src', response.id_picture);
                        $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
                        $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
                        $('#updateProfileForm input[name="college"]').val(response.college);
                        $('#updateProfileForm input[name="id"]').val(response.id);
                        $('#updateProfileForm input[name="high_school_name_address"]').val(response.high_school_name_address);
                        $('#updateProfileForm input[name="lrn"]').val(response.lrn);
                        $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);
                        $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
                        $('#updateProfileForm input[name="Gr11_A2"]').val(response.Gr11_A2);
                        $('#updateProfileForm input[name="Gr11_A3"]').val(response.Gr11_A3);
                        $('#updateProfileForm input[name="Gr11_GWA"]').val(response.Gr11_GWA);
                        $('#updateProfileForm input[name="GWA_OTAS"]').val(response.GWA_OTAS);
                        $('#updateProfileForm select[name="nature_qualification"]').val(response.nature_qualification);
                        $('#updateProfileForm select[name="Personnel_Result"]').val(response.Personnel_Result);
                        $('#updateProfileForm select[name="Degree_Remarks"]').val(response.Degree_Remarks);
                        $('#updateProfileForm input[name="English_Subject_1"]').val(response.English_Subject_1);
                        $('#updateProfileForm input[name="English_Subject_2"]').val(response.English_Subject_2);
                        $('#updateProfileForm input[name="English_Subject_3"]').val(response.English_Subject_3);
                        $('#updateProfileForm input[name="Science_Subject_1"]').val(response.Science_Subject_1);
                        $('#updateProfileForm input[name="Science_Subject_2"]').val(response.Science_Subject_2);
                        $('#updateProfileForm input[name="Science_Subject_3"]').val(response.Science_Subject_3);
                        $('#updateProfileForm input[name="Math_Subject_1"]').val(response.Math_Subject_1);
                        $('#updateProfileForm input[name="Math_Subject_2"]').val(response.Math_Subject_2);
                        $('#updateProfileForm input[name="Gr12_A1"]').val(response.Gr12_A1);
                        $('#updateProfileForm input[name="Gr12_A2"]').val(response.Gr12_A2);
                        $('#updateProfileForm input[name="Gr12_A3"]').val(response.Gr12_A3);
                        $('#updateProfileForm input[name="Gr12_GWA"]').val(response.Gr12_GWA);
                        $('#updateProfileForm input[name="English_Oral_Communication_Grade"]').val(response.English_Oral_Communication_Grade);
                        $('#updateProfileForm input[name="English_Reading_Writing_Grade"]').val(response.English_Reading_Writing_Grade);
                        $('#updateProfileForm input[name="English_Academic_Grade"]').val(response.English_Academic_Grade);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade"]').val(response.English_Other_Courses_Grade);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade_2"]').val(response.English_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade_3"]').val(response.English_Other_Courses_Grade_3);
                        $('#updateProfileForm input[name="Science_Earth_Science_Grade"]').val(response.Science_Earth_Science_Grade);
                        $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
                        $('#updateProfileForm input[name="Science_Earth_and_Life_Science_Grade"]').val(response.Science_Earth_and_Life_Science_Grade);
                        $('#updateProfileForm input[name="Science_Physical_Science_Grade"]').val(response.Science_Physical_Science_Grade);
                        $('#updateProfileForm input[name="Science_Disaster_Readiness_Grade"]').val(response.Science_Disaster_Readiness_Grade);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade"]').val(response.Science_Other_Courses_Grade);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade_2"]').val(response.Science_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade_3"]').val(response.Science_Other_Courses_Grade_3);
                        $('#updateProfileForm input[name="Math_General_Mathematics_Grade"]').val(response.Math_General_Mathematics_Grade);
                        $('#updateProfileForm input[name="Math_Statistics_and_Probability_Grade"]').val(response.Math_Statistics_and_Probability_Grade);
                        $('#updateProfileForm input[name="Math_Other_Courses_Grade"]').val(response.Math_Other_Courses_Grade);
                        $('#updateProfileForm input[name="Math_Other_Courses_Grade_2"]').val(response.Math_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="Old_HS_English_Grade"]').val(response.Old_HS_English_Grade);
                        $('#updateProfileForm input[name="Old_HS_Math_Grade"]').val(response.Old_HS_Math_Grade);
                        $('#updateProfileForm input[name="Old_HS_Science_Grade"]').val(response.Old_HS_Science_Grade);
                        $('#updateProfileForm input[name="ALS_English"]').val(response.ALS_English);
                        $('#updateProfileForm input[name="ALS_Math"]').val(response.ALS_Math);

                        $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
                        $('#updateProfileForm input[name="OSS_Endorsement_Slip"]').val(response.OSS_Endorsement_Slip);
                        $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response.OSS_Admission_Test_Score);
                        $('#updateProfileForm input[name="OSS_Remarks"]').val(response.OSS_Remarks);
                        $('#updateProfileForm input[name="Qualification_Nature_Degree"]').val(response.Qualification_Nature_Degree);
                        $('#updateProfileForm textarea[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
                        $('#updateProfileForm textarea[name="OSS_Remarks"]').val(response.OSS_Remarks);

                        $('#updateProfileForm input[name="Interview_Result"]').val(response.Interview_Result);
                        $('#updateProfileForm input[name="Endorsed"]').val(response.Endorsed);
                        $('#updateProfileForm input[name="Confirmed_Slot"]').val(response.Confirmed_Slot);
                        $('#updateProfileForm textarea[name="Final_Remarks"]').val(response.Final_Remarks);
                        $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);

                        $('#updateProfileForm input[name="college"]').val(response.college);
                        $('#applicantPicture').attr('src', response.id_picture);
                        $('#updateProfileForm2 input[name="Name"]').val(response.Name);
                        $('#updateProfileForm2 input[name="Middle_Name"]').val(response.Middle_Name);
                        $('#updateProfileForm2 input[name="Last_Name"]').val(response.Last_Name);
                        $('#updateProfileForm2 input[name="applicant_number"]').val(response.applicant_number);
                        $('#updateProfileForm2 input[name="birthplace"]').val(response.birthplace);
                        $('#updateProfileForm2 select[name="gender"]').val(response.gender);
                        $('#updateProfileForm2 input[name="birthdate"]').val(response.birthdate);
                        $('#updateProfileForm2 input[name="age"]').val(response.age);
                        $('#updateProfileForm2 input[name="civil_status"]').val(response.civil_status);
                        $('#updateProfileForm2 input[name="citizenship"]').val(response.citizenship);
                        $('#updateProfileForm2 input[name="nationality"]').val(response.nationality);
                        $('#updateProfileForm input[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
                        $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
                        $('#updateProfileForm2 input[name="phone_number"]').val(response.phone_number);
                        $('#updateProfileForm2 input[name="facebook"]').val(response.facebook);
                        $('#updateProfileForm2 input[name="email"]').val(response.email);
                        $('#updateProfileForm2 input[name="contact_person_1"]').val(response.contact_person_1);
                        $('#updateProfileForm2 input[name="contact_person_1_mobile"]').val(response.contact1_phone);
                        $('#updateProfileForm2 select[name="relationship_1"]').val(response.relationship_1);
                        $('#updateProfileForm2 input[name="contact_person_2"]').val(response.contact_person_2);
                        $('#updateProfileForm2 input[name="contact_person_2_mobile"]').val(response.contact_person_2_mobile);
                        $('#updateProfileForm2 select[name="relationship_2"]').val(response.relationship_2);
                        $('#updateProfileForm2 select[name="academic_classification"]').val(response.academic_classification);

                        $('#updateProfileForm2 select[name="college"]').val(response.college);
                        $('#updateProfileForm2 input[name="id"]').val(response.id);
                        $('#updateProfileForm2 input[name="high_school_name_address"]').val(response.high_school_name_address);
                        $('#updateProfileForm2 input[name="lrn"]').val(response.lrn);
                        $('#updateProfileForm2 select[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm2 select[name="nature_of_degree"]').val(response.nature_of_degree);
                        var academicClassification = response.academic_classification;



                        // Show the relevant div based on academic classification
                        $('.SHS-Average,.Gr-12-Average, .ALS, .Subjects, .GWA-OTAS, .Transferee, .Gr-12, .HS-Graduate, .2nd-degree, .Remarks').hide(); // Hide all divs first
                        if (academicClassification === 'Senior High School Graduate') {
                            $('.Gr-12-Average, .Subjects,.Remarks ').show();
                        } else if (academicClassification === 'Currently enrolled as Grade 12') {
                            $('.SHS-Average, .Subjects, .Remarks').show();
                        } else if (academicClassification === 'Transferee') {
                            $('.Transferee, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'ALS/PEPT Completer') {
                            $('.ALS, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'High School (Old Curriculum) Graduate') {
                            $('.HS-Graduate, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'Second Degree') {
                            $('.2nd-degree, .GWA-OTAS, .Remarks').show();
                        }

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


        // Click event handler for the close button
        $('.close-form').click(function () {
            // Hide the form
            $('.todo').hide();
        });


        function updateStatus(id, status) {
            // Show the confirmation dialog
            $('.confirmation-dialog').show();
            $('.confirmation-dialog-overlay').show();

            // Set the message in the dialog
            $('.confirmation-dialog p').text('Are you sure you want to set the status to ' + status + '?');

            // Handle button clicks in the confirmation dialog
            $('.confirmation-buttons button').click(function () {
                var userConfirmed = $(this).data('confirmed');
                if (userConfirmed) {
                    // User confirmed, send the AJAX request to update the status
                    $.ajax({
                        type: 'POST',
                        url: 'Personnel_UpdateStatus.php',
                        data: {
                            id: id,
                            status: status
                        },
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            if (response.success) {
                                // Update the status in the table cell
                                $('[data-id="' + id + '"] [data-field="appointment_status"]').text(status);
                                showToast(response.message, 'success');
                            } else {
                                showToast(response.message, 'error');
                            }
                        },
                        error: function (error) {
                            console.error('Error updating status:', error);
                        }
                    });
                }

                // Hide the confirmation dialog and overlay
                $('.confirmation-dialog').hide();
                $('.confirmation-dialog-overlay').hide();
            });
        }



        var toggleState = false; // Initial state

        document.getElementById('toggleSubjects').addEventListener('click', function () {
            var coreSubjects = document.querySelectorAll('.core_subject');
            var otherSubjects = document.querySelectorAll('.other_subject');

            if (toggleState) { // If currently showing other subjects, switch to showing core subjects
                coreSubjects.forEach(function (subject) {
                    subject.style.display = 'block';
                });

                otherSubjects.forEach(function (subject) {
                    subject.style.display = 'none';
                });

                this.textContent = "Other Subjects"; // Update text
                toggleState = false; // Update toggle state
            } else { // If currently showing core subjects, switch to showing other subjects
                coreSubjects.forEach(function (subject) {
                    subject.style.display = 'none';
                });

                otherSubjects.forEach(function (subject) {
                    subject.style.display = 'block';
                });

                this.textContent = "Show Core Subjects"; // Update text
                toggleState = true; // Update toggle state
            }
        });

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
                        document.getElementById('alertMessage').innerText = 'Sent Successfully to the Applicants!';
                        document.getElementById('alertModal').style.display = 'block';
                        // Hide success message after 3 seconds
                        setTimeout(function () {
                            document.getElementById('alertModal').style.display = 'none';
                        }, 3000);
                    } else {
                        // Show error alert
                        document.getElementById('alertMessage').innerText = 'Failed to send to the Appliacnts. Please try again later.';
                        document.getElementById('alertModal').style.display = 'block';
                    }
                }
            };
            xhr.open('POST', 'Personnel_Send_Result.php');
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