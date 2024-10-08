<?php

include ("admin_cover.php");


// Query to fetch data from admission_data_archive
$query = "SELECT * FROM programs";
$result = $conn->query($query);


// Query to fetch data from users_archive
$query2 = "SELECT * FROM admission_period";
$result2 = $conn->query($query2);


$query4 = "SELECT * FROM ethnicity";
$result4 = $conn->query($query4);

$query5 = "SELECT * FROM academicclassification";
$result5 = $conn->query($query5);

?>

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.2/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.2/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.1/css/select.dataTables.min.css">
    <script src="https://cdn.datatables.net/select/1.6.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <title>BSU ADMIN Admission Unit Personnel</title>

</head>

<body>


    <style>
        .data-container1 {
            display: grid;
            grid-template-columns: 20% 23% 23% 23%;
            gap: 2%;
        }

        .data-container2 {
            display: grid;
            grid-template-columns: 44% 19% 33%;
            gap: 2%;
        }

        .data-container3 {
            display: grid;
            grid-template-columns: 65% 33%;
            gap: 2%;
        }

        .data-container4 {
            display: grid;
            grid-template-columns: 100%;
            gap: 10px;
        }

        .data-container5 {
            display: grid;
            grid-template-columns: 45%;
            gap: 10px;
        }

        .button-container {
            position: relative;
        }

        .button.inc-btn,
        .button.cancel-btn,
        .button.save-btn,
        .button.check-btn,
        .button.archive-btn { 
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .button.inc-btn i,
        .button.save-btn i,
        .button.cancel-btn i,
        .button.check-btn i,
        .button.archive-btn i {
            font-size: 13px;
            color: black;
        }

        .button.inc-btn:hover i {
            color: orange;
        }
        .button.save-btn:hover i {
            color: green;
        }
        .button.cancel-btn:hover i {
            color: blue;
        }

        .button.check-btn:hover i {
            color: green;
        }
        .button.archive-btn:hover i {
            color: blue;
        }

        .button-container .button::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 5px);
            /* Position the tooltip above the button with some spacing */
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            /* Use ease transition for smooth appearance */
            z-index: 999;
            pointer-events: none;
        }

        .button-container .button:hover::after {
            opacity: 1;
        }


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

        .sendmodal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;

        }

        .sendmodal-content {
            position: fixed;
            top: 15%;
            right: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            z-index: 9;
            animation: slideInUp 0.3s ease-in-out, fadeOut 2s ease-in-out 0.3s forwards;
        }

        .modala {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-contenta {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 20%;
            font-size: 18px;
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

        .modal,

        .confirmation-dialoga {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Modal Content/Box */
        .modal-content,
        .dialoga-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            /* Could be more or less, depending on screen size */
            border-radius: 10px;
        }

        .exit {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .exit:hover,
        .exit:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        .cancel {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            background-color: #ff5757;
            color: white;
            /* Float the "Cancel" button to the right */
        }

        .confirm {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            /* Float the "Cancel" button to the right */
        }

        .confirm:hover,
        .cancel:hover {
            opacity: 0.8;
        }

        .confirmation-message {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 5px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        #deleteConfirmationModal,
        #errorModal,
        #selectRowModal,
        #sendSuccessModal {
            display: none;
        }

        .field-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .field-group>* {
            flex-basis: calc(25% - 10px);
            margin-bottom: 10px;
        }

        .success-message {
            position: fixed;
            top: 15%;
            right: 10%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            z-index: 999;
            animation: slideInUp 0.3s ease-in-out;
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
        }

        .form-container1 {
            display: grid;
            grid-template-columns: 50% 23% 23%;
            gap: 2%;
        }

        .form-container2 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2%;
        }

        .form-container7 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2%;
        }

        .form-container7 .form-group {
            display: grid;
            grid-template-columns: 1fr;
            align-items: start;
            /* Align items to the start of the grid cell */
        }

        .form-container7 .form-group .small-label {
            margin-bottom: 10px;
            white-space: normal;
            text-align: left;
            word-wrap: break-word;
        }

        .form-container7 .form-group input {
            width: 100%;
            /* Take up full width of the grid cell */
        }



        .form-container8 {
            display: grid;
            grid-template-columns: 20% 10% 20% 10% 20% 10%;

            gap: 2%;
        }

        .form-container8 .form-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .form-container9 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* evenly distribute columns */
            gap: 2%;
        }

        .form-container9 .form-group {
            display: flex;
            flex-direction: column;

        }

        .form-container9 .form-group .small-label {
            margin-bottom: 10px;
            max-height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: left;
        }

        .form-container8 .form-group .small-label {
            margin-bottom: 10px;
            max-height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: left;
        }

        .form-container3 {
            display: grid;
            grid-template-columns: 18% 18% 18% 18% 18%;
            gap: 2%;
        }

        .form-container4 {
            display: grid;
            grid-template-columns: 100%;
            gap: 10px;
        }

        input[readonly] {
            background-color: #f2f2f2;
            /* Light gray background color */
        }

        .form-container5 {
            display: grid;
            grid-template-columns: 70% 20%;
            gap: 10px;
        }

        .form-container6 {
            display: grid;
            grid-template-columns: 35% 15%;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .small-label {
            display: block;
            font-size: .9vw;
            margin-bottom: 5px;
        }

        .input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: .8vw;
        }

        .submit {
            background-color: #4CAF50;
            color: white;
            padding: 2% 4%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1vw;
        }

        .submit:hover {
            opacity: 0.8;
        }

        .personal_information {
            font-size: 1vw;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #updateProfileForm {
            max-width: 800px;
            margin: 0 auto;
        }



        @media screen and (max-width: 881px) {
            .form-group {
                width: 100%;
            }
        }

        #update_success {
            position: fixed;
            top: 75px;
            /* Adjust the distance from the top */
            right: 20px;
            /* Adjust the distance from the right */
            padding: 10px 20px;
            background-color: green;
            color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            animation: slideUp 0.5s ease forwards, fadeOut 0.5s 2.5s forwards;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(100%);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auto-expand {
            min-height: 50px;
            /* Set a minimum height for the textarea */
        }

        #toggleSubjects {
            background-color: green;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
            /* Set width to auto */
            float: right;
            /* Float it to the right */
        }

        #toggleSubjects:hover {
            background-color: darkgreen;
        }

        .other_subject {
            display: none;
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

    <section id="content">
        <?php

        // Check if the success message session variable is set
        if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
            // Display success message with animation
            echo '<div class="success-message" id="successMessage">Data successfully updated!</div>';

            // Unset the session variable to avoid displaying the message again on page refresh
            unset($_SESSION['update_success']);
        }

        // Check if the success message session variable is set
