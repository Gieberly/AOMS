<?php
include("../config.php");

if(isset($_POST['add_OSS'])) {
    // Get form data
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $userType = mysqli_real_escape_string($conn, $_POST['office']);
    $temp_password = password_hash($_POST['temp_pass'], PASSWORD_DEFAULT);

    // Mandatory field check
    if(empty($lname) || empty($fname) || empty($mname) || empty($email) || empty($status) || empty($userType) || empty($temp_password)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    // Check if user already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        // User already exists
        $res = [
            'status' => 200,
            'message' => 'Email address already exists. Please choose a different email.'
        ];
        echo json_encode($res);
        return;
    }else{
        $sql = "INSERT INTO users (name, last_name, mname, email, password, userType, lstatus) 
        VALUES ('$fname', '$lname', '$mname', '$email', '$temp_password', '$userType', '$status')";
        $sql_run = mysqli_query($conn, $sql);
    
        // Check if insertion was successful
        if($sql_run) {
            // Insertion successful
            $res = [
                'status' => 200,
                'message' => 'User Created Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            // Insertion failed
            $res = [
                'status' => 500,
                'message' => 'User Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }

    // Insert data into database
    
} 

if(isset($_POST['update_OSS']))
{
    $OSS_id = mysqli_real_escape_string($conn, $_POST['OSS_id']);

    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $office = mysqli_real_escape_string($conn, $_POST['office']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if($lname == NULL ||$fname == NULL ||$mname == NULL || $email == NULL || $status == NULL || $office == NULL)

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE users SET last_name='$lname',name='$fname',mname='$mname', email='$email', lstatus='$status', userType='$office',password='$password'
                WHERE id='$OSS_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'OSS Staff Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'OSS Staff Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['OSS_id']))
{
    $OSS_id = mysqli_real_escape_string($conn, $_GET['OSS_id']);

    $query = "SELECT * FROM users WHERE id='$OSS_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $oss = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'OSS Staff Fetch Successfully by id',
            'data' => $oss
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'OSS Staff Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_oss']))
{
    $OSS_id = mysqli_real_escape_string($conn, $_POST['OSS_id']);

    $query = "DELETE FROM users WHERE id='$OSS_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'OSS Staff Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'OSS Staff Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>
