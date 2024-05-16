<?php
include ("admin_cover.php");

// Capture selected academic year from POST data
$startYear = isset($_POST['start_year']) ? mysqli_real_escape_string($conn, $_POST['start_year']) : null;
$endYear = isset($_POST['end_year']) ? mysqli_real_escape_string($conn, $_POST['end_year']) : null;

// If no academic year is selected, use the first one from the dropdown
if (!$startYear || !$endYear) {
    // Get the latest admission period
    $latestPeriod = getLatestAdmissionPeriod($conn);
    if (!empty($latestPeriod)) {
        $startYear = $latestPeriod['start_year'];
        $endYear = $latestPeriod['end_year'];
    } else {
        // Handle case when no admission periods are available
        // You may set default values or handle the error accordingly
        $startYear = null;
        $endYear = null;
    }
}
// Count not qualified applicants meeting specified conditions
$sql = "SELECT COUNT(*) AS total_not_qualified_applicants FROM admission_data WHERE Personnel_Result = 'NOR(Not Qualified)'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalNotQualApplicants = $row["total_not_qualified_applicants"];
} else {
    $totalNotQualApplicants = 0; // Set default value if no rows found
}

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
$sql = "SELECT COUNT(*) AS total_admitted_applicants FROM admission_data WHERE Admission_Result = 'NOA(Admitted-Qualified)'  OR Admission_Result = 'NOA(Admitted-Not Qualified)'  AND Personnel_Message = 'sent'";
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
// Initialize other variables with default values

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

$sqlApprovedPersonnel = "SELECT COUNT(*) AS count_approved_personnel FROM users WHERE userType = 'Personnel' AND lstatus = 'Approved'";
$resultApprovedPersonnel = $conn->query($sqlApprovedPersonnel);
$countApprovedPersonnel = $resultApprovedPersonnel->fetch_assoc()['count_approved_personnel'];

$sqlApprovedFaculty = "SELECT COUNT(*) AS count_approved_faculty FROM users WHERE userType = 'Faculty' AND lstatus = 'Approved'";
$resultApprovedFaculty = $conn->query($sqlApprovedFaculty);
$countApprovedFaculty = $resultApprovedFaculty->fetch_assoc()['count_approved_faculty'];

$sqlApprovedOSS = "SELECT COUNT(*) AS count_approved_oss FROM users WHERE userType = 'OSS' AND lstatus = 'Approved'";
$resultApprovedOSS = $conn->query($sqlApprovedOSS);
$countApprovedOSS = $resultApprovedOSS->fetch_assoc()['count_approved_oss'];

// Get total counts for each user type
$sqlPersonnel = "SELECT COUNT(*) AS count_personnel FROM users WHERE userType = 'Personnel'";
$resultPersonnel = $conn->query($sqlPersonnel);
$countPersonnel = $resultPersonnel->fetch_assoc()['count_personnel'];

$sqlFaculty = "SELECT COUNT(*) AS count_faculty FROM users WHERE userType = 'Faculty'";
$resultFaculty = $conn->query($sqlFaculty);
$countFaculty = $resultFaculty->fetch_assoc()['count_faculty'];

$sqlOSS = "SELECT COUNT(*) AS count_oss FROM users WHERE userType = 'OSS'";
$resultOSS = $conn->query($sqlOSS);
$countOSS = $resultOSS->fetch_assoc()['count_oss'];

// Encode counts into JSON format
$userCounts = [
    'Personnel' => $countPersonnel,
    'Faculty' => $countFaculty,
    'OSS' => $countOSS
];

$approvedUserCounts = [
    'Personnel' => $countApprovedPersonnel,
    'Faculty' => $countApprovedFaculty,
    'OSS' => $countApprovedOSS
];
$sqlPendingPersonnel = "SELECT COUNT(*) AS count_pending_personnel FROM users WHERE userType = 'Personnel' AND lstatus = 'Pending'";
$resultPendingPersonnel = $conn->query($sqlPendingPersonnel);
$countPendingPersonnel = $resultPendingPersonnel->fetch_assoc()['count_pending_personnel'];

