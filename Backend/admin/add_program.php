<?php
session_start(); // Ensure sessions are enabled

include("../config.php");

// Retrieve form data
$college = $_POST['college'];
$courses = $_POST['courses'];
$nature_of_degree = $_POST['nature_of_degree'];
$no_of_sections = (int)$_POST['no_of_sections'];
$no_of_students_per_section = (int)$_POST['no_of_students_per_section'];
$number_of_available_slots = isset($_POST['number_of_available_slots']) ? (int)$_POST['number_of_available_slots'] : 0;

// SQL query to insert a new program
$sql = "INSERT INTO programs (College, courses, nature_of_degree, no_of_sections, no_of_students_per_section, number_of_available_slots) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("sssiii", $college, $courses, $nature_of_degree, $no_of_sections, $no_of_students_per_section, $number_of_available_slots);

if ($stmt->execute()) {
    // Set a session variable to indicate success
    $_SESSION['program_added_successfully'] = true;
} else {
    $_SESSION['program_added_successfully'] = false;
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect to manage_data.php
header("Location: manage_data.php");
exit(); // Make sure to exit after redirecting
?>
