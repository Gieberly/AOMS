<?php
session_start(); // Start the session if not already started

// Load the database configuration file
include_once '../config.php';

// Include XLSX generator library
require_once '../PhpXlsxGenerator.php';

// Excel file name for download
$fileName = "Applicants_verification_" . date('Y-m-d') . ".xlsx";

// Define column names
$excelData[] = array('APPLICANT NUMBER','LAST NAME', 'FIRST NAME','MIDDLE NAME', 'NATURE OF DEGREE', 'PROGRAM',    'ACADEMIC CLASSIFICATION', 'APPLICATION DATE', 'APPLICATION TIME', 'STATUS');

// Fetch records from database based on the search session
$search = isset($_SESSION['search']) ? $_SESSION['search'] : ''; // Retrieve the stored search query from session
$filterDate = isset($_GET['appointment_date']) ? $_GET['appointment_date'] : '';
$query = "SELECT * FROM admission_data WHERE 
            (
              `Name` LIKE '%$search%' OR 
             `Middle_Name` LIKE '%$search%' OR 
             `Last_Name` LIKE '%$search%' OR 
             `academic_classification` LIKE '%$search%' OR 
             TRIM(`nature_of_degree`) = '$search' OR 
              TRIM(`appointment_status`) = '$search' 
            )
            AND (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
            AND `appointment_date` IS NOT NULL
         
            ORDER BY applicant_number ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lineData = array($row['applicant_number'], $row['nature_of_degree'], $row['degree_applied'], $row['Last_Name'], $row['Name'], $row['Middle_Name'], $row['academic_classification'], $row['appointment_date'], $row['appointment_time'], $row['appointment_status']);
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

exit;
?>
