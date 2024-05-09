<?php
include("../config.php");
include "../includes/functions.php";
include "../includes/fetch_data.php";
include "../template/header_admin.php";
include "../template/sidebar-admin.php";
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: ../loginpage.php");
    exit();
}
?>
<body>
        <!-- MAIN -->
        <main> 
        <!--Colleges List-->
            <div id="data-info-content">
                <div class="head-title">
                    <div class="left">
                            <h1>Archives</h1>
                            <ul class="breadcrumb" style="background-color:inherit">
                                <li><a href="#" style="text-decoration:none;">Admin</a></li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#top" style="text-decoration:none">Archives</a></li>
                            </ul>                            
                    </div>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-primary" id="retrieveDataBtn" style="border-radius: 20px;">
                            <i class='bx bxs-share'></i> Retieve all data
                        </button>
                        <button type="button" class="btn btn-danger" id="deleteDataBtn" style="border-radius: 20px;">
                        <i class='bx bxs-trash'></i> Delete All data
                        </button>
                    </div>           
                </div>
                

                <!--Table-->
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
                                <div class="table-responsive">
                                    <!-- Table for displaying student data -->
                                    <table class="display nowrap" width="100%" id="applicants">
                                        <!-- table header -->
                                        <h4>Archive Applicants</h4>
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>User Type</th>
                                                <th>Account Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                            $pending = getArchiveUsers();
                                            if(mysqli_num_rows($pending)>0)
                                            {
                                                foreach($pending as $pend){
                                                    ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?=  $pend['last_name']; ?></td>
                                                <td><?=  $pend['name']; ?></td>
                                                <td><?=  $pend['mname']; ?></td>
                                                <td><?=  $pend['email']; ?></td>
                                                <td><?=  $pend['Department']; ?></td>
                                                <td><?=  $pend['Designation']; ?></td>
                                                <td><?=  $pend['userType']; ?></td>
                                                <td><?=  $pend['lstatus']; ?></td>
                                                <td>
                                                <button type="button" value="<?=$pend['id'];?>" class="undoBtn btn btn-success btn-sm">Undo</button>
                                                <button type="button" value="<?=$pend['id'];?>" class="deleteBtn btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!--OffCanvas-->
                    <!--End of Canvass-->
                 </div>
                <!--Table-->
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
                                <div class="table-responsive">
                                    <!-- Table for displaying student data -->
                                    <table class="display nowrap" width="100%" id="personnels">
                                        <!-- table header -->
                                        <h4>Archive Personnels</h4>
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>User Type</th>
                                                <th>Account Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                            $pending = getArchivePersonnel();
                                            if(mysqli_num_rows($pending)>0)
                                            {
                                                foreach($pending as $pend){
                                                    ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?=  $pend['last_name']; ?></td>
                                                <td><?=  $pend['name']; ?></td>
                                                <td><?=  $pend['mname']; ?></td>
                                                <td><?=  $pend['email']; ?></td>
                                                <td><?=  $pend['Department']; ?></td>
                                                <td><?=  $pend['Designation']; ?></td>
                                                <td><?=  $pend['userType']; ?></td>
                                                <td><?=  $pend['lstatus']; ?></td>
                                                <td>
                                                <button type="button" value="<?=$pend['id'];?>" class="undoBtn btn btn-success btn-sm">Undo</button>
                                                <button type="button" value="<?=$pend['id'];?>" class="deleteBtn btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                 </div>
                <!--Table-->
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
                                <div class="table-responsive">
                                    <!-- Table for displaying student data -->
                                    <table class="display nowrap" width="100%" id="faculty">
                                        <!-- table header -->
                                        <h4>Archive Faculty</h4>
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>User Type</th>
                                                <th>Account Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                            $pending = getArchiveFaculty();
                                            if(mysqli_num_rows($pending)>0)
                                            {
                                                foreach($pending as $pend){
                                                    ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?=  $pend['last_name']; ?></td>
                                                <td><?=  $pend['name']; ?></td>
                                                <td><?=  $pend['mname']; ?></td>
                                                <td><?=  $pend['email']; ?></td>
                                                <td><?=  $pend['Department']; ?></td>
                                                <td><?=  $pend['Designation']; ?></td>
                                                <td><?=  $pend['userType']; ?></td>
                                                <td><?=  $pend['lstatus']; ?></td>
                                                <td>
                                                    <button type="button" value="<?=$pend['id'];?>" class="undoBtn btn btn-success btn-sm">Undo</button>
                                                    <button type="button" value="<?=$pend['id'];?>" class="deleteBtn btn btn-danger btn-sm">Delete</button>

                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                 </div>
                 <!--Table-->
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
                                <div class="table-responsive">
                                    <!-- Table for displaying student data -->
                                    <table class="display wrap" width="100%" id="masterlist">
                                        <!-- table header -->
                                        <h4>Archive Masterlist</h4>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Applicant Number</th>
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Birth Place</th>
                                                <th>College</th>
                                                <th>Program</th>
                                                <th>Grade 11 GWA</th>
                                                <th>Grade 12 GWA</th>
                                                <th>Interview Result</th>
                                                <th>OSS Admission Score</th>
                                                <th>OSS Endorsement</th>
                                                <th>Personnel Result</th>
                                                <th>Result</th>
                                                <th>Confirmation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                            $pending = getArchiveMarterList();
                                            if(mysqli_num_rows($pending)>0)
                                            {
                                                foreach($pending as $pend){
                                                    ?>
                                            <tr>
                                            <td><?= $counter++; ?></td>
                                            <td><?=  $pend['applicant_number']; ?></td>
                                            <td><?= $pend['Last_Name']; ?></td>
                                            <td><?=  $pend['Name']; ?></td>
                                            <td><?=  $pend['Middle_Name']; ?></td>
                                            <td><?=  $pend['birthplace']; ?></td>
                                            <td><?=  $pend['college']; ?></td>
                                            <td><?=  $pend['degree_applied']; ?></td>
                                            <td><?=  $pend['Gr11_GWA']; ?></td>
                                            <td><?=  $pend['Gr12_GWA']; ?></td>
                                            <td><?=  $pend['Interview_Result']; ?></td>
                                            <td><?=  $pend['OSS_Admission_Test_Score']; ?></td>
                                            <td><?= $pend['Endorsed']; ?></td>
                                            <td><?=  $pend['Personnel_Result']; ?></td>
                                            <td><?=  $pend['Admission_Result']; ?></td>
                                            <td><?=  $pend['Confirmed_Slot']; ?></td>
                                            <td>
                                                    <button type="button" value="<?=$pend['id'];?>" class="undoAppBtn btn btn-success btn-sm">Undo</button>
                                                    <button type="button" value="<?=$pend['id'];?>" class="deleteAppBtn btn btn-danger btn-sm">Delete</button>

                                                </td>
                                            </tr>
                                            <?php
                                                }
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
<?php include ('script.php')?>
<script>
     $(document).ready(function() {
        $('#deleteDataBtn').click(function() {
            $.ajax({
                url: 'delete_data.php', 
                type: 'POST',
                data: { delete: true },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); 
                    } else {
                        alert(response.message); 
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error: ' + xhr.responseText); 
                }
            });
        });
    });

 $(document).ready(function() {
        $('#retrieveDataBtn').click(function() {
            $.ajax({
                url: 'undo_archive.php', // Change to the correct PHP script file
                type: 'POST',
                data: { undo: true }, // Assuming you're using POST method and passing 'undo' parameter
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Show success message
                    } else {
                        alert(response.message); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error: ' + xhr.responseText); // Show error message
                }
            });
        });
    });

//undo individualy

$(document).ready(function() {
    $(document).on('click', '.undoBtn', function() {
        var id_to_restore = $(this).val();

        // Prompt a confirmation message
        var confirmRestore = confirm("Are you sure you want to restore this user?");

        if (confirmRestore) {
            $.ajax({
                type: "POST",
                url: "data_code.php", // Replace "your_php_file.php" with the actual filename where your PHP function is defined
                data: {
                    undo: true,
                    id_to_restore: id_to_restore
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        // Success message
                        alert(res.message);
                        location.reload(); // Reload the page after successful restoration
                    } else {
                        // Error message
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error("AJAX Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});
//undo Applicant info
$(document).ready(function() {
    $(document).on('click', '.undoAppBtn', function() {
        var id_to_restore = $(this).val();

        // Prompt a confirmation message
        var confirmRestore = confirm("Are you sure you want to restore this user?");

        if (confirmRestore) {
            $.ajax({
                type: "POST",
                url: "data_code.php", // Replace "your_php_file.php" with the actual filename where your PHP function is defined
                data: {
                    undoApp: true,
                    id_to_restore: id_to_restore
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        // Success message
                        alert(res.message);
                        location.reload(); // Reload the page after successful restoration
                    } else {
                        // Error message
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error("AJAX Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});
//delete individualy
$(document).ready(function() {
    $(document).on('click', '.deleteBtn', function() {
        var id_to_delete = $(this).val(); // Corrected variable name

        // Prompt a confirmation message
        var confirmDelete = confirm("Are you sure you want to delete this user?");

        if (confirmDelete) {
            $.ajax({
                type: "POST",
                url: "data_code.php",
                data: {
                    delete: true,
                    id_to_delete: id_to_delete // Corrected variable name
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        // Success message
                        alert(res.message);
                        location.reload();
                    } else {
                        // Error message
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error("AJAX Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});
//delete inididually applicant
$(document).ready(function() {
    $(document).on('click', '.deleteAppBtn', function() {
        var id_to_delete = $(this).val(); // Corrected variable name

        // Prompt a confirmation message
        var confirmDelete = confirm("Are you sure you want to delete this user?");

        if (confirmDelete) {
            $.ajax({
                type: "POST",
                url: "data_code.php",
                data: {
                    deleteApp: true,
                    id_to_delete: id_to_delete // Corrected variable name
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 200) {
                        // Success message
                        alert(res.message);
                        location.reload();
                    } else {
                        // Error message
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX error
                    console.error("AJAX Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });
});

//dataTable
$('#applicants').DataTable( {
    layout: {
        top1Start: {
            buttons:['colvis','excelHtml5']
        }
    },     
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });
   

   $('#personnels').DataTable( {
    layout: {
        top1Start: {
            buttons:['colvis', 'excelHtml5']
        }
    },     
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });
   
   $('#faculty').DataTable( {
    layout: {
        top1Start: {
            buttons:['colvis','excelHtml5']
        }
    },     
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });
   $('#masterlist').DataTable( {
    layout: {
        top1Start: {
            buttons:['colvis', 'excelHtml5']
        }
    },     
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
    
   });
</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>