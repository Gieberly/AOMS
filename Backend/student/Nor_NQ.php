<?php
session_start();
include("../config.php");

$imagePath = '../assets/images/resulthead.png';

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
$admissionData = $resultAdmission->fetch_assoc();

// Check if the Personnel_Result is NOA
if ($admissionData['Personnel_Result'] !== "NOR(Not Qualified)") {
    // Redirect the user or display an error message
    echo "You are not allowed to access this page.";
    exit;
}


// Check if the user's degree matches any entry in the `Courses` column
$degreeApplied = $admissionData['degree_applied'];
$stmtPrograms = $conn->prepare("SELECT * FROM programs WHERE Courses = ?");
$stmtPrograms->bind_param("s", $degreeApplied);
$stmtPrograms->execute();
$resultPrograms = $stmtPrograms->get_result();

// If there is a match, retrieve the corresponding College value
if ($resultPrograms->num_rows > 0) {
    $programData = $resultPrograms->fetch_assoc();
    $college = $programData['College'];
} else {
    $college = "Unknown College";
}

$stmtDate = $conn->prepare("SELECT * FROM admission_period");
$stmtDate->execute();
$dateAdmission = $stmtDate->get_result();
$admissionDate = $dateAdmission->fetch_assoc();

$pdfContent = '';

ob_start(); // Start output buffering
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Application</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="../assets/images/BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets\css\applicationformdownload.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

</head>
<style>
    .head-red {
        color: red;
        font: Verdana;
    }

    .name {

        font: arial;
    }

    .body {

        font: arial;
    }
</style>

<body onload="downloadPDF()">
    <div class="page-containerr" id="DownloadForm">
       <div class="inline-heading">
    
        <div class="head-der">
     <div class="inline-heading">
                <img src="<?php echo $imagePath; ?>" alt="Header Image" class="header-image">
            </div>
            <br>
            <h2 style="font-size: 14px">NOTICE OF RESULT (NOR)</h2>
            
            <p class="head-red">(Non-Qualifier)</p>
        </div>
       
        </div>
     
        <div style="float:right">
            <h3 style="font-size: 14px;">
                <?php
                $releaseDate = strtotime($admissionDate['result_release']);
                echo date("F j, Y", $releaseDate); // Formats the date as "Month day, year"
                ?>
                <span style="color: red;"></span>
            </h3>
        </div>
        <br>
        <div style="float:left">
            <p class="name">To:
                <strong>Mr/Ms.</strong><strong><u><?php echo htmlspecialchars($admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name']); ?></u></strong>
            </p>
        </div>
        <br><br>
        <div class="bodyLetter">
            <p>
              
                <span style="display: inline-block; margin-left: 10px;">
                    <strong>
                        Greetings</u></strong>
                    This is to notify you on the result of your application for admission to the degree program
<strong><u><?php echo htmlspecialchars($admissionData['degree_applied']); ?></u></strong> in Benguet State University (BSU) for the
                    for the <strong><?php echo htmlspecialchars($admissionDate['sem']); ?>, School Year
                        <?php echo htmlspecialchars($admissionDate['start_year']); ?> –
                        <?php echo htmlspecialchars($admissionDate['end_year']); ?></strong>. 
                </span>
            </p>
            <br>
           
<p>It is with deep regret to inform you that you did not meet the admission requirements of the University.
As such, you are advised to seek admission to other schools.</p>
<p>We wish you all the best in your endeavors. God bless.</p>
<p>Regards,</p>
            <br> 
            <div class="inquiry_contacts">
                

            <!--<p class="contact_info left"><strong>BERNADETTE BAO-IDANG</strong><br>Registrar II and Head, Admissions Unit-->
            <!--</p>-->

            <p class="contact_info left"><strong>JULIE AMADO BUASEN</strong><br>Director, Office of the University
                Registrar</p>
</div>
<br>
             <div class="head-der">
     <div class="inline-heading">
              
            </div>
            <br>
              <hr style="border-style: dashed; border-color: gray;" />
            <h2 style="font-size: 14px">REQUEST FOR ISSUANCE OF NOTICE OF ADMISSION (NOA)</h2>
            
            <p class="head-red">(Non-Qualifier)</p>
        </div>
         <h3 style="font-size: 14px;">
                <?php
                $releaseDate = strtotime($admissionDate['result_release']);
                echo date("F j, Y", $releaseDate); // Formats the date as "Month day, year"
                ?>
                <span style="color: red;"></span>
            </h3>
            <br>
                    <div class="inquiry_contacts">
                

            <!--<p class="contact_info left"><strong>BERNADETTE BAO-IDANG</strong><br>Registrar II and Head, Admissions Unit-->
            <!--</p>-->

            <p class="contact_info left"><strong>JULIE AMADO BUASEN</strong><br>Director <br>Office of the University
                Registrar</p>
                

</div>
<br>
                <p>
                    May we request for the issuance of a Notice of Admission (NOA) to </strong><strong><u><?php echo htmlspecialchars($admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name']); ?></u></strong> who is admitted to the program,for First Semester, SY 2023 – 2024. As per the evaluation of his/her academic records, the applicant
did not meet the minimum admission requirements of the University. However, upon interview of the
applicant and considering that there is available slot in the program, he/she is signifying interest to
pursue the chosen degree in the University and the College is accepting the applicant. The applicant
is also aware that he/she cannot be a beneficiary of the RA 10931 for the First Semester,School Year
                        <?php echo htmlspecialchars($admissionDate['start_year']); ?> –
                        <?php echo htmlspecialchars($admissionDate['end_year']); ?></strong>. 
                </p>
                <br><br>
                  <div class="inquiry_contacts">
                

            <p class="contact_info left"><span style="border-top: 1px solid black;">Signature over PRINTED NAME</span><br>Department Chairperson
            </p>
            
            

            <p class="contact_info right"><span style="border-top: 1px solid black;">Signature over PRINTED NAME</span><br>Dean
                Registrar</p>
</div>
        </div>
    </div>


    <style>
        .header-image {
            width:45%;
            /* Set the width to 50% of the container (page width) */
            height: auto;
            /* Allow the height to adjust proportionally */
            display: block;
            /* Ensure the image is treated as a block element */
            margin: 0 auto;
            /* Center the image horizontally */
        }

        .inquiry_contacts {
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Distribute items evenly with space between them */
        }

        .contact_info {
            flex: 1;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }
    </style>



</body>

<!-- Include html2pdf.js library from a local file -->
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script>
    function downloadPDF() {
        var element = document.getElementById("DownloadForm");
        var opt = {
            margin: 0.32,
            html2canvas: { scale: 5 },
            filename: 'NOR-NQ.pdf',
            jsPDF: { unit: 'in', format: [8.5, 13], orientation: 'portrait' },
            pagebreak: { before: '#page-containerr', avoid: '.avoid-this' }
        };
        html2pdf().set(opt).from(element).save().then(function () {
            // PDF generation completed, redirect to Transaction_page.php after 1 second
            setTimeout(function () {
                window.location.href = 'Student_Profile.php';
            }, 1000); // 1000 milliseconds = 1 second
        });
    }
</script>

</html>