$sqlPendingFaculty = "SELECT COUNT(*) AS count_pending_faculty FROM users WHERE userType = 'Faculty' AND lstatus = 'Pending'";
$resultPendingFaculty = $conn->query($sqlPendingFaculty);
$countPendingFaculty = $resultPendingFaculty->fetch_assoc()['count_pending_faculty'];

$sqlPendingOSS = "SELECT COUNT(*) AS count_pending_oss FROM users WHERE userType = 'OSS' AND lstatus = 'Pending'";
$resultPendingOSS = $conn->query($sqlPendingOSS);
$countPendingOSS = $resultPendingOSS->fetch_assoc()['count_pending_oss'];

// Get total counts for each user type (already retrieved in previous code)
// No need to re-query the database for total counts

// Encode counts into JSON format
$pendingUserCounts = [
    'Personnel' => $countPendingPersonnel,
    'Faculty' => $countPendingFaculty,
    'OSS' => $countPendingOSS
];
$sqlRejectedPersonnel = "SELECT COUNT(*) AS count_rejected_personnel FROM users WHERE userType = 'Personnel' AND lstatus = 'Rejected'";
$resultRejectedPersonnel = $conn->query($sqlRejectedPersonnel);
$countRejectedPersonnel = $resultRejectedPersonnel->fetch_assoc()['count_rejected_personnel'];

$sqlRejectedFaculty = "SELECT COUNT(*) AS count_rejected_faculty FROM users WHERE userType = 'Faculty' AND lstatus = 'Rejected'";
$resultRejectedFaculty = $conn->query($sqlRejectedFaculty);
$countRejectedFaculty = $resultRejectedFaculty->fetch_assoc()['count_rejected_faculty'];

$sqlRejectedOSS = "SELECT COUNT(*) AS count_rejected_oss FROM users WHERE userType = 'OSS' AND lstatus = 'Rejected'";
$resultRejectedOSS = $conn->query($sqlRejectedOSS);
$countRejectedOSS = $resultRejectedOSS->fetch_assoc()['count_rejected_oss'];

// Get total counts for each user type (already retrieved in previous code)
// No need to re-query the database for total counts

// Encode counts into JSON format
$rejectedUserCounts = [
    'Personnel' => $countRejectedPersonnel,
    'Faculty' => $countRejectedFaculty,
    'OSS' => $countRejectedOSS
];

// Query to fetch pending users
$sqlPendingUsers = "SELECT COUNT(*) AS count_pending_users FROM users WHERE lstatus = 'Pending' AND userType != 'Student'";
$resultPendingUsers = $conn->query($sqlPendingUsers);
$countPendingUser = $resultPendingUsers->fetch_assoc()['count_pending_users'];


// Query to count approved users for each user type
$sqlApprovedPersonnel = "SELECT COUNT(*) AS count_approved_personnel FROM users WHERE userType = 'Personnel' AND lstatus = 'Approved'";
$resultApprovedPersonnel = $conn->query($sqlApprovedPersonnel);
$countApprovedPersonnel = $resultApprovedPersonnel->fetch_assoc()['count_approved_personnel'];

$sqlApprovedFaculty = "SELECT COUNT(*) AS count_approved_faculty FROM users WHERE userType = 'Faculty' AND lstatus = 'Approved'";
$resultApprovedFaculty = $conn->query($sqlApprovedFaculty);
$countApprovedFaculty = $resultApprovedFaculty->fetch_assoc()['count_approved_faculty'];

$sqlApprovedOSS = "SELECT COUNT(*) AS count_approved_oss FROM users WHERE userType = 'OSS' AND lstatus = 'Approved'";
$resultApprovedOSS = $conn->query($sqlApprovedOSS);
$countApprovedOSS = $resultApprovedOSS->fetch_assoc()['count_approved_oss'];

