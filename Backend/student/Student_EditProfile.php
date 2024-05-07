<?php
include("Student_Cover.php");

// Retrieve the admission data based on the user's email
$email = $studentData['email'];
$stmtAdmission = $conn->prepare("SELECT * FROM admission_data WHERE email = ?");
$stmtAdmission->bind_param("s", $email);
$stmtAdmission->execute();
$resultAdmission = $stmtAdmission->get_result();
$admissionData = $resultAdmission->fetch_assoc();

// Fetch data from the academicclassification table for the Classification column
$sqlClassification = "SELECT DISTINCT Classification FROM academicclassification";
$resultClassification = $conn->query($sqlClassification);

// Fetch data from the ethnicity table for the ethnicity_name column
$sqlEthnicity = "SELECT DISTINCT ethnicity_name FROM ethnicity";
$resultEthnicity = $conn->query($sqlEthnicity);


// Check if the admission data is set and if the appointment status is 'Complete'
if (isset($admissionData['appointment_status']) && $admissionData['appointment_status'] == 'Complete') {
  $readonly = "readonly"; // Set the readonly attribute
} else {
  $readonly = ""; // No readonly attribute
}

if (isset($_SESSION['success_message'])) {
    echo "<p class='success-message'>{$_SESSION['success_message']}</p>";
    unset($_SESSION['success_message']); // remove the message after displaying it
}

if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>{$_SESSION['error_message']}</p>";
    unset($_SESSION['error_message']); // remove the message after displaying it
}
?>



