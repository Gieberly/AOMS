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

// Check if the academic classification is allowed and Personnel_Result is NOA
$allowed_classifications = array(
    "Senior High School Graduate",
    "High School (Old Curriculum) Graduate",
    "Currently enrolled as Grade 12",
    "ALS/PEPT Completer"
);

if (!in_array($admissionData['academic_classification'], $allowed_classifications) || $admissionData['Personnel_Result'] !== "NOA") {
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
            <h2 style="font-size: 14px">NOTICE OF ADMISSION (NOA)</h2>
            
            <p class="head-red">(New First Year)</p>
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
            <p class="name">Dear
                <strong>Mr/Ms.</strong><strong><u><?php echo htmlspecialchars($admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name']); ?></u></strong>
            </p>
        </div>
        <br><br>
        <div class="bodyLetter">
            <p>
                <span style="font-family: Trebuchet MS; color: #00B050;">Congratulations!</span> <br>
                <span style="display: inline-block; margin-left: 10px;">
                    You are qualified to enroll at the <strong>
                        <u><?php echo htmlspecialchars($college); ?></u></strong>
                    to pursue <strong><u><?php echo htmlspecialchars($admissionData['degree_applied']); ?></u></strong>
                    for the <strong><?php echo htmlspecialchars($admissionDate['sem']); ?>, School Year
                        <?php echo htmlspecialchars($admissionDate['start_year']); ?> –
                        <?php echo htmlspecialchars($admissionDate['end_year']); ?></strong>. Here are
                    important procedures for you to follow:
                </span>
            </p>
            <br>
            <ol style="font-size: 15px;">
                <li>Prepare the following DOCUMENTARY REGISTRATION/ENROLLMENT REQUIREMENTS <strong>before the ENROLLMENT
                        PERIOD</strong>. Place all documents in a long brown envelope.</li>
                <ol type="a">
                    <li><strong> Photocopy of PSA/NSO Birth Certificate</strong>. For married females using the family
                        name/surname of the husband, submit also a photocopy of PSA Marriage Certificate (bring an
                        original copy for verification purposes)</li>
                    <li><strong>One (1) copy of your 2x2 recent formal studio-type photo</strong> (white background)
                        taken within the last two months with name tag (signature over printed name);</li>
                    <li><strong>Original Copy of Certificate of Good Moral Character</strong> from the last school
                        attended;</li>
                    <li><strong>Original Copy of Grade 12 Report Card/High School Card/Alternative Learning System (ALS)
                            Rating and Certification</strong>, whichever is applicable.</li>
                    <li><strong>BSU Medical Certificate</strong>. Schedule of physical examination at the BSU University
                        Health Services (UHS) will start on <strong style="background-color: yellow;"> <?php
                        $releaseDate = strtotime($admissionDate['clinic_sched']);
                        echo date("F j, Y", $releaseDate); // Formats the date as "Month day, year"
                        ?></strong>. It will be on a <strong>first-come-first-served basis</strong>. Only 100 students
                        will be
                        accommodated per day.</li>
                </ol>
                  <p><span style="color: red;">IMPORTANT:</span> Make sure that you have all the requirements for the processing of the medical certificate (Refer
                    to <span
                        style="color: red;">**requirements</span> indicated below) <strong>BEFORE</strong> going to the BSU-UHS.</p>

                <li>DURING the ENROLLMENT PERIOD <strong style="background-color: yellow;">(starting
                        <?php
                        $releaseDate = strtotime($admissionDate['enrollment_period']);
                        echo date("F j, Y", $releaseDate); // Formats the date as "Month day, year"
                        ?>)</strong>:

                </li>
                <ol type="a">
                    <li>Present this NOA and ALL the documentary registration requirements.<span style="color: red;">
                            Students with incomplete and
                            incorrect requirements will not be allowed to enroll.</li></span>
                    <li>Accomplish the pre-registration form and wait for your Certificate of Registration (COR) or
                        Enrollment and
                        Assessment Form (EAF) to be printed. Check details of your COR/EAF before leaving the enrollment
                        venue.
                        <span style="color: red;">IMPORTANT</span>: Changing of program/degree during the enrollment
                        period is NOT allowed.
                    </li>

                </ol>
            </ol>
            <br>
            <p><strong><u>FOR INQUIRIES:</u></strong> Contact us through our e-mail,
                <strong>registrar.admissions@bsu.edu.ph</strong>. Follow the FB Page of the
                Office of the University Registrar: <strong>https://www.facebook.com/ourbsulatrinidadcampus</strong> for
                updates and
                announcements on enrollment.</p>


            <br> 
            <div class="inquiry_contacts">
                

            <p class="contact_info left"><strong>BERNADETTE BAO-IDANG</strong><br>Registrar II and Head, Admissions Unit
            </p>

            <p class="contact_info right"><strong>JULIE AMADO BUASEN</strong><br>Director, Office of the University
                Registrar</p>
</div>
<br>
            <p><span style="color: red;">**REQUIREMENTS FOR PROCESSING OF MEDICAL CERTIFICATE (Place all requirements in
                    a long white folder)</span></p>
            <ol type="A">
                <li><strong>LABORATORY TEST RESULTS</strong>
                    <ol>
                        <li><strong>Chest X-ray taken</strong> by any <strong>authorized X-ray Laboratory
                                Facility</strong> available in your locality. <span style="font-size: 12px;"><strong><u>Detach</u> the Request for Chest X-ray
                                which is found in the lower portion of this Notice of Admission and present it to the
                                concerned X-ray laboratory personnel</strong>.</span>
                                </li>
                        <li><strong>Blood Type</strong> taken by any <strong>authorized Laboratory Facility. No
                                endorsement by the University is needed for this purpose.</strong></li>
                    </ol>
                </li>
                <li><strong>One (1) copy of your 2x2 recent formal studio-type photo</strong> (white background) taken
                    within the last two months with name tag (signature over printed name);</li>
                <li><strong>1 piece LONG White Folder</strong></li>
            </ol>
            <p style="text-align: center;"><strong>NO LABORATORY RESULTS, NO PHYSICAL EXAMINATION.</strong></p>
            <br>
            <p style="font-weight: bold; font-size: 12px;">Cut here: CHEST X-RAY: Detach this portion and give it to the
                X-ray Laboratory Personnel</p>

            <hr style="border-style: dashed; border-color: gray;" />
            <p style="font-weight: bold; color: #00B050; text-align: center;">BENGUET STATE UNIVERSITY - UNIVERSITY
                HEALTH SERVICES</p>
            <p style="font-weight: bold;  text-align: center;">Request for CHEST X-RAY (For enrollment purposes only)
            </p>

            <div style="float:right">
                <h3 style="font-size: 14px;">
                    <?php
                    $releaseDate = strtotime($admissionDate['result_release']);
                    echo date("F j, Y", $releaseDate); // Formats the date as "Month day, year"
                    ?>
                    <span style="color: red;"></span>
                </h3>
            </div>
            <p>Patient’s Name: Mr./Ms <strong><u>
                        <?php echo htmlspecialchars($admissionData['Name'] . ' ' . $admissionData['Middle_Name'] . ' ' . $admissionData['Last_Name']); ?></u>
                    </stong>
            </p>
            <p>Age: <u><?php echo htmlspecialchars($admissionData['age']); ?></u> Sex:
                <u><?php echo htmlspecialchars($admissionData['gender']); ?></u> </p>
            <br>
            <div style="text-align: right;">
                <p style="font-weight: bold;">FLORENCE V. POLTIC, M. D., MPH</p>
                <p style="font-weight: normal;">LIC # 77236; University Physician</p>
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
            margin: 0.39,
            html2canvas: { scale: 5 },
            filename: 'New First Year.pdf',
            jsPDF: { unit: 'in', format: [8.5, 13], orientation: 'portrait' },
            pagebreak: { before: '#page-containerr', avoid: '.avoid-this' }
        };
        html2pdf().set(opt).from(element).save().then(function () {
            // PDF generation completed, redirect to Transaction_page.php after 1 second
          setTimeout(function () {
                window.location.href = 'Student_Profile.php';
            }, .00000001); // 1000 milliseconds = 1 second
        });
    }
</script>

</html>