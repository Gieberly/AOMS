<?php
include("../config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_data'])) {
    $programID = $_POST['program_id'];
    $college = $_POST['college'];
    $courses = $_POST['courses'];
    $natureOfDegree = $_POST['nature_of_degree'];
    $noOfSections = $_POST['no_of_sections'];
    $noOfStudentsPerSection = $_POST['no_of_students_per_section'];

    // Prepare update statement
    $sql = "UPDATE programs SET College=?, Courses=?, Nature_of_Degree=?, No_of_Sections=?, No_of_Students_Per_Section=? WHERE ProgramID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $college, $courses, $natureOfDegree, $noOfSections, $noOfStudentsPerSection, $programID);

    // Execute update
    if ($stmt->execute()) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>