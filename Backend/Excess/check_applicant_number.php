<?php
// Include config.php and establish database connection
include("config.php");

// Check if the applicant number is sent via POST request
if(isset($_POST['applicant_number'])) {
    // Sanitize the input applicant number
    $applicantNumber = mysqli_real_escape_string($conn, $_POST['applicant_number']);

    // Query to check if the applicant number exists in the database
    $query = "SELECT COUNT(*) AS count FROM admission_data WHERE applicant_number = '$applicantNumber'";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the result row
        $row = $result->fetch_assoc();
        // Check if the applicant number exists in the database
        if ($row['count'] > 0) {
            // If the applicant number exists, echo 'exists'
            echo 'exists';
        } else {
            // If the applicant number does not exist, echo 'not_exists'
            echo 'not_exists';
        }
    } else {
        // If the query fails, echo an error message
        echo 'error';
    }
} else {
    // If the applicant number is not sent via POST request, echo an error message
    echo 'error';
}

// Close database connection
$conn->close();
?>