// Calculate total count of approved users
$countApprovedUsers = $countApprovedPersonnel + $countApprovedFaculty + $countApprovedOSS;

// Query to count rejected accounts for each user type
$sqlRejectedPersonnel = "SELECT COUNT(*) AS count_rejected_personnel FROM users WHERE userType = 'Personnel' AND lstatus = 'Rejected'";
$resultRejectedPersonnel = $conn->query($sqlRejectedPersonnel);
$countRejectedPersonnel = $resultRejectedPersonnel->fetch_assoc()['count_rejected_personnel'];

$sqlRejectedFaculty = "SELECT COUNT(*) AS count_rejected_faculty FROM users WHERE userType = 'Faculty' AND lstatus = 'Rejected'";
$resultRejectedFaculty = $conn->query($sqlRejectedFaculty);
$countRejectedFaculty = $resultRejectedFaculty->fetch_assoc()['count_rejected_faculty'];

$sqlRejectedOSS = "SELECT COUNT(*) AS count_rejected_oss FROM users WHERE userType = 'OSS' AND lstatus = 'Rejected'";
$resultRejectedOSS = $conn->query($sqlRejectedOSS);
$countRejectedOSS = $resultRejectedOSS->fetch_assoc()['count_rejected_oss'];

// Calculate total count of rejected accounts
$countRejectedUsers = $countRejectedPersonnel + $countRejectedFaculty + $countRejectedOSS;



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

// Fetch pending accounts from the users table
$pending_query = "SELECT * FROM users WHERE lstatus = 'Pending' AND userType != 'Student'";
$pending_result = $conn->query($pending_query);

?>


