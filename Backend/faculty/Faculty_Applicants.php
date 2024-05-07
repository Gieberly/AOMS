<?php
include("Faculty_Cover.php");

$userId = $_SESSION['user_id'];

// Fetch user's department
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

// Check if the user's department is a college
$checkIfCollege = "SELECT COUNT(*) FROM programs WHERE College = ?";
$stmtCheckIfCollege = $conn->prepare($checkIfCollege);
$stmtCheckIfCollege->bind_param("s", $department);
$stmtCheckIfCollege->execute();
$isCollege = $stmtCheckIfCollege->fetch();
$stmtCheckIfCollege->close();

$allNonBoard = false;
if ($isCollege) {
    // Check all courses under the college to see if they are "Non-Board"
    $fetchCoursesQuery = "SELECT Nature_of_Degree FROM programs WHERE College = ?";
    $stmtFetchCourses = $conn->prepare($fetchCoursesQuery);
    $stmtFetchCourses->bind_param("s", $department);
    $stmtFetchCourses->execute();

    // Bind the result to `Nature_of_Degree`
    $stmtFetchCourses->bind_result($Nature_of_Degree);

    $isAllNonBoard = true; // Flag to check if all are "Non-Board"
    while ($stmtFetchCourses->fetch()) {
        if ($Nature_of_Degree !== 'Non-Board') { // If any course is not "Non-Board"
            $isAllNonBoard = false;
            break;
        }
    }

    $stmtFetchCourses->close();

    $allNonBoard = $isAllNonBoard;
}


// Fetch relevant courses based on the department
$courses = [];
if ($isCollege) {
    $fetchCoursesQuery = "SELECT Courses FROM programs WHERE College = ?";
    $stmtFetchCourses = $conn->prepare($fetchCoursesQuery);
    $stmtFetchCourses->bind_param("s", $department);
    $stmtFetchCourses->execute();
    $stmtFetchCourses->bind_result($course);

    while ($stmtFetchCourses->fetch()) {
        $courses[] = $course;
    }
    $stmtFetchCourses->close();
} else {
    $courses[] = $department; // Treat department as a specific course if not a college
}

// Store the search query in a session variable if it's set
if (isset($_GET['search'])) {
    $_SESSION['search'] = $_GET['search'];
}
if (isset($_GET['filter'])) {
    $_SESSION['filter'] = $_GET['filter'];
}

$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';
$filter = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';

// Base query with dynamic `IN` clause for multiple courses
$baseQuery = "SELECT *, 
              CASE 
                WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                ELSE Gr12_GWA
              END AS GWA
              FROM admission_data 
              WHERE degree_applied IN (" . implode(',', array_fill(0, count($courses), '?')) . ") 
              AND faculty_Message = 'sent'
              AND (`Name` LIKE ? OR 
                   `Middle_Name` LIKE ? OR 
                   `Last_Name` LIKE ? OR 
                   `applicant_number` LIKE ? OR 
                   academic_classification LIKE ? OR 
                   degree_applied LIKE ?)";

if ($filter == 'qualified') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Qualified)'";
} else if ($filter == 'qualifiedNQ') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
} else if ($filter == 'nor_qualifier') {
    $fetchStudentListQuery = $baseQuery . " AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')";
} else {
    $fetchStudentListQuery = $baseQuery;
}

// Create dynamic parameter binding
$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);

$paramTypes = str_repeat('s', count($courses) + 6); // +6 for search parameters
$searchParam = "%$search%";
$bindVariables = array_merge($courses, array_fill(0, 6, $searchParam));

// Ensure the correct number of parameters and types
$stmtFetchStudentList->bind_param($paramTypes, ...$bindVariables);

$stmtFetchStudentList->execute();
$result = $stmtFetchStudentList->get_result();
$stmtFetchStudentList->close();

// Further processing with $result to display data
?>






<head>




</head>