if (isset($_SESSION['program_added_successfully']) && $_SESSION['program_added_successfully']) {
    // Display success message with animation or transition
    echo '<div class="success-message" id="successMessage">New program added successfully!</div>';

    // Unset the session variable to avoid displaying the message again on page refresh
    unset($_SESSION['program_added_successfully']);
}
        ?>


        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Data</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Data</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                        <li><a class="active" href="Admin_Dashboard.php">Home</a></li>
                        </li>
                    </ul>
                </div>
                <div class="button-container">

                  
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of Programs</h3>
                        <!-- Add this input field for date filtering -->

                        <div class="headfornaturetosort">
                            <!-- <form method="GET" action="" id="calendarFilterForm">
                                <label for="appointment_date"></label>
                                <input type="date" name="appointment_date" id="appointment_date">
                                <button type="submit"><i class='bx bx-filter'></i></button>
                            </form>
              
                            <button type="button" id="sendButton" style="display: none;">
                                <i class='bx bx-send'></i>
                            </button> -->
                            <button type="button" id="toggleAddProgram">
                                <i class='bx bx-select-multiple'></i> Add
                            </button>

                        </div>
                    </div>
                    <style>
                        .table-container {
                            max-height: 400px;
                            overflow-y: auto;
                            max-width: 100%;
                            /* Set maximum width to adjust to the end of the screen */
                            margin: 0 auto;
                            /* Center the table horizontally */
                        }

                        #thead {
                            position: sticky;
                            top: 0;
                            z-index: 1;
                            background-color: white;
                        }

                        /* Table scrollbar */
                        .table-container::-webkit-scrollbar {
                            width: 10px;
                        }

                        .table-container::-webkit-scrollbar-thumb {
                            background-color: #4CAF50;
                            border-radius: 5px;
                        }
                    </style>

                    <div class="table-container">
                        <table class="display" style="width: 100%;">

                            <!-- Thead Section -->
                            <thead id="thead">
    <tr>
        <th>#</th>
        <th>College</th>
    <th>Courses</th>
    <th>Nature of Degree</th>
    <th>Sections</th> <!-- Number of sections -->
    <th>Students Per Section</th> 
    <th>Action</th> 
    
    </tr>
</thead>

<!-- Tbody Section -->
<tbody id="tbody">
<?php
$rowNumber = 1; // To number each row
while ($row = $result->fetch_assoc()) {
    echo "<tr data-id='{$row['ProgramID']}'>";
    echo "<td>{$rowNumber}</td>"; // Row number
    echo "<td class='editable' data-field='College'>{$row['College']}</td>"; // College
    echo "<td class='editable' data-field='Courses'>{$row['Courses']}</td>"; // Courses
    echo "<td class='editable' data-field='Nature_of_Degree'>{$row['Nature_of_Degree']}</td>"; // Nature of Degree
    echo "<td class='editable' data-field='No_of_Sections'>{$row['No_of_Sections']}</td>"; // Number of Sections
    echo "<td class='editable' data-field='No_of_Students_Per_Section'>{$row['No_of_Students_Per_Section']}</td>"; // Students Per Section
    echo "<td>
            <div class='button-container'>
                <button type='button' class='button inc-btn' data-tooltip='Delete' onclick='deleteProgram({$row['ProgramID']})'>
                    <i class='bx bxs-trash'></i>
                </button>
                <button type='button' class='button check-btn' data-tooltip='Edit' onclick='editProgram(this)'>
                    <i class='bx bxs-edit'></i>
                </button>
                <button type='button' class='button save-btn' data-tooltip='Save' onclick='saveProgram({$row['ProgramID']})' style='display:none;'>
                    <i class='bx bxs-save'></i>
                </button>
                <button type='button' class='button cancel-btn' data-tooltip='Cancel' onclick='cancelEdit(this)' style='display:none;'>
                    <i class='bx bxs-x-circle'></i>
                </button>
            </div>
          </td>"; 
    echo "</tr>";
    $rowNumber++; // Increment for the next row
}
?>

</tbody>

                        </table>
                    </div>
<script>
    function editProgram(button) {
    var row = $(button).closest('tr');
    row.find('.editable').each(function() {
        var cell = $(this);
        var value = cell.text();
        var field = cell.data('field');
        cell.html('<input type="text" class="form-control" data-field="' + field + '" value="' + value + '">');
    });
    // Toggle button visibility
    row.find('.inc-btn').hide();
    row.find('.check-btn').hide();
    row.find('.save-btn').show();
    row.find('.cancel-btn').show();
}

function cancelEdit(button) {
    var row = $(button).closest('tr');
    row.find('.editable').each(function() {
        var cell = $(this);
        var input = cell.find('input');
        cell.text(input.val()); // Restore the original value
    });
    // Toggle button visibility
    row.find('.inc-btn').show();
    row.find('.check-btn').show();
    row.find('.save-btn').hide();
    row.find('.cancel-btn').hide();
}

function saveProgram(id) {
    // Show confirmation dialog
    $('.confirmation-dialog').show();
    $('.confirmation-dialog-overlay').show();
    $('.confirmation-dialog p').text('Are you sure you want to update this data?');

    // Handle button clicks in the confirmation dialog
    $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
            // User confirmed, send AJAX request to delete data
            $.ajax({
                url: "update_program.php",
                type: "POST",
                data: { delete_ids: [id] },
                success: function(response) {
                    // Show response message in success message div
                    showSuccessMessage(response);
                    // Reload or update the table as needed
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    // Handle error as needed
                }
            });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
    });
}


