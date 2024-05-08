<?php
session_start(); // Start the session if not already started

// Load the database configuration file
include_once '../config.php';

// Include XLSX generator library
require_once '../PhpXlsxGenerator.php';

if (isset($_GET['search'])) {
    $_SESSION['search'] = $_GET['search'];
}

// Retrieve the stored search query from session if it exists
$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';

// Retrieve the stored filter from session if it exists
$filter = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';

// Define Excel file name for download
$fileName = "Personnel_Masterlist_" . date('Y-m-d') . ".xlsx";

// Construct the query based on the filter and search parameters
$query = "SELECT * FROM admission_data WHERE 
            (
              `Name` LIKE '%$search%' OR 
             `Middle_Name` LIKE '%$search%' OR 
             `Last_Name` LIKE '%$search%' OR 
             `academic_classification` LIKE '%$search%' OR 
             TRIM(`nature_of_degree`) = '$search' OR 
             TRIM(`Personnel_Result`) = '$search' OR 
             TRIM(`Admission_Result`) = '$search' OR 
             `degree_applied` LIKE '%$search%'
           
            )
            AND Personnel_Message = 'sent'";

// Apply filter if specified
if($filter == 'toadmit') {
    $query .= " AND AAdmission_Result = 'NOA(Admitted-Qualified)' OR Admission_Result = 'NOA(Admitted-Not Qualified)' ";
} elseif ($filter == 'reapplication') {
    $query .= " AND (Personnel_Result = 'NOR(Possible Qualifier-Non-Board)' OR 
                    Personnel_Result = 'NOR(Possible Qualifier-Board)')";
}elseif ($filter == 'notqualified') {
    $query .= " AND (Personnel_Result = 'NOR(Not Qualified)')";
}


$query .= " ORDER BY applicant_number ASC";

$result = $conn->query($query);

// Define column names
$excelData[] = array('Applicant Number',  'Last Name', 'First Name', 'Middle Name','Nature of Degree', 'Degree Applied', 'Academic Classification', 'Result from College', 'Result as per policy');

// Fetch data and populate excelData array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lineData = array($row['applicant_number'],  $row['Last_Name'], $row['Name'], $row['Middle_Name'],$row['nature_of_degree'], $row['degree_applied'], $row['academic_classification'], $row['Admission_Result'], $row['Personnel_Result']);
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

exit;

