<?php
include("../config.php");

// Fetch data from the database
$query = "SELECT * FROM programs";
$result = $conn->query($query);

$labels = [];
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add label and data to arrays
        $labels[] = $row['course_name'] . ', ' . $row['course_slots']. ', ' . $row['college_name']. ', ' . $row['nature']; // Modify as per your database structure
        $data[] = $row['course_name']; // Modify 'your_data_column' to the column containing data for the chart
    }
}

// Prepare data to be sent as JSON
$response = [
    'labels' => $labels,
    'data' => $data
];

echo json_encode($response);
?>
