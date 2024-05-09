<?php
include("../config.php");
// Retrieve form data
$college = $_POST['college'];
$courses = $_POST['courses'];
$nature_of_degree = $_POST['nature_of_degree'];
$no_of_sections = (int)$_POST['no_of_sections']; // Ensure it's an integer
$no_of_students_per_section = (int)$_POST['no_of_students_per_section']; // Ensure it's an integer

// SQL query to insert a new program
$sql = "INSERT INTO programs (college, courses, nature_of_degree, no_of_sections, no_of_students_per_section) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters to the query
$stmt->bind_param("sssii", $college, $courses, $nature_of_degree, $no_of_sections, $no_of_students_per_section);

// Execute the query and check if it was successful
if ($stmt->execute()) {
    echo "New program added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>