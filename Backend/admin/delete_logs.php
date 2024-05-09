<?php
include("../config.php");

if(isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];
    foreach ($delete_ids as $id) {


        // Delete data from original table
        $delete_query = "DELETE FROM activity_log WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);
        $delete_stmt->execute();
    }
    echo "Applicant has been deleted successfully.";
}

?>
