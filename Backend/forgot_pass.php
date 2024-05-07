
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <title>Admin and Faculty login</title>
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
            <form action="send_pass.php" method="POST" id="#login_page">
                <h2>Reset Password</h2>
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="message"><?php echo $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div id="successMessage" class="message" style="background-color: #dff0d8; color: #3c763d;"><?php echo $_SESSION['success_message']; ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <input type="text" name="email" placeholder="Enter Email" required>
                <br>

                    <!--button class="btn btn-secondary" style="border-radius:5px" type="submit" id="cancel_search">Cancel</button-->
                    <button class="btn btn-success" style="border-radius:5px" type="submit" id="search">Reset</button>
            </form>
        </div>
    </section>
    <script src="assets\js\login.js"></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>