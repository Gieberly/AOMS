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

    $query = "UPDATE users SET last_name='$lname',
    name='$fname',
    mname='$mname',
    email='$email',
    lstatus='$status',
    userType='$office',
    Designation='$designation',
    Department='$dept'
    WHERE id='$staff_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'User Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'User Not Updated'
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

if(isset($_POST['delete_staff'])) {
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

    // Step 1: Retrieve user information before deletion
    $select_query = "SELECT * FROM users WHERE id='$staff_id'";
    $select_result = mysqli_query($conn, $select_query);
    $staff_data = mysqli_fetch_assoc($select_result);

    // Step 2: Insert user information into users_archive table
    $insert_query = "INSERT INTO users_archive (id, last_name, name, mname, email, password, userType, status, lstatus, Department, Designation, verification_code, token, token_expire, created_date, state)
                     VALUES ('{$staff_data['id']}', '{$staff_data['last_name']}', '{$staff_data['name']}', '{$staff_data['mname']}', '{$staff_data['email']}', '{$staff_data['password']}', '{$staff_data['userType']}', '{$staff_data['status']}', '{$staff_data['lstatus']}', '{$staff_data['Department']}', '{$staff_data['Designation']}', '{$staff_data['verification_code']}', '{$staff_data['token']}', '{$staff_data['token_expire']}', '{$staff_data['created_date']}', '{$staff_data['state']}')";
    $insert_result = mysqli_query($conn, $insert_query);

    if($insert_result) {
        // Step 3: Delete the staff member from users table
        $delete_query = "DELETE FROM users WHERE id='$staff_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result) {
            // Staff member deleted successfully
            $res = [
                'status' => 200,
                'message' => 'Staff Deleted Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            // Failed to delete staff member from users table
            $res = [
                'status' => 500,
                'message' => 'Error deleting staff member from users table'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        // Failed to insert staff member into users_archive table
        $res = [
            'status' => 500,
            'message' => 'Error inserting staff member into users_archive table'
        ];
        echo json_encode($res);
        return;
    }
}


?>