<?php

require '../config.php';

if(isset($_GET['app_id']))
{
    $app_id = mysqli_real_escape_string($conn, $_GET['app_id']);

    $query = "SELECT * FROM admission_data WHERE id='$app_id'";
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

if(isset($_POST['update_app']))
{
    $app_id = mysqli_real_escape_string($conn, $_POST['app_id']);

    $app_num = mysqli_real_escape_string($conn, $_POST['app_num']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $bp = mysqli_real_escape_string($conn, $_POST['bp']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $gr11 = mysqli_real_escape_string($conn, $_POST['gr_11']);
    $gr12 = mysqli_real_escape_string($conn, $_POST['gr_12']);
    $interview = mysqli_real_escape_string($conn, $_POST['interview']);
    $score = mysqli_real_escape_string($conn, $_POST['score']);
    $endorsed = mysqli_real_escape_string($conn, $_POST['endorsed']);
    $personnel = mysqli_real_escape_string($conn, $_POST['personnel']);
    $result = mysqli_real_escape_string($conn, $_POST['result']);
    $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);


    if( $app_num == NULL || $lname == NULL || $fname == NULL ||$mname == NULL )

    {
        $res = [
            'status' => 422,
            'message' => 'Application Number and Fullname are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE admission_data SET 
    applicant_number='$app_num',
    Last_Name ='$lname',
    Name = '$fname',
    Middle_Name ='$mname',
    birthplace= '$bp',
    college= '$college',
    degree_applied= '$program',
    Gr11_GWA = '$gr11',
    Gr12_GWA = '$gr12',
    Interview_Result= '$interview',
    OSS_Admission_Test_Score = '$score',
    Endorsed = '$endorsed',
    Personnel_Result = '$personnel',
    Admission_Result = '$result',
    Confirmed_Slot= '$confirm'
    WHERE id='$app_id'";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Applicant Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Applicant Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_applicant'])) {
    $app_id = mysqli_real_escape_string($conn, $_POST['app_id']);

    // Step 1: Retrieve user information before deletion
    $select_query = "SELECT * FROM admission_data WHERE id='$app_id'";
    $select_result = mysqli_query($conn, $select_query);
    $staff_data = mysqli_fetch_assoc($select_result);

    // Step 2: Insert user information into admission_data_archive table
    $insert_query = "INSERT INTO admission_data_archive 
    (applicant_number, Last_Name, Name, Middle_Name, birthplace, college, degree_applied, Gr11_GWA, Gr12_GWA, Interview_Result, OSS_Admission_Test_Score, Endorsed, Personnel_Result, Admission_Result, Confirmed_Slot)
    VALUES ('{$staff_data['applicant_number']}', '{$staff_data['Last_Name']}', '{$staff_data['Name']}', '{$staff_data['Middle_Name']}', '{$staff_data['birthplace']}', '{$staff_data['college']}', 
    '{$staff_data['degree_applied']}', '{$staff_data['Gr11_GWA']}', '{$staff_data['Gr12_GWA']}', '{$staff_data['Interview_Result']}', '{$staff_data['OSS_Admission_Test_Score']}', '{$staff_data['Endorsed']}',
     '{$staff_data['Personnel_Result']}', '{$staff_data['Admission_Result']}', '{$staff_data['Confirmed_Slot']}')";
    $insert_result = mysqli_query($conn, $insert_query);

    if($insert_result) {
        // Step 3: Delete the staff member from admission_data table
        $delete_query = "DELETE FROM admission_data WHERE id='$app_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result) {
            // Staff member deleted successfully
            $res = [
                'status' => 200,
                'message' => 'Applicant Deleted Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            // Failed to delete staff member from admission_data table
            $res = [
                'status' => 500,
                'message' => 'Error deleting applicant from admission_data table'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        // Failed to insert staff member into admission_data_archive table
        $res = [
            'status' => 500,
            'message' => 'Error inserting applicant into admission_data_archive table'
        ];
        echo json_encode($res);
        return;
    }
}

?>