<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
  
    $Requirements_Remarks = !empty($_POST['Requirements_Remarks']) ? $_POST['Requirements_Remarks'] : null;
    $Personnel_Result = !empty($_POST['Personnel_Result']) ? $_POST['Personnel_Result'] : null;
   
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET Requirements_Remarks=?, Personnel_Result=? WHERE id=?");
    $stmt->bind_param("ssi", $Requirements_Remarks, $Personnel_Result, $id); // Updated bind_param with additional parameter
   
    // Execute the statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

       // Redirect to desired page with filter and search parameters
header("Location: admin_masterlist.php?filter=" . urlencode($_GET['filter']) . "&search=" . urlencode($_GET['search']));
exit();

    } else {
        // Print error if update fails
        echo "Error updating record: " . $conn->error;
    }
}

