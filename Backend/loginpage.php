<?php
session_start();
include("config.php");
date_default_timezone_set('Asia/Manila');
// Check if there's a message parameter in the URL
$message = isset($_GET['message']) ? $_GET['message'] : '';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password, userType, lstatus FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword, $userType, $lstatus);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_type'] = $userType;
            $_SESSION['user_email'] = $email;
       
            // Log user activity
            $action = "User logs in";
            $description = " $userType User with email: $email  logged into their dashboard.";
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $created_at = date('Y-m-d H:i:s'); // Get current date/time in the correct timezone

            $logSql = "INSERT INTO activity_log (user_id, email, userType, action, description, created_at, ip_address)
                       VALUES ('$id', '$email', '$userType', '$action', '$description', '$created_at', '$ip_address')";
            $conn->query($logSql);

            if ($userType == 'Student' || $userType == 'student') {
                header("Location: student/Student_Dashboard.php");
                exit();
            } elseif ($userType == 'Faculty'|| $userType == 'faculty') {
                if (strtolower($lstatus) == 'approved') {
                    header("Location: faculty/Faculty_Dashboard.php");
                    exit();
                } elseif (strtolower($lstatus) == 'Pending') {
                    $_SESSION['message'] = "Your registration is pending approval.";
                    header("Location: loginpage.php");
                    exit();
                } elseif (strtolower($lstatus) == 'rejected') {
                    $_SESSION['message'] = "Your registration has been rejected. Please contact the administrator.";
                    header("Location: loginpage.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Your registration is not yet approved. Please wait for admin approval.";
                    header("Location: loginpage.php");
                    exit();
                }
            } elseif ($userType == 'Staff'|| $userType == 'Personnel') {
                if (strtolower($lstatus) == 'approved') {
                    header("Location:personnel/Personnel_dashboard.php");
                    exit();
                } elseif (strtolower($lstatus) == 'Pending') {
                    $_SESSION['message'] = "Your registration is pending approval.";
                    header("Location: loginpage.php");
                    exit();
                } elseif (strtolower($lstatus) == 'rejected') {
                    $_SESSION['message'] = "Your registration has been rejected. Please contact the administrator.";
                    header("Location: loginpage.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Your registration is not yet approved. Please wait for admin approval.";
                    header("Location: loginpage.php");
                    exit();
                }
            } 
            elseif ($userType == 'OSS'|| $userType == 'Oss') {
                if (strtolower($lstatus) == 'approved') {
                    header("Location: oss/OSS_Dashboard.php");
                    exit();
                } elseif (strtolower($lstatus) == 'Pending') {
                    $_SESSION['message'] = "Your registration is pending approval.";
                    header("Location: loginpage.php");
                    exit();
                } elseif (strtolower($lstatus) == 'rejected') {
                    $_SESSION['message'] = "Your registration has been rejected. Please contact the administrator.";
                    header("Location: loginpage.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Your registration is not yet approved. Please wait for admin approval.";
                    header("Location: loginpage.php");
                    exit();
                }
            }elseif ($userType == 'admin' || $userType == 'Admin' ) {
                header("Location: admin/dashboard_admin.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Incorrect password";
            header("Location: loginpage.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found";
        header("Location: loginpage.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <title>Account Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
    
    body {
        background-image: url('assets/images/banner.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
    }
        .message {
            display: block;
            padding: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
            /* Dark red text color */
            border-radius: 4px;
            opacity: 0.9;
            /* Adjust opacity as needed */
            animation: slideUp 0.5s ease-out;
            /* Animation settings */
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 0.9;
                transform: translateY(0);
                /* Final position at the top */
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="icon">
            <a href="#" class="logo"><img src="assets/images/BSU Logo1.png" alt="BSU Logo"></a>
            <h2 class="scname">Benguet State University</h2>
        </div>
    </header>

    <section class="content">
        <div class="side">
            <h1 class="text_content">Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
        </div>
        <div class="form" id="loginForm" style="display: block;">
            <form action="loginpage.php" method="POST" id="#login_page">
                <h2>Login</h2>
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="message"><?php echo $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div id="successMessage" class="message" style="background-color: #dff0d8; color: #3c763d;"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                 <?php if (isset($_SESSION['success_messages'])) : ?>
                    <div id="successMessage" class="message" style="background-color: #dff0d8; color: #3c763d;"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_messages']); ?>
                <?php endif; ?>
                
                <?php if (!empty($message)) : ?>
                    <div class="message" id="successMessage" style="background-color: #dff0d8; color: #3c763d;"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
                <?php if (!empty($error_message)) : ?>
                    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <?php if (!empty($success_message)) : ?>
                    <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
                <?php endif; ?>

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <button class="btnn" style="border-radius:5px" type="submit" id="login">Login</button>
                <p class="link"><br>
                <a href="forgot_pass.php" id="signupLink">Forgot Password?</a></p>

                    <div class="dropdown-divider"></div>
                    <br>
                <button class="btn btn-primary btn-block" type="submit" id="create_account">Create account</button>
            </form>
        </div>
    </section>
    <script src="assets\js\login.js"></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
   $(document).ready(function() {
    // Event listener for the "Create account" button
    $('#create_account').click(function() {
        // AJAX request to redirect the user to the register page
        $.ajax({
            url: 'register.php', // URL of the register page
            type: 'GET', // Using GET method to retrieve the register page
            success: function(response) {
                // Redirect the user to the register page
                window.location.href = 'register.php';
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>
</body>

</html>