document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("toggleAddProgram").addEventListener("click", function () {
    document.getElementById("addProgramModal").style.display = "block"; // Open modal
  });

  document.getElementById("closeButton").addEventListener("click", function () {
    document.getElementById("addProgramModal").style.display = "none"; // Close modal
  });

  window.addEventListener("click", function (event) {
    if (event.target === document.getElementById("addProgramModal")) { // Close by clicking outside
      document.getElementById("addProgramModal").style.display = "none";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Function to update the hidden input
  function updateAvailableSlots() {
    const noOfSections = parseInt(document.getElementById("no_of_sections").value) || 0;
    const noOfStudentsPerSection = parseInt(document.getElementById("no_of_students_per_section").value) || 0;
    const numberOfAvailableSlots = noOfSections * noOfStudentsPerSection;
    
    document.getElementById("number_of_available_slots").value = numberOfAvailableSlots;
  }

  // Attach event listeners to inputs
  document.getElementById("no_of_sections").addEventListener("input", updateAvailableSlots);
  document.getElementById("no_of_students_per_section").addEventListener("input", updateAvailableSlots);

  // Initial update in case there's a default value
  updateAvailableSlots();
});

</script>

                    <style>
                        /* Scrollbar styling for content areas */
                        #content1,
                        #content2 {
                            max-height: 400px;
                            overflow-y: auto;
                            padding-right: 20px;
                            /* Adjust this value based on the scrollbar width */
                            box-sizing: border-box;
                            /* Include padding and border in the total width/height */
                        }

                        #content1::-webkit-scrollbar,
                        #content2::-webkit-scrollbar {
                            width: 10px;
                        }

                        #content1::-webkit-scrollbar-thumb,
                        #content2::-webkit-scrollbar-thumb {
                            background-color: #4CAF50;
                            /* green thumb color */
                            border-radius: 5px;
                        }

                        #content1::-webkit-scrollbar-track,
                        #content2::-webkit-scrollbar-track {
                            background-color: #f4f4f4;
                        }


 .modalB {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
  z-index: 99999;
}

.modal-contentB {
  background-color: white;
  margin: 15% auto; /* 15% from top, centered */
  padding: 20px;
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
  border-radius: 10px;
}

#closeButton {
  color: #aaa;
  float: right; /* Position to the right */
  font-size: 28px;
  font-weight: bold;
}

#closeButton:hover,
#closeButton:focus {
  color: black; /* Change color on hover */
  text-decoration: none;
  cursor: pointer; /* Change cursor to pointer */
}
                    </style>
<!-- Modal for adding new program -->
<div id="addProgramModal" class="modalB">
  <div class="modal-contentB">
    <span id="closeButton">&times;</span> <!-- Ensure ID matches -->

    <h2>Add New Program</h2>
    <form id="addProgramForm" action="add_program.php" method="POST">
  <div class="form-group">
    <label for="college">College:</label>
    <input class="input" type="text" id="college" name="college" required>
  </div>
  <div class="form-group">
    <label for="courses">Courses:</label>
    <input class="input" type="text" id="courses" name="courses" required>
  </div>
  <div class="form-group">
    <label for="nature_of_degree">Nature of Degree:</label>
    <input class="input" type="text" id="nature_of_degree" name="nature_of_degree" required>
  </div>
  <div class="form-group">
    <label for="no_of_sections">Number of Sections:</label>
    <input class="input" type="number" id="no_of_sections" name="no_of_sections" required>
  </div>
  <div class="form-group">
    <label for="no_of_students_per_section">Students Per Section:</label>
    <input class="input" type="number" id="no_of_students_per_section" name="no_of_students_per_section" required>
  </div>
  <div class="form-group">
    <label for="number_of_available_slots">Number of Available Slots:</label>
    <input class="input" type="number" id="number_of_available_slots" name="number_of_available_slots" required>
  </div>
  <button type="submit">Submit</button>
</form>


  </div>
</div>


                    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="mr-auto">Success!</strong>

                        </div>
                        <div class="toast-body" id="toast-body"></div>
                    </div>
                    <div id="confirmationModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <p>Are you sure you want to send these applicants to the OSS?</p>
                            <button class="confirm" id="confirmSend">Confirm</button>
                            <button class="cancel">Cancel</button>
                        </div>
                    </div>
                    <div id="applicantNoModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <p>Last entered applicant number: <?php echo $last_applicant_number; ?></p>
                            <button id="modalCloseBtn" class="confirm">OK</button>
                        </div>
                    </div>
                    <div id="alertModal" class="sendmodal" style="display: none;">
                        <div class="sendmodal-content">
                            <p id="alertMessage"></p>
                        </div>
                    </div>

                    <div id="noSelectionModal" class="modal">
                        <div class="modal-content">
                            <span class="exit">&times;</span>
                            <br>
                            <p>Please select at least one applicant.</p>
                        </div>
                    </div>


                    <div id="alertModal" class="sendmodal">
                        <div class="sendmodal-content">
                            <p id="alertMessage"></p>
                        </div>
                    </div>


                </div>

           
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Applicant Classifications and Requirements</h3>

                        
                        <div class="headfornaturetosort">
                    
                            <button type="button" id="toggleAddClassification">
                                <i class='bx bx-select-multiple'></i> Add
                            </button>

                        </div>
                    </div>
                    <div class="table-container">
                    <table class="" style="width: 100%;">

<!-- Thead Section -->
<thead id="thead">
    <tr>
        <th>#</th>
<th>Classification</th>
<th>Description</th>
<th>Requirement1</th>
<th>Requirement2</th>
<th>Requirement3</th>
<th>Requirement4</th>
<th>Requirement5</th>
<th>Requirement6</th>
<th>Requirement7</th>
<th>Criteria1</th>
<th>Criteria2</th>
<th>Criteria3</th>
<th>Criteria4</th>
<th>Nature of Degree</th>
<th> Action</th>
      
    </tr>
</thead>

