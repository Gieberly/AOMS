<?php
include("../config.php");

if(isset($_POST['delete_ids'])) {
    $delete_ids = $_POST['delete_ids'];
    foreach ($delete_ids as $id) {
        // Move data to archive table
        $move_query = "INSERT INTO admission_data SELECT * FROM admission_data_archive WHERE id = ?";
        $move_stmt = $conn->prepare($move_query);
        $move_stmt->bind_param("i", $id);
        $move_stmt->execute();

        // Delete data from original table
        $delete_query = "DELETE FROM admission_data_archive WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $id);
        $delete_stmt->execute();
    }
    echo "Applicant has been archived successfully.";
}

?>
