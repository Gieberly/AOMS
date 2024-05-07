<?php
include("../config.php"); 

session_start();



// Check if the user is a student member, otherwise redirect them
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Personnel') {
    header("Location: ../loginpage.php");
    exit();
}

// Check if 'clear' parameter is set and clear stored filter and search if true
if (isset($_GET['clear']) && $_GET['clear'] === 'true') {
    unset($_SESSION['search']);
    unset($_SESSION['filter']);
}

$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, mname, last_name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $mname, $last_name, $email, $userType, $status);
$stmt->fetch();
$stmt->close();
$full_name = $name . ' ' . $mname . ' ' . $last_name;


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <link rel="icon" href="../assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/Personnel.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    
    <div class="overlay1"></div>
    <div class="box">
        <div class="close">&times;</div>
        <div class="registration-box">
          <p>Personnel User Manual</p>
          <!-- Add images here -->
          <img src="../assets/images/personnel/1.png" alt="User's Manual">
          <img src="../assets/images/personnel/2.png" alt="User's Manual">
          <img src="../assets/images/personnel/3.png" alt="User's Manual">
          <img src="../assets/images/personnel/4.png" alt="User's Manual">
          <img src="../assets/images/personnel/5.png" alt="User's Manual">
          <img src="../assets/images/personnel/6.png" alt="User's Manual">
          <img src="../assets/images/personnel/7.png" alt="User's Manual">
          <img src="../assets/images/personnel/8.png" alt="User's Manual">
          <!-- Add more images if needed -->
            </div>
    </div>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a class="brand">
            <img class="bsulogo" src="../assets/images/BSU Logo1.png" alt="BSU LOGO">
            <span class="text">Personnel</span>
        </a>

        <ul class="side-menu top">
        <li class="">
    <a href="Personnel_dashboard.php" id="dashboard-link" onclick="clearSearchFilter()">
        <i class='bx bxs-dashboard'></i>
        <span class="text">Dashboard</span>
    </a>
</li>

<li>
    <a href="Personnel_Applicants.php" onclick="clearSearchFilter()">
        <i class='bx bxs-user-detail'></i>
        <span class="text">Applicants</span>
    </a>
</li>

<li class="">
    <a href="Personnel_Masterlist.php" id="master-list-link" onclick="clearSearchFilter()">
        <i class='bx bxs-user-pin'></i>
        <span class="text">Master List</span>
    </a>
</li>


           
        </ul>
    </section>
    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Personnel_Verification.php') {
            ?>
                <form action="Personnel_Verification.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Personnel_Masterlist.php') {
            ?>
                <form action="Personnel_Masterlist.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'PersonnelsReceiving.php') {
            ?>
                <form action="PersonnelsReceiving.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="bx bx-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page === 'Personnel_Applicants.php') {
            ?>
                <form action="Personnel_Applicants.php" method="GET">
                    <div class="form-input">
                        <input type="search" name="search" placeholder="Search...">
                        <button type="submit" class="search-btn"><i id="searchIcon" class="fas fa-search" onclick="changeIcon()"></i></button>
                    </div>
                </form>
            <?php
            }
            ?>
            <form id="search-form">
                <div class="form-input" style="display: none;">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div id="clock">8:10:45</div>

            <a href="#" class="profile" id="profile-button">
                <img src="../assets/images/human icon.png" alt="User Profile">
            </a>
        </nav>
    </section>

    <!-- Add the profile popup container here -->
    <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="../assets/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name">
                <?php echo $full_name; ?>
                </p>
            </div>


            <hr>
            <div class="profile-menu">
                <a href="#" id="" class="profile-item1"> <i class='bx bx-sun'></i>User Manual</a>

                <div class="" id="settings-dropdown" style="display: none;">
                    <a href="#">User Manual
                        <input type="checkbox" id="switch-mode" hidden>
                        <label for="switch-mode" class="switch-mode"></label></a>

                </div>

                <a href="#" id="setting" class="profile-item"> <i class='bx bx-cog'></i> Settings</a>

                <div class="dropdown" id="setting-content" style="display: none;">
                    <a href="EditInfo.php">&nbsp; &nbsp; Change Password</a>

                </div>

                <a href="#" id="logout" class="profile-item" onclick="return confirmLogout();"><i class='bx bx-log-out'></i> Logout</a>
                <div class="overlay" id="confirmationOverlayLogout" style="display: none;">
                    <div class="confirmation-modal">
                        <p>Are you sure you want to log out?</p>
                        <button id="confirmYesLogout">Confirm</button>
                        <button id="confirmNoLogout">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="logout-confirmation-message" id="logoutConfirmationMessage">
                Account logging out...
            </div>
        </div>
    </div>

    <script>
    
    function clearSearchFilter() {
    // Clear the session variables for search and filter
    <?php unset($_SESSION['search']); ?>
    <?php unset($_SESSION['filter']); ?>
}