<!-- Tbody Section -->
<tbody id="tbody">
<?php
$rowNumber = 1; // To number each row
while ($row5 = $result5->fetch_assoc()) {
echo "<tr>";
echo "<td>{$rowNumber}</td>"; // Row number
echo "<td>{$row5['Classification']}</td>"; // Display Classification
echo "<td>{$row5['Description']}</td>"; // Display Description
echo "<td>{$row5['Requirement1']}</td>"; // Display Requirement1
echo "<td>{$row5['Requirement2']}</td>"; // Display Requirement2
echo "<td>{$row5['Requirement3']}</td>"; // Display Requirement3
echo "<td>{$row5['Requirement4']}</td>"; // Display Requirement4
echo "<td>{$row5['Requirement5']}</td>"; // Display Requirement5
echo "<td>{$row5['Requirement6']}</td>"; // Display Requirement6
echo "<td>{$row5['Requirement7']}</td>"; // Display Requirement7
echo "<td>{$row5['Criteria1']}</td>"; // Display Criteria1
echo "<td>{$row5['Criteria2']}</td>"; // Display Criteria2
echo "<td>{$row5['Criteria3']}</td>"; // Display Criteria3
echo "<td>{$row5['Criteria4']}</td>"; // Display Criteria4
echo "<td>{$row5['NatureOfDegree']}</td>"; // Display Nature of Degree
echo "<td>
<div class='button-container'>
    <button type='button' class='button inc-btn' data-tooltip='Delete' onclick='deleteClass({$row5['ID']})'>
        <i class='bx bxs-trash'></i>
    </button>
    <button type='button' class='button check-btn' data-tooltip='Edit' onclick='editProgram(this)'>
        <i class='bx bxs-edit'></i>
    </button>
    <button type='button' class='button save-btn' data-tooltip='Save' onclick='saveClass({$row5['ID']})' style='display:none;'>
        <i class='bx bxs-save'></i>
    </button>
    <button type='button' class='button cancel-btn' data-tooltip='Cancel' onclick='cancelEdit(this)' style='display:none;'>
        <i class='bx bxs-x-circle'></i>
    </button>
</div>
</td>"; 
echo "</tr>";
echo "</tr>";
$rowNumber++; // Increment for the next row
}
    ?>
</tbody>

</table>
                    </div>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Academic Year Schedule</h3>
                    </div>
                    <div class="table-container">
                        <table class="" style="width: 100%;">

                            <!-- Thead Section -->
                            <tr>
    <th>#</th> <!-- Row number -->
    <th>Start Year</th>
    <th>End Year</th>
    <th>Semester</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Clinic Schedule</th>
    <th>Result Release Date</th>
    <th>Enrollment Period</th>
    <th>Action</th>
</tr>
        </thead>
        <!-- Table Body -->
        <tbody>
            <?php
            $rowNumber = 1;
            while ($row2 = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowNumber}</td>"; // Display row number
                echo "<td>{$row2['start_year']}</td>"; // Start year
                echo "<td>{$row2['end_year']}</td>"; // End year
                echo "<td>{$row2['sem']}</td>"; // Semester
                echo "<td>{$row2['start']}</td>"; // Start date
                echo "<td>{$row2['end']}</td>"; // End date
                echo "<td>{$row2['clinic_sched']}</td>"; // Clinic schedule
                echo "<td>{$row2['result_release']}</td>"; // Result release date
                echo "<td>{$row2['enrollment_period']}</td>"; // Enrollment period
                echo "<td>
<div class='button-container'>
    
    <button type='button' class='button check-btn' data-tooltip='Edit' onclick='editProgram(this)'>
        <i class='bx bxs-edit'></i>
    </button>
    <button type='button' class='button save-btn' data-tooltip='Save' onclick='saveClass({$row2['id']})' style='display:none;'>
        <i class='bx bxs-save'></i>
    </button>
    <button type='button' class='button cancel-btn' data-tooltip='Cancel' onclick='cancelEdit(this)' style='display:none;'>
        <i class='bx bxs-x-circle'></i>
    </button>
</div>
</td>"; 
                echo "</tr>";
                
                $rowNumber++; // Increment for the next row
            }
            ?>
        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of Programs</h3>
                        <!-- Add this input field for date filtering -->

                        <div class="headfornaturetosort">
                            <!-- <form method="GET" action="" id="calendarFilterForm">
                                <label for="appointment_date"></label>
                                <input type="date" name="appointment_date" id="appointment_date">
                                <button type="submit"><i class='bx bx-filter'></i></button>
                            </form>
              
                            <button type="button" id="sendButton" style="display: none;">
                                <i class='bx bx-send'></i>
                            </button> -->
                            <button type="button" id="toggleAddProgram">
                                <i class='bx bx-select-multiple'></i> Add
                            </button>

                        </div>
                    </div>
                    <style>
                        .table-container {
                            max-height: 400px;
                            overflow-y: auto;
                            max-width: 100%;
                            /* Set maximum width to adjust to the end of the screen */
                            margin: 0 auto;
                            /* Center the table horizontally */
                        }

                        #thead {
                            position: sticky;
                            top: 0;
                            z-index: 1;
                            background-color: white;
                        }

                        /* Table scrollbar */
                        .table-container::-webkit-scrollbar {
                            width: 10px;
                        }

                        .table-container::-webkit-scrollbar-thumb {
                            background-color: #4CAF50;
                            border-radius: 5px;
                        }
                    </style>

                    <div class="table-container">
                        <table class="display" style="width: 100%;">

                            <!-- Thead Section -->
                            <thead id="thead">
<tr>
    <th>#</th> <!-- Row numbering -->
    <th>Ethnicity Name</th> <!-- Ethnicity Name -->
    <th> Action</th>
</tr>
        </thead>
        <!-- Table Body -->
        <tbody>
            <?php
            $rowNumber = 1;
            while ($row4 = $result4->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowNumber}</td>"; // Display row number
                echo "<td>{$row4['ethnicity_name']}</td>"; // Display Ethnicity Name
                echo "<td>
<div class='button-container'>
    <button type='button' class='button inc-btn' data-tooltip='Delete' onclick='deleteEthni({$row4['ethnicity_id']})'>
        <i class='bx bxs-trash'></i>
    </button>
    <button type='button' class='button check-btn' data-tooltip='Edit' onclick='editEthni(this)'>
        <i class='bx bxs-edit'></i>
    </button>
    <button type='button' class='button save-btn' data-tooltip='Save' onclick='saveEthni({$row4['ethnicity_id']})' style='display:none;'>
        <i class='bx bxs-save'></i>
    </button>
    <button type='button' class='button cancel-btn' data-tooltip='Cancel' onclick='cancelEthni(this)' style='display:none;'>
        <i class='bx bxs-x-circle'></i>
    </button>
