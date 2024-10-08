<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id']; // Assuming you're passing the ID from the form
    $first_name = $_POST['Name'];
    $middle_name = $_POST['Middle_Name'];
    $last_name = $_POST['Last_Name'];
    $gender = $_POST['gender'];
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contact_person_1 = isset($_POST['contact_person_1']) ? $_POST['contact_person_1'] : '';
    $contact_person_1_mobile = isset($_POST['contact_person_1_mobile']) ? $_POST['contact_person_1_mobile'] : '';
    $relationship_1 = isset($_POST['relationship_1']) ? $_POST['relationship_1'] : '';
    $contact_person_2 = isset($_POST['contact_person_2']) ? $_POST['contact_person_2'] : '';
    $contact_person_2_mobile = isset($_POST['contact_person_2_mobile']) ? $_POST['contact_person_2_mobile'] : '';
    $relationship_2 = isset($_POST['relationship_2']) ? $_POST['relationship_2'] : '';
    $academic_classification = isset($_POST['academic_classification']) ? $_POST['academic_classification'] : '';
    $college = isset($_POST['college']) ? $_POST['college'] : '';
    $degree_applied = isset($_POST['degree_applied']) ? $_POST['degree_applied'] : '';
    $nature_of_degree = isset($_POST['nature_of_degree']) ? $_POST['nature_of_degree'] : '';
    $high_school_name_address = isset($_POST['high_school_name_address']) ? $_POST['high_school_name_address'] : '';
    $lrn = isset($_POST['lrn']) ? $_POST['lrn'] : '';
     $applicant_number = isset($_POST['applicant_number']) ? $_POST['applicant_number'] : '';

    $stmt = $conn->prepare("UPDATE admission_data SET Name=?, Middle_Name=?, Last_Name=?, gender=?, phone_number=?, email=?, contact_person_1=?, contact1_phone=?, relationship_1=?, contact_person_2=?, contact_person_2_mobile=?, relationship_2=?, academic_classification=?, college=?, degree_applied=?, nature_of_degree=?, high_school_name_address=?, lrn=?,applicant_number=? WHERE id=?");
    $stmt->bind_param("sssssssssssssssssisi", $first_name, $middle_name, $last_name, $gender, $phone_number, $email, $contact_person_1, $contact_person_1_mobile, $relationship_1, $contact_person_2, $contact_person_2_mobile, $relationship_2, $academic_classification, $college, $degree_applied, $nature_of_degree, $high_school_name_address, $lrn,$applicant_number, $id);

    if ($stmt->execute()) {
        // Set a session variable for success message
        session_start();
        $_SESSION['update_success'] = true;

        header("Location: Personnel_Applicants.php?search=" . urlencode($_GET['search']));
        exit();
    }
}
?>
