<?php
// Required setup
session_start(); // Start the session
include_once '../config.php'; // Load database configuration
require_once '../PhpXlsxGenerator.php'; // Load XLSX generator library

// User-related data fetching
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

// College check
$isCollegeQuery = "SELECT COUNT(*) FROM programs WHERE College = ?";
$stmtIsCollege = $conn->prepare($isCollegeQuery);
$stmtIsCollege->bind_param("s", $department);
$stmtIsCollege->execute();
$stmtIsCollege->bind_result($isCollege);
$stmtIsCollege->fetch();
$stmtIsCollege->close();

// Retrieve courses
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
    $courses[] = $department;
}

// Search and filter handling
$search = isset($_SESSION['search']) ? $_SESSION['search'] : '';
$filter = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';

// Base query construction
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

// Applying filters
if ($filter == 'qualified') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Qualified)'";
} else if ($filter == 'qualifiedNQ') {
    $fetchStudentListQuery = $baseQuery . " AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
} else if ($filter == 'nor_qualifier') {
    $fetchStudentListQuery = $baseQuery . " AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')";
} else {
    $fetchStudentListQuery = $baseQuery;
}

// Preparing and binding the query
$stmtFetchStudentList = $conn->prepare($fetchStudentListQuery);
$paramTypes = str_repeat('s', count($courses) + 6); // Courses + 6 search parameters
$searchParam = "%$search%";
$bindVariables = array_merge($courses, array_fill(0, 6, $searchParam));
$stmtFetchStudentList->bind_param($paramTypes, ...$bindVariables);

$stmtFetchStudentList->execute();
$result = $stmtFetchStudentList->get_result();

// Define Excel headers
$excelData = [
    ['#', 'Applicant Number', 'Last Name', 'First Name', 'Middle Name', 'Nature of Degree', 'Degree Applied', 'Academic Classification', 'GWA', 'Oral Communication', 'Reading and Writing', 'English for Academic and Professional Purposes', 'Earth Science', 'Earth and Life Science', 'Physical Science', 'Disaster Readiness', 'General Math', 'Statistics', 'English', 'Math', 'Science', 'Result', 'Personnel Eval']
];

// Fetch data and populate excelData with a counter
$counter = 1; // Initialize the counter
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gwa = $row['GWA'] ?? '';
        $oralCommunicationGrade = $row['Oral_Communication_Grade'] ?? '';
        
        $lineData = [
            $counter, // Add the counter here
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
        ];
        
        $excelData[] = $lineData; // Add data to the array
        $counter++; // Increment the counter
    }
}

// Export to Excel
$fileName = "Faculty_Applicants_" . date('Y-m-d') . ".xlsx";
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

exit;
?>