<body>


    <style>
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

        /* Modal styles */
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

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;

        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Modal */
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

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }




        /* Add this CSS to your stylesheet */
        input[readonly] {
            background-color: #f2f2f2;
            /* Light gray background color */
        }

        textarea[readonly] {
            background-color: #f2f2f2;
            /* Light gray background color */
        }

        .als_grade {
            color: #3C91E6;
        }

        .tooltip {
            position: absolute;
            z-index: 1;
            background-color: green;
            color: #fff;
            padding: 5px;
            border-radius: 6px;
            font-size: 12px;
        }

        .failing_grade {
            background-color: hsl(350, 100%, 80%);
            /* Darker shade of red with adjusted lightness */
        }



        .other_subjects {
            color: #3C91E6;
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

        /* Close Button */

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Buttons */
        /* Buttons */
        #confirmSend,
        .yes,
        {
        padding: 10px 15px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
        display: inline-block;
        }

        #confirmSend,
        .yes {
            background-color: #4CAF50;
            /* Green color for "Confirm" button */
            color: white;
        }


        #confirmSend:hover,
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
            z-index: 9;
            animation: slideInUp 0.3s ease-in-out, fadeOut 2s ease-in-out 0.3s forwards;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
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

        .form-container5 {
            display: grid;
            grid-template-columns: 40% 40% 15%;
            gap: 10px;
        }

        .form-container6 {
            display: grid;
            grid-template-columns: 50% 15%;
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
    </style>


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
                        <li><a class="active" href="Faculty_Dashboard.php">Home</a></li>
                        </li>
                    </ul>
                </div>
                <div class="button-container">
                    <a href="excel.php?search=<?php echo urlencode($search); ?>&filter=<?php echo urlencode($filter); ?>&export_excel=1"
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
                            <select id="dropdownMenu">
                                <option value="">Sort Applicants Grade</option>
                                <option value="gwa">GWA</option>
                                <option value="test">Test Score</option>
                                <option class="Board_only" value="oaralcom">Oral communication in context</option>
                                <option class="Board_only" value="rewri">Reading and writing skills</option>
                                <option class="Board_only" value="engca">English for academic and professional purposes
                                </option>
                                <option class="Board_only" value="earscie">Earth Science</option>
                                <option class="Board_only" value="earli">Earth and Life Science</option>
                                <option class="Board_only" value="phylscie">Physical Science</option>
                                <option class="Board_only" value="dire">Disaster Readiness and Risk Reduction</option>
                                <option class="Board_only" value="genma">General Mathematics</option>
                                <option class="Board_only" value="stapro">Statistics and Probability</option>
                                <option class="Board_only" value="english">English</option>
                                <option class="Board_only" value="math">Math</option>
                                <option class="Board_only" value="scie">Science</option>
                            </select>
                            <button type="button" id="sort">
                                <i class='bx bx-sort-up'></i>
                            </button>
                            <!--<form method="GET" action="" id="calendarFilterForm">-->
                            <!--    <label for="appointment_date"></label>-->
                            <!--    <input type="date" name="appointment_date" id="appointment_date">-->
                            <!--    <button type="submit"><i class='bx bx-filter'></i></button>-->
                            <!--</form>-->
                            <button type="button" id="toggleSelection">
                                <i class='bx bx-select-multiple'></i> Toggle Selection
                            </button>

                            <button type="button" id="sendButton" style="display: none;">
                                <i class='bx bx-send'></i>
                            </button>
                        </div>
                    </div>
                    <style>
                        #dropdownMenu {
                            appearance: none;
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            background-color: #fff;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            /* Border radius */
                            padding: 6px 12px;
                            /* Adjusted padding */
                            font-size: 14px;
                            /* Adjusted font size */
                            width: 100%;
                            max-width: 300px;
                            cursor: pointer;
                        }

                        /* Style the options */
                        #dropdownMenu option {
                            background-color: #fff;
                            color: #333;
                        }

                        /* Style the hover effect */
                        #dropdownMenu option:hover {
                            background-color: #f0f0f0;
                        }

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
                    </style>

                    <div class="table-container">

                        <table id="studentTable">
                            <thead id="thead">
                                <tr>
                                <?php if (!$allNonBoard): ?>
                                    <th colspan="9" style="text-align: center;"></th>
                                    <th style="background-color: Yellow;text-align: center;" class="Board_only"
                                        colspan="3">English</th>
                                    <th style="background-color: #F88379;text-align: center;" class="Board_only"
                                        colspan="4">Science</th>
                                    <th style="background-color: #00FFFF;text-align: center;" class="Board_only"
                                        colspan="2">Math</th>
                                    <th class="Board_only" colspan="3"
                                        style="text-align: center;background-color: lightgreen;">Old high school
                                        curriculum/ALS</th>

                                    <th class="Board_only"></th>
                                    <th class="Board_only"></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Applicant #</th>
                                    <th>Last Name</th>
                                    <th>Middle Name</th>
                                    <th>First Name</th>
                                    <th>Classification</th>
                                    <th>Program</th>
                                    <!--<th>Nature</th> -->
                                    <th id="gwa">GWA</th>
                                    <th id="test">Test Score</th>

                                    <th id="oaralcom" class="Board_only" style="background-color: Yellow;">Oral
                                        communication in
                                        context</th>
                                    <th id="rewri" class="Board_only" style="background-color: Yellow;">Reading and
                                        writing skills
                                    </th>
                                    <th id="engca" class="Board_only" style="background-color: Yellow;">English for
                                        academic and
                                        professional purposes</th>
                                    <th id="earscie" class="Board_only" style="background-color: #F88379;">Earth Science
                                    </th>
                                    <th id="earli" class="Board_only" style="background-color: #F88379;">Earth and Life
                                        Science
                                    </th>
                                    <th id="phylscie" class="Board_only" style="background-color: #F88379;">Physical
                                        Science</th>
                                    <th id="dire" class="Board_only" style="background-color: #F88379;">Disaster
                                        Readiness and
                                        Risk Reduction</th>
                                    <th id="genma" class="Board_only" style="background-color: #00FFFF;">General
                                        Mathematics</th>
                                    <th id="stapro" class="Board_only" style="background-color: #00FFFF;">Statistics and
                                        Probability
                                    </th>
                                    <th id="english" class="Board_only" style="background-color:lightgreen">English</th>
                                    <th id="math" class="Board_only" style="background-color:lightgreen">Math</th>
                                    <th id="scie" class="Board_only" style="background-color:lightgreen">Science</th>
                                    <th>Result</th>
                                    <th class="">Personnel Eval</th>

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
                                    echo "<td>" . $row['Last_Name'] . "</td>";
                                    echo "<td>" . $row['Name'] . "</td>";
                                    echo "<td>" . $row['Middle_Name'] . "</td>";
                                    echo "<td>" . $row['academic_classification'] . "</td>";
                                    echo "<td>" . $row['degree_applied'] . "</td>";
                                    echo "<td style='display:none'>" . $row['nature_of_degree'] . "</td>";

                                    // Check nature_of_degree and academic_classification for failing grades
                                    $failing_grade = false;
                                    if ($row['nature_of_degree'] == "Board") {
                                        // condition based on academic_classification and nature_of_degree
                                        if (
                                            $row['academic_classification'] == "Senior High School Graduates" ||
                                            $row['academic_classification'] == "High School (Old Curriculum) Graduates" ||
                                            $row['academic_classification'] == "Currently Grade 12"
                                        ) {
                                        } elseif (
                                            $row['academic_classification'] == "ALS/PEPT Completers" ||
                                            $row['academic_classification'] == "Transferees" ||
                                            $row['academic_classification'] == "Second Degree"
                                        ) {
                                            if ($row['GWA'] < 80) {
                                                $failing_grade = true;
                                            }
                                        }
                                    } elseif ($row['nature_of_degree'] == "Non-Board") {
                                        // similar conditions as above
                                        // additional conditions based on academic_classification
                                        if (
                                            $row['academic_classification'] == "Senior High School Graduates" ||
                                            $row['academic_classification'] == "High School (Old Curriculum) Graduates" ||
                                            $row['academic_classification'] == "Currently Grade 12"
                                        ) {
                                            if ($row['GWA'] < 80) {
                                                $failing_grade = true;
                                            }
                                        } elseif (
                                            $row['academic_classification'] == "ALS/PEPT Completers" ||
                                            $row['academic_classification'] == "Transferees" ||
                                            $row['academic_classification'] == "Second Degree"
                                        ) {
                                            if ($row['GWA'] < 80) {
                                                $failing_grade = true;
                                            }
                                        }
                                    }

                                    // Apply background color based on failing grade
                                    if ($failing_grade) {
                                        echo "<td class='failing_grade'>" . number_format($row['GWA'], 2) . "</td>";
                                    } else {
                                        echo "<td>" . number_format($row['GWA'], 2) . "</td>";
                                    }

                                    // Determine Admission Score
                                    $admissionScore = $row['OSS_Admission_Test_Score'];

                                    // Check if the score is failing and apply CSS class accordingly
                                    $admissionScoreClass = '';
                                    if ($admissionScore != null && $admissionScore != '' && $admissionScore < 85) {
                                        $admissionScoreClass = 'failing_grade';
                                    }

                                    // Add Admission Score
                                    echo "<td class='{$admissionScoreClass}'>" . $admissionScore . "</td>";
                                    // Determine ORAL COMMUNICATION IN CONTEXT grade
                                    $oralCommunicationGrade = ($row['English_Oral_Communication_Grade'] != null && $row['English_Oral_Communication_Grade'] != '') ? $row['English_Oral_Communication_Grade'] : $row['English_Other_Courses_Grade'];

                                    // Check if the grade is fetched from English_Other_Courses_Grade column and apply CSS class accordingly
                                    $oralCommunicationClass = '';
                                    if ($oralCommunicationGrade != null && $oralCommunicationGrade != '' && $oralCommunicationGrade < 86) {
                                        if ($row['English_Other_Courses_Grade'] != null && $row['English_Other_Courses_Grade'] != '') {
                                            $oralCommunicationClass = 'failing_grade other_subjects';
                                        } else {
                                            $oralCommunicationClass = 'failing_grade';
                                        }
                                    } elseif ($row['English_Other_Courses_Grade'] != null && $row['English_Other_Courses_Grade'] != '') {
                                        $oralCommunicationClass = 'other_subjects';
                                    }

                                    // Add English_Subject_1 data as a data attribute
                                    $englishSubject1 = $row['English_Subject_1'];

                                    echo "<td ' class='Board_only {$oralCommunicationClass}' data-english-subject='{$englishSubject1}'>" . $oralCommunicationGrade . "</td>";
                                    // Determine READING AND WRITING SKILLS grade and subject
                                    $readingWritingGrade = ($row['English_Reading_Writing_Grade'] != null && $row['English_Reading_Writing_Grade'] != '') ? $row['English_Reading_Writing_Grade'] : $row['English_Other_Courses_Grade_2'];
                                    $readingWritingSubject = $row['English_Subject_2'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $readingWritingClass = '';
                                    if ($readingWritingGrade != null && $readingWritingGrade != '' && $readingWritingGrade < 86) {
                                        if ($row['English_Other_Courses_Grade_2'] != null && $row['English_Other_Courses_Grade_2'] != '') {
                                            $readingWritingClass = 'failing_grade other_subjects';
                                        } else {
                                            $readingWritingClass = 'failing_grade';
                                        }
                                    } elseif ($row['English_Other_Courses_Grade_2'] != null && $row['English_Other_Courses_Grade_2'] != '') {
                                        $readingWritingClass = 'other_subjects';
                                    }

                                    // Add READING AND WRITING SKILLS grade and subject data as data attributes
                                    echo "<td class='Board_only {$readingWritingClass}' data-english-subject='{$readingWritingSubject}'>" . $readingWritingGrade . "</td>";
                                    // Determine ENGLISH FOR ACADEMIC AND PROFESSIONAL PURPOSES grade and subject
                                    $englishAcademicGrade = ($row['English_Academic_Grade'] != null && $row['English_Academic_Grade'] != '') ? $row['English_Academic_Grade'] : $row['English_Other_Courses_Grade_3'];
                                    $englishAcademicSubject = $row['English_Subject_3'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $englishAcademicClass = '';
                                    if ($englishAcademicGrade != null && $englishAcademicGrade != '' && $englishAcademicGrade < 86) {
                                        if ($row['English_Other_Courses_Grade_3'] != null && $row['English_Other_Courses_Grade_3'] != '') {
                                            $englishAcademicClass = 'failing_grade other_subjects';
                                        } else {
                                            $englishAcademicClass = 'failing_grade';
                                        }
                                    } elseif ($row['English_Other_Courses_Grade_3'] != null && $row['English_Other_Courses_Grade_3'] != '') {
                                        $englishAcademicClass = 'other_subjects';
                                    }

                                    // Add ENGLISH FOR ACADEMIC AND PROFESSIONAL PURPOSES grade and subject data as data attributes
                                    echo "<td class='Board_only {$englishAcademicClass}' data-english-subject='{$englishAcademicSubject}'>" . $englishAcademicGrade . "</td>";
                                    // Determine Earth Science grade and subject
                                    $earthScienceGrade = ($row['Science_Earth_Science_Grade'] != null && $row['Science_Earth_Science_Grade'] != '') ? $row['Science_Earth_Science_Grade'] : $row['Science_Other_Courses_Grade'];
                                    $earthScienceSubject = $row['Science_Subject_1'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $earthScienceClass = '';
                                    if ($earthScienceGrade != null && $earthScienceGrade != '' && $earthScienceGrade < 86) {
                                        if ($row['Science_Other_Courses_Grade'] != null && $row['Science_Other_Courses_Grade'] != '') {
                                            $earthScienceClass = 'failing_grade other_subjects';
                                        } else {
                                            $earthScienceClass = 'failing_grade';
                                        }
                                    } elseif ($row['Science_Other_Courses_Grade'] != null && $row['Science_Other_Courses_Grade'] != '') {
                                        $earthScienceClass = 'other_subjects';
                                    }

                                    // Add Earth Science grade and subject data as data attributes
                                    echo "<td class='Board_only {$earthScienceClass}' data-science-subject='{$earthScienceSubject}'>" . $earthScienceGrade . "</td>";
                                    // Determine Earth and Life Science grade and subject
                                    $earthLifeScienceGrade = ($row['Science_Earth_and_Life_Science_Grade'] != null && $row['Science_Earth_and_Life_Science_Grade'] != '') ? $row['Science_Earth_and_Life_Science_Grade'] : $row['Science_Other_Courses_Grade_2'];
                                    $earthLifeScienceSubject = $row['Science_Subject_2'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $earthLifeScienceClass = '';
                                    if ($earthLifeScienceGrade != null && $earthLifeScienceGrade != '' && $earthLifeScienceGrade < 86) {
                                        if ($row['Science_Other_Courses_Grade_2'] != null && $row['Science_Other_Courses_Grade_2'] != '') {
                                            $earthLifeScienceClass = 'failing_grade other_subjects';
                                        } else {
                                            $earthLifeScienceClass = 'failing_grade';
                                        }
                                    } elseif ($row['Science_Other_Courses_Grade_2'] != null && $row['Science_Other_Courses_Grade_2'] != '') {
                                        $earthLifeScienceClass = 'other_subjects';
                                    }
                                    // Add Earth and Life Science grade and subject data as data attributes
                                    echo "<td class=' Board_only {$earthLifeScienceClass}' data-science-subject='{$earthLifeScienceSubject}'>" . $earthLifeScienceGrade . "</td>";
                                    // Determine Physical Science grade and subject
                                    $physicalScienceGrade = ($row['Science_Physical_Science_Grade'] != null && $row['Science_Physical_Science_Grade'] != '') ? $row['Science_Physical_Science_Grade'] : $row['Science_Other_Courses_Grade_3'];
                                    $physicalScienceSubject = $row['Science_Subject_3'];
                                    // Check if the grade is failing and apply CSS class accordingly
                                    $physicalScienceClass = '';
                                    if ($physicalScienceGrade != null && $physicalScienceGrade != '' && $physicalScienceGrade < 86) {
                                        if ($row['Science_Other_Courses_Grade_3'] != null && $row['Science_Other_Courses_Grade_3'] != '') {
                                            $physicalScienceClass = 'failing_grade other_subjects';
                                        } else {
                                            $physicalScienceClass = 'failing_grade';
                                        }
                                    } elseif ($row['Science_Other_Courses_Grade_3'] != null && $row['Science_Other_Courses_Grade_3'] != '') {
                                        $physicalScienceClass = 'other_subjects';
                                    }
                                    // Add Physical Science grade and subject data as data attributes
                                    echo "<td class=' Board_only {$physicalScienceClass}' data-science-subject='{$physicalScienceSubject}'>" . $physicalScienceGrade . "</td>";
                                    // Determine Disaster Readiness and Risk Reduction grade
                                    $disasterReadinessGrade = $row['Science_Disaster_Readiness_Grade'];
                                    // Check if the grade is failing and apply CSS class accordingly
                                    $disasterReadinessClass = '';
                                    if ($disasterReadinessGrade != null && $disasterReadinessGrade != '' && $disasterReadinessGrade < 86) {
                                        $disasterReadinessClass = 'failing_grade';
                                    }
                                    // Add Disaster Readiness and Risk Reduction grade as data attribute
                                    echo "<td class=' Board_only {$disasterReadinessClass}'>" . $disasterReadinessGrade . "</td>";
                                    // Determine General Mathematics grade
                                    $generalMathGrade = ($row['Math_General_Mathematics_Grade'] != null && $row['Math_General_Mathematics_Grade'] != '') ? $row['Math_General_Mathematics_Grade'] : $row['Math_Other_Courses_Grade'];
                                    $generalMathSubject = $row['Math_Subject_1'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $generalMathClass = '';
                                    if ($generalMathGrade != null && $generalMathGrade != '' && $generalMathGrade < 86) {
                                        if ($row['Math_Other_Courses_Grade'] != null && $row['Math_Other_Courses_Grade'] != '') {
                                            $generalMathClass = 'failing_grade other_subjects';
                                        } else {
                                            $generalMathClass = 'failing_grade';
                                        }
                                    } elseif ($row['Math_Other_Courses_Grade'] != null && $row['Math_Other_Courses_Grade'] != '') {
                                        $generalMathClass = 'other_subjects';
                                    }
                                    // Add General Mathematics grade and subject data as data attributes
                                    echo "<td class=' Board_only {$generalMathClass}' data-math-subject='{$generalMathSubject}'>" . $generalMathGrade . "</td>";
                                    // Determine Statistics and Probability grade
                                    $statsProbabilityGrade = ($row['Math_Statistics_and_Probability_Grade'] != null && $row['Math_Statistics_and_Probability_Grade'] != '') ? $row['Math_Statistics_and_Probability_Grade'] : $row['Math_Other_Courses_Grade_2'];
                                    $statsProbabilitySubject = $row['Math_Subject_2'];

                                    // Check if the grade is failing and apply CSS class accordingly
                                    $statsProbabilityClass = '';
                                    if ($statsProbabilityGrade != null && $statsProbabilityGrade != '' && $statsProbabilityGrade < 86) {
                                        if ($row['Math_Other_Courses_Grade_2'] != null && $row['Math_Other_Courses_Grade_2'] != '') {
                                            $statsProbabilityClass = 'failing_grade other_subjects';
                                        } else {
                                            $statsProbabilityClass = 'failing_grade';
                                        }
                                    } elseif ($row['Math_Other_Courses_Grade_2'] != null && $row['Math_Other_Courses_Grade_2'] != '') {
                                        $statsProbabilityClass = 'other_subjects';
                                    }
                                    // Add Statistics and Probability grade and subject data as data attributes
                                    echo "<td class=' Board_only {$statsProbabilityClass}' data-math-subject='{$statsProbabilitySubject}'>" . $statsProbabilityGrade . "</td>";
                                    // Determine English grade
                                    $englishGrade = ($row['Old_HS_English_Grade'] != null && $row['Old_HS_English_Grade'] != '') ? $row['Old_HS_English_Grade'] : $row['ALS_English'];
                                    // Check if the grade is failing and apply CSS class accordingly
                                    $englishClass = '';
                                    if ($englishGrade != null && $englishGrade != '' && $englishGrade < 86) {
                                        $englishClass = 'failing_grade';
                                    }
                                    // Add English grade as data attribute
                                    echo "<td class='Board_only {$englishClass}'>" . $englishGrade . "</td>";

                                    // Determine Math grade
                                    // Determine Math grade
                                    $mathGrade = ($row['Old_HS_Math_Grade'] != null && $row['Old_HS_Math_Grade'] != '') ? $row['Old_HS_Math_Grade'] : $row['ALS_Math'];
                                    // Check if the grade is failing and apply CSS class accordingly
                                    $mathClass = '';
                                    if ($mathGrade != null && $mathGrade != '' && $mathGrade < 86) {
                                        $mathClass = 'failing_grade';
                                    }
                                    // Add Math grade as data attribute
                                    echo "<td class='Board_only {$mathClass}'>" . $mathGrade . "</td>";

                                    // Determine Science grade
                                    $scienceGrade = $row['Old_HS_Science_Grade'];
                                    // Check if the grade is failing and apply CSS class accordingly
                                    $scienceClass = '';
                                    if ($scienceGrade != null && $scienceGrade != '' && $scienceGrade < 86) {
                                        $scienceClass = 'failing_grade';
                                    }
                                    // Add Science grade as data attribute
                                    echo "<td class=' Board_only {$scienceClass}'>" . $scienceGrade . "</td>";


                                    echo "<td>" . $row['Admission_Result'] . "</td>";
                                    echo "<td>" . $row['Personnel_Result'] . "</td>";
                                    echo "<td id='checkbox-{$row['id']}'><input type='checkbox' style='display: none;' class='select-checkbox' id='checkbox-{$row['id']}'></td>";
                                    $counter++; // Increment the counter for the next row
                                }
                                ?>
                            </tbody>
                            <?php endif; ?>
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
                            action="Submit.php?filter=<?php echo urlencode($filter); ?>&search=<?php echo urlencode($search); ?>">

                            <div class="form-container6">
                                <div class="form-group">
                                    <label class="small-label" for="nature_qualification"
                                        style="white-space: nowrap;">Qualification</label>
                                    <input name="nature_qualification" class="input" id="degree_applied"
                                        value="<?php echo $admissionData['nature_qualification']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="small-label" for="Degree_Remarks" style="white-space: nowrap;">Degree
                                        meets admission policy</label>
                                    <input name="Degree_Remarks" class="input" id="degree_applied"
                                        value="<?php echo $admissionData['Degree_Remarks']; ?>" readonly>
                                </div>


                            </div>
                            <label class="small-label" for="OSS_Remarks" style="white-space: nowrap;">Remarks From the
                                OSS</label>
                            <textarea name="OSS_Remarks" placeholder="Enter remarks..." class="input auto-expand"
                                id="OSS_Remarks" readonly><?php echo $admissionData['OSS_Remarks']; ?></textarea>
                            <br>

                            <label class="small-label" for="Requirements_Remarks" style="white-space: nowrap;">Remarks
                                From the OUR Personnels</label>
                            <textarea name="Requirements_Remarks" placeholder="Enter remarks..."
                                class="input auto-expand" id="Requirements_Remarks"
                                readonly><?php echo $admissionData['Requirements_Remarks']; ?></textarea>
                            <div class="form-container6">
                                <div class="form-group">
                                    <label class="small-label" for="Admission_Result"
                                        style="white-space: nowrap;">Result</label>
                                    <select name="Admission_Result" class="input" id="Admission_Result">
                                        <option value="" disabled selected>Select Result</option>
                                        <option value="NOA(Admitted-Qualified)">NOA(Admitted-Qualified)</option>
                                        <option value="NOA(Admitted-Not Qualified)">NOA(Admitted-Not Qualified)</option>

                                        <option value="NOR">NOR</option>

                                    </select>
                                </div>

                            </div>
                            <label class="small-label" for="Final_Remarks" style="white-space: nowrap;">Remarks</label>
                            <textarea name="Final_Remarks" placeholder="Enter remarks..." class="input auto-expand"
                                id="Final_Remarks"><?php echo $admissionData['Final_Remarks']; ?></textarea>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">
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
                        $('#updateProfileForm input[name="nature_qualification"]').val(response.nature_qualification);
                        $('#updateProfileForm input[name="Degree_Remarks"]').val(response.Degree_Remarks);
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
                        $('#updateProfileForm input[name="ALS_Math"]').val(response.ALS_Math);
                        $('#updateProfileForm input[name="ALS_Science"]').val(response.ALS_Science);
                        $('#updateProfileForm select[name="Admission_Result"]').val(response.Admission_Result);

                        $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
                        $('#updateProfileForm input[name="OSS_Endorsement_Slip"]').val(response.OSS_Endorsement_Slip);
                        $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response.OSS_Admission_Test_Score);
                        $('#updateProfileForm input[name="OSS_Remarks"]').val(response.OSS_Remarks);
                        $('#updateProfileForm input[name="Qualification_Nature_Degree"]').val(response.Qualification_Nature_Degree);
                        $('#updateProfileForm textarea[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
                        $('#updateProfileForm textarea[name="Final_Remarks"]').val(response.Final_Remarks);
                        $('#updateProfileForm textarea[name="OSS_Remarks"]').val(response.OSS_Remarks);
                        $('#updateProfileForm input[name="Interview_Result"]').val(response.Interview_Result);
                        $('#updateProfileForm input[name="Endorsed"]').val(response.Endorsed);
                        $('#updateProfileForm input[name="Confirmed_Slot"]').val(response.Confirmed_Slot);
                        $('#updateProfileForm input[name="Final_Remarks"]').val(response.Final_Remarks);
                        $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);

                        $('#updateProfileForm input[name="college"]').val(response.college);




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
            xhr.open('POST', 'Faculty_send.php');
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

  $(document).ready(function () {
            $('#sort').click(function () {
                var column = $('#dropdownMenu').val();
                if (column === 'gwa') {
                    sortByColumn(7); // Index 7 corresponds to the GWA column
                } else if (column === 'test') {
                    sortByColumn(8); // Index 8 corresponds to the Test Score column
                } else if (column === 'oaralcom') {
                    sortByColumn(9); // Index 9 corresponds to the Oral Communication in Context column
                } else if (column === 'rewri') {
                    sortByColumn(10); // Index 10 corresponds to the Reading and Writing Skills column
                } else if (column === 'engca') {
                    sortByColumn(11); // Index 11 corresponds to the English for Academic and Professional Purposes column
                } else if (column === 'earscie') {
                    sortByColumn(12); // Index 12 corresponds to the Earth Science column
                } else if (column === 'earli') {
                    sortByColumn(13); // Index 13 corresponds to the Earth and Life Science column
                } else if (column === 'phylscie') {
                    sortByColumn(14); // Index 14 corresponds to the Physical Science column
                } else if (column === 'dire') {
                    sortByColumn(15); // Index 15 corresponds to the Disaster Readiness and Risk Reduction column
                } else if (column === 'genma') {
                    sortByColumn(16); // Index 16 corresponds to the General Mathematics column
                } else if (column === 'stapro') {
                    sortByColumn(17); // Index 17 corresponds to the Statistics and Probability column
                } else if (column === 'english') {
                    sortByColumn(18); // Index 18 corresponds to the English column
                } else if (column === 'math') {
                    sortByColumn(19); // Index 19 corresponds to the Math column
                } else if (column === 'scie') {
                    sortByColumn(20); // Index 20 corresponds to the Science column
                }
            });

            function sortByColumn(index) {
                var tbody = $('#tbody');
                var rows = tbody.find('tr').get();
                rows.sort(function (a, b) {
                    var aValue = parseFloat($(a).find('td').eq(index).text());
                    var bValue = parseFloat($(b).find('td').eq(index).text());
                    if (isNaN(aValue)) return 1; // Move empty values to the bottom
                    if (isNaN(bValue)) return -1;
                    return bValue - aValue; // Sort from highest to lowest
                });

                // Remove previous sorting class
                tbody.find('td.sorted-column').removeClass('sorted-column');

                $.each(rows, function (index, row) {
                    var sortedCell = $(row).find('td').eq(index);
                    sortedCell.addClass('sorted-column'); // Add class to sorted column
                    tbody.append(row);
                });
            }
        });

 // JavaScript for hovering effect to display English_Subject_1 data
        const oralCommunicationCells = document.querySelectorAll('.editRow td[data-english-subject]');
        oralCommunicationCells.forEach(cell => {
            cell.addEventListener('mouseenter', function () {
                const isOtherCoursesGrade = this.classList.contains('other_subjects');
                if (isOtherCoursesGrade) {
                    const englishSubject1 = this.getAttribute('data-english-subject');
                    const tooltip = document.createElement('div');
                    tooltip.classList.add('tooltip');
                    tooltip.textContent = englishSubject1;
                    document.body.appendChild(tooltip);
                    const rect = this.getBoundingClientRect();
                    tooltip.style.top = (rect.top + window.pageYOffset - tooltip.offsetHeight) + 'px';
                    tooltip.style.left = (rect.left + window.pageXOffset + (this.offsetWidth - tooltip.offsetWidth) / 2) + 'px';
                }
            });
            cell.addEventListener('mouseleave', function () {
                const tooltip = document.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });
        // JavaScript for hovering effect to display English_Subject_1 data
        const scienceCells = document.querySelectorAll('.editRow td[data-science-subject]');
        scienceCells.forEach(cell => {
            cell.addEventListener('mouseenter', function () {
                const isOtherCoursesGrade = this.classList.contains('other_subjects');
                if (isOtherCoursesGrade) {
                    const scienceSubject = this.getAttribute('data-science-subject');
                    const tooltip = document.createElement('div');
                    tooltip.classList.add('tooltip');
                    tooltip.textContent = scienceSubject;
                    document.body.appendChild(tooltip);
                    const rect = this.getBoundingClientRect();
                    tooltip.style.top = (rect.top + window.pageYOffset - tooltip.offsetHeight) + 'px';
                    tooltip.style.left = (rect.left + window.pageXOffset + (this.offsetWidth - tooltip.offsetWidth) / 2) + 'px';
                }
            });
            cell.addEventListener('mouseleave', function () {
                const tooltip = document.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });
        // JavaScript for hovering effect to display Math Subject data
        const mathCells = document.querySelectorAll('.editRow td[data-math-subject]');
        mathCells.forEach(cell => {
            cell.addEventListener('mouseenter', function () {
                const isOtherCoursesGrade = this.classList.contains('other_subjects');
                if (isOtherCoursesGrade) {
                    const mathSubject = this.getAttribute('data-math-subject');
                    const tooltip = document.createElement('div');
                    tooltip.classList.add('tooltip');
                    tooltip.textContent = mathSubject;
                    document.body.appendChild(tooltip);
                    const rect = this.getBoundingClientRect();
                    tooltip.style.top = (rect.top + window.pageYOffset - tooltip.offsetHeight) + 'px';
                    tooltip.style.left = (rect.left + window.pageXOffset + (this.offsetWidth - tooltip.offsetWidth) / 2) + 'px';
                }
            });
            cell.addEventListener('mouseleave', function () {
                const tooltip = document.querySelector('.tooltip');
                if (tooltip) {
                    tooltip.remove();
                }
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