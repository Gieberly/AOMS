<?php
include("../config.php");
include("../includes/fetch_data.php");
// Usage:
if(isset($_POST['undo'])) {
    $id_to_restore = mysqli_real_escape_string($conn, $_POST['id_to_restore']);
    $success = restoreFromArchive($conn, $id_to_restore);

    if($success) {
        // Restoration successful
        $res = [
            'status' => 200,
            'message' => 'User Restored Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        // Restoration failed
        $res = [
            'status' => 500,
            'message' => 'Error Restoring User'
        ];
        echo json_encode($res);
        return;
    }
}
?>