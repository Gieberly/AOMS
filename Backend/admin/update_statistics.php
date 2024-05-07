<?php
include("../config.php");
include("../includes/fetch_data.php");

// Check if admission period ID is provided
if(isset($_POST['admission_period_id'])) {
    $admissionPeriodId = $_POST['admission_period_id'];

    // Fetch start and end years for the selected admission period ID
    $query = "SELECT start_year, end_year FROM admission_period WHERE id = $admissionPeriodId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $startYear = $row['start_year'];
        $endYear = $row['end_year'];

        // Use the fetched start and end years to calculate statistics
        $applicantsCount = countApplicants($startYear, $endYear);
        $countPersonnel = countPersonnel($startYear, $endYear);
        $countPending = countPersonnelPending($startYear, $endYear);
        $rejectedAccounts = countRejectedAccounts($startYear, $endYear);

        // Construct an array with updated statistics
        $updatedStatistics = array(
            'applicantsCount' => $applicantsCount,
            'countPersonnel' => $countPersonnel,
            'countPending' => $countPending,
            'rejectedAccounts' => $rejectedAccounts
        );

        // Return updated statistics as JSON
        header('Content-Type: application/json');
        echo json_encode($updatedStatistics);
    } else {
        // Admission period not found
        echo json_encode(array("status" => 404, "message" => "Admission period not found."));
    }
} else {
    // Admission period ID not provided
    echo json_encode(array("status" => 400, "message" => "Admission period ID not provided."));
}
?>
