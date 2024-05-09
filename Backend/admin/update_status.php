<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['lstatus']; // Fixed parameter name

    $updateQuery = "UPDATE users SET lstatus = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $id);

    $response = array(); // Response array to hold success or failure message

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Status updated successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error updating status";
    }

    $stmt->close();
    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo "Invalid request";
}
?>
