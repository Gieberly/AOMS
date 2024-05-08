<?php
include("../config.php"); // Include your database configuration file
include("../includes/functions.php");
include("../includes/fetch_data.php");

if(isset($_POST['save_admission'])) {
    // Get form data
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);
    $start_year = mysqli_real_escape_string($conn, $_POST['start_year']);
    $end_year = mysqli_real_escape_string($conn, $_POST['end_year']);

    // Mandatory field check
    if(empty($start) || empty($end) || empty($sem) || empty($start_year)|| empty($end_year)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    
// Validate each year separately
if (!isValidYear($start_year) || !isValidYear($end_year)) {
    echo json_encode(array("status" => 422, "message" => "Invalid year format. Please use YYYY format."));
    exit;
}

    if (isAcademicYearRegistered($start_year,$end_year)) {
        // Academic year is already registered
        echo json_encode(array("status" => 422, "message" => "Academic year already registered."));
        exit;
    } else {
        // Insert data into database using prepared statement
        $sql = "INSERT INTO admission_period (start, end, sem, start_year, end_year) VALUES (?, ?, ?, ?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $start, $end, $sem, $start_year, $end_year);
        $sql_run = mysqli_stmt_execute($stmt);

// Check if insertion was successful
if($sql_run) {
    // Insertion successful
    
    // Define table mappings
    $tableMappings = array(
        'admission_data' => 'admission_data_archive'
    );

    // Archive and truncate tables
    $archiveSuccess = archiveAndTruncateTables($conn, $tableMappings);
    
    // Delete students and archive the data
    $deleteAndArchiveSuccess = deleteAndArchiveStudents($conn, 'users', 'users_archive');

    if ($archiveSuccess && $deleteAndArchiveSuccess) {
        // Archiving and deleting students successful
        $res = [
            'status' => 200,
            'message' => 'Successfully created Admission'
        ];
        echo json_encode($res);
    } else {
        // Archiving or deleting students failed
        $res = [
            'status' => 500,
            'message' => 'Failed to archive or delete students'
        ];
        echo json_encode($res);
    }
} else {
    // Insertion failed
    $res = [
        'status' => 500,
        'message' => 'Admission Period Not Created'
    ];
    echo json_encode($res);
}

    }
} 
?>
