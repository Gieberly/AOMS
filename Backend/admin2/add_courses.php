<?php
session_start();
include("../config.php");
include("../includes/functions.php");
include("../includes/fetch_data.php"); // Include your database configuration file

if(isset($_POST['add_course'])) {
    
    $action = "Course Added";
    logAction($action, $email, $userType, $conn);

    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $nature  = mysqli_real_escape_string($conn, $_POST['nature']);
    $sections  = mysqli_real_escape_string($conn, $_POST['sections']);
    $students  = mysqli_real_escape_string($conn, $_POST['students']);

    // Mandatory field check
    if(empty($course) || empty($college) || empty($nature) || empty($sections) || empty($students)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
        // Calculate the Number_of_Available_Slots using multiplyColumns function
    $number_of_available_slots = multiplyColumns($sections, $students);
    // Insert data into database using prepared statement
    $sql = "INSERT INTO programs (College ,Courses,Nature_of_Degree,No_of_Sections,No_of_Students_Per_Section,Number_of_Available_Slots) VALUES (?, ?, ?, ?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $course,$college,$nature,$sections,$students,$number_of_available_slots);
    $sql_run = mysqli_stmt_execute($stmt);

    // Check if insertion was successful
    if($sql_run) {
        $action = "Course Added";
        $email = $_SESSION['email'];
        $userType = $_SESSION['user_type'];
    
        logAction($action, $email, $userType, $conn);
        $res = [
            'status' => 200,
            'message' => 'Program Created Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        // Insertion failed
        $res = [
            'status' => 500,
            'message' => 'Program Not Created'
        ];
        echo json_encode($res);
        return;
    }
} 


if(isset($_POST['update_program'])) {
    $action = "Program Updated";
    $email = $_SESSION['email'];
    $userType = $_SESSION['user_type'];
    logAction($action, $email, $userType, $conn);

    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $college = mysqli_real_escape_string($conn, $_POST['colleges']);
    $course = mysqli_real_escape_string($conn, $_POST['courses']);
    $nature = mysqli_real_escape_string($conn, $_POST['program_nature']);
    $sections = mysqli_real_escape_string($conn, $_POST['number_sections']);
    $students = mysqli_real_escape_string($conn, $_POST['number_students']);

    if($course == NULL || $college == NULL || $nature == NULL || $sections == NULL || $students == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Calculate the Number_of_Available_Slots using multiplyColumns function
    $number_of_available_slots = multiplyColumns($sections, $students);

    $query = "UPDATE programs SET College='$college', Courses='$course', Nature_of_Degree='$nature', 
              No_of_Sections='$sections', No_of_Students_Per_Section='$students', 
              Number_of_Available_Slots='$number_of_available_slots' WHERE ProgramID='$program_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Program Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Program Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['program_id']))
{
    $program_id = mysqli_real_escape_string($conn, $_GET['program_id']);

    $query = "SELECT * FROM programs WHERE ProgramID='$program_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $oss = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Program Fetch Successfully by id',
            'data' => $oss
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Program Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_program'])) {
    $action = "Program deleted";
    $email = $_SESSION['email'];
    $userType = $_SESSION['user_type'];
    logAction($action, $email, $userType, $conn);

    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    
    // Step 1: Select the row to be deleted
    $select_query = "SELECT * FROM programs WHERE ProgramID='$program_id'";
    $select_query_run = mysqli_query($conn, $select_query);
    $deleted_student = mysqli_fetch_assoc($select_query_run); // Fetch the row to be deleted
    
    // Step 2: Insert the row into users_archive table
    $archive_query = "INSERT INTO programs_archive (College, Courses, Nature_of_Degree, No_of_Sections, No_of_Students_Per_Section, Number_of_Available_Slots, 
    Number_of_Applicants_As_of_Date, Remaining_Slots, SLOTS_After_Screening, Admitted_Qualified, Admitted_Not_Qualified, Admitted_Total, Not_Admitted_Possible_Qualifier,PQ_NB,Not_Admitted_Not_Qualified,Not_Admitted_Total ,Overall_Total) 
              VALUES ( '{$deleted_student['College']}', '{$deleted_student['Courses']}', '{$deleted_student['Nature_of_Degree']}', '{$deleted_student['No_of_Sections']}', '{$deleted_student['No_of_Students_Per_Section']}', 
              '{$deleted_student['Number_of_Available_Slots']}', '{$deleted_student['Number_of_Applicants_As_of_Date']}', '{$deleted_student['Remaining_Slots']}', '{$deleted_student['SLOTS_After_Screening']}', '{$deleted_student['Admitted_Qualified']}', 
              '{$deleted_student['Admitted_Not_Qualified']}', '{$deleted_student['Admitted_Total']}', '{$deleted_student['Not_Admitted_Possible_Qualifier']}', '{$deleted_student['PQ_NB']}', '{$deleted_student['Not_Admitted_Not_Qualified']}'
              , '{$deleted_student['Not_Admitted_Total']}', '{$deleted_student['Overall_Total']}')";

    $archive_query_run = mysqli_query($conn, $archive_query);
    
    // Step 3: Delete the student from users table
    $delete_query = "DELETE FROM programs WHERE ProgramID='$program_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    
    if($delete_query_run) {
        $res = [
            'status' => 200,
            'message' => 'Program Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Program Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>
