<?php

include("OSS_Cover.php");

// Fetch count of data for finished admission test
$sql_finished = "SELECT COUNT(*) AS test_count FROM admission_data WHERE oss_Message = 'sent' AND OSS_Admission_Test_Score IS NOT NULL";
$result_finished = $conn->query($sql_finished);

if ($result_finished->num_rows > 0) { 
    $row_finished = $result_finished->fetch_assoc();
    $test_count = $row_finished["test_count"];
} else {
    $test_count = 0; // Set default value if no rows found
}

// Fetch count of data for pending admission test
$sql_pending = "SELECT COUNT(*) AS pending_count FROM admission_data WHERE oss_Message = 'sent' AND OSS_Admission_Test_Score IS NULL";
$result_pending = $conn->query($sql_pending);

if ($result_pending->num_rows > 0) {
    $row_pending = $result_pending->fetch_assoc();
    $pending_count = $row_pending["pending_count"];
} else {
    $pending_count = 0; // Set default value if no rows found
}

// Calculate the total number of applicants for admission
$total_applicants = $test_count + $pending_count;
?>

<head>
    <meta charset="UTF-8">
    <title>BSU OSS</title>
</head>

<body>
    <!--User Manual-->
    <div class="overlay_oss"></div>
    <div class="box">
        <div class="close">&times;</div>
        <div class="registration-box">
          <p>OSS User Manual</p>
          <!-- Add images here -->
          <img src="assets/images/oss/1.png" alt="User's Manual">
          <img src="assets/images/oss/2.png" alt="User's Manual">
          <!-- Add more images if needed -->
            </div>
    </div>
    
    
    <section id="content">
        <main>
            <!--Dashboard-->
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="OSS_Dashboard.php">Home</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="box-info">
                    
                    <li id="admission-box">
                        <a href="OSS_Applicants.php">
                            <i class='bx bxs-group'></i>
                        </a>
                        <span class="text">
                             <h3><?php echo $total_applicants; ?></h3>
                            <p>Applicants For Admission test</p>
                        </span>
                    </li>


                    <li id="admitted-box">
    <a href="OSS_Applicants.php?filter=finished_test">
        <i class='bx bx-user-check'></i>
    </a>
    <span class="text">
        <h3><?php echo $test_count; ?></h3>
        <p>Finished Admission test</p>
    </span>
</li>


                    <li id="readmitted-box">
                         <a href="OSS_Applicants.php?filter=unfinished_test">
                            <i class='bx bxs-user-x'></i></a>
                        <span class="text">
                          <h3><?php echo $pending_count; ?></h3>
                            <p>Pending for Admission test</p>
                        </span>
                    </li>
                </ul>

            </div>






        </main>
        <!-- MAIN -->

    </section>
    
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

.overlay_oss {
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

</style>

<script>
    let overlay_oss = document.querySelector(".overlay_oss");
    let box = document.querySelector(".box");
    let close = document.querySelector(".close");

    // Show the box and overlay when the page loads if it hasn't been closed before
    window.addEventListener('DOMContentLoaded', function () {
        if (!localStorage.getItem('boxClosed')) {
            overlay_oss.style.display = "block";
            box.style.display = "block";
        }
    });

    close.addEventListener("click", () => {
        box.style.display = "none";
        overlay_oss.style.display = "none";
        localStorage.setItem('boxClosed', true); // Set item in local storage indicating the box has been closed
    });

</script>
    
</body>



</html>