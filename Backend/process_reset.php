<?php

session_start();

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

$conn = require __DIR__ . "/config.php";

$sql = "SELECT * FROM users WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    $_SESSION['error'] = "Token not found";
} elseif (strtotime($user["token_expire"]) <= time()) {
    $_SESSION['error'] = "Token has expired";
} elseif (strlen($_POST["password"]) < 8) {
    $_SESSION['error'] = "Password must be at least 8 characters";
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $_SESSION['error'] = "Password must contain at least one letter";
} elseif (!preg_match("/[0-9]/", $_POST["password"])) {
    $_SESSION['error'] = "Password must contain at least one number";
} elseif ($_POST["password"] !== $_POST["password_confirm"]) {
    $_SESSION['error'] = "Passwords must match";
} else {
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ?, token = NULL, token_expire = NULL WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password_hash, $user["id"]);
    $stmt->execute();
    $_SESSION['success'] = "Password updated. You can now login.";
}

header('Location: loginpage.php');
exit();

?>
