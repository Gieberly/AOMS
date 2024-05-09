<?php
include ("../config.php");

if(isset($_GET['file_id']))
{
    $file_id = mysqli_real_escape_string($conn, $_GET['file_id']);

    $query = "SELECT * FROM users WHERE id='$file_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $faculty = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'File Fetch Successfully by id',
            'data' => $faculty
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'File Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_file']))
{
    $file_id = mysqli_real_escape_string($conn, $_POST['file_id']);

    $query = "DELETE FROM files WHERE id='$file_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'File Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'File Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>