<?php
include("../config.php"); // Include your database configuration file

if(isset($_POST['add_course'])) {
    // Get form data
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $nature  = mysqli_real_escape_string($conn, $_POST['nature']);
    $slots  = mysqli_real_escape_string($conn, $_POST['slots']);

    // Mandatory field check
    if(empty($course) || empty($college) || empty($nature) || empty($slots)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Insert data into database using prepared statement
    $sql = "INSERT INTO programs (College ,Courses,Nature_of_Degree, Number_of_Available_Slots) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $course,$college,$nature,$slots);
    $sql_run = mysqli_stmt_execute($stmt);

    // Check if insertion was successful
    if($sql_run) {
        // Insertion successful
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


if(isset($_POST['update_program']))
{
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);
    $college = mysqli_real_escape_string($conn, $_POST['colleges']);
    $course = mysqli_real_escape_string($conn, $_POST['courses']);
    $nature  = mysqli_real_escape_string($conn, $_POST['program_nature']);
    $slots  = mysqli_real_escape_string($conn, $_POST['new_slots']);

    if($course == NULL || $college == NULL ||$nature == NULL || $slots == NULL)

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE programs SET College='$college',Courses='$course ',Nature_of_Degree='$nature', Number_of_Available_Slots='$slots'
                WHERE ProgramID='$program_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Program Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
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

if(isset($_POST['delete_program']))
{
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);

    $query = "DELETE FROM programs WHERE ProgramID='$program_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Program Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Program Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>