document.addEventListener("DOMContentLoaded", function() {
    const profileItem = document.querySelector(".profile-item1");
    const overlay1 = document.querySelector(".overlay1");
    const box = document.querySelector(".box");
    const closeButton = document.querySelector(".close");

    // Function to show the box and overlay
    function showBox() {
        box.style.display = "block";
        overlay1.style.display = "block";
    }

    // Function to hide the box and overlay
    function hideBox() {
        box.style.display = "none";
        overlay1.style.display = "none";
    }

    // Event listener for clicking the profile item
    profileItem.addEventListener("click", function() {
        showBox();
    });

    // Event listener for clicking the close button
    closeButton.addEventListener("click", function() {
        hideBox();
    });

}); //



        function confirmLogout() {
            // Show the overlay with the confirmation dialog
            $("#confirmationOverlayLogout").fadeIn();

            // Handle 'Yes' button click
            $("#confirmYesLogout").click(function() {
                // Close the overlay
                $("#confirmationOverlayLogout").fadeOut();

                // Display the logout confirmation message
                $("#logoutConfirmationMessage").fadeIn();

                // Hide the message after 2 seconds
                setTimeout(function() {
                    $("#logoutConfirmationMessage").fadeOut();
                    // Redirect to the logout page after hiding the message
                    window.location.href = "../logout.php";
                }, 2000);

                // Prevent further clicks on 'Yes' button
                $(this).prop('disabled', true);
            });

            // Handle 'No' button click
            $("#confirmNoLogout").click(function() {
                // Close the overlay without logging out
                $("#confirmationOverlayLogout").fadeOut();
                return false; // Cancel link click
            });

            // Prevent the default link click
            return false;
        }
    </script>

    <style>
    
     /*User Manual*/

.box{
    position: fixed;
    width: 60%; 
    top: 50%;
    left: 50%;
    text-align: center;
    padding: 10px;
    background-color: #E6F7F0;
    display: none; 
    transform: translate(-50%, -50%);
    z-index: 1000;
    overflow: auto;
    height: 80%;
    margin-top: 2%;
}

.overlay1 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 999;
    display: none;
}
.close{
    display: block;
    position: sticky;
    width: 40px;
    height: 40px;
    top: 0;
    right: 0;
    color: tomato;
    font-size: 34px;
    z-index: 1001;
}
.close:hover{
    background-color: red;
    color: #fcfcfc;
    cursor: pointer;
}
.registration-box{
    margin-top: 50px;
    margin-bottom: 50px;
    overflow-y: auto;
}

.registration-box img {
    width: 90%;
    margin-bottom: 10px;
}

.registration-box p {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}


        /* Styles for the logout confirmation message */
        .logout-confirmation-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: green;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            z-index: 1000;
        }

        #confirmationOverlayLogout {
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
            max-width: 400px;
            /* Adjust the maximum width as needed */
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
        #confirmYesLogout {
            background-color: #28a745;
            /* Green color */
            color: white;
        }

        /* Style the 'No' button in red */
        #confirmNoLogout {
            background-color: #dc3545;
            /* Red color */
            color: white;
        }
    </style>
    <script src="../assets/js/personnels.js"></script>

</body>
<!-- #region -->

</html>