<?php
include("../config.php");
session_start();

// Retrieve the original data based on the email
$email = $_SESSION['user_email']; // Assuming email is stored in the session
$stmtOriginal = $conn->prepare("SELECT * FROM admission_data WHERE email = ?");
$stmtOriginal->bind_param("s", $email);
$stmtOriginal->execute();
$originalData = $stmtOriginal->get_result()->fetch_assoc();
$stmtOriginal->close();

// Updated data from the form
$Name = $_POST['Name'];
$Middle_Name = $_POST['Middle_Name'];
$Last_Name = $_POST['Last_Name'];
$birthplace = $_POST['birthplace'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$age = $_POST['age'];
$civil_status = $_POST['civil_status'];
$citizenship = $_POST['citizenship'];
$ethnicity = $_POST['ethnicity'];
$permanent_address = $_POST['permanent_address'];
$zip_code = trim($_POST['zip_code']);
$phone_number = $_POST['phone_number'];
$facebook = $_POST['facebook'];
$contact_person_1 = $_POST['contact_person_1'];
$contact1_phone = $_POST['contact_person_1_mobile'];
$relationship_1 = $_POST['relationship_1'];
$contact_person_2 = $_POST['contact_person_2'];
$contact_person_2_mobile = $_POST['contact_person_2_mobile'];
$relationship_2 = $_POST['relationship_2'];
$academic_classification = $_POST['academic_classification'];
$high_school_name_address = $_POST['high_school_name_address'];
$lrn = $_POST['lrn'];
$degree_applied = $_POST['degree_applied'];
$nature_of_degree = $_POST['nature_of_degree'];


// Prepare update statement
// Prepare the update statement
$stmt = $conn->prepare("UPDATE admission_data SET 
Name=?, Middle_Name=?, Last_Name=?, birthplace=?, gender=?, birthdate=?, age=?, civil_status=?, 
citizenship=?, ethnicity=?, permanent_address=?, zip_code=?, phone_number=?, facebook=?, 
contact_person_1=?, contact1_phone=?, relationship_1=?, contact_person_2=?, 
contact_person_2_mobile=?, relationship_2=?, academic_classification=?, high_school_name_address=?, 
lrn=?, degree_applied=?, nature_of_degree=? WHERE email=?");

$stmt->bind_param("ssssssisssssssssssssssssss", 
$Name, $Middle_Name, $Last_Name, $birthplace, $gender, $birthdate, $age, 
$civil_status, $citizenship, $ethnicity, $permanent_address, $zip_code, 
$phone_number, $facebook, $contact_person_1, $contact1_phone, $relationship_1,
$contact_person_2, $contact_person_2_mobile, $relationship_2, 
$academic_classification, $high_school_name_address, $lrn, 
$degree_applied, $nature_of_degree, $email);
// If update is successful
if ($stmt->execute()) {
    // Set success message
    $_SESSION['success_message'] = "Profile updated successfully.";

    // Create an activity log with fields that were updated
    $fieldsUpdated = [];
    if ($Name !== $originalData['Name']) {
        $fieldsUpdated[] = "Name";
    }
    if ($Middle_Name !== $originalData['Middle_Name']) {
        $fieldsUpdated[] = "Middle Name";
    }
    if ($Last_Name !== $originalData['Last_Name']) {
        $fieldsUpdated[] = "Last Name";
    }
    if ($birthplace !== $originalData['birthplace']) {
        $fieldsUpdated[] = "Birthplace";
    }
    if ($gender !== $originalData['gender']) {
        $fieldsUpdated[] = "Gender";
    }
    if ($birthdate !== $originalData['birthdate']) {
        $fieldsUpdated[] = "Birthdate";
    }

    if ($civil_status !== $originalData['civil_status']) {
        $fieldsUpdated[] = "Civil Status";
    }
    if ($citizenship !== $originalData['citizenship']) {
        $fieldsUpdated[] = "Citizenship";
    }
    if ($ethnicity !== $originalData['ethnicity']) {
        $fieldsUpdated[] = "Ethnicity";
    }
    if ($permanent_address !== $originalData['permanent_address']) {
        $fieldsUpdated[] = "Permanent Address";
    }

    if ($phone_number !== $originalData['phone_number']) {
        $fieldsUpdated[] = "Phone Number";
    }
    if ($facebook !== $originalData['facebook']) {
        $fieldsUpdated[] = "Facebook";
    }
    if ($contact_person_1 !== $originalData['contact_person_1']) {
        $fieldsUpdated[] = "Contact Person 1";
    }
    if ($contact1_phone !== $originalData['contact1_phone']) {
        $fieldsUpdated[] = "Contact Person 1 Mobile";
    }
    if ($relationship_1 !== $originalData['relationship_1']) {
        $fieldsUpdated[] = "Relationship with Contact Person 1";
    }
    if ($contact_person_2 !== $originalData['contact_person_2']) {
        $fieldsUpdated[] = "Contact Person 2";
    }
    if ($contact_person_2_mobile !== $originalData['contact_person_2_mobile']) {
        $fieldsUpdated[] = "Contact Person 2 Mobile";
    }
    if ($relationship_2 !== $originalData['relationship_2']) {
        $fieldsUpdated[] = "Relationship with Contact Person 2";
    }
    if ($academic_classification !== $originalData['academic_classification']) {
        $fieldsUpdated[] = "Academic Classification";
    }
    if ($high_school_name_address !== $originalData['high_school_name_address']) {
        $fieldsUpdated[] = "High School Name/Address";
    }
    if ($lrn !== $originalData['lrn']) {
        $fieldsUpdated[] = "LRN";
    }
    if ($degree_applied !== $originalData['degree_applied']) {
        $fieldsUpdated[] = "Degree Applied";
    }
    if ($nature_of_degree !== $originalData['nature_of_degree']) {
        $fieldsUpdated[] = "Nature of Degree";
    }

    // Create a description of updated fields
    $fieldsDescription = implode(", ", $fieldsUpdated);

    // Log the activity
    $userId = $_SESSION['user_id'];
    $userName = $originalData['Name'] . ' ' . $originalData['Last_Name'];
    $action = "Profile Updated";
    $description = "Student with an $email updated the following fields: " . $fieldsDescription;
    $createdAt = date('Y-m-d H:i:s'); // Current time
    $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

// Corrected `bind_param()` for seven placeholders
$logStmt = $conn->prepare("INSERT INTO activity_log (user_id, email, userType, action, description, created_at, ip_address) VALUES (?, ?, 'Student', ?, ?, ?, ?)");
$logStmt->bind_param("isssss", $userId, $email, $action, $description, $createdAt, $ip_address);

    if (!$logStmt->execute()) {
        error_log("Error logging activity: " . $logStmt->error);
    }

    $logStmt->close();
} else {
    // Set error message if update fails
    $_SESSION['error_message'] = "Failed to update profile. Please try again later.";
}

$stmt->close();

// Redirect to avoid form resubmission
header("Location: Student_EditProfile.php");
exit();
?>
