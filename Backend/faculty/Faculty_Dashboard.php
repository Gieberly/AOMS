<?php


include("Faculty_Cover.php");

// Fetch the user's department
$userId = $_SESSION['user_id'];
$fetchDepartmentQuery = "SELECT Department FROM users WHERE id = ?";
$stmtFetchDepartment = $conn->prepare($fetchDepartmentQuery);
$stmtFetchDepartment->bind_param("i", $userId);
$stmtFetchDepartment->execute();
$stmtFetchDepartment->bind_result($department);
$stmtFetchDepartment->fetch();
$stmtFetchDepartment->close();

// Check if the department matches a college
$isCollegeQuery = "SELECT COUNT(*) FROM programs WHERE College = ?";
$stmtIsCollege = $conn->prepare($isCollegeQuery);
$stmtIsCollege->bind_param("s", $department);
$stmtIsCollege->execute();
$stmtIsCollege->bind_result($isCollege);
$stmtIsCollege->fetch();
$stmtIsCollege->close();

// Define the course or courses to query
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

    // Create the query to count applicants for all courses under the college
    $countStudentsQuery = "SELECT COUNT(*) FROM admission_data WHERE degree_applied IN (" . implode(',', array_fill(0, count($courses), '?')) . ") AND faculty_Message = 'sent'";
    $stmtCountStudents = $conn->prepare($countStudentsQuery);
    $stmtCountStudents->bind_param(str_repeat('s', count($courses)), ...$courses);
} else {
    // Count students for a specific course
    $countStudentsQuery = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND faculty_Message = 'sent'";
    $stmtCountStudents = $conn->prepare($countStudentsQuery);
    $stmtCountStudents->bind_param("s", $department);
}

// Execute the query and fetch the result
$stmtCountStudents->execute();
$stmtCountStudents->bind_result($studentCountForAdmission);
$stmtCountStudents->fetch();
$stmtCountStudents->close();
// Check if the user's department matches any value in the College column of the programs table
// Fetch the courses
$courses = [];
$stmtGetAvailableSlots = null; // Initialize the variable to avoid undefined errors

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

    // Get the available slots for all courses under the college
    $getAvailableSlotsQuery = "SELECT SUM(Number_of_Available_Slots) FROM programs WHERE Courses IN (" . implode(',', array_fill(0, count($courses), '?')) . ")";
    $stmtGetAvailableSlots = $conn->prepare($getAvailableSlotsQuery);
    $stmtGetAvailableSlots->bind_param(str_repeat('s', count($courses)), ...$courses);
} else {
    // Fetch available slots for the specific course
    $checkDepartmentQuery = "SELECT Number_of_Available_Slots FROM programs WHERE Courses = ?";
    $stmtCheckDepartment = $conn->prepare($checkDepartmentQuery);
    $stmtCheckDepartment->bind_param("s", $department);
    $stmtGetAvailableSlots = $stmtCheckDepartment; // Assign this to stmtGetAvailableSlots
}

// Ensure the statement is not null before executing
if ($stmtGetAvailableSlots !== null) {
    $stmtGetAvailableSlots->execute();
    $stmtGetAvailableSlots->bind_result($availableSlots);
    $stmtGetAvailableSlots->fetch();
    $stmtGetAvailableSlots->close();
} else {
    $availableSlots = 0; // Default value if no valid statement
}

// Prepare the list of courses and initialize the statement variable
$courses = [];
$stmtCountStudentsNOA = null;

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

    // Query to count students with "NOA" (Admitted-Qualified) for all courses under the college
    $countStudentsQueryNOA = "SELECT COUNT(*) FROM admission_data WHERE degree_applied IN (" . implode(',', array_fill(0, count($courses), '?')) . ") AND faculty_Message = 'sent' AND Admission_Result = 'NOA(Admitted-Qualified)'";
    $stmtCountStudentsNOA = $conn->prepare($countStudentsQueryNOA);
    $stmtCountStudentsNOA->bind_param(str_repeat('s', count($courses)), ...$courses);
} else {
    // Query to count students with "NOA(Admitted-Qualified)" for a specific course
    $countStudentsQueryNOA = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND faculty_Message = 'sent' AND Admission_Result = 'NOA(Admitted-Qualified)'";
    $stmtCountStudentsNOA = $conn->prepare($countStudentsQueryNOA);
    $stmtCountStudentsNOA->bind_param("s", $department);
}

// Ensure the statement is not null before executing
if ($stmtCountStudentsNOA !== null) {
    $stmtCountStudentsNOA->execute();
    $stmtCountStudentsNOA->bind_result($noaStudentCount);
    $stmtCountStudentsNOA->fetch();
    $stmtCountStudentsNOA->close();
} else {
    $noaStudentCount = 0; // Default value if no valid statement
}

$courses = [];
$stmtCountStudentsNOA = null;

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

    // Query to count students with "NOA(Admitted-Not Qualified)" for all courses under the college
    $countStudentsQueryNOA = "SELECT COUNT(*) FROM admission_data WHERE degree_applied IN (" . implode(',', array_fill(0, count($courses), '?')) . ") AND faculty_Message = 'sent' AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
    $stmtCountStudentsNOA = $conn->prepare($countStudentsQueryNOA);
    $stmtCountStudentsNOA->bind_param(str_repeat('s', count($courses)), ...$courses);
} else {
    // Query to count students with "NOA(Admitted-Not Qualified)" for the specific course
    $countStudentsQueryNOA = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND faculty_Message = 'sent' AND Admission_Result = 'NOA(Admitted-Not Qualified)'";
    $stmtCountStudentsNOA = $conn->prepare($countStudentsQueryNOA);
    $stmtCountStudentsNOA->bind_param("s", $department);
}

