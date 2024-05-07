<?php
$host = "benguetsuadmission.online";
$user = "u749192116_bsu_admission";
$password = "6Gx~sDdHXH*";
$database = "u749192116_bsu_admission";

// Create connection
$conn = new mysqli(hostname: $host, 
                    username: $user, 
                    password: $password, 
                    database: $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;

?>
