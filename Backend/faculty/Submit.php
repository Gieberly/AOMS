<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
  
    $Admission_Result = !empty($_POST['Admission_Result']) ? $_POST['Admission_Result'] : null;
   
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET Admission_Result=? WHERE id=?");
    $stmt->bind_param("si", $Admission_Result, $id); // Updated bind_param with additional parameter
   
  // Execute the statement
  if ($stmt->execute()) {
    // Set a session variable for success message
    session_start();
    $_SESSION['update_success'] = true;

    header("Location: Faculty_Applicants.php?filter=" . urlencode($_GET['filter']) . "&search=" . urlencode($_GET['search']));

exit();

} else {
    // Print error if update fails
    echo "Error updating record: " . $conn->error;
}
}