<head>
    <meta charset="UTF-8">
    <title>BSU OUR Admission Unit Personnel</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <!-- CONTENT -->
    <section id="content">
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
            .button.delete-btn,
            .button.check-btn {
                background: none;
                border: none;
                padding: 0;
                cursor: pointer;
            }

            .button.inc-btn i,
            .button.check-btn i,
            .button.delete-btn i {
                font-size: 13px;
                color: black;
            }

            .button.inc-btn:hover i {
                color: orange;
            }

            .button.check-btn:hover i {
                color: green;
            }

            .button.delete-btn:hover i {
                color: red;
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

            input[readonly] {
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
        <!-- MAIN -->
        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none;">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="dashboard_admin.php" style="text-decoration:none">Home</a></li>
                        </ul>
                    </div>


                </div>
                <div>
                    <!--Modal-->
                    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="mr-auto">Success!</strong>

                        </div>
                        <div class="toast-body" id="toast-body"></div>
                    </div>
                    <div class="confirmation-dialog-overlay"></div>
                    <div class="confirmation-dialog">
                        <p></p>
                        <div class="confirmation-buttons">
                            <button class="confirm" data-confirmed="true">Confirm</button>
                            <button class="cancel" data-confirmed="false">Cancel</button>
                        </div>
                    </div>


                    <div class="modal fade" id="admissionAddModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Create New Admission Period</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="error" id="err"></p>
                                </div>
                                <form id="saveAdmission">
                                    <div class="modal-body">
                                        <div id="error-message-add" class="alert alert-danger" style="display: none;">
                                        </div>
                                        <div id="message-add" class="alert alert-success" style="display: none;"></div>

                                        <!-- Warning Message -->
                                        <div class="alert alert-warning" role="alert">
                                            Warning: Creating a new admission period will archive all previous data of
                                            all users.
                                        </div>

                                        <div class="form-group">
                                            <label for="start">Start of Admission</label>
                                            <input type="date" class="form-control" id="start" name="start"
                                                placeholder="Enter date">
                                        </div>
                                        <div class="form-group">
                                            <label for="end">End of Admission</label>
                                            <input type="date" class="form-control" id="end" name="end"
                                                placeholder="Enter Admission End">
                                        </div>
                                        <div class="form-group">
                                            <label for="sem">Select Semester</label>
                                            <select class="custom-select" name="sem" id="sem">
                                                <!-- Add name attribute -->
                                                <option selected>Choose...</option>
                                                <option value="1st Semester">1st Semester</option>
                                                <option value="2nd Semester">2nd Semester</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="acad">Academic Year</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="start_year"
                                                        name="start_year" placeholder="YYYY">
                                                </div>
                                                -
                                                <div class="col">
                                                    <input type="text" class="form-control" id="end_year"
                                                        name="end_year" placeholder="YYYY">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Admission</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal End-->
                    <!-- Edit Staff Modal -->
                    <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="error" id="err"></p>
                                </div>
                                <form id="updateUser">
                                    <div class="modal-body">
                                        <div id="error-message-edit" class="alert alert-danger" style="display: none;">
                                        </div>
                                        <div id="message-edit" class="alert alert-success" style="display: none;"></div>

                                        <input type="hidden" name="staff_id" id="staff_id">

                                        <div class="mb-3">
                                            <label for="">First name</label>
                                            <input type="text" name="fname" id="fname" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Middle Name</label>
                                            <input type="text" name="mname" id="mname" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Last Name</label>
                                            <input type="text" name="lname" id="lname" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Department</label>
                                            <input type="text" name="dept" id="dept" class="form-control"
                                                placeholder="Enter Designation" />
                                        </div>
                                        <div class="input-group mb-3">
                                            <label for="">Designation</label>
                                            <input type="text" name="designation" id="designation" class="form-control"
                                                placeholder="Enter Designation" />
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <label for="status">Select Status</label>
                                                <select class="custom-select" name="status" id="status">
                                                    <!-- Add name attribute -->
                                                    <option selected>Choose...</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Rejected">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="office">Select Office</label>
                                            <select class="form-control" name="office" id="office">
                                                <!-- Add name attribute -->
                                                <option selected>Choose...</option>
                                                <option value="Admin">BSU-OUR Administrator</option>
                                                <option value="Faculty">BSU- Faculty/Staff</option>
                                                <option value="Personnel">BSU-OUR Personnel</option>
                                                <option value="OSS">BSU-OSS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Staff Modal End -->
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
                        <a href="admin_masterlist.php?filter=toadmit">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                            <h3><?php echo $totalAdmittedApplicants; ?></h3>
                            <p>Qualified Applicants for Admission</p>
                        </span>
                    </li>

                    <li id="admitted-box">
                        <a href="admin_masterlist.php?filter=reapplication">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $totalReadmittedApplicants; ?></h3>
                            <p>Possible Qualifier</p>
                            <span class="text">
                            </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="admin_masterlist.php?filter=notqualified">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                            <h3><?php echo $totalNotQualApplicants; ?></h3>
                            <p>Not Qualified Applicants</p>
                        </span>
                    </li>
                </ul>
                <ul class="box-info">


                    <li id="admission-box">
                        <i class='bx bxs-user-account'></i>
                        <span class="text">
                            <h3 id="admission-applicants"><?php echo $countApprovedUsers; ?></h3>
                            <p>Approved Personnel Accounts</p>
                        </span>
                    </li>

                    <li id="admitted-box">
                        <i class='bx bx-user-check'></i>
                        <span class="text">
                            <h3 id="personnel"><?php echo $countPendingUser; ?></h3>
                            <p>Pending Personnel Accounts</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <i class='bx bx-user-x'></i>
                        <span class="text">
                            <h3 id="applicants-with-results"><?php echo $countRejectedUsers; ?></h3>
                            <p>Rejected Personnel Accounts</p>
                        </span>
                    </li>

                </ul>

            </div>
            <!--Table-->
            <div class="table-data">
                <div class="order" id="programsContainer">
                    <div class="head">
                        <h4>Monitoring table</h4>
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
                        <table id="programs">
                            <thead id="thead">
                                <tr>
                                    <th colspan="10" style="text-align: center;"></th>
                                    <th style="background-color: #C9DAF8;text-align: center;" class="Board_only"
                                        colspan="2">Admitted as per College submission</th>
                                    <th></th>

                                    <th style="background-color: #F4CCCC;text-align: center;" class="Board_only"
                                        colspan="3">Not Admitted</th>

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
                                    echo "<td>" . $total_slots . "</td>"; // Display total 
                                
                                    echo "<td>" . $program['num_applicants'] . "</td>"; // Display number of applicant
                                    $total_remaining = $program['No_of_Sections'] * $program['No_of_Students_Per_Section'] - $program['num_applicants'];

                                    echo "<td>" . $total_remaining . "</td>"; // Display remaining slots
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

            <div class="table-data">
                <div class="order">
                    <div id="table-container">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="panel-title"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Table for displaying student data -->
                            <table id="dashboard" class="display responsive wrap" width="100%" id="courses">
                                <!-- table header -->
                                <h3>Pending Accounts</h3>
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>User Type</th>
                                        <th>Account Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="datalist">
                                    <?php
                                    $rowNumber = 1; // Initialize a counter for the row numbers
                                    while ($row = $pending_result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$rowNumber}</td>"; // Display the row number
                                        echo "<td>{$row['last_name']}</td>";
                                        echo "<td>{$row['name']}</td>";
                                        echo "<td>{$row['mname']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td>{$row['Department']}</td>";
                                        echo "<td>{$row['Designation']}</td>";
                                        echo "<td>{$row['userType']}</td>";
                                        echo "<td>{$row['lstatus']}</td>"; // Display account status
                                    
                                        // Action buttons for Approve/Reject with appropriate event handling
                                        echo "<td>
                                    <div class='button-container'>
                                       <button type='button' class='button check-btn' data-tooltip='Approve' onclick='updateStatus({$row['id']}, \"Approved\")'>
                                        <i class='bx bxs-check-circle'></i>
                                   </button>
                                   <button type='button' class='button delete-btn'  data-tooltip='Reject' onclick='updateStatus({$row['id']}, \"Rejected\")'>
                                        <i class='bx bxs-x-circle'></i>
                                   </button>
                                   </div>
                                   </td>";

                                        echo "</tr>"; // End of the row
                                        $rowNumber++; // Increment the row counter
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <style>
                        .button.inc-btn,
                        .button.delete-btn,
                        .button.check-btn {
                            background: none;
                            border: none;
                            padding: 0;
                            cursor: pointer;
                        }

                        .button.inc-btn i,
                        .button.check-btn i,
                        .button.delete-btn i {
                            font-size: 13px;
                            color: black;
                        }

                        .button.inc-btn:hover i {
                            color: orange;
                        }

                        .button.check-btn:hover i {
                            color: green;
                        }

                        .button.delete-btn:hover i {
                            color: red;
                        }
                    </style>
                </div>
                <!--OffCanvas-->
                <!--End of Canvass-->
            </div>
            <div class="table-data">
                <div class="order">
                    <h3>Applicants Monitoring Graph</h3>
                    <!-- Add this input field for date filtering -->

                    <div class="headfornaturetosort">
                        <div class="button-container">

                            <label for="remaining-slots"></label>
                            <button class="toggle-button" onclick="toggleChartType()">Switch Chart Type</button>
                        </div>
                    </div>
                    <canvas id="applicantsAndSlotsChart"></canvas>

                </div>
            </div>
            <!--Table-->
            <div class="table-data">

                <div class="order">
                    <h3>Personnel Monitoring Graph</h3>
                    <!-- Add this input field for date filtering -->

                    <canvas id="PersonnelChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
            <!--Table-->
            <div class="table-data">
                <div class="order">
                    <div id="table-container">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="panel-title"></h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Table for displaying student data -->
                            <table id="Archive" class="display responsive wrap " width="100%">
                                <!-- table header -->
                                <h4>Archive Logs</h4>
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Archive I.D</th>
                                        <th>Origin</th>
                                        <th>Archive Table</th>
                                        <th>Archive Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody id="datalist">
                                    <?php
                                    // Counter for numbering the students
                                    $counter = 1;
                                    $archive = getArchiveLogs();
                                    if (mysqli_num_rows($archive) > 0) {
                                        foreach ($archive as $arch) {
                                            ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?= $arch['id']; ?></td>
                                                <td><?= $arch['origin']; ?></td>
                                                <td><?= $arch['archive_table']; ?></td>
                                                <td><?= $arch['archive_datetime']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--OffCanvas-->
                <!--End of Canvass-->
            </div>

        </main>
        <!-- MAIN -->
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
    </style>
    <script>
        new DataTable('#dashboard', {
            order: [[3, 'desc']]
        });

        function showToast(message, type) {
            // Display the toast message
            $('#toast-body').text(message);
            $('#toast').removeClass().addClass('toast').addClass(type).addClass('show');

            // Hide the toast and reload the page after a few seconds
            setTimeout(function () {
                $('#toast').removeClass('show');
                if (type === 'success') {
                    // Reload the page only for success messages
                    location.reload();
                }
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
        function updateStatus(id, status) {
            // Show the confirmation dialog
            $('.confirmation-dialog').show();
            $('.confirmation-dialog-overlay').show();

            // Set the message in the dialog
            $('.confirmation-dialog p').text('Are you sure you want to set the status to ' + status + '?');

            // Handle button clicks in the confirmation dialog
            $('.confirmation-buttons button').off('click').on('click', function () {
                var userConfirmed = $(this).data('confirmed');
                if (userConfirmed) {
                    // User confirmed, send the AJAX request to update the status
                    $.ajax({
                        type: 'POST',
                        url: 'update_status.php',
                        data: {
                            id: id,
                            lstatus: status // Corrected to use 'lstatus' as key
                        },
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            if (response.success) {
                                // Show success message with toast and reload after 3 seconds
                                showToast(response.message, 'success');
                            } else {
                                showToast(response.message, 'error');
                            }
                        },
                        error: function (error) {
                            console.error('Error updating status:', error);
                            showToast('An error occurred while updating the status', 'error');
                        }
                    });
                }

                // Hide the confirmation dialog and overlay
                $('.confirmation-dialog').hide();
                $('.confirmation-dialog-overlay').hide();
            });
        }


        document.addEventListener('DOMContentLoaded', function () {
            var ctxPersonnel = document.getElementById('PersonnelChart').getContext('2d');
            var userCounts = <?php echo json_encode($userCounts); ?>;
            var approvedUserCounts = <?php echo json_encode($approvedUserCounts); ?>;
            var pendingUserCounts = <?php echo json_encode($pendingUserCounts); ?>;
            var rejectedUserCounts = <?php echo json_encode($rejectedUserCounts); ?>;


            var chartPersonnel = new Chart(ctxPersonnel, {
                type: 'bar',
                data: {
                    labels: ['OUR Admission Unit', 'Faculty', 'OSS'],
                    datasets: [{
                        label: 'Total Count',
                        data: [userCounts.Personnel, userCounts.Faculty, userCounts.OSS],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Approved Count',
                        data: [approvedUserCounts.Personnel, approvedUserCounts.Faculty,
                        approvedUserCounts.OSS
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Pending Count',
                        data: [pendingUserCounts.Personnel, pendingUserCounts.Faculty,
                        pendingUserCounts.OSS
                        ],
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Rejected Count',
                        data: [rejectedUserCounts.Personnel, rejectedUserCounts.Faculty,
                        rejectedUserCounts.OSS
                        ],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Start y-axis at 0
                        }
                    }
                }
            });
        });

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
    <!-- CONTENT -->