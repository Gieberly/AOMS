@ -1,37 +0,0 @@
<?php

declare(strict_types=1);
require_once '../config.php';

function get_email(object $conn,string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $conn->prepare($query);
    $stmt -> bindParam(":email", $email);
    $stmt ->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function set_user(object $conn, string $name, string $mname, string $lname, string $email, string $pwd, string $role)
{
    if ($pwd) {
        $query = "INSERT INTO users (name, mname, last_name, email, password, userType) VALUES (:name, :mname, :lname, :email, :pwd, :role)";
        $stmt = $conn->prepare($query);
        $option = [
            'cost' => 12
        ];
        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $option);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":mname", $mname);
        $stmt->bindParam(":lname", $lname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashedPwd); // Changed from :password to :pwd
        $stmt->bindParam(":role", $role);
        
        $stmt->execute();
    } else {
        echo '<p class= form-error>password did not match</p>';
        die();
    }
}