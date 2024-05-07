<?php
include("../config.php");

// Get the selected row IDs from the AJAX request
$selectedRowIds = json_decode(file_get_contents('php://input'))->selectedRowIds;

// Update the 'sent' field in the database for the selected rows
foreach ($selectedRowIds as $rowId) {
    $updateQuery = "UPDATE admission_data SET faculty_Message = 'sent' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $rowId);
    $stmt->execute();
}

// Send a response back to the client
$response = array('success' => true);
echo json_encode($response);
?>
