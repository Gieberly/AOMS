<?php

include("Student_Cover.php");

// Retrieve the student's information from the users table
$studentId = $_SESSION['user_id'];
$stmtUser = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmtUser->bind_param("i", $studentId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$studentData = $resultUser->fetch_assoc();

// Retrieve the admission data based on the user's email
$email = $studentData['email'];
$stmtAdmission = $conn->prepare("SELECT * FROM admission_data WHERE email = ?");
$stmtAdmission->bind_param("s", $email);
$stmtAdmission->execute();
$resultAdmission = $stmtAdmission->get_result();

// Check if admission data is available
if ($resultAdmission->num_rows > 0) {
    $admissionData = $resultAdmission->fetch_assoc();

    // Display the student's and admission data
    // ... (your existing HTML code for displaying data)
} else {
    // Display a message indicating that data is not set

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Student Profile</title>

</head>

<body>
    <section id="content">

        <main>
        <div id="custom-alert_SP" class="custom-alert_SP hidden">
            <span id="alert-message_SP"></span>
        </div>

            <!--Student Profile-->
            <div id="student-profile-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Profile</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Profile</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="Student_Dashboard.php">Home</a></li>
                        </ul>
                    </div>

                </div>
                <!--profile-->
                <div id="student-profile">
                    <div class="table-data">
                        <div class="order">
                            <div class="order-profile">
                                <div class="StudentResult-Content">
                                    <div id="StudentResult-picture" class="student-picture">
                                        <?php if (!empty($admissionData) && isset($admissionData['id_picture'])) : ?>
                                            <img src="<?php echo $admissionData['id_picture']; ?>" alt="ID Picture">
                                        <?php else : ?>
                                            <p></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="result-info">
                                        <?php if (!empty($admissionData)) : ?>
                                            <div class="result-style">
                                                <p class="result-p">
                                                    <strong>Applicant Name:</strong>
                                                    <span id="result-ApplicantName" class="applicant-name">
                                                        <?php
                                                        // Check if all three name parts are set
                                                        if (isset($admissionData['Name']) && isset($admissionData['Middle_Name']) && isset($admissionData['Last_Name'])) {
                                                            echo $admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name'];
                                                        } else {
                                                            echo 'Data not set';
                                                        }
                                                        ?>
                                                        <style>
/* Style for Pending status */
.StudentStatus[data-status="Pending" ] {
    color: orange;
    cursor: pointer; /* Set cursor to pointer for hover effect */
}

/* Style for the tooltip */
.StudentStatus[data-status="Pending"]:hover::after {
    content: "Availability of results will be posted at the BSU registrar page.";
    display: block;
    position: absolute;
    background-color: black;
    color: white;
    padding: 5px;
    border-radius: 5px;
    z-index: 999; /* Ensure the tooltip is above other elements */
}

.StudentStatus[data-status="Available"]:hover::after {
    content: "Click to download result.";
    display: block;
    position: absolute;
    background-color: black;
    color: white;
    padding: 5px;
    border-radius: 5px;
    z-index: 999; /* Ensure the tooltip is above other elements */
}

/* Styles for Custom Alert */
.custom-alert_SP {
    position: fixed;
    top: 15%;
    right: 5%;
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
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="result-style">
                                                <p class="result-p">
                                                    <strong>Applicant Number:</strong>
                                                    <span id="result-ApplicantNumber" class="applicant-number">
                                                        <?php echo isset($admissionData['applicant_number']) ? $admissionData['applicant_number'] : 'Data not set'; ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="result-style">
                                                <p class="result-p">
                                                    <strong>Program:</strong>
                                                    <span id="result-Program" class="program-info">
                                                        <?php echo isset($admissionData['degree_applied']) ? $admissionData['degree_applied'] : 'Data not set'; ?>
                                                    </span>
                                                </p>
                                            </div>
                                           <div class="result-style">
        <p class="result-p">
        <strong>Status of Result:</strong>
        <?php
        $resultStatus = isset($admissionData['Student_ResultStatus']) ? $admissionData['Student_ResultStatus'] : '';
        if ($resultStatus === "Pending") {
            echo '<a href="#" id="ResultStatus" class="StudentStatus" data-status="Pending">' . $resultStatus . '</a>';
        } else {
            echo '<a href="#" id="ResultStatus" class="StudentStatus" data-status="Available">' . $resultStatus . '</a>';
        }
        ?>

        

    </p>
</div>

                                        <?php else : ?>
                                            <a class="apply-program" href="Student_Dashboard.php">CHOOSE PROGRAM</a>
                                        <?php endif; ?>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>


<script>

function showAlert_SP(message) {
      var alertElement = document.getElementById("custom-alert_SP");
      alertElement.classList.add("show");
      alertElement.classList.remove("hidden");
      document.getElementById("alert-message_SP").innerText = message;
    
      setTimeout(function() {
        alertElement.classList.remove("show");
        alertElement.classList.add("hidden");
      }, 3000);
    }


// Add data-status attribute based on the result status
document.addEventListener("DOMContentLoaded", function() {
    var studentStatus = document.getElementById("Pending");
    if (studentStatus.innerText.trim() === "Pending") {
        studentStatus.setAttribute("data-status", "Pending");
    }
});


// Add click event to the result status link
document.addEventListener("DOMContentLoaded", function() {
    var resultStatusLink = document.getElementById("ResultStatus");
    resultStatusLink.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior

        var academicClassification = '<?php echo isset($admissionData['academic_classification']) ? $admissionData['academic_classification'] : ''; ?>';
        var personnelResult = '<?php echo isset($admissionData['Personnel_Result']) ? $admissionData['Personnel_Result'] : ''; ?>';

        if (resultStatusLink.innerText.trim() === "Available") {
            if (academicClassification === "Senior High School Graduate" ||
                academicClassification === "High School (Old Curriculum) Graduate" ||
                academicClassification === "Currently enrolled as Grade 12" ||
                academicClassification === "ALS/PEPT Completer") {
                if (personnelResult === "NOA") {
                    window.location.href = "Noa_new.php"; // Redirect to Noa_new.php
                } else if (personnelResult === "NOR(Possible Qualifier)") {
                    window.location.href = "NOR-PQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Not Qualified)") {
                    window.location.href = "Nor_NQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Possible Qualifier-Non-Board)") {
                    window.location.href = "NOR_PQNB.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else {
                    showAlert_SP("Personnel result is not NOA or NOR."); // Optional: Show alert if personnel result is neither NOA nor NOR
                }
            } else if (academicClassification === "Transferee") {
                if (personnelResult === "NOA") {
                    window.location.href = "Noa_Transferee.php"; // Redirect to Noa_Transferee.php for Transferee
                } else if (personnelResult === "NOR(Possible Qualifier)") {
                    window.location.href = "NOR-PQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Not Qualified)") {
                    window.location.href = "Nor_NQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Possible Qualifier-Non-Board)") {
                    window.location.href = "NOR_PQNB.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else {
                    showAlert_SP("Personnel result is not NOA or NOR."); // Optional: Show alert if personnel result is neither NOA nor NOR
                }
            } else if (academicClassification === "Second Degree") {
                if (personnelResult === "NOA") {
                    window.location.href = "Noa_SecondDegree.php"; // Redirect to Noa_SecondDegree.php for Second Degree
                } else if (personnelResult === "NOR(Possible Qualifier)") {
                    window.location.href = "NOR-PQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Not Qualified)") {
                    window.location.href = "Nor_NQ.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else if (personnelResult === "NOR(Possible Qualifier-Non-Board)") {
                    window.location.href = "NOR_PQNB.php"; // Redirect to Nor_NQ.php if personnel result is NOR
                } else {
                    showAlert_SP("Personnel result is not NOA or NOR."); // Optional: Show alert if personnel result is neither NOA nor NOR
                }
            } else {
                showAlert_SP("Not eligible for redirection."); // Optional: Show alert if academic classification is not one of the specified
            }
        } else {
            showAlert_SP("Result is not yet available."); // Optional: Show alert if result status is not Available
        }
    });
});

                </script>
        </main>
    </section>

</body>

</html>