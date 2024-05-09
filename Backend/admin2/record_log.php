<?php
include("../config.php");
include "../includes/functions.php";
$logs = getAuditLogs();
if ($logs !== false) {
    $logsArray = [];
    while ($row = $logs->fetch_assoc()) {
        $logsArray[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($logsArray);
} else {
    echo json_encode([]);
}
?>
