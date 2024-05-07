<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $nature_qualification = !empty($_POST['nature_qualification']) ? $_POST['nature_qualification'] : null;
    $Degree_Remarks = !empty($_POST['Degree_Remarks']) ? $_POST['Degree_Remarks'] : null;
    $Requirements_Remarks = !empty($_POST['Requirements_Remarks']) ? $_POST['Requirements_Remarks'] : null; // New line to retrieve Requirements_Remarks
   
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET  nature_qualification=?, Degree_Remarks=?, Requirements_Remarks=? WHERE id=?");
    $stmt->bind_param("sssi",  $nature_qualification, $Degree_Remarks, $Requirements_Remarks, $id); // Updated bind_param with additional parameter
   
    // Execute the statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        // Redirect to desired page
        header("Location: Personnel_Applicants.php");
        exit();
    } else {
        // Print error if update fails
        echo "Error updating record: " . $conn->error;
    }
}