</div>
</td>"; 
                echo "</tr>";
                $rowNumber++;
            }
            ?>
        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>

    <!-- Success message div -->
<div class="success-message" id="archive" style="display: none;">
  <p id="archive-message"></p>
</div>
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>

    <div class="confirmation-dialoga" id="confirmationDialoga">
        <div class="dialoga-content">
            <p>Are you sure you want to submit the form?</p>
            <button class="confirm" onclick="submitForm()">Confirm</button>
            <button class="cancel" onclick="cancelSubmit()">Cancel</button>
        </div>
    </div>
    <div id="applicantNoValidation" class="modal" style="display: none;">
        <div class="modal-content">
            <p>The applicant number is already taken</p>
            <button id="valCloseBtn" class="confirm">OK</button>
        </div>
    </div>


    <script>

         
// Function to display success message
function showSuccessMessage(message) {
  var archiveMessage = document.getElementById('archive-message');
  archiveMessage.innerHTML = message;
  var archiveDiv = document.getElementById('archive');
  archiveDiv.style.display = 'block';
  // Hide the success message after 3 seconds
  setTimeout(function() {
    archiveDiv.style.display = 'none';
    // Reload the page after the message disappears
    location.reload();
  }, 2000);
}

function deleteProgram(id) {
    // Show confirmation dialog
    $('.confirmation-dialog').show();
    $('.confirmation-dialog-overlay').show();
    $('.confirmation-dialog p').text('Are you sure you want to delete this data?');

    // Handle button clicks in the confirmation dialog
    $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
            // User confirmed, send AJAX request to delete data
            $.ajax({
                url: "delete_program.php",
                type: "POST",
                data: { delete_ids: [id] },
                success: function(response) {
                    // Show response message in success message div
                    showSuccessMessage(response);
                    // Reload or update the table as needed
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    // Handle error as needed
                }
            });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
    });
}



function deleteUser(id) {
    // Show confirmation dialog
    $('.confirmation-dialog').show();
    $('.confirmation-dialog-overlay').show();
    $('.confirmation-dialog p').text('Are you sure you want to permanently delete this data?');

    // Handle button clicks in the confirmation dialog
    $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
            // User confirmed, send AJAX request to delete data
            $.ajax({
                url: "delete_applicants.php",
                type: "POST",
                data: { delete_ids: [id] },
                success: function(response) {
                    // Show response message in success message div
                    showSuccessMessage(response);
                    // Reload or update the table as needed
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    // Handle error as needed
                }
            });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
    });
}

function deletePersonnel(id) {
    // Show confirmation dialog
    $('.confirmation-dialog').show();
    $('.confirmation-dialog-overlay').show();
    $('.confirmation-dialog p').text('Are you sure you want to permanently delete this data?');

    // Handle button clicks in the confirmation dialog
    $('.confirmation-buttons button').click(function() {
        var userConfirmed = $(this).data('confirmed');
        if (userConfirmed) {
            // User confirmed, send AJAX request to delete data
            $.ajax({
                url: "delete_users.php",
                type: "POST",
                data: { delete_ids: [id] },
                success: function(response) {
                    // Show response message in success message div
                    showSuccessMessage(response);
                    // Reload or update the table as needed
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                    // Handle error as needed
                }
            });
        }

        // Hide the confirmation dialog and overlay
        $('.confirmation-dialog').hide();
        $('.confirmation-dialog-overlay').hide();
    });
}

new DataTable('#studentTable', {
    order: [[3, 'desc']]
});


