<?php
include("../config.php");

if(isset($_POST['add_faculty'])) {
    // Get form data
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $userType = mysqli_real_escape_string($conn, $_POST['office']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);


    // Mandatory field check
    if(empty($lname) || empty($fname) || empty($mname) || empty($email) || empty($status) || empty($userType) || empty($designation)|| empty($dept)) {
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
        $sql = "INSERT INTO users (name, last_name, mname, email, userType, lstatus, Department, Designation) 
        VALUES ('$fname', '$lname', '$mname', '$email', '$userType', '$status', '$dept','$designation')";
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

   }   // Insert data into database
    

    if(isset($_POST['update_faculty']))
    {
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    
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
                    WHERE id='$faculty_id'";
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
    
    
    if(isset($_GET['faculty_id']))
    {
        $faculty_id = mysqli_real_escape_string($conn, $_GET['faculty_id']);
    
        $query = "SELECT * FROM users WHERE id='$faculty_id'";
        $query_run = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($query_run) == 1)
        {
            $faculty = mysqli_fetch_array($query_run);
    
            $res = [
                'status' => 200,
                'message' => 'Faculty Fetch Successfully by id',
                'data' => $faculty
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Faculty Id Not Found'
            ];
            echo json_encode($res);
            return;
        }
    }
    
    if(isset($_POST['delete_student'])) {
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
        
        // Step 1: Select the row to be deleted
        $select_query = "SELECT * FROM users WHERE id='$faculty_id'";
        $select_query_run = mysqli_query($conn, $select_query);
        $deleted_student = mysqli_fetch_assoc($select_query_run); // Fetch the row to be deleted
        
        // Step 2: Insert the row into users_archive table
        $archive_query = "INSERT INTO users_archive (id, last_name, name, mname, email, password, userType, status, lstatus, Department, Designation, verification_code, token, token_expire, created_date, state) 
                  VALUES ('{$deleted_student['id']}', '{$deleted_student['last_name']}', '{$deleted_student['name']}', '{$deleted_student['mname']}', '{$deleted_student['email']}', '{$deleted_student['password']}', '{$deleted_student['userType']}', '{$deleted_student['status']}', '{$deleted_student['lstatus']}', '{$deleted_student['Department']}', '{$deleted_student['Designation']}', '{$deleted_student['verification_code']}', '{$deleted_student['token']}', '{$deleted_student['token_expire']}', '{$deleted_student['created_date']}', '{$deleted_student['state']}')";

        $archive_query_run = mysqli_query($conn, $archive_query);
        
        // Step 3: Delete the student from users table
        $delete_query = "DELETE FROM users WHERE id='$faculty_id'";
        $delete_query_run = mysqli_query($conn, $delete_query);
        
        if($delete_query_run) {
            $res = [
                'status' => 200,
                'message' => 'Faculty Deleted Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Student Not Deleted'
            ];
            echo json_encode($res);
            return;
        }
    }
    
    
?>
