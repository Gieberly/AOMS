<?php
include("../config.php");
include("../includes/functions.php");
include ('../template/header_admin.php');

?>
<body>
<?php include ('sidebar-admin.php')?>
    <!-- CONTENT -->
    <section id="content">
        <?php include("../template/navBar_admin.php")?>
        <!-- MAIN -->
        <main>
            <div id="schedule-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Schedule</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#" style="text-decoration:none">Appointment Schedule</a></li>
                        </ul>
                    </div>

                    <div class="button-container">
                <a href="../our/AppointmentDate.php" class="btn btn-primary">
                        <i class='bx bxs-calendar calendar-icon'></i>
                        <span class="text">Set Appointment Dates</span>
                    </a>

                </div>
                </div>

                <!--COntents Here-->
                <div id="scheduled-appointment">
                    <?php
                    if(isset($_GET['msg']))
                    {
                        $msg = $_GET['msg'];
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    }
                    ?>

                    <div class="table-data">
                        <div class="order">
                            <div id="table-container">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h3 class="panel-title"></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table for displaying student data -->
                                <table class="display responsive wrap " width="100%"id="appointmentId">
                                    <!-- table header -->
                                    <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Slots</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contents">
                                        <?php
                                        // Counter for numbering the students
                                        $counter = 1;
                                        $getAppointments = getAppointments();
                                        // Loop through the results and populate the table rows
                                        if(mysqli_num_rows($getAppointments)>0){
                                            foreach($getAppointments as $app){
                                                ?>
                                                <tr>
                                                    <td><?= $counter++;?></td>
                                                    <td><?= $app['appointment_date'];?></td>
                                                    <td><?= $app['appointment_time'];?></td>
                                                    <td><?= $app['available_slots'];?></td>

                                                </tr>
                                                <?php 
                                                }
                                             }
                                        ?>                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--OffCanvas-->
                        <!--End of Canvass-->
                    </div>
                </div>
            </div>
         </main>
        <!-- MAIN -->
</section>
<?php include ('profile.php')?>
<?php include ('script.php')?>

<script>
//DataTables
    $('#appointmentId').DataTable({
    responsive: true,
});


</script>

<?php include("../template/footer.php")?>