<?php
include("../config.php");
function multiplyColumns($value1, $value2) {
    return intval($value1) * intval($value2);
}
function approveUser($conn, $email) {
    // Sanitize input
    $email = mysqli_real_escape_string($conn, $email);

    // Update the user's status to "Approved"
    $query = "UPDATE users SET lstatus='Approved' WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true; // Status updated successfully
    } else {
        return false; // Status update failed
    }
}

function getfiles() {
    global $conn;
    $query = "SELECT * FROM files";
    $result = $conn->query($query);
    return $result;
}
function getArchiveMarterList() {
    global $conn;
    $query = "SELECT * FROM admission_data_archive";
    $result = $conn->query($query);
    return $result;
}
function getArchiveUsers() {
    global $conn;
    $query = "SELECT * FROM users_archive WHERE userType = 'Student'";
    $result = $conn->query($query);
    return $result;
}

function getArchiveFaculty() {
    global $conn;
    $query = "SELECT * FROM users_archive WHERE userType = 'Faculty'";
    $result = $conn->query($query);
    return $result;
}

function getArchivePersonnel() {
    global $conn;
    $query = "SELECT * FROM users_archive WHERE userType = 'Personnel'";
    $result = $conn->query($query);
    return $result;
}
function getArchiveUsersData() {
    global $conn;
    $query = "SELECT * FROM admission_data_archive";
    $result = $conn->query($query);
    return $result;
}
//Function to get all staff members
function getArchiveLogs() {
    global $conn;
    $query = "SELECT * FROM archive_log";
    $result = $conn->query($query);
    return $result;
}
function getPendingAccounts() {
    global $conn;
    $query = "SELECT * FROM users WHERE lstatus = 'Pending'";
    $result = $conn->query($query);
    return $result;
}
function getAllStaff() {
    global $conn;
    $query = "SELECT *FROM users WHERE userType IN ('Personnel', 'OSS', 'Faculty')";
    $result = $conn->query($query);
    return $result;
}



function getAllFaculty() {
    global $conn;
    $query = "SELECT * FROM users WHERE userType IN ('OSS', 'Faculty')";
    $result = $conn->query($query);
    return $result;
}


// Function to update staff status
function updateStaffStatus($staffId, $newState) {
    global $conn;
    $query = "UPDATE users SET state = ? WHERE id = ? AND userType = 'Staff'";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("si", $newState, $staffId);
    return $stmt->execute();
}

function editAppointmentSlots($appointment_id, $newSlot) {
    global $conn;
    $query = "SELECT appointment_id From appointmentdate";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("si",$newSlot, $appointment_id);
    return $stmt->execute();
}
function getAppointments()
{
    global $conn;
    $query = "SELECT*FROM appointmentdate";
    $result = $conn->query($query);
    return $result;
}
function getCourses()
{
    global $conn;
    $query = "SELECT*FROM programs";
    $result = $conn->query($query);
    return $result;
}
// Function to delete staff member
function deleteStaff($staffId) {
    global $conn;
    $query = "DELETE FROM users WHERE id = ? AND userType = 'Staff'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staffId);
    return $stmt->execute();
}

// Check if the form for updating status is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'])) {
    $staffId = $_POST['staffId'];
    $newStatus = $_POST['newStatus'];
    updateStaffStatus($staffId, $newStatus);
}

// Check if the form for deleting staff member is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteStaff'])) {
    $staffId = $_POST['staffId'];
    deleteStaff($staffId);
}

// Check if the form for editing appointment slots is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateSlots'])) {
    $appointment_id = $_POST['appointment_id'];
    editAppointmentSlots($appointment_id);
}
//Function to get all Departments
function getAllDept() {
    global $conn;
    $query = "SELECT * FROM programs ";
    $result = $conn->query($query);
    return $result;
}


//Function to get all student form data
function getAllStudentFormData() {
    global $conn;
    $query = "SELECT *FROM admission_data";
    $result = $conn->query($query);
    return $result;
}
// Function to get the name of the logged-in user
function getLoggedInUserName() {
    // Check if the user is logged in
    if(isset($_SESSION['id'])) {
        // Assuming you have stored the user's name in the session upon login
        // Adjust this line to fetch the user's name from your database or wherever it's stored
        $username = $_SESSION['last_name'];
        return $username;
    } else {
        // User is not logged in
        return null;
    }
}
function isValidYear($year) {
    // Check if the year is numeric and has exactly 4 digits
    if (!preg_match('/^\d{4}$/', $year)) {
        return false;
    }
    return true;
}

// Function to check if academic year is already registered
function isAcademicYearRegistered($start_year, $end_year) {
    global $conn; // Assuming $conn is your database connection

    // Prepare and execute SQL query to check if the start year is already registered
    $sql = "SELECT * FROM admission_period WHERE start_year = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $start_year);
    $stmt->execute();
    $result = $stmt->get_result();

    // If any rows are returned, the start year is already registered
    if ($result->num_rows > 0) {
        return true; // Academic year is already registered
    } else {
        return false; // Academic year is not registered
    }
}


function getAllFacultyByAdmissionPeriod($startYear, $endYear) {
    global $conn;

    // Initialize an array to store faculty data
    $facultyData = array();

    // SQL query to retrieve faculty data based on the admission period
    $sql = "SELECT * FROM faculty WHERE YEAR(created_date) BETWEEN '{$startYear}' AND '{$endYear}'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch each row of the result as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            // Append the row to the faculty data array
            $facultyData[] = $row;
        }
    } else {
        // Handle the case where the query failed
        echo "Error: " . mysqli_error($conn);
    }

    // Free the result set
    mysqli_free_result($result);

    // Return the faculty data array
    return $facultyData;
}


// Display all student form data in the table
 $studentFormData = getAllStudentFormData();
// $allColleges = getColleges();



