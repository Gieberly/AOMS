<?php



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
if($filter == 'qualified') {
    $fetchStudentListQuery = "SELECT *, 
                           CASE 
                             WHEN Gr11_GWA IS NOT NULL THEN Gr11_GWA
                             WHEN GWA_OTAS IS NOT NULL THEN GWA_OTAS
                             ELSE Gr12_GWA
                           END AS GWA
                           FROM admission_data 
                           WHERE degree_applied = ? 
                           AND faculty_Message = 'sent'
                           AND Admission_Result = 'NOA'
                           AND (`Name` LIKE ? OR 
                                `Middle_Name` LIKE ? OR 
                                `Last_Name` LIKE ? OR 
                                `applicant_number` LIKE ? OR 
                                applicant_number LIKE ? OR 
                                academic_classification LIKE ? OR 
                                degree_applied LIKE ?)
                           ORDER BY applicant_number ASC";
} else if($filter == 'nor_qualifier') {
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
                                degree_applied LIKE ?)
                           ORDER BY applicant_number ASC";
}

$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);
$searchParam = "%$search%";
$stmtFetchStudentList->bind_param("ssssssss", $department,  $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
$stmtFetchStudentList->execute();
$result = $stmtFetchStudentList->get_result();
$stmtFetchStudentList->close();

// Define column names for the Excel file
$excelData[] = array('Applicant #', 'Last Name', 'Middle Name', 'First Name', 'Classification', 'GWA', 'Test Score');

// Fetch data and populate excelData array
while ($row = $result->fetch_assoc()) {
    $excelData[] = array(
        $row['applicant_number'],
        $row['Last_Name'],
        $row['Middle_Name'],
        $row['Name'],
        $row['academic_classification'],
        number_format($row['GWA'], 2),
        $row['OSS_Admission_Test_Score']
    );
}

// Include PhpXlsxGenerator library
require_once 'PhpXlsxGenerator.php';

// Define Excel file name for download
$fileName = "student_data_" . date('Y-m-d') . ".xlsx";

// Generate Excel file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

exit;
?>
