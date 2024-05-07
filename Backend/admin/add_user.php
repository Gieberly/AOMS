<?php
include("../config.php");

if(isset($_POST['add_staff'])) {
    // Get form data
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $userType = mysqli_real_escape_string($conn, $_POST['office']);
    $designation= mysqli_real_escape_string($conn, $_POST['designation']);

    if($lname == NULL ||$fname == NULL ||$mname == NULL || $email == NULL || $status == NULL || $userType == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE users SET last_name='$lname',name='$fname',mname='$mname', email='$email', lstatus='$status', userType='$userType', Designation='$designation'
                WHERE email='$email'";

    // Check if user already exists
    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if(mysqli_num_rows($check_result) > 0) {
        // User already exists
        $res = [
            'status' => 422,
            'message' => 'Email address already exists. Please choose a different email.'
        ];
        echo json_encode($res);
        return;
    }else{
        $sql = "INSERT INTO users (name, last_name, mname, email, Designation, userType, lstatus) 
        VALUES ('$fname', '$lname', '$mname', '$email', '$designation', '$userType', '$status')";
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
?>