<section id="content">
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Profile</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Profiled</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="Student_Dashboard.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                   
        <div id="custom-alert_EditProf" class="custom-alert_EditProf hidden">
            <span id="alert-message_EditProf"></span>
        </div>

         <div id="table-container">
        <h1 style="text-align: center; font-size: 18px;">My Profile</h1>
        <form id="updateProfileForm" method="post" action="Student_update.php">
        <p class="personal_information">Personal Information</p>

        <div class="form-container1">
          <!-- Full name -->
          <div class="form-group">
            <label class="small-label" for="Name">Name</label>
            <input name="Name" class="input" id="Name" oninput="capitalizeInput('Name')" value="<?php echo isset($admissionData['Name']) ? $admissionData['Name'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="Middle_Name">Middle Name</label>
            <input name="Middle_Name" class="input" id="Middle_Name" oninput="capitalizeInput('Middle_Name')" value="<?php echo isset($admissionData['Middle_Name']) ? $admissionData['Middle_Name'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="Last_Name">Complete Name</label>
            <input name="Last_Name" class="input" id="Last_Name" oninput="capitalizeInput('Last_Name')" value="<?php echo isset($admissionData['Last_Name']) ? $admissionData['Last_Name'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
        </div>

        <div class="form-container2">
        <!-- Sex at Birth -->
        <div class="form-group">
        <label class="small-label" for="gender">Sex at birth</label><br>
          <?php
            // Assuming $admissionData is an array containing retrieved data from the database
              $selectedGender = isset($admissionData['gender']) ? $admissionData['gender'] : ''; ?>
              <select name="gender" class="input" id="gender" <?php echo $readonly; ?>>
                <option value="" disabled>Select Gender</option>
                <option value="male" <?php if ($selectedGender === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($selectedGender === 'female') echo 'selected'; ?>>Female</option>
              </select>
            </div>

        <!-- Age -->
        <div class="form-group">
            <label class="small-label" for="age">Age</label>
            <input name="age" class="input" id="age" maxlength="2" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); calculateAge();" value="<?php echo isset($admissionData['age']) ? $admissionData['age'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <!-- civil status -->
          <div class="form-group">
            <label class="small-label" for="civil_status">Civil Status</label><br>
                <?php
                  // Assuming $admissionData is an array containing retrieved data from the database
                  $civil_status = isset($admissionData['civil_status']) ? $admissionData['civil_status'] : '';
                ?>
                <select name="civil_status" class="input" id="civil_status" required>
                  <option value="" disabled>Select Civil Status</option>
                  <option value="single" <?php if ($civil_status === 'single') echo 'selected'; ?>>Not Married</option>
                  <option value="married" <?php if ($civil_status === 'married') echo 'selected'; ?>>Married</option>
                </select>
              </div>
          <!-- Citizenship -->
          <div class="form-group">
            <label class="small-label" for="citizenship">Citizenship</label>
            <input name="citizenship" class="input" id="citizenship" oninput="capitalizeInput2('citizenship')" value="<?php echo isset($admissionData['citizenship']) ? $admissionData['citizenship'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <!-- ethnicity-->
          <div class="form-group">
            <label class="small-label" for="ethnicity">Ethnicity</label><br>
              <?php
                // Assuming $admissionData is an array containing retrieved data from the database
                $ethnicity = isset($admissionData['ethnicity']) ? $admissionData['ethnicity'] : '';
              ?>
            <select name="ethnicity" class="input" id="ethnicity" maxlength="28" required onchange="handleEthnicityChange()">
                  <option value="" disabled>Select Ethnicity</option>
                  <?php
                  // Check if the query was successful
                    if ($resultEthnicity && $resultEthnicity->num_rows > 0) {
                      while ($rowEthnicity = $resultEthnicity->fetch_assoc()) {
                            $ethnicityName = $rowEthnicity['ethnicity_name'];
                            $selected = ($ethnicity === $ethnicityName) ? 'selected' : '';
                        echo "<option value=\"$ethnicityName\" $selected>$ethnicityName</option>";
                        }
                    } else {
                      echo "<option value=\"\">No Ethnicity found</option>";
                    }
                  ?>
                  <option value="others" <?php if ($ethnicity === 'others') echo 'selected'; ?>>Others</option>
            </select>
          </div>

        </div>

        <div class="form-container3">
          <!-- Birthplace -->
          <div class="form-group">
            <label class="small-label" for="birthplace">Birthplace</label>
            <input name="birthplace" class="input" id="birthplace" oninput="capitalizeInput('birthplace')" value="<?php echo isset($admissionData['birthplace']) ? $admissionData['birthplace'] : ''; ?>" <?php echo $readonly; ?> oninput="capitalizeInput('birthplace')">
          </div>
          <!-- Birthdate -->
          <div class="form-group">
            <label class="small-label" for="birthdate">Birthdate</label>
            <input type="date" name="birthdate" class="input" id="birthdate" oninput="validateBirthdate(); calculateAge();" value="<?php echo isset($admissionData['birthdate']) ? $admissionData['birthdate'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
        </div>

        <p class="personal_information">Permanent Home Address</p>

        <div class="form-container3">
          <div class="form-group">
            <label class="small-label" for="permanent_address">Address</label>
            <input name="permanent_address" class="input" id="permanent_address" oninput="capitalizeInput('permanent_address')" value="<?php echo isset($admissionData['permanent_address']) ? $admissionData['permanent_address'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <!-- zip-code -->
          <div class="form-group">
            <label class="small-label" for="zip_code">Zip Code</label>
            <input name="zip_code" class="input" id="zip_code" pattern="[0-9]*" id="zip_code" placeholder="Zip Code" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?php echo isset($admissionData['zip_code']) ? $admissionData['zip_code'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
        </div>

        <p class="personal_information">Contact Information</p>
        <div class="form-container4">
          <!-- Telephone/Mobile No -->
          <div class="form-group">
            <label class="small-label" for="phone_number">Telephone/Mobile No.</label>
            <input type="tel" name="phone_number" class="input" id="phone" value="<?php echo isset($admissionData['phone_number']) ? $admissionData['phone_number'] : ''; ?>" <?php echo $readonly; ?>>
          </div>

          <!-- Facebook Account Name -->
          <div class="form-group">
            <label class="small-label" for="facebook">Facebook Account Name</label>
            <input name="facebook" class="input" id="facebook" oninput="capitalizeInput('facebook')" value="<?php echo isset($admissionData['facebook']) ? $admissionData['facebook'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <!--Email Address -->
          <div class="form-group">
            <label class="small-label" for="email">Email Address</label>
            <input name="email" class="input" id="email" oninput="capitalizeInput('email')" value="<?php echo isset($admissionData['email']) ? $admissionData['email'] : ''; ?>" readonly>
          </div>
        </div>

        <p class="personal_information">Contact Person(s) in Case of Emergency</p>
        <div class="form-container7">
          <!-- Contact Person 1 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_1">Contact Person</label>
            <input name="contact_person_1" class="input" id="contact_person_1" oninput="capitalizeInput('contact_person_1')" value="<?php echo isset($admissionData['contact_person_1']) ? $admissionData['contact_person_1'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_1_mobile">Mobile Number</label>
            <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="<?php echo isset($admissionData['contact1_phone']) ? $admissionData['contact1_phone'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_1">Relationship with Contact Person</label><br>
              <?php
                  // Assuming $admissionData is an array containing retrieved data from the database
                  $relationship_1 = isset($admissionData['relationship_1']) ? $admissionData['relationship_1'] : '';
              ?>
            <select name="relationship_1" class="input custom-dropdown" id="relationship_1" required>
                <option value="" disabled>Select Relationship</option>
                <option value="Parent" <?php if ($relationship_1 === 'Parent') echo 'selected'; ?>>Parent</option>
                <option value="Guardian" <?php if ($relationship_1 === 'Guardian') echo 'selected'; ?>>Guardian</option>
            </select>
          </div>
        </div>
        <div class="form-container7">
          <!-- Contact Person 2 -->
          <div class="form-group">
            <label class="small-label" for="contact_person_2">Contact Person</label>
            <input name="contact_person_2" class="input" id="contact_person_2" oninput="capitalizeInput('contact_person_2')" value="<?php echo isset($admissionData['contact_person_2']) ? $admissionData['contact_person_2'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="contact_person_2_mobile">Mobile Number</label>
            <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="<?php echo isset($admissionData['contact_person_2_mobile']) ? $admissionData['contact_person_2_mobile'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="relationship_2">Relationship with Contact Person</label><br>
              <?php
                  // Assuming $admissionData is an array containing retrieved data from the database
                  $relationship_2 = isset($admissionData['relationship_2']) ? $admissionData['relationship_2'] : '';
              ?>
            <select name="relationship_2" class="input custom-dropdown" id="relationship_2" required>
                <option value="" disabled>Select Relationship</option>
                <option value="Parent" <?php if ($relationship_2 === 'Parent') echo 'selected'; ?>>Parent</option>
                <option value="Guardian" <?php if ($relationship_2 === 'Guardian') echo 'selected'; ?>>Guardian</option>
            </select>
          </div>
        </div>

        <p class="personal_information">Academic Classification</p>
        <div class="form-container6">
          <!-- Academic Classification -->
          <div class="form-group">
            <label class="small-label" for="academic_classification">Academic Classification</label>
              <?php
              // Assuming $admissionData is an array containing retrieved data from the database
              $academic_classification = isset($admissionData['academic_classification']) ? $admissionData['academic_classification'] : '';
              ?>
            <select name="academic_classification" class="inputs" id="academic_classification_board" onchange="BoardRequirements()">
              <option value="">Select Academic Classification</option>
            <?php
              // Check if the query was successful and classifications are available
              if ($resultClassification && $resultClassification->num_rows > 0) {
            while ($rowClassification = $resultClassification->fetch_assoc()) {
                $classification = $rowClassification['Classification'];
                $selected = ($academic_classification === $classification) ? 'selected' : '';
                echo "<option value=\"$classification\" $selected>$classification</option>";
            }
        } else {
            echo "<option value=\"\">No classifications found</option>";
        }
        ?>
    </select>
</div>


          <div class="form-group">
            <label class="small-label" for="degree_applied">Degree</label>
            <!-- Display the selected program in this input field -->
            <input name="degree_applied" class="input" id="degree_applied" value="<?php echo isset($admissionData['degree_applied']) ? $admissionData['degree_applied'] : ''; ?>" <?php echo $readonly; ?>>
            
          </div>
          <div class="form-group">
            <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
            <input name="nature_of_degree" class="input" id="nature_of_degree" value="<?php echo isset($admissionData['nature_of_degree']) ? $admissionData['nature_of_degree'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
        </div>
        <p class="personal_information">Academic Background </p>
        <div class="form-container5">
          <!-- Academic Background -->
          <div class="form-group">
            <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">High School/Senior High School</label>
            <input name="high_school_name_address" class="input" id="high_school_name_address" oninput="capitalizeInput('high_school_name_address')" value="<?php echo isset($admissionData['high_school_name_address']) ? $admissionData['high_school_name_address'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group">
            <label class="small-label" for="lrn" style="white-space: nowrap;">Learner's Reference Number</label>
            <input name="lrn" class="input" id="lrn" oninput="validateLRN(this)" value="<?php echo isset($admissionData['lrn']) ? $admissionData['lrn'] : ''; ?>" <?php echo $readonly; ?>>
          </div>
        </div>
        <input type="submit" value="Update Profile" onclick="return confirmUpdateProfile();">
    </form>
<!-- Add the overlay and modal for the confirmation dialog -->
<div class="overlay" id="confirmationOverlayProfile"style="display: none;">
    <div class="confirmation-modal">
        <p>Are you sure you want to update your profile?</p>
        <button id="confirmYes">Confirm</button>
        <button id="confirmNo">Cancel</button>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<script>
function confirmUpdateProfile() {
    // Show the overlay with the confirmation dialog
    $("#confirmationOverlayProfile").fadeIn();

    // Handle 'Yes' button click
    $("#confirmYes").click(function () {
        // Close the overlay
        $("#confirmationOverlayProfile").fadeOut();

        // Proceed with form submission
        $("#updateProfileForm").submit();
    });

    // Handle 'No' button click
    $("#confirmNo").click(function () {
        // Close the overlay without submitting the form
        $("#confirmationOverlayProfile").fadeOut();
        return false; // Cancel form submission
    });

    // Prevent the default form submission
    return false;
}


    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.querySelector('.success-message');
        if (successMessage) {
            successMessage.style.display = 'block';
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 4000);
        }
    });

    //Auto-capitalize each word ad Some Validations for mix word/number inputs
