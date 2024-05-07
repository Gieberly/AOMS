<?php 
 
// Load the database configuration file 
include_once 'config.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 
 
// Excel file name for download 
$fileName = "MasterLists_" . date('Y-m-d') . ".xlsx"; 
 
// Define column names 
$excelData[] = array('APPLICATION NUMBER', 'NAME', 'ACADEMIC CLASSIFICATION', 'NATURE OF DEGREE', 'PROGRAM',
 'EMAIL', 'ENGLISH', 'SCIENCE' , 'MATH', 'GWA', 'RESULT'); 
 
// Fetch records from database and store in an array 
$query = $conn->query("SELECT * FROM admission_data WHERE Admission_Result IN ('NOA(Q-A)', 'NOA(NQ-NA)', 'NOR(Q-NA)') ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($row['applicant_number'], $row['Name'], $row['academic_classification'], $row['nature_of_degree'], $row['degree_applied'],  $row['email'], $row['Name'], $row['Name'], $row['Middle_Name'], $row['Last_Name'], $row['Admission_Result']);  
        $excelData[] = $lineData; 
    } 
} 
 
// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>