<?php

include("Student_Cover.php");

$studentId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$studentData = $result->fetch_assoc();

$stmt->close();

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating user password
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Check if the entered old password matches the stored hashed password
    if (password_verify($oldPassword, $studentData['password'])) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Perform the update query
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $studentId);

        if ($updateStmt->execute()) {
            // Update successful
            $message = "Password updated successfully!";

            // Insert into activity log
            $action = "Password Updated";
            $description = " Student $studentName ($studentEmail) updated their password.";
            $createdAt = date('Y-m-d H:i:s'); // Current time in PST
            $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

            $logStmt = $conn->prepare("INSERT INTO activity_log (user_id, email, userType, action, description, created_at, ip_address) VALUES (?, ?, 'Student', ?, ?, ?, ?)");
            $logStmt->bind_param("isssss", $studentId, $_SESSION['user_email'], $action, $description, $createdAt, $ip_address);

            if (!$logStmt->execute()) {
                error_log("Error logging activity: " . $logStmt->error);
            }

            $logStmt->close();
        } else {
            // Update failed
            $message = "Error updating password: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        // Old password does not match
        $message = "Old password is incorrect. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="icon" href="assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/student.css" />
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="assets\js\jspdf.min.js"></script>
    <!-- Include the pdf.js library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<section id="content">
    <main>
        <!--Student Profile-->
        <div id="student-profile-content">
            <div class="head-title">
                <div class="left">
                    <h1>Password</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Password</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="Student_Dashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="custom-alert_ChangePass" class="custom-alert_ChangePass hidden">
                <span id="alert-message_ChangePass"></span>
            </div>

            <!--profile-->
            <div id="student-profile">
                <div class="table-data">
                    <div class="order">
                        <h1 style="text-align: center;">CHANGE PASSWORD</h1>
                        <form id="updatePasswordForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <label for="old_password">Old Password:</label>
                            <input type="password" id="old_password" name="old_password" required>
                            <br>
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required>
                            <br>
                            <!-- Add other fields for additional information editing -->
                            <input type="submit" id="updatePasswordBtn" value="Update Password" onclick="return confirmUpdate();">

                        </form>
                        <!-- Add the overlay and modal for the confirmation dialog -->
<div class="overlay" id="confirmationOverlay" style="display: none;">
    <div class="confirmation-modal">
        <p>Are you sure you want to update your password?</p>
        <button id="confirmYes">Confirm</button>
        <button id="confirmNo">Cancel</button>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<style>
    /* Add styles for the confirmation dialog overlay */
/* Add styles for the confirmation dialog overlay */
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Add styles for the confirmation dialog modal */
.confirmation-modal {
    background-color: white;
    color: black;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    max-width: 400px; /* Adjust the maximum width as needed */
}

.confirmation-modal p {
    margin-bottom: 15px;
}

.confirmation-modal button {
    padding: 10px 15px;
    margin: 0 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the 'Yes' button in green */
#confirmYes {
    background-color: #28a745; /* Green color */
    color: white;
}

/* Style the 'No' button in red */
#confirmNo {
    background-color: #dc3545; /* Red color */
    color: white;
}


    .head-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    #student-profile {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }


    /* Custom style for popup message */
    .popup-message {
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: green;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        display: none;
    }
    
      /* Styles for Custom Alert */
  .custom-alert_ChangePass {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f44336;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    transition: opacity 0.5s;
    z-index: 1000;
  }
  
  .hidden {
    opacity: 0;
    visibility: hidden;
  }
  
  .show {
    opacity: 1;
    visibility: visible;
  }
  
  /* End of Custom alert Styles */
</style>

<script>
function confirmUpdate() {
        // Validate the new password
        var newPassword = document.getElementById("new_password").value;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        
        if (!passwordRegex.test(newPassword)) {
            // Password does not meet the criteria, display error message
            showAlert_ChangePass("New password must be at least 8 characters long and contain an uppercase letter, alowercase letter, a number, and a special character.");
            return false; // Prevent form submission
        }

        // Show the overlay with the confirmation dialog
        $("#confirmationOverlay").fadeIn();

        // Handle 'Yes' button click
        $("#confirmYes").click(function () {
            // Close the overlay
            $("#confirmationOverlay").fadeOut();

            // Proceed with form submission
            $("#updatePasswordForm").submit();
        });

        // Handle 'No' button click
        $("#confirmNo").click(function () {
            // Close the overlay without submitting the form
            $("#confirmationOverlay").fadeOut();
            return false; // Cancel form submission
        });

        // Prevent the default form submission
        return false;
    }

    function showAlert_ChangePass(message) {
        var alertElement = document.getElementById("custom-alert_ChangePass");
            alertElement.classList.add("show");
            alertElement.classList.remove("hidden");
        document.getElementById("alert-message_ChangePass").innerText = message;

    setTimeout(function() {
        alertElement.classList.remove("show");
        alertElement.classList.add("hidden");
        }, 5000);
    }

$(document).ready(function () {
        // Check if message is not empty
        var message = "<?php echo $message; ?>";
        if (message !== "") {
            // Create and display the popup message
            var popupMessage = $("<div class='popup-message'></div>").text(message);
            // Check if the message contains certain strings and apply red color
            if (message.includes("Error updating password") || message.includes("Old password is incorrect")) {
                popupMessage.css("background-color", "red");
            }
            $("body").append(popupMessage);
            popupMessage.fadeIn();
            // Hide the popup message after 2 seconds
            setTimeout(function () {
                popupMessage.fadeOut(function () {
                    $(this).remove(); // Remove the popup message from the DOM
                });
            }, 2000);
        }
    });


</script>

</body>
</html>
