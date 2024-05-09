<?php

require '../config.php';

if(isset($_GET['log_id']))
{
    $log_id = mysqli_real_escape_string($conn, $_GET['log_id']);

    $query = "SELECT * FROM audit_trail WHERE id='$log_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $log = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Log Fetch Successfully by id',
            'data' => $log
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Log Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_log'])) {
    $log_id = mysqli_real_escape_string($conn, $_POST['log_id']);

    // Step 1: Retrieve user information before deletion
    $select_query = "SELECT * FROM audit_trail WHERE id='$log_id'";
    $select_result = mysqli_query($conn, $select_query);
    $log_data = mysqli_fetch_assoc($select_result);

        $delete_query = "DELETE FROM audit_trail WHERE id='$log_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if($delete_result) {
            $res = [
                'status' => 200,
                'message' => 'Log Deleted Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Log deleting from audit trail table'
            ];
            echo json_encode($res);
            return;
        }
    
}

if(isset($_POST['delete_all_logs'])) {
    $delete_all_query = "DELETE FROM audit_trail";
    $delete_all_result = mysqli_query($conn, $delete_all_query);

    if($delete_all_result) {
        $res = [
            'status' => 200,
            'message' => 'All Logs Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Error occurred while deleting all logs'
        ];
        echo json_encode($res);
        return;
    }
}

?>