function capitalizeInput(inputId) {
  let input = document.getElementById(inputId);
  let inputValue = input.value;

  // Regular expression to match only letters, numbers, dashes, and spaces
  let validInput = /^[a-zA-Z0-9][a-zA-Z0-9 -]*$/;

  if (validInput.test(inputValue)) {
    let words = inputValue.split(' ');
    for (let i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    input.value = words.join(' ');
  } else {
    // Invalid input, do something (e.g., display error message)
    showAlert_EditProf("Input is invalid. It cannot start with a dash or space and can only contain letters, numbers, dashes, and spaces.");
    // You might also clear the input or handle it differently based on your requirements
    input.value = '';
  }
}

//Auto-capitalize each word and some validations for mixed word inputs
function capitalizeInput2(inputId) {
  let input = document.getElementById(inputId);
  let inputValue = input.value;

  // Regular expression to match only letters, dashes, and spaces
  let validInput = /^[a-zA-Z][a-zA-Z -]*$/;

  if (validInput.test(inputValue)) {
    let words = inputValue.split(' ');
    for (let i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    input.value = words.join(' ');
  } else {
    // Invalid input, do something (e.g., display error message)
    showAlert_EditProf("Input is invalid. It cannot start with a dash or space and can only contain letters, dashes, and spaces.");
    // You might also clear the input or handle it differently based on your requirements
    input.value = '';
  }
}

function showAlert_EditProf(message) {
      var alertElement = document.getElementById("custom-alert_EditProf");
      alertElement.classList.add("show");
      alertElement.classList.remove("hidden");
      document.getElementById("alert-message_EditProf").innerText = message;
    
      setTimeout(function() {
        alertElement.classList.remove("show");
        alertElement.classList.add("hidden");
      }, 3000);
    }

    function handleEthnicityChange() {
    var selectBox = document.getElementById("ethnicity");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (selectedValue.toLowerCase() === "others") {
        var textBox = document.createElement("input");
        textBox.type = "text";
        textBox.className = "input";
        textBox.id = "ethnicityInput"; // Change the id to avoid conflicts
        textBox.name = "ethnicity";
        textBox.required = true;
        textBox.placeholder = "Enter Ethnicity";
        textBox.addEventListener("input", function(event) {
            var value = event.target.value;
            // Capitalize first letter of each word
            event.target.value = value.replace(/\b\w/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        });
        textBox.addEventListener("keypress", function(event) {
            var key = event.keyCode;
            // Allow only letters, spaces, and dashes
            if (!((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key === 32 || key === 45)) {
                event.preventDefault();
            }
        });
        selectBox.parentNode.replaceChild(textBox, selectBox);

        // Add a blur event listener to check if the input is left empty
        textBox.addEventListener("blur", function() {
            if (textBox.value.trim() === "") {
                var selectBox = document.createElement("select");
                selectBox.name = "ethnicity";
                selectBox.className = "input";
                selectBox.id = "ethnicity";
                selectBox.required = true;
                selectBox.onchange = handleEthnicityChange;

                // Add initial options back to the dropdown
                for (var i = 0; i < initialOptions.length; i++) {
                    selectBox.innerHTML += initialOptions[i];
                }

                textBox.parentNode.replaceChild(selectBox, textBox);
            }
        });
    }
}

function validateLRN(input) {
  // Remove non-numeric characters
  let inputValue = input.value.replace(/\D/g, '');

  // Limit the input to 12 digits
  inputValue = inputValue.slice(0, 12);

  // Update the input value
  input.value = inputValue;

  // Validate input length and update border and error message
  const lrnInput = document.getElementById("lrn");
  const lrnNote = document.getElementById("lrn_note");
  if (inputValue.length < 12) {
      lrnInput.style.borderColor = "red";
      lrnNote.textContent = "Invalid input (must be 12 digits)";
      lrnNote.classList.add("error"); // Add the error class
  } else {
      lrnInput.style.borderColor = "initial";
      lrnNote.textContent = "";
      lrnNote.classList.remove("error"); // Remove the error class (optional)
  }
}

function calculateAge() {
  var birthdateInput = document.getElementById("birthdate");
  var ageInput = document.getElementById("age");

  if (birthdateInput.value) {
    var birthdate = new Date(birthdateInput.value);
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();

    // Check if birthday has occurred this year
    if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
      age--;
    }

    ageInput.value = age;
   
}
}

function validateBirthdate() {
  var birthdateInput = document.getElementById('birthdate').value;
  var birthdate = new Date(birthdateInput);
  var currentDate = new Date();
  var minBirthdate = new Date();
  minBirthdate.setFullYear(currentDate.getFullYear() - 15); // Subtract 10 years from the current date

  if (birthdate > minBirthdate) {
      // If the birthdate entered is less than 10 years from the current date
      showAlert_SF("You must be at least 15 years old to register.");
      document.getElementById('birthdate').value = ''; // Clear the input field
  }
}

</script>

<style>
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
    background-color:white;
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

.success-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #4CAF50;
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 1000;
        display: none;
    }
.head-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;

}

#student-profile {
    /* background-color: #fff; */
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
    padding: 5px;
    margin-bottom: 5px;
    box-sizing: border-box;
    font-size: 12px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    margin-top: 10px;
    padding: 5px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
   
}

