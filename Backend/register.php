<?php
session_start();

date_default_timezone_set('Asia/Manila');
include ("config.php");

// Fetch data from the database and sort by College and Course
$sql = "SELECT * FROM programs ORDER BY College, Courses ASC";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $name = $_POST['name'];
    $mname = $_POST['mname'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Check if there are existing records with the same combination of first name, middle name, and last name (or just first and last name)
    $existingRecordsQuery = "SELECT * FROM users WHERE name = '$name' AND last_name = '$last_name'";
    $result = $conn->query($existingRecordsQuery);

    // If records with the same combination exist
    if ($result->num_rows > 0) {
        // Display a modal informing the user about the existing registration
        echo '<script>
                $(document).ready(function(){
                    $("#existingRegistrationModal").modal("show");
                });
              </script>';
    } else {
        // Continue with the registration process
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userType = $_POST['userType'];

        // Set status and department based on user type
        if ($userType == 'Student') {
            $lstatus = 'Approved';
            $department = NULL;
        } elseif ($userType == 'Personnel' || $userType == 'Faculty' || $userType == 'OSS') {
            $lstatus = 'Pending';
            $department = ($userType == 'Faculty') ? $_POST['description'] : NULL;
        } else {
            $lstatus = NULL;
            $department = NULL;
        }

        // Check if the email already exists
        $emailExistsQuery = "SELECT * FROM users WHERE email ='$email'";
        $result = $conn->query($emailExistsQuery);

        if ($result->num_rows > 0) {
            $error_message = "Email address already exists. Please choose a different email.";
        } else {
            // Email does not exist, proceed with registration
            $sql = "INSERT INTO users (name, last_name, mname, email, password, userType, lstatus, Department) 
                    VALUES ('$name', '$last_name', '$mname', '$email', '$password', '$userType', '$lstatus', '$department')";

            if ($conn->query($sql) === TRUE) {
                // User registration successful, log this action in the activity_log table
                $userId = $conn->insert_id; // Get the last inserted user ID
                $action = "Created an account";
                // Determine department (only applicable if userType is Faculty)
                $department = NULL;
                if ($userType == 'Faculty') {
                    $department = $_POST['description']; // Assuming 'description' holds the department for Faculty
                }

                $fullName = "$name $mname $last_name"; // Full name with middle name

                $currentDate = date('Y-m-d H:i:s'); // Get the current date and time
                if ($department !== NULL) {
                    $description = "User $userType registered with a name: $fullName,  department: $department, email address: $email, on $currentDate";
                } else {
                    $description = "User $userType registered with a name: $fullName,  email address: $email, on $currentDate";
                }

                // Log the activity
                $logSql = "INSERT INTO activity_log (user_id, email, userType, action, description, ip_address)
           VALUES ('$userId', '$email', '$userType', 'Created an account', '$description', '{$_SERVER['REMOTE_ADDR']}')";

                if ($conn->query($logSql) === TRUE) {
                    $success_message = "You have successfully registered. Redirecting to Login Page!";
                    header("refresh:3;url=loginpage.php"); // Redirect to login page after 3 seconds
                } else {
                    $error_message = "Error logging activity: " . $conn->error;
                }

            } else {
                $error_message = "Error during registration: " . $conn->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
            <h1>Welcome to<br><span>Benguet State <br>University </span> <br>Admission</h1>
        </div>
        <div class="modal" id="existingRegistrationModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Existing Registration Found!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>The same name and last name are already registered. If you haven't submitted any application
                            form, you can proceed. Note that repeated applicant forms will be disqualified.</p>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="confirmCheckbox">
                            <label class="form-check-label" for="confirmCheckbox">I confirm that I want to
                                proceed.</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proceedRegistration()">Proceed</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="form" id="registrationForm" style="display: block;">
            <form method="POST" id="RegForm">
                <h2>Register</h2>
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <!-- Display the success message with slide-up animation and red outer color -->
                <?php if (!empty($success_message)): ?>
                    <div class="success-message"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <!-- HTML input fields with validation -->
                <div id="errorname" class="error-message" style="display: none;"></div>
                <input class="register_in" type="text" name="name" placeholder="First Name*" autocomplete="name"
                    required oninput="validateInput(this)" id="register_name">

                <input class="register_in" type="text" name="mname" placeholder="Middle Name"
                    oninput="validateInput(this)" id="register_middlename">

                <input class="register_in" type="text" name="last_name" placeholder="Last Name*"
                    autocomplete="family-name" required oninput="validateInput(this)" id="register_lastname">

                <input class="register_in" type="email" name="email" placeholder="Email*" autocomplete="on">
                <div id="emailError" class="message">
                    <p class="create-email-link">Don't have an email? <a
                            href="https://accounts.google.com/v3/signin/identifier?continue=https://mail.google.com/mail/&service=mail&theme=glif&flowName=GlifWebSignIn&flowEntry=ServiceLogin"
                            target="_blank">Create email</a></p>
                </div>

                <div style="position: relative;">
                    <input class="register_in" type="password" id="registerEmail" autocomplete="on" name="password"
                        placeholder="Password*" required required oninput="validatePassword()">
                    <span id="passwordToggle" class="password-toggle" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye"></i> <!-- Assuming you're using Font Awesome for icons -->
                    </span>
                </div>
                <div id="validatepassword" class="error-message" style="display: none;"></div>

                <input class="register_in" type="password" name="confirm_password" autocomplete="password"
                    placeholder="Confirm Password*" required oninput="validateConfirmPassword()">
                <div id="passwordError" class="error-message"></div>


                <select id="userType" name="userType" required onchange="toggleDepartmentDropdown()">
                <option value="" disabled selected>Select User Type*</option>
                    <option value="Student">Applicant</option>
                    <option value="Personnel">Personnel</option>
                    <option value="Faculty">Faculty/Staff</option>
                    <option value="OSS">OSS</option>
                </select>
                <!-- Style for the "Select Department" dropdown -->

                <select name="description" id="description">
                    <option value="" disabled selected>Select Department:</option>
                    <?php
                    // Loop through the fetched data and group courses under their respective colleges
                    if ($result->num_rows > 0) {
                        $currentCollege = null;
                        while ($row = $result->fetch_assoc()) {
                            $college = $row['College'];
                            $course = $row['Courses'];

                            if ($college != $currentCollege) {
                                if ($currentCollege !== null) {
                                    echo "</optgroup>";
                                }
                                echo "<optgroup label=\"$college\">";
                                $currentCollege = $college;
                            }

                            echo "<option value=\"$course\">$course</option>";
                        }
                        echo "</optgroup>";
                    } else {
                        echo "<option value=\"\">No programs available</option>";
                    }
                    ?>
                </select>

                <button class="btnn" type="submit" onclick="validateForm()">Register</button>
                <p class="link">Already have an account<br>
                    <a href="loginpage.php" id="loginLink">Login</a> here
                </p>
            </form>

        </div>

        <?php
        // Check if the checkbox is clicked
        $showPopup = isset($_POST['agree_checkbox']) && $_POST['agree_checkbox'] === 'on';
        if (!$showPopup) {
            // Show the popup if the checkbox is not clicked
            echo '<div class="popup-container" id="popupContainer">
                <div class="popup">
                <h3>Privacy Notice</h3>
                <div class="border-pop">
                    
                    <p>Pursuant to the Data Privacy Act of 2012 and the BSU Data Policy from the Office of the University Registrar, concerned Personnel of BSU La Trinidad are committed to keep with utmost confidentiality, all sensitive personal information collected from applicants. Personal information are collected, accessed, used and or disclosed on a “need to know basis” and only as reasonably required. Confidential information either within or outside the University will not be communicated, except to persons authorized to receive such information. Authorized hardware, software, or other authorized equipment shall be used only in accessing, processing and transmitting such information. Read more on BSU Data Privacy Notice: <a href="http://www.bsu.edu.ph/dpa/bsu-data-privacy-notice-students" target="_blank">Click here to visit the BSU Data Privacy Notice for Students</a></p>
                    <p>I affirm that I have read and understood all the instructions. I promise to abide by the rules and regulations of the admission process of Benguet State University. I am aware that any information I have concealed, falsely given and/or withheld is enough basis for the invalidation/cancellation of my application. I have understood the Data Privacy Notice above and freely give my consent to the legitimate use of my personal data.</p>
                    </div>
                    <form method="post">
                        <input type="checkbox" name="agree_checkbox" id="agreeCheckbox" >
                        <label for="agreeCheckbox">By clicking this, you agree to share your personal information to Benguet State University - Office of the University Registrar.</label>
                        <button type="submit" id="agreeButton" class="agree">I agree</button>
                    </form>
                </div>
            </div>';
        }
        ?>

    </section>
    <script>
        function proceedRegistration() {
            if ($('#confirmCheckbox').is(':checked')) {
                // If user confirms, submit the registration form
                $('#RegForm').submit();
            } else {
                // If user hasn't confirmed, alert them to confirm
                alert('Please confirm that you want to proceed.');
            }
        }
    </script>
    <style>
        body {
            background-image: url('assets/images/banner.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
    </style>
    <footer>
    </footer>
    <script src="assets\js\reg.js"></script>
</body>

</html>