new DataTable('table.display');

        function confirmSubmission() {
            document.getElementById("confirmationDialoga").style.display = "block";
            document.getElementById("confirmationDialoga").dataset.formId = "updateProfileForm";
            var inputApplicantNumber = document.getElementById("applicant_number").value;

            // AJAX request to check if the input applicant number exists in the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        // If the applicant number exists in the database, display the validation modal
                        if (response === 'exists') {
                            document.getElementById("applicantNoValidation").style.display = "block";
                        } else {
                            // If the applicant number does not exist in the database, proceed with submission
                            document.getElementById("updateProfileForm").submit(); // Assuming your form ID is "updateProfileForm"
                        }
                    } else {
                        // Handle error if AJAX request fails
                        console.error("AJAX request failed.");
                    }
                }
            };
            xhr.open("POST", "check_applicant_number.php", true); // Replace "check_applicant_number.php" with your PHP script to check the database
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("applicant_number=" + inputApplicantNumber);
        }

        // Close modal when "OK" button is clicked
        document.getElementById("valCloseBtn").addEventListener("click", function () {
            document.getElementById("applicantNoValidation").style.display = "none";
        });
        function confirmSubmission2() {
            document.getElementById("confirmationDialoga").style.display = "block";
            document.getElementById("confirmationDialoga").dataset.formId = "updateProfileForm2";
        }

        function submitForm() {
            var formId = document.getElementById("confirmationDialoga").dataset.formId;
            document.getElementById("confirmationDialoga").style.display = "none";
            document.getElementById(formId).submit();
        }

        function cancelSubmit() {
            document.getElementById("confirmationDialoga").style.display = "none";
        }
        $(document).ready(function () {

            // Check if there is a selected tab stored in local storage
            var selectedTab = localStorage.getItem('selectedTab');

            // If a tab was previously selected, show its content
            if (selectedTab) {
                $('#' + selectedTab).prop('checked', true); // Check the radio button corresponding to the selected tab
                $('.tab-content').hide(); // Hide all tab contents
                $('#content' + selectedTab.substr(3)).show(); // Show the content of the selected tab
            } else {
                // If no tab was previously selected, default to the first tab
                $('#tab1').prop('checked', true);
                $('#content1').show();
            }

            // Store the ID of the selected tab in localStorage when a tab is clicked
            $('.tab').click(function () {
                var selectedTabId = $(this).attr('id');
                localStorage.setItem('selectedTab', selectedTabId);

                // Hide all tab contents and show the content of the selected tab
                $('.tab-content').hide();
                $('#content' + selectedTabId.substr(3)).show();
            });
            // Check if there is a selected row stored in local storage
            var selectedRowIdApplicants = localStorage.getItem('selectedRowIdApplicants');
            if (selectedRowIdApplicants) {

                // Highlight the selected row
                $('tr[data-id="' + selectedRowIdApplicants + '"]').addClass('selected');

                // Populate form fields with data corresponding to the selected row
                populateForm(selectedRowIdApplicants);

                // Show the todo div
                $('.todo').show();
            }

            $('.editRow').click(function (event) {
                // Check if the click target is not a button, checkbox, or its child elements
                if (!$(event.target).is('button') && !$(event.target).is('i') && !$(event.target).is(':checkbox')) {
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
                    localStorage.setItem('selectedRowIdApplicants', userId);
                }
            });

            // Click event handler for the close button
            $('.close-form').click(function () {
                // Hide the todo div
                $('.todo').hide();
                // Remove the selected class from all table rows
                $('.editRow').removeClass('selected');

                // Clear the selected row ID from local storage
                localStorage.removeItem('selectedRowIdApplicants');
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
                    success: function (response) {
                        $('#applicantPicture').attr('src', response.id_picture);
                        $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
                        $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
                        $('#updateProfileForm input[name="college"]').val(response.college);
                        $('#updateProfileForm input[name="id"]').val(response.id);
                        $('#updateProfileForm input[name="high_school_name_address"]').val(response.high_school_name_address);
                        $('#updateProfileForm input[name="lrn"]').val(response.lrn);
                        $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);
                        $('#updateProfileForm input[name="Gr11_A1"]').val(response.Gr11_A1);
                        $('#updateProfileForm input[name="Gr11_A2"]').val(response.Gr11_A2);
                        $('#updateProfileForm input[name="Gr11_A3"]').val(response.Gr11_A3);
                        $('#updateProfileForm input[name="Gr11_GWA"]').val(response.Gr11_GWA);
                        $('#updateProfileForm input[name="GWA_OTAS"]').val(response.GWA_OTAS);
                        $('#updateProfileForm select[name="nature_qualification"]').val(response.nature_qualification);
                        $('#updateProfileForm select[name="Degree_Remarks"]').val(response.Degree_Remarks);
                        $('#updateProfileForm input[name="English_Subject_1"]').val(response.English_Subject_1);
                        $('#updateProfileForm input[name="English_Subject_2"]').val(response.English_Subject_2);
                        $('#updateProfileForm input[name="English_Subject_3"]').val(response.English_Subject_3);
                        $('#updateProfileForm input[name="Science_Subject_1"]').val(response.Science_Subject_1);
                        $('#updateProfileForm input[name="Science_Subject_2"]').val(response.Science_Subject_2);
                        $('#updateProfileForm input[name="Science_Subject_3"]').val(response.Science_Subject_3);
                        $('#updateProfileForm input[name="Math_Subject_1"]').val(response.Math_Subject_1);
                        $('#updateProfileForm input[name="Math_Subject_2"]').val(response.Math_Subject_2);
                        $('#updateProfileForm input[name="Gr12_A1"]').val(response.Gr12_A1);
                        $('#updateProfileForm input[name="Gr12_A2"]').val(response.Gr12_A2);
                        $('#updateProfileForm input[name="Gr12_A3"]').val(response.Gr12_A3);
                        $('#updateProfileForm input[name="Gr12_GWA"]').val(response.Gr12_GWA);
                        $('#updateProfileForm input[name="English_Oral_Communication_Grade"]').val(response.English_Oral_Communication_Grade);
                        $('#updateProfileForm input[name="English_Reading_Writing_Grade"]').val(response.English_Reading_Writing_Grade);
                        $('#updateProfileForm input[name="English_Academic_Grade"]').val(response.English_Academic_Grade);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade"]').val(response.English_Other_Courses_Grade);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade_2"]').val(response.English_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="English_Other_Courses_Grade_3"]').val(response.English_Other_Courses_Grade_3);
                        $('#updateProfileForm input[name="Science_Earth_Science_Grade"]').val(response.Science_Earth_Science_Grade);
                        $('#updateProfileForm input[name="academic_classification"]').val(response.academic_classification);
                        $('#updateProfileForm input[name="Science_Earth_and_Life_Science_Grade"]').val(response.Science_Earth_and_Life_Science_Grade);
                        $('#updateProfileForm input[name="Science_Physical_Science_Grade"]').val(response.Science_Physical_Science_Grade);
                        $('#updateProfileForm input[name="Science_Disaster_Readiness_Grade"]').val(response.Science_Disaster_Readiness_Grade);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade"]').val(response.Science_Other_Courses_Grade);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade_2"]').val(response.Science_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="Science_Other_Courses_Grade_3"]').val(response.Science_Other_Courses_Grade_3);
                        $('#updateProfileForm input[name="Math_General_Mathematics_Grade"]').val(response.Math_General_Mathematics_Grade);
                        $('#updateProfileForm input[name="Math_Statistics_and_Probability_Grade"]').val(response.Math_Statistics_and_Probability_Grade);
                        $('#updateProfileForm input[name="Math_Other_Courses_Grade"]').val(response.Math_Other_Courses_Grade);
                        $('#updateProfileForm input[name="Math_Other_Courses_Grade_2"]').val(response.Math_Other_Courses_Grade_2);
                        $('#updateProfileForm input[name="Old_HS_English_Grade"]').val(response.Old_HS_English_Grade);
                        $('#updateProfileForm input[name="Old_HS_Math_Grade"]').val(response.Old_HS_Math_Grade);
                        $('#updateProfileForm input[name="Old_HS_Science_Grade"]').val(response.Old_HS_Science_Grade);
                        $('#updateProfileForm input[name="ALS_English"]').val(response.ALS_English);
                        $('#updateProfileForm input[name="ALS_Math"]').val(response.ALS_Math);

                        $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
                        $('#updateProfileForm input[name="OSS_Endorsement_Slip"]').val(response.OSS_Endorsement_Slip);
                        $('#updateProfileForm input[name="OSS_Admission_Test_Score"]').val(response.OSS_Admission_Test_Score);
                        $('#updateProfileForm input[name="OSS_Remarks"]').val(response.OSS_Remarks);
                        $('#updateProfileForm input[name="Qualification_Nature_Degree"]').val(response.Qualification_Nature_Degree);
                        $('#updateProfileForm textarea[name="Requirements_Remarks"]').val(response.Requirements_Remarks);

                        $('#updateProfileForm input[name="Interview_Result"]').val(response.Interview_Result);
                        $('#updateProfileForm input[name="Endorsed"]').val(response.Endorsed);
                        $('#updateProfileForm input[name="Confirmed_Slot"]').val(response.Confirmed_Slot);
                        $('#updateProfileForm input[name="Final_Remarks"]').val(response.Final_Remarks);
                        $('#updateProfileForm input[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm input[name="nature_of_degree"]').val(response.nature_of_degree);

                        $('#updateProfileForm input[name="college"]').val(response.college);
                        $('#applicantPicture').attr('src', response.id_picture);
                        $('#updateProfileForm2 input[name="Name"]').val(response.Name);
                        $('#updateProfileForm2 input[name="Middle_Name"]').val(response.Middle_Name);
                        $('#updateProfileForm2 input[name="Last_Name"]').val(response.Last_Name);
                        $('#updateProfileForm2 input[name="applicant_number"]').val(response.applicant_number);
                        $('#updateProfileForm2 input[name="birthplace"]').val(response.birthplace);
                        $('#updateProfileForm2 select[name="gender"]').val(response.gender);
                        $('#updateProfileForm2 input[name="birthdate"]').val(response.birthdate);
                        $('#updateProfileForm2 input[name="age"]').val(response.age);
                        $('#updateProfileForm2 input[name="civil_status"]').val(response.civil_status);
                        $('#updateProfileForm2 input[name="citizenship"]').val(response.citizenship);
                        $('#updateProfileForm2 input[name="nationality"]').val(response.nationality);
                        $('#updateProfileForm input[name="Requirements_Remarks"]').val(response.Requirements_Remarks);
                        $('#updateProfileForm input[name="Requirements"]').val(response.Requirements);
                        $('#updateProfileForm2 input[name="phone_number"]').val(response.phone_number);
                        $('#updateProfileForm2 input[name="facebook"]').val(response.facebook);
                        $('#updateProfileForm2 input[name="email"]').val(response.email);
                        $('#updateProfileForm2 input[name="contact_person_1"]').val(response.contact_person_1);
                        $('#updateProfileForm2 input[name="contact_person_1_mobile"]').val(response.contact1_phone);
                        $('#updateProfileForm2 select[name="relationship_1"]').val(response.relationship_1);
                        $('#updateProfileForm2 input[name="contact_person_2"]').val(response.contact_person_2);
                        $('#updateProfileForm2 input[name="contact_person_2_mobile"]').val(response.contact_person_2_mobile);
                        $('#updateProfileForm2 select[name="relationship_2"]').val(response.relationship_2);
                        $('#updateProfileForm2 select[name="academic_classification"]').val(response.academic_classification);

                        $('#updateProfileForm2 select[name="college"]').val(response.college);
                        $('#updateProfileForm2 input[name="id"]').val(response.id);
                        $('#updateProfileForm2 input[name="high_school_name_address"]').val(response.high_school_name_address);
                        $('#updateProfileForm2 input[name="lrn"]').val(response.lrn);
                        $('#updateProfileForm2 select[name="degree_applied"]').val(response.degree_applied);
                        $('#updateProfileForm2 select[name="nature_of_degree"]').val(response.nature_of_degree);
                        var academicClassification = response.academic_classification;



                        // Show the relevant div based on academic classification
                        $('.SHS-Average,.Gr-12-Average, .ALS, .Subjects, .GWA-OTAS, .Transferee, .Gr-12, .HS-Graduate, .2nd-degree, .Remarks').hide(); // Hide all divs first
                        if (academicClassification === 'Senior High School Graduate') {
                            $('.Gr-12-Average, .Subjects,.Remarks ').show();
                        } else if (academicClassification === 'Currently enrolled as Grade 12') {
                            $('.SHS-Average, .Subjects, .Remarks').show();
                        } else if (academicClassification === 'Transferee') {
                            $('.Transferee, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'ALS/PEPT Completer') {
                            $('.ALS, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'High School (Old Curriculum) Graduate') {
                            $('.HS-Graduate, .GWA-OTAS, .Remarks').show();
                        } else if (academicClassification === 'Second Degree') {
                            $('.2nd-degree, .GWA-OTAS, .Remarks').show();
                        }

                        // Add similar logic for other form fields
                        // Display the form for editing
                        $('.todo').show();
                    },
                    error: function (error) {
                        console.error('Error fetching user data: ', error);
                    }
                });
            }
        });

        // Click event handler for the close button
        $('.close-form').click(function () {
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
            $('.confirmation-buttons button').click(function () {
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
                        success: function (response) {
                            if (response.success) {
                                // Update the status in the table cell
                                $('[data-id="' + id + '"] [data-field="appointment_status"]').text(status);
                                showToast(response.message, 'success');
                            } else {
                                showToast(response.message, 'error');
                            }
                        },
                        error: function (error) {
                            console.error('Error updating status:', error);
                        }
                    });
                }

                // Hide the confirmation dialog and overlay
                $('.confirmation-dialog').hide();
                $('.confirmation-dialog-overlay').hide();
            });
        }



        var toggleState = false; // Initial state

        document.getElementById('toggleSubjects').addEventListener('click', function () {
            var coreSubjects = document.querySelectorAll('.core_subject');
            var otherSubjects = document.querySelectorAll('.other_subject');

            if (toggleState) { // If currently showing other subjects, switch to showing core subjects
                coreSubjects.forEach(function (subject) {
                    subject.style.display = 'block';
                });

                otherSubjects.forEach(function (subject) {
                    subject.style.display = 'none';
                });

                this.textContent = "Other Subjects"; // Update text
                toggleState = false; // Update toggle state
            } else { // If currently showing core subjects, switch to showing other subjects
                coreSubjects.forEach(function (subject) {
                    subject.style.display = 'none';
                });

                otherSubjects.forEach(function (subject) {
                    subject.style.display = 'block';
                });

                this.textContent = "Show Core Subjects"; // Update text
                toggleState = true; // Update toggle state
            }
        });

        function showToast(message, type) {
            // Display a toast message
            $('#toast-body').text(message);
            $('#toast').removeClass().addClass('toast').addClass(type).addClass('show');

            // Hide the toast after a few seconds
            setTimeout(function () {
                $('#toast').removeClass('show');
            }, 3000);
        }
        document.addEventListener('DOMContentLoaded', function () {
            var successMessage = document.getElementById('successMessage');

            if (successMessage) {
                successMessage.style.display = 'block';

                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            // Add click event listener to each row
            var rows = document.querySelectorAll('.editRow');
            rows.forEach(function (row) {
                row.addEventListener('click', function () {
                    // Remove 'selected' class from all rows
                    rows.forEach(function (r) {
                        r.classList.remove('selected');
                    });

                    // Add 'selected' class to the clicked row
                    this.classList.add('selected');
                });
            });
        });
        document.getElementById('toggleSelection').addEventListener('click', function () {
            var sendButton = document.getElementById('sendButton');
            var selectColumn = document.getElementById('selectColumn');
            var checkboxes = document.querySelectorAll('.select-checkbox');

            // Toggle the visibility of sendButton, selectColumn, and checkboxes
            sendButton.style.display = sendButton.style.display === 'none' ? 'block' : 'none';
            selectColumn.style.display = selectColumn.style.display === 'none' ? 'table-cell' : 'none';

            checkboxes.forEach(function (checkbox) {
                checkbox.style.display = checkbox.style.display === 'none' ? 'block' : 'none';
            });
        });

        document.getElementById('selectAllCheckbox').addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('.select-checkbox');

            // Iterate through all checkboxes and set their checked property accordingly
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = document.getElementById('selectAllCheckbox').checked;
            });
        });
        function hideModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        document.getElementById('sendButton').addEventListener('click', function () {
            // Check if any checkboxes are checked
            var checkboxes = document.querySelectorAll('.select-checkbox:checked');
            if (checkboxes.length === 0) {
                // Show the noSelectionModal if no checkboxes are checked
                document.getElementById('noSelectionModal').style.display = 'block';
                return; // Exit the function to prevent showing the confirmation modal
            }

            // Show confirmation modal
            document.getElementById('confirmationModal').style.display = 'block';
        });

        document.getElementById('confirmSend').addEventListener('click', function () {
            // Close confirmation modal
            document.getElementById('confirmationModal').style.display = 'none';

            // Get the selected row IDs
            var selectedRowIds = [];
            var checkboxes = document.querySelectorAll('.select-checkbox:checked');
            checkboxes.forEach(function (checkbox) {
                selectedRowIds.push(checkbox.parentNode.parentNode.dataset.id);
            });

            // AJAX call to send_selected_applicants.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Show success alert
                        document.getElementById('alertMessage').innerText = 'Sent Successfully to the OSS!';
                        document.getElementById('alertModal').style.display = 'block';
                        // Hide success message after 3 seconds
                        setTimeout(function () {
                            document.getElementById('alertModal').style.display = 'none';
                        }, 3000);
                    } else {
                        // Show error alert
                        document.getElementById('alertMessage').innerText = 'Failed to send to the OSS. Please try again later.';
                        document.getElementById('alertModal').style.display = 'block';
                    }
                }
            };
            xhr.open('POST', 'send_selected_applicants.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ selectedRowIds: selectedRowIds }));
        });
        var cancelButtons = document.querySelectorAll('.cancel');
        cancelButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                document.getElementById('confirmationModal').style.display = 'none';
                document.getElementById('alertModal').style.display = 'none';
            });
        });



        // Close modals on close button click
        var closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                document.getElementById('noSelectionModal').style.display = 'none';
                document.getElementById('confirmationModal').style.display = 'none';
                document.getElementById('alertModal').style.display = 'none';
            });
        });

        // Close modals when clicking on the exit button
        var exitButtons = document.querySelectorAll('.exit');
        exitButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                hideModal(button.closest('.modal').id);
            });
        });



    </script>

    <style>
        /* Change the default background color for selected rows */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        table.dataTable tbody tr.selected,
        table.dataTable tbody tr:hover,
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_filter input:focus {
            background-color: lightgray !important;
            /* Change the default background color */
            color: #000 !important;
            /* Adjust text color to ensure visibility */
        }

        /* Default color for unsorted columns */
        th.sorting {
            color: black;
            /* Default color for unsorted columns */
        }

        /* Color for sorted columns */
        th.sorting_asc,
        th.sorting_desc {
            color: green;
            /* Color for sorted columns */
        }

        /* Optional: Custom icons for sorting arrows */
        th.sorting_asc::after {
            content: '\2191';
            /* Up arrow for ascending */
        }

        th.sorting_desc::after {
            content: '\2193';
            /* Down arrow for descending */
        }

        @media (max-width: 768px) {

            #studentTable th,
            #studentTable td {
                font-size: 18em;
                /* Reduce font size on smaller screens */
            }
        }

        /* Ensure proper text alignment */
        #studentTable th {
            text-align: center;
            /* Center-align text in table headers */
        }

        #studentTable td {
            text-align: left;
            /* Left-align text in table body */
        }

        .table-data {
            width: 100%;
            /* Occupy full width */
            overflow-x: auto;
            /* Allow horizontal scrolling for wider tables */
        }

        /* Set the DataTable's width to ensure it occupies the full width of the parent */
        #studentTable {
            width: 100%;
            /* Ensure full width on page load */
        }

        /* Adjust font size for smaller screens for better responsiveness */
        @media (max-width: 768px) {

            #studentTable th,
            #studentTable td {
                font-size: 0.8em;
                /* Smaller font on smaller screens */
            }
        }
    </style>



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