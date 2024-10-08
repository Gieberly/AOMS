<?php
include("config.php");
include("Personnel_Cover.php");


// Fetch courses from the programs table
$courses_query = "SELECT DISTINCT Courses FROM programs";
$courses_result = $conn->query($courses_query);

$courses = array();
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row['Courses'];
}

$colleges_query = "SELECT DISTINCT College FROM programs";
$colleges_result = $conn->query($colleges_query);

$colleges = array();
while ($row = $colleges_result->fetch_assoc()) {
    $colleges[] = $row['College'];
}

// Fetch classifications from the academicclassification table
$classifications_query = "SELECT Classification FROM academicclassification";
$classifications_result = $conn->query($classifications_query);

$classifications = array();
while ($row = $classifications_result->fetch_assoc()) {
    $classifications[] = $row['Classification'];
}

// Retrieve admission data from the database with date filter
$filterDate = isset($_GET['appointment_date']) ? $_GET['appointment_date'] : '';

if (isset($_GET['search'])) {
    $search = $_GET["search"];
    $query = "SELECT * FROM admission_data WHERE 
                ( 
                `Name` LIKE '$search' OR 
                `Middle_Name` LIKE '$search' OR 
                `Last_Name` LIKE '$search' OR 
                `applicant_number` LIKE '$search' OR 
                `academic_classification` LIKE '$search' OR 
                `email` LIKE '$search' OR 
                `Admission_Result` LIKE '$search' OR 
                `nature_of_degree` LIKE '$search' OR 
                `appointment_status` LIKE '$search' OR 
                `degree_applied` LIKE '$search'
                )
                AND (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
                AND `appointment_date` IS NOT NULL
                ORDER BY `appointment_date` ASC, `appointment_time` ASC";
} else {
    $query = "SELECT * FROM admission_data WHERE 
                (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
                AND `appointment_date` IS NOT NULL
                ORDER BY `appointment_date` ASC, `appointment_time` ASC";
}

$result = $conn->query($query);

// Fetch user information from the database based on user ID
$userID = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email, userType, status FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($name, $email, $userType, $status);
$stmt->fetch();

// Close statement
$stmt->close();
?>




<head>
  <meta charset="UTF-8">

  <title>BSU OUR Admission Unit Personnel</title>

</head>

<body>
  <section id="content">
    <?php

    // Check if the success message session variable is set
    if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
      // Display success message with animation
      echo '<div class="success-message" id="successMessage">Data successfully updated!</div>';

      // Unset the session variable to avoid displaying the message again on page refresh
      unset($_SESSION['update_success']);
    }
    ?>

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Document Checking</h1>
          <ul class="breadcrumb">
            <li><a href="#">Document Checking</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
            <li><a class="active" href="Personnel_dashboard.php">Home</a></li>
            </li>
          </ul>
        </div>
        <div class="button-container">

          <a href="excel_export_appointments.php" class="btn-download">
            <i class='bx bxs-file-export'></i>
            <span class="text">Excel Export</span>
          </a>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>List of Students</h3>
            <!-- Add this input field for date filtering -->
            <div class="headfornaturetosort">
              <form method="GET" action="" id="calendarFilterForm">
                <label for="appointment_date"></label>
                <input type="date" name="appointment_date" id="appointment_date">
                <button type="submit"><i class='bx bx-filter'></i></button>
              </form>
            </div>
          </div>


          <table id="studentTable">
            <thead>
              <tr>
                  <th>#</th>
                <th>Applicant #</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Appointment Date</th>
                <th>Application Time</th>
                <th>Status</th>
                <th>Action</th>
                <th style="display: none;" id="selectColumn">
                  <input type="checkbox" id="selectAllCheckbox">
                </th>
              </tr>
            </thead>
            <tbody style="overflow-y: auto;">
                          <?php
              $counter = 1; // Initialize the counter before the loop

              while ($row = $result->fetch_assoc()) {
                echo "<tr class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row['applicant_number'] . "</td>";
                echo "<td>" . $row['Last_Name'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Middle_Name'] . "</td>";
                $appointmentDate = $row['appointment_date'];
                echo "<td>" . ($appointmentDate ? date('F d, Y', strtotime($appointmentDate)) : '') . "</td>";
                $appointmentTime = $row['appointment_time'];
                echo "<td>" . ($appointmentTime ? date('g:i A', strtotime($appointmentTime)) : '') . "</td>";
                echo "<td  data-field='appointment_status'>{$row['appointment_status']}</td>";
                echo "<td>
                <div class='button-container'>
                <button type='button' class='button inc-btn' data-tooltip='Incomplete' onclick='updateStatus({$row['id']}, \"Incomplete\")'><i class='bx bxs-no-entry'></i></button>
                <button type='button' class='button check-btn' data-tooltip='Complete' onclick='updateStatus({$row['id']}, \"Complete\")'><i class='bx bxs-check-circle'></i></button>
                </div>
                </td>";
                echo "<td  id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
                echo "</tr>";
                $counter++; // Increment the counter for the next row
              }
              ?>
            </tbody>
          </table>

        </div>

        <div class="todo" style="display: none;">
          <i class="bx bx-x close-form" style="float: right;font-size: 24px;"></i>

          <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
          <label class="tab-label" for="tab1">Student Data</label>

      
          <div class="tab-content" id="content1">

            <form id="updateProfileForm" class="tab1-content" method="post" action="Personnel_DataUpdate.php">
              <p class="personal_information">Personal Information </p>

              <div class="form-container1">

                <div class="form-group">
                  <!-- Last_ Name -->
                  <label class="small-label" for="Last_Name">Last Name</label>
                  <input name="Last_Name" class="input" id="Last_Name" value="<?php echo $admissionData['Last_Name']; ?>">
                  <br>
                  <!--Email Address -->
                  <label class="small-label" for="email">Email Address</label>
                  <input name="email" class="input" autocomplete="off" id="email" value="<?php echo $admissionData['email']; ?>" readonly>
                </div>
                <div class="form-group">
                  <!-- First Name -->
                  <label class="small-label" for="Name">First Name</label>
                  <input name="Name" class="input" id="Name" value="<?php echo $admissionData['Name']; ?>">

                  <br>

                  <!-- Sex at Birth -->
                  <label class="small-label" for="gender">Sex at birth</label>
                  <select name="gender" class="input" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <!-- First Name -->
                  <label class="small-label" for="Middle_Name">Middle Name</label>
                  <input name="Middle_Name" class="input" id="Middle_Name" value="<?php echo $admissionData['Middle_Name']; ?>">
                  <br>
                  <!-- Telephone/Mobile No -->
                  <label class="small-label" for="phone_number">Mobile No.</label>
                  <input name="phone_number" autocomplete="off" class="input" id="phone_number" value="<?php echo $admissionData['phone_number']; ?>">


                </div>
                <!-- ID -->
                <img id="applicantPicture" alt="Applicant Picture">
                <div class="form-group">


                </div>

              </div>
              <br>
              <p class="personal_information">Contact Person(s) in Case of Emergency</p>
              <div class="form-container2">
                <!-- Contact Person 1 -->
                <div class="form-group">
                  <label class="small-label" for="contact_person_1">Contact Person</label>
                  <input name="contact_person_1" class="input" id="contact_person_1" value="<?php echo $admissionData['contact_person_1']; ?>">
                </div>
                <div class="form-group">
                  <label class="small-label" for="contact_person_1_mobile">Mobile No.</label>
                  <input name="contact_person_1_mobile" class="input" id="contact_person_1_mobile" value="<?php echo $admissionData['contact1_phone']; ?>">
                </div>
                <div class="form-group">
                  <!-- Relationship -->
                  <label class="small-label" for="relationship_1">Relationship</label>
                  <select name="relationship_1" class="input" id="relationship_1">
                    <option value="Parent">Parent</option>
                    <option value="Guardian">Guardian</option>
                  </select>
                </div>
              </div>

              <div class="form-container2">
                <!-- Contact Person 2 -->
                <div class="form-group">
                  <label class="small-label" for="contact_person_2">Contact Person</label>
                  <input name="contact_person_2" class="input" id="contact_person_2" value="<?php echo $admissionData['contact_person_2']; ?>">
                </div>
                <div class="form-group">
                  <label class="small-label" for="contact_person_2_mobile">Mobile No.</label>
                  <input name="contact_person_2_mobile" class="input" id="contact_person_2_mobile" value="<?php echo $admissionData['contact_person_2_mobile']; ?>">
                </div>
                <div class="form-group">
                  <!-- Relationship -->
                  <label class="small-label" for="relationship_2">Relationship</label>
                  <select name="relationship_2" class="input" id="relationship_2">
                    <option value="Parent">Parent</option>
                    <option value="Guardian">Guardian</option>
                  </select>
                </div>

              </div>

              <br>
              <p class="personal_information">Academic Classification</p>

              <div class="form-container3">

                <div class="form-group">
                  <!-- College -->
                  <label class="small-label" for="college">College</label>
                  <select name="college" class="input" id="college">
                    <?php foreach ($colleges as $college) { ?>
                      <option value="<?php echo $college; ?>"><?php echo $college; ?></option>
                    <?php } ?>
                  </select>
                  <br>
                  <!-- Degree -->
                  <label class="small-label" for="degree_applied">Degree</label>
                  <select name="degree_applied" class="input" id="degree_applied">
                    <?php
                    // Fetch distinct colleges from programs table
                    $distinct_colleges_query = "SELECT DISTINCT College FROM programs";
                    $distinct_colleges_result = $conn->query($distinct_colleges_query);

                    while ($college_row = $distinct_colleges_result->fetch_assoc()) {
                      $college_name = $college_row['College'];
                    ?>
                      <optgroup label="<?php echo $college_name; ?>">
                        <?php
                        // Fetch courses associated with this college
                        $courses_for_college_query = "SELECT Courses FROM programs WHERE College = ?";
                        $stmt = $conn->prepare($courses_for_college_query);
                        $stmt->bind_param("s", $college_name);
                        $stmt->execute();
                        $courses_for_college_result = $stmt->get_result();
                        $stmt->close();

                        // Display courses
                        while ($course_row = $courses_for_college_result->fetch_assoc()) {
                          $course_name = $course_row['Courses'];
                        ?>
                          <option value="<?php echo $course_name; ?>"><?php echo $course_name; ?></option>
                        <?php
                        }
                        ?>
                      </optgroup>
                    <?php
                    }
                    ?>
                  </select>


                </div>

                <div class="form-group">
                  <!-- Academic Classification -->
                  <label class="small-label" for="academic_classification">Classification</label>
                  <select name="academic_classification" class="input" id="academic_classification">
                    <?php foreach ($classifications as $classification) { ?>
                      <option value="<?php echo $classification; ?>"><?php echo $classification; ?></option>
                    <?php } ?>
                  </select>
                  <br>
                  <!-- Nature -->
                  <label class="small-label" for="nature_of_degree" style="white-space: nowrap;">Nature of degree</label>
                  <select name="nature_of_degree" class="input" id="nature_of_degree">
                    <option value="Board">Board</option>
                    <option value="Non-Board">Non-Board</option>
                  </select>
                </div>
              </div>

              <br>
              <p class="personal_information">Academic Background </p>
              <div class="form-container3">
                <!-- Academic Background -->
                <div class="form-group">
                  <label class="small-label" for="high_school_name_address" style="white-space: nowrap;">LAST SCHOOL ATTENDED</label>
                  <input name="high_school_name_address" class="input" id="high_school_name_address" value="<?php echo $admissionData['high_school_name_address']; ?>">
                </div>
                <div class="form-group">
                  <label class="small-label" for="lrn" style="white-space: nowrap;">LRN</label>
                  <input name="lrn" class="input" id="lrn" value="<?php echo $admissionData['lrn']; ?>">
                </div>
              </div>

              <br>
              <input type="hidden" name="id" value="<?php echo $admissionData['id']; ?>">
              <input type="submit" name="submit">
            </form>

          </div>




        </div>
      </div>



      </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>

  <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">


    </div>
    <div class="toast-body" id="toast-body"></div>
  </div>

  <style>
    #sendButton {
      background-color: transparent;
      border: none;
      cursor: pointer;
      padding: 0;
    }

    #sendButton i {
      font-size: 14px;
      color: black;
    }

    #sendButton:hover i {
      color: green;
      transform: scale(1.2);
    }

    .field-group {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .field-group>* {
      flex-basis: calc(25% - 10px);
      /* Adjust the width as needed */
      margin-bottom: 10px;
      /* Adjust the vertical spacing as needed */
    }

    .success-message {
      position: fixed;
      top: 10%;
      right: 10%;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 4px;
      animation: slideInRight 0.5s ease-in-out;
      display: none;
    }


    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }

      to {
        transform: translateY(0);
      }
    }

    .button-container {
      display: flex;
      justify-content: center;
      /* Align buttons horizontally */

    }

    @media screen and (max-width: 600px) {
      .button-container {
        flex-direction: column;
        /* Stack buttons vertically on smaller screens */
        align-items: center;
      }
    }

    .button.ekis-btn {
      position: relative;
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
    }


    .button.ekis-btn i {
      font-size: 13px;
      pointer-events: auto;
      color: black;

    }

    .button.ekis-btn:hover i {
      color: red;
    }

    .button.ekis-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
    }



    .button.inc-btn {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      position: relative;
    }

    .button.inc-btn i {
      font-size: 13px;
      pointer-events: auto;
      color: black;

    }

    .button.inc-btn:hover i {
      color: orange;
    }

    .button.inc-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
    }


    .button.check-btn {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      position: relative;
    }

    .button.check-btn i {
      font-size: 13px;
      pointer-events: auto;
      color: black;
    }

    .button.check-btn:hover i {
      color: green;

    }

    .button.check-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      bottom: -100%;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 5px;
      border-radius: 3px;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
      z-index: 2;
      pointer-events: none;
    }

    #calendarFilterForm button {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      font-size: 0;
      color: #000;
    }

    #calendarFilterForm button i {
      font-size: 18px;
    }

    #calendarFilterForm input[type="date"] {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 10px;
    }

    #toast {
      position: fixed;
      top: 10%;
      right: 10%;
      width: 300px;
      background-color: #4CAF50;
      color: #fff;
      border-radius: 5px;
      padding: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    #toast.show {
      opacity: 1;
    }

    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }

      to {
        transform: translateY(0);
      }
    }

    .close-form {
      transition: background-color 0.3s, transform 0.3s;
      border-radius: 50%;
    }

    .close-form:hover {
      background-color: rgba(255, 0, 0, 0.2);
      /* Red with 80% opacity */
    }

    /* Apply styles to the form container */
    .form-container1 {
      display: grid;
      grid-template-columns: 20% 23% 23% 23%;
      gap: 2%;
    }

    .form-container2 {
      display: grid;
      grid-template-columns: 44% 19% 33%;
      gap: 2%;
    }

    .form-container3 {
      display: grid;
      grid-template-columns: 65% 33%;
      gap: 2%;
    }

    .form-container4 {
      display: grid;
      grid-template-columns: 100%;
      gap: 10px;
    }

    /* Apply styles to the form groups */
    .form-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
    }

    /* Apply styles to the labels */
    .small-label {
      display: block;
      font-size: .9vw;
      margin-bottom: 5px;
    }

    /* Apply styles to the input fields */
    .input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: .8vw;
    }

    /* Apply styles to the submit button */
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 2% 4%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1vw;
    }

    input[type="submit"]:hover {
      background-color: darkcyan;
    }

    /* Style for the personal information headings */
    .personal_information {
      font-size: 1vw;
      font-weight: bold;
      margin-bottom: 10px;
    }

    /* Style for the form container */
    #updateProfileForm {
      max-width: 800px;
      margin: 0 auto;
    }

    .success-message {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 10px;
      z-index: 9;
    }

    /* Responsive styles for smaller screens */
    @media screen and (max-width: 881px) {
      .form-group {
        width: 100%;
      }
    }

    /* Add this CSS to your existing styles */
    .confirmation-dialog {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      border-radius: 5px;
    }

    .confirmation-dialog p {
      margin-bottom: 15px;
    }

    .confirmation-buttons {
      text-align: center;
      outline: none;
      margin: 0 10px;
      padding: 20px;
      border-radius: 5px;
      max-width: 400px;
    }



    .confirmation-buttons button[data-confirmed="true"] {
      background-color: green;
      color: white;
      transition: background-color 0.3s ease;
      padding: 10px 15px;
      margin: 0 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Hover effect for Confirm button */
    .confirmation-buttons button[data-confirmed="true"]:hover {
      background-color: #4caf50;
    }


    /* Styling for Cancel button */
    .confirmation-buttons button[data-confirmed="false"] {
      background-color: red;
      color: white;
      transition: background-color 0.3s ease;
      padding: 10px 15px;
      margin: 0 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Hover effect for Cancel button */
    .confirmation-buttons button[data-confirmed="false"]:hover {
      background-color: #e57373;
    }

    .confirmation-dialog-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    #applicantPicture {
      width: 100%;
      /* Adjust width as a percentage of the container */
      max-width: 192px;
      min-width: 20px;
      height: auto;
      border-radius: 2%;
      float: right;
    }
  </style>

  <div class="confirmation-dialog-overlay"></div>
  <div class="confirmation-dialog">
    <p></p>
    <div class="confirmation-buttons">
      <button data-confirmed="true">Confirm</button>
      <button data-confirmed="false">Cancel</button>
    </div>
  </div>


  <script>
$(document).ready(function() {
    // Check if there is a selected row stored in local storage
    var selectedRowId = localStorage.getItem('selectedRowId');
    if (selectedRowId) {
        // Highlight the selected row
        $('tr[data-id="' + selectedRowId + '"]').addClass('selected');

        // Populate form fields with data corresponding to the selected row
        populateForm(selectedRowId);
        
        // Show the todo div
        $('.todo').show();
    }

    $('.editRow').click(function() {
        // Get the 'data-id' attribute from the clicked row
        var userId = $(this).data('id');

        // Highlight the clicked row
        $('.editRow').removeClass('selected');
        $(this).addClass('selected');

        // Populate form fields with data corresponding to the clicked row
        populateForm(userId);
        
        // Show the todo div
        $('.todo').show();

        // Store the selected row ID in local storage
        localStorage.setItem('selectedRowId', userId);
    });

    // Click event handler for the close button
    $('.close-form').click(function() {
        // Hide the todo div
        $('.todo').hide();
   // Remove the selected class from all table rows
   $('.editRow').removeClass('selected');

// Clear the selected row ID from local storage
localStorage.removeItem('selectedRowId');
});

    function populateForm(userId) {
        // Send an AJAX request to fetch the user data based on the user ID
        $.ajax({
            url: 'Personnel_fetchStudentdata.php', // replace with the actual URL for fetching user data
            type: 'POST',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function(response) {
              // Populate the form fields with the fetched data

                 $('#applicantPicture').attr('src', response.id_picture);
              $('#updateProfileForm input[name="Name"]').val(response.Name);
              $('#updateProfileForm input[name="Middle_Name"]').val(response.Middle_Name);
              $('#updateProfileForm input[name="Last_Name"]').val(response.Last_Name);
              $('#updateProfileForm input[name="applicant_number"]').val(response.applicant_number);
              $('#updateProfileForm input[name="birthplace"]').val(response.birthplace);
              $('#updateProfileForm select[name="gender"]').val(response.gender);
              $('#updateProfileForm input[name="birthdate"]').val(response.birthdate);
              $('#updateProfileForm input[name="age"]').val(response.age);
              $('#updateProfileForm input[name="civil_status"]').val(response.civil_status);
              $('#updateProfileForm input[name="citizenship"]').val(response.citizenship);
              $('#updateProfileForm input[name="nationality"]').val(response.nationality);
              $('#updateProfileForm input[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
              $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
              $('#updateProfileForm input[name="phone_number"]').val(response.phone_number);
              $('#updateProfileForm input[name="facebook"]').val(response.facebook);
              $('#updateProfileForm input[name="email"]').val(response.email);
              $('#updateProfileForm input[name="contact_person_1"]').val(response.contact_person_1);
              $('#updateProfileForm input[name="contact_person_1_mobile"]').val(response.contact1_phone);
              $('#updateProfileForm select[name="relationship_1"]').val(response.relationship_1);
              $('#updateProfileForm input[name="contact_person_2"]').val(response.contact_person_2);
              $('#updateProfileForm input[name="contact_person_2_mobile"]').val(response.contact_person_2_mobile);
              $('#updateProfileForm select[name="relationship_2"]').val(response.relationship_2);
              $('#updateProfileForm select[name="academic_classification"]').val(response.academic_classification);

              $('#updateProfileForm select[name="college"]').val(response.college);
              $('#updateProfileForm input[name="id"]').val(response.id);
              $('#updateProfileForm input[name="high_school_name_address"]').val(response.high_school_name_address);
              $('#updateProfileForm input[name="lrn"]').val(response.lrn);
              $('#updateProfileForm select[name="degree_applied"]').val(response.degree_applied);
              $('#updateProfileForm select[name="nature_of_degree"]').val(response.nature_of_degree);
              // Add similar lines for other form fields

              // Display the form for editing
              $('.todo').show();
            },
            error: function(error) {
                console.error('Error fetching user data: ', error);
            }
        });
    }
});

      // Click event handler for the close button
      $('.close-form').click(function() {
        // Hide the form
        $('.todo').hide();
      });
  


    function updateStatus(id, status) {
      // Show the confirmation dialog
      $('.confirmation-dialog').show();
      $('.confirmation-dialog-overlay').show();

      // Set the message in the dialog
      $('.confirmation-dialog p').text('Are you sure you want to set the status to ' + status + '?');

      // Handle button clicks in the confirmation dialog
      $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
          // User confirmed, send the AJAX request to update the status
          $.ajax({
            type: 'POST',
            url: 'Personnel_UpdateStatus.php',
            data: {
              id: id,
              status: status
            },
            dataType: 'json', // Expect JSON response
            success: function(response) {
              if (response.success) {
                // Update the status in the table cell
                $('[data-id="' + id + '"] [data-field="appointment_status"]').text(status);
                showToast(response.message, 'success');
              } else {
                showToast(response.message, 'error');
              }
            },
            error: function(error) {
              console.error('Error updating status:', error);
            }
          });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
      });
    }

    function showToast(message, type) {
      // Display a toast message
      $('#toast-body').text(message);
      $('#toast').removeClass().addClass('toast').addClass(type).addClass('show');

      // Hide the toast after a few seconds
      setTimeout(function() {
        $('#toast').removeClass('show');
      }, 3000);
    }
    document.addEventListener('DOMContentLoaded', function() {
      var successMessage = document.getElementById('successMessage');

      if (successMessage) {
        successMessage.style.display = 'block';

        setTimeout(function() {
          successMessage.style.display = 'none';
        }, 3000);
      }
    });
    document.addEventListener("DOMContentLoaded", function() {
      // Add click event listener to each row
      var rows = document.querySelectorAll('.editRow');
      rows.forEach(function(row) {
        row.addEventListener('click', function() {
          // Remove 'selected' class from all rows
          rows.forEach(function(r) {
            r.classList.remove('selected');
          });

          // Add 'selected' class to the clicked row
          this.classList.add('selected');
        });
      });
    });
  </script>



  </div>

  </div>
  </div>
  </div>
  </div>



  </main>
  <!-- MAIN -->


  </section>
</body>

</html>