// Execute the query and fetch the result
if ($stmtCountStudentsNOA !== null) {
    $stmtCountStudentsNOA->execute();
    $stmtCountStudentsNOA->bind_result($noaNQStudentCount);
    $stmtCountStudentsNOA->fetch();
    $stmtCountStudentsNOA->close();
} else {
    $noaNQStudentCount = 0; // Default value if the statement is null
}

// Prepare the list of courses
$courses = [];
$stmtCountStudentsNOR = null;

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

    // Query to count students with "NOR(Possible Qualifier)" or "NOR(Possible Qualifier-Non-Board)" for all courses under the college
    $countStudentsQueryNOR = "SELECT COUNT(*) FROM admission_data WHERE degree_applied IN (" . implode(',', array_fill(0, count($courses), '?')) . ") AND faculty_Message = 'sent' AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')";
    $stmtCountStudentsNOR = $conn->prepare($countStudentsQueryNOR);
    $stmtCountStudentsNOR->bind_param(str_repeat('s', count($courses)), ...$courses);
} else {
    // Query to count students with "NOR(Possible Qualifier)" or "NOR(Possible Qualifier-Non-Board)" for a specific course
    $countStudentsQueryNOR = "SELECT COUNT(*) FROM admission_data WHERE degree_applied = ? AND faculty_Message = 'sent' AND (Personnel_Result = 'NOR(Possible Qualifier)' OR Personnel_Result = 'NOR(Possible Qualifier-Non-Board)')";
    $stmtCountStudentsNOR = $conn->prepare($countStudentsQueryNOR);
    $stmtCountStudentsNOR->bind_param("s", $department);
}

// Execute the query to fetch the result
if ($stmtCountStudentsNOR !== null) {
    $stmtCountStudentsNOR->execute();
    $stmtCountStudentsNOR->bind_result($norStudentCount);
    $stmtCountStudentsNOR->fetch();
    $stmtCountStudentsNOR->close();
} else {
    $norStudentCount = 0; // Default value if the statement is not initialized
}


?>





<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css//personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    
    <!--User Manual-->
    <div class="overlay_college"></div>
    <div class="box">
        <div class="close">&times;</div>
        <div class="registration-box">
          <p>OSS User Manual</p>
          <!-- Add images here -->
          <img src="assets/images/college/1.png" alt="User's Manual">
          <img src="assets/images/college/2.png" alt="User's Manual">
          <img src="assets/images/college/3.png" alt="User's Manual">
          <img src="assets/images/college/4.png" alt="User's Manual">
          <!-- Add more images if needed -->
            </div>
    </div>
    
    <section id="content">
        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="Faculty_Dashboard.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    <li id="available-box">
                        <a href="">
                            <i class='bx bx-clipboard'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $availableSlots; ?></h3>
                            <p>Quata</p>
                        </span>
                    </li>

                    <li id="admission-box">
                        <a href="Faculty_Applicants.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $studentCountForAdmission; ?></h3>
                            <p>Applicants For Admission</p>
                        </span>
                    </li>


                    <li id="admitted-box">
                        <a href="Faculty_Applicants.php?filter=qualified">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                            <h3><?php echo $noaStudentCount; ?></h3>
                            <p>Admitted-Qualified Applicants</p>
                        </span>
                    </li>
                    <li id="admitted-box">
                        <a href="Faculty_Applicants.php?filter=qualifiedNQ">
                            <i class='bx bx-user-check'></i></a>
                        <span class="text">
                            <h3><?php echo $noaNQStudentCount; ?></h3>
                            <p>Admitted-Not Qualified Applicants</p>
                        </span>
                    </li>

                    <li id="readmitted-box">
                        <a href="Faculty_Applicants.php?filter=nor_qualifier">
                            <i class='bx bx-user-check'></i>
                        </a>
                        <span class="text">
                            <h3><?php echo $norStudentCount; ?></h3>
                            <p>Possible Qualifier</p>
                            </span> </ul>
                    </li>
            </div>






        </main>
        <!-- MAIN -->

    </section>
    
    <style>
.box{
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

.overlay_college {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 999;
    display: none;
}
.close{
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
.close:hover{
    background-color: red;
    color: #fcfcfc;
    cursor: pointer;
}
.registration-box{
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

</style>

<script>
    let overlay_college = document.querySelector(".overlay_college");
    let box = document.querySelector(".box");
    let close = document.querySelector(".close");

    // Show the box and overlay when the page loads if it hasn't been closed before
    window.addEventListener('DOMContentLoaded', function () {
        if (!localStorage.getItem('boxClosed')) {
            overlay_college.style.display = "block";
            box.style.display = "block";
        }
    });

    close.addEventListener("click", () => {
        box.style.display = "none";
        overlay_college.style.display = "none";
        localStorage.setItem('boxClosed', true); // Set item in local storage indicating the box has been closed
    });

</script>
    
</body>

</html>