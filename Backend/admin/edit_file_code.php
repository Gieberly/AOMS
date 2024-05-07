<?php

require '../config.php';

if(isset($_POST['edit_file']))
{
    $file_id = mysqli_real_escape_string($conn, $_POST['file_id']);

    $class = mysqli_real_escape_string($conn, $_POST['classification']);
    $start = mysqli_real_escape_string($conn, $_POST['start_year']);
    $end = mysqli_real_escape_string($conn, $_POST['end_year']);
    $sem = mysqli_real_escape_string($conn, $_POST['sem']);    
    $name = mysqli_real_escape_string($conn, $_POST['nsme']);
    $file = mysqli_real_escape_string($conn, $_POST['filew']);

    if($class == NULL ||$start == NULL ||$end == NULL || $sem == NULL || $name == NULL || $file == NULL)

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE files SET classification='$class',start_year='$start',end_year='$end', sem='$email', file_name='$file'
                WHERE id='$file_id'";
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

?>