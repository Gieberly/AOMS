<?php
require_once 'db_connection.php'; // Include your database connection file

// Function to count applicants by program
function countApplicantsByProgram() {
    global $conn;

    $counts = array();

    $query = "SELECT degree_applied, COUNT(*) AS program_count FROM admission_data GROUP BY degree_applied";

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $counts[$row['degree_applied']] = $row['program_count'];
        }
        mysqli_free_result($result);
    } else {
        echo json_encode(array('error' => mysqli_error($conn)));
        exit(); // Exit if query fails
    }

    return $counts;
}

// Call the function and echo the result as JSON
echo json_encode(countApplicantsByProgram());
?>
