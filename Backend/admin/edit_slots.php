<?php
include("../config.php");
if(isset($_POST['update_appointment']))
{
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $slots = mysqli_real_escape_string($conn, $_POST['slots']);
    

    if($date == NULL ||$time == NULL ||$slots == NULL )

    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE appointmentdate SET appointment_date='$date',appointment_time='$time',available_slots='$slots'
                WHERE id='$appointment_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Appointment Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Appointment Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}