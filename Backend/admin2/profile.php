<?php
include("../config.php");

?>
       <!-- Add the profile popup container here -->
       <div class="profile-popup" id="profile-popup">
        <!-- Popup content -->
        <div class="popup-content" id="profile-content">
            <div class="profile-header">
                <img src="../assets_admin/images/human icon.png" alt="User Profile Picture" class="profile-picture" id="profile-picture">
                <p class="profile-name" id="applicant-name"><?php echo $name; ?></p>
            </div>


            <hr>
            <div class="profile-menu">
                <a href="#" id="settings" class="profile-item"> <i class='bx bx-sun'></i>Display</a>

                <div class="dropdown" id="settings-dropdown" style="display: none;">
                    <a href="#"> &nbsp; Dark Mode
                     &nbsp;  &nbsp; <input type="checkbox" id="switch-mode" hidden>
                    &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <label for="switch-mode" class="switch-mode"></label></a>

                </div>
          
                <a href="#" id="setting" class="profile-item" > <i class='bx bx-cog'></i> Settings</a>
          
                <div class="dropdown" id="setting-content" style="display: none;">
                <a href="EditInfo.php">&nbsp; &nbsp; Change Password</a>
             
            </div>

                <a href="#" id="help" class="profile-item"><i class='bx bx-question-mark'></i> Help and Support</a>
                <div class="dropdown" id="help-dropdown" style="display: none;">
                    <!-- Content for Help and Support dropdown -->
                    <!-- Trigger for the FAQ pop-up -->
                    <a href="" onclick="openPopup('faq-popup')">&nbsp;&nbsp;&nbsp;Manual </a>
                
                </div>
                <a href="#" id="logout" class="profile-item" onclick="confirmLogout()"><i class='bx bx-log-out'></i> Logout</a>
            </div>

        </div>
    </div>