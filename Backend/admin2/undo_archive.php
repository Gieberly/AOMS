<?php
include("../config.php"); // Include your database configuration file
include("../includes/functions.php");
include("../includes/fetch_data.php");

// Define the response array
$response = array();

if (isset($_POST['undo'])) {

    // Undo truncation by copying data from archive table back to original table
    $result = copyData($conn);
    
    if ($result['status'] == 200) {
        // Truncation undone successfully
        $response['success'] = true;
        $response['message'] = $result['message'];
    } else {
        // Failed to undo truncation
        $response['success'] = false;
        $response['message'] = $result['message'];
    }
}

// Encode the response as JSON
echo json_encode($response);
?>
