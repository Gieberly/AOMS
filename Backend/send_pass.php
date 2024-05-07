<?php

$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$conn = require __DIR__."/config.php";
$sql = "UPDATE users SET token = ?, token_expire = ? WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt-> bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

if ($conn->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="https://benguetsuadmission.online/Backend/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();
        // Redirect with a success message
        header('Location: loginpage.php?message=Message sent, please check your inbox.');

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

} else {
    // If no rows affected, redirect with an error message
    header('Location: loginpage.php?message=Failed to send the reset email.');
}

?>
