<?php
require '../config.php';

if(isset($_POST['update_user']))
{
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);    
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    if($lname == NULL ||$fname == NULL ||$mname == NULL || $email == NULL || $status == NULL || $office == NULL)

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE users SET last_name='$lname',name='$fname',mname='$mname', email='$email', 
                lstatus='$status', userType='$office',Department='$dept', Designation='$designation'
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