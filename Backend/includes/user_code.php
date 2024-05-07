<?php

require '../config.php';

if(isset($_POST['update_staff']))
{
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);    
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);

    if($lname == NULL ||$fname == NULL ||$mname == NULL || $email == NULL || $status == NULL || $office == NULL)

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE users SET last_name='$lname',name='$fname',mname='$mname', email='$email', lstatus='$status', userType='$office', Designation='$designation', Department='$dept'
                WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['staff_id']))
{
    $staff_id = mysqli_real_escape_string($conn, $_GET['staff_id']);

    $query = "SELECT * FROM users WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $staff = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Staff Fetch Successfully by id',
            'data' => $staff
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Staff Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_student']))
{
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

    $query = "DELETE FROM users WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Staff Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>