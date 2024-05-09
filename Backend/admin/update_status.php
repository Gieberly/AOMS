<?php
include("../config.php");
include("../includes/functions.php");

if(isset($_POST['id']) && isset($_POST['name'])) {
    $id = $_POST['id'];
    $valueName = $_POST['name'];
    
    // Prepare the SQL query to update the value in the database
    $sql = "UPDATE users SET lstatus = ? WHERE id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "si", $valueName, $id);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo json_encode(['status' => 'success', 'message' => 'Value updated successfully']);
    } else {
        // Update failed
        echo json_encode(['status' => 'error', 'message' => 'Failed to update value: ' . mysqli_error($conn)]);
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Invalid request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>

