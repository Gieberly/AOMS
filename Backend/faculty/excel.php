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
$fileName = "Faculty_Applicants_" . date('Y-m-d') . ".xlsx";

// Fetch user's department
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

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
if ($filter == 'qualified') {
  $fetchStudentListQuery = "SELECT *, 
                         CASE 
                           WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                           WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                           ELSE Gr12_GWA
                         END AS GWA
                         FROM admission_data 
                         WHERE degree_applied = ? 
                         AND faculty_Message = 'sent'
                         AND Admission_Result = 'NOA(Admitted-Qualified)'
                         AND (`Name` LIKE ? OR 
                              `Middle_Name` LIKE ? OR 
                              `Last_Name` LIKE ? OR 
                              `applicant_number` LIKE ? OR 
                              applicant_number LIKE ? OR 
                              academic_classification LIKE ? OR 
                              TRIM(`Personnel_Result`) = '$search' OR 
                 TRIM(`Admission_Result`) = '$search' OR 
                              degree_applied LIKE ?)
                         ORDER BY applicant_number ASC";
}  else if ($filter == 'qualifiedNQ') {
  $fetchStudentListQuery = "SELECT *, 
                         CASE 
                           WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                           WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                           ELSE Gr12_GWA
                         END AS GWA
                         FROM admission_data 
                         WHERE degree_applied = ? 
                         AND faculty_Message = 'sent'
                         AND Admission_Result = 'NOA(Admitted-Not Qualified)'
                         AND (`Name` LIKE ? OR 
                              `Middle_Name` LIKE ? OR 
                              `Last_Name` LIKE ? OR 
                              `applicant_number` LIKE ? OR 
                              applicant_number LIKE ? OR 
                              academic_classification LIKE ? OR 
                              TRIM(`Personnel_Result`) = '$search' OR 
                 TRIM(`Admission_Result`) = '$search' OR 
                              degree_applied LIKE ?)
                         ORDER BY applicant_number ASC";
}else if ($filter == 'nor_qualifier') {
  $fetchStudentListQuery = "SELECT *, 
                         CASE 
                           WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                           WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                           ELSE Gr12_GWA
                         END AS GWA
                         FROM admission_data 
                         WHERE degree_applied = ? 
                         AND faculty_Message = 'sent'
                         AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')
                         AND (`Name` LIKE ? OR 
                              `Middle_Name` LIKE ? OR 
                              `Last_Name` LIKE ? OR 
                              `applicant_number` LIKE ? OR 
                              applicant_number LIKE ? OR 
                              academic_classification LIKE ? OR 
                              TRIM(`Personnel_Result`) = '$search' OR 
                 TRIM(`Admission_Result`) = '$search' OR 
                              degree_applied LIKE ?)
                         ORDER BY applicant_number ASC";
} else {
  // Default query without filter
  $fetchStudentListQuery = "SELECT *, 
                         CASE 
                           WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                           WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                           ELSE Gr12_GWA
                         END AS GWA
                         FROM admission_data 
                         WHERE degree_applied = ? 
                         AND faculty_Message = 'sent'
                         AND (`Name` LIKE ? OR 
                              `Middle_Name` LIKE ? OR 
                              `Last_Name` LIKE ? OR 
                              `applicant_number` LIKE ? OR 
                              applicant_number LIKE ? OR 
                              academic_classification LIKE ? OR 
                              TRIM(`Personnel_Result`) = '$search' OR 
                 TRIM(`Admission_Result`) = '$search' OR 
                              degree_applied LIKE ?)
                         ORDER BY applicant_number ASC";
}
$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);
$searchParam = "%$search%";
$stmtFetchStudentList->bind_param("ssssssss", $department,  $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
$stmtFetchStudentList->execute();
$result = $stmtFetchStudentList->get_result();

// Define column names
$excelData[] = array(
    'Applicant Number',  
    'Last Name', 
    'First Name', 
    'Middle Name',
    'Nature of Degree', 
    'Degree Applied', 
    'Academic Classification', 
    'GWA', 
    'Oral Communication in Context', 
    'Reading and Writing Skills',
    'English for Academic and Professional Purposes',
    'Earth Science',
    'Earth and Life Science',
    'Physical Science',
    'Disaster Readiness and Risk Reduction',
    'General Mathematics',
    'Statistics and Probability',
    'English',
    'Math',
    'Science',
    'Result',
    'Personnel Eval'
);

// Fetch data and populate excelData array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if any of the GWA columns has data, if not, leave the GWA column empty
        $gwa = $row['GWA'] ?? '';
        // Check if either English_Oral_Communication_Grade or English_Other_Courses_Grade has data
        $oralCommunicationGrade = $row['Oral_Communication_Grade'] ?? '';
        $lineData = array(
            $row['applicant_number'],  
            $row['Last_Name'], 
            $row['Name'], 
            $row['Middle_Name'], 
            $row['nature_of_degree'], 
            $row['degree_applied'], 
            $row['academic_classification'], 
            $gwa, 
            $oralCommunicationGrade,
            $row['Reading_Writing_Grade'] ?? '',
            $row['English_Academic_Grade'] ?? '',
            $row['Earth_Science_Grade'] ?? '',
            $row['Earth_and_Life_Science_Grade'] ?? '',
            $row['Physical_Science_Grade'] ?? '',
            $row['Science_Disaster_Readiness_Grade'] ?? '',
            $row['General_Mathematics_Grade'] ?? '',
            $row['Statistics_Probability_Grade'] ?? '',
            $row['English_Grade'] ?? '',
            $row['Math_Grade'] ?? '',
            $row['Old_HS_Science_Grade'] ?? '',
            $row['Admission_Result'] ?? '',
            $row['Personnel_Result'] ?? ''
        );
        $excelData[] = $lineData;
    }
}

// Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

exit;
?>
