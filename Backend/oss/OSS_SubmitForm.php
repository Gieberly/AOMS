<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check form data
    var_dump($_POST);

    // Retrieve form data
    $id = $_POST['id'];
    $OSS_Remarks = !empty($_POST['OSS_Remarks']) ? $_POST['OSS_Remarks'] : null;
    $OSS_Admission_Test_Score = !empty($_POST['OSS_Admission_Test_Score']) ? $_POST['OSS_Admission_Test_Score'] : null;
    $OSS_Endorsement_Slip = !empty($_POST['OSS_Endorsement_Slip']) ? $_POST['OSS_Endorsement_Slip'] : null;
      $OSS_Degree = !empty($_POST['OSS_Degree']) ? $_POST['OSS_Degree'] : null;
$OSS_Applicant_no = !empty($_POST['OSS_Applicant_no']) ? $_POST['OSS_Applicant_no'] : null;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("UPDATE admission_data SET OSS_Remarks=?, OSS_Admission_Test_Score=?, OSS_Endorsement_Slip=?,OSS_Degree=?,OSS_Applicant_no=? WHERE id=?");
    $stmt->bind_param("sssssi", $OSS_Remarks, $OSS_Admission_Test_Score,$OSS_Endorsement_Slip,$OSS_Degree,$OSS_Applicant_no, $id);

    // Debugging: Echo out the SQL query
    echo $stmt->sql;

    // Execute the statement
    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        // Redirect to desired page
        header("Location: OSS_Applicants.php");
        exit();
    } else {
        // Print error if update fails
        echo "Error updating record: " . $conn->error;
    }
}
?>