/* Styles for Custom Alert */
.custom-alert_EditProf {
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

p.personal_information {
    margin-top: 5px;
    margin-bottom: 5px;
    font-size: 12px;
    font-weight: bold;
    font-style: italic;
}
.form-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2%;
  }
  .form-container1 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2%;
  }
  .form-container2 {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 2%;
  }
  .form-container3 {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 2%;
  }
  .form-container4 {
    display: grid;
    grid-template-columns: repeat(3, 25% 35.5% 35.5%); 
    gap: 2%; 
  }
  .form-container5 {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2%;
  }
  .form-container6 {
    display: grid;
    grid-template-columns: 26% 56% 14%;  
    gap: 2%;
  }
  .form-container7 {
    display: grid;
    grid-template-columns: repeat(3, 53% 19% 24%); 
    gap: 2%; 
  }
  .form-group {
  display: inline-block;
  margin-right: 15px;
  }
  
  /* Optional: Adjust the width of the label and input if needed */
  .small-label {
  /* width: 150px; Adjust the width as needed */
  font-size: 12px; /* Adjust this value as needed */
  margin-bottom: 5px;
  color: gray;
  }

  .table-data {
    max-height: 75vh; /* Set a maximum height for the profile form container */
    overflow-y: auto; /* Enable vertical scrolling */
}

/* #dashboard-content {
    position: fixed;
    overflow-y: auto;
} */

.input {
  width: 100%;
  padding: 10px;
  margin-top: 2px;
  border: 1px solid #ccc;
  border-radius: 3px;
  }
  .inputs {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    height: 37px;
    }

</style>
