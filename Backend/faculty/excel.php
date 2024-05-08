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

// Fetch the user's department
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

// Check if the department is a college
$isCollegeQuery = "SELECT COUNT(*) FROM programs WHERE College = ?";
$stmtIsCollege = $conn->prepare($isCollegeQuery);
$stmtIsCollege->bind_param("s", $department);
$stmtIsCollege->execute();
$stmtIsCollege->bind_result($isCollege);
$stmtIsCollege->fetch();
$stmtIsCollege->close();

// Get the relevant courses
$courses = [];
if ($isCollege) {
    // Fetch all courses under the specified college
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
    $courses[] = $department; // If not a college, it's a specific course
}

// Store the search query and filter in session if set
if (isset($_GET['search'])) {
    $_SESSION['search'] = $_GET['search'];
}
if (isset($_GET['filter'])) {
    $_SESSION['filter'] = $_GET['filter'];
}

$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';
$filter = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';

// Base query for multiple or single courses
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

// Determine the filter and add specific conditions to the base query
if ($filter == 'qualified') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Qualified)'";
} else if ($filter == 'qualifiedNQ') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
} else if ($filter == 'nor_qualifier') {
    $baseQuery = $baseQuery . " AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')";
} else {
    $fetchStudentListQuery = $baseQuery;
}

// Prepare the statement and bind parameters
$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);

$paramTypes = str_repeat('s', count($courses) + 6); // For courses + 6 search parameters
$searchParam = "%$search%";
$bindVariables = array_merge($courses, array_fill(0, 6, $searchParam));

$stmtFetchStudentList->bind_param($paramTypes, ...$bindVariables);

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
