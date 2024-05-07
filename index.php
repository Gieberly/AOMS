<?php

include("Backend/config.php");
include("cover.php");


// Define search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// If a college is clicked, get the college ID
$selectedCollege = isset($_GET['college']) ? $_GET['college'] : '';

// Fetch data from the database where Overall_Slots is not empty or zero
$sql = "SELECT * FROM programs WHERE Number_of_Available_Slots IS NOT NULL AND Number_of_Available_Slots <> 0";

// If a college is selected, filter programs by the selected college
if (!empty($selectedCollege)) {
    $sql .= " AND College = '$selectedCollege'";
}

// If search term is provided, append search criteria
if (!empty($search)) {
    $sql .= " AND (College LIKE '%$search%' OR Courses LIKE '%$search%' OR Nature_of_Degree LIKE '%$search%')";
}

$result = $conn->query($sql);

// Fetch data from the database
$combinedResults = $result->fetch_all(MYSQLI_ASSOC);

// Track displayed colleges to avoid repetition
$displayedColleges = array();

?>
<section id="content">
    
    <!-- <div class="overlay"></div>
    <div class="box">
        <div class="close">&times;</div>
        <div class="registration-box">
          <p>Student User Manual</p>
          Add images here -->
          <!-- <img src="assets/images/student/1.png" alt="User's Manual">
          <img src="assets/images/student/2.png" alt="User's Manual">
          <img src="assets/images/student/3.png" alt="User's Manual">
          <img src="assets/images/student/4.png" alt="User's Manual">
          <img src="assets/images/student/5.png" alt="User's Manual">
          <img src="assets/images/student/6.png" alt="User's Manual">
          <img src="assets/images/student/7.png" alt="User's Manual">
          <img src="assets/images/student/8.png" alt="User's Manual">
          <img src="assets/images/student/9.png" alt="User's Manual"> 
          <img src="assets/images/student/10.png" alt="User's Manual">
          <img src="assets/images/student/11.png" alt="User's Manual">
          <img src="assets/images/student/12.png" alt="User's Manual"> -->
          <!-- Add more images if needed -->
            <!-- </div> -->
    <!-- </div> --> 
    
    <main>
        <!-- Dashboard -->
        <div id="dashboard-content">
            <div class="head-title">
                <div class="left">
                    <h1>Programs</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Programs</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="index.php">Home</a></li>
                    </ul>
                </div>
            </div>

            <div id="master-list">
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>List of Available Programs Offered</h3>
                            <div class="headfornaturetosort">
                            </div>
                        </div>
                        <div id="table-container1" class="table-container1">
                            <table id="searchableTable">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>Nature of Degree</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (!empty($combinedResults)) {
                                        $count = 1;
                                        foreach ($combinedResults as $row) {
                                            $college = $row['College'];
                                            // Check if the college has already been displayed
                                            if (!in_array($college, $displayedColleges)) {
                                                echo "<tr class='college-row'><td colspan='5'><strong>{$college}</strong></td></tr>";
                                                // Add the college to the displayed array
                                                $displayedColleges[] = $college;
                                            }
                                           
                                            
                                            echo "<tr data-id='{$row['ProgramID']}' class='list-row'>";
                                           
                                            echo "<td class='editable' data-field='Courses'>{$count}. &nbsp; {$row['Courses']}</td>";
                                            echo "<td class='editable' data-field='Nature_of_Degree'>{$row['Nature_of_Degree']}</td>";
                                            // echo "<td><a href='Student_Forms.php?programID={$row['ProgramID']}&Courses={$row['Courses']}&degree={$row['Nature_of_Degree']}&college={$row['College']}' class='apply-button'>Apply</a></td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No courses found</td></tr>";
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
</section>

<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Changes Saved Successfully!</strong>
    </div>
</div>

<style>

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

.overlay {
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

 /* Scrollbar Style*/
 .table-container1::-webkit-scrollbar {
  width: 15px;
  right:0;
}

.table-container1::-webkit-scrollbar-thumb {
  background-color: #4CAF50;
  border-radius: 5px;
}
 /* Scrollbar Style */

    /* Custom styles for the toast */
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

    .apply-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 1vw;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .apply-button:hover {
        background-color: #45a049;
    }
</style>
<script>

let overlay = document.querySelector(".overlay");
    let box = document.querySelector(".box");
    let close = document.querySelector(".close");

    // Show the box and overlay when the page loads if it hasn't been closed before
    window.addEventListener('DOMContentLoaded', function () {
        if (!localStorage.getItem('boxClosed')) {
            overlay.style.display = "block";
            box.style.display = "block";
        }
    });

    close.addEventListener("click", () => {
        box.style.display = "none";
        overlay.style.display = "none";
        localStorage.setItem('boxClosed', true); // Set item in local storage indicating the box has been closed
    });

    document.addEventListener('DOMContentLoaded', function () {
// Add event listener to Apply buttons
document.querySelectorAll('.apply-button').forEach(function (button) {
    button.addEventListener('click', function () {
        var programId = this.getAttribute('data-id'); // Fix: Use 'data-id' instead of 'data-program-id'
        var college = this.getAttribute('data-college'); // Get the college attribute
        // Redirect to Student_Forms.php with the necessary parameters
        window.location.href = `Student_Forms.php?programID=${programId}&college=${college}`;
    });
});


    });
</script>
