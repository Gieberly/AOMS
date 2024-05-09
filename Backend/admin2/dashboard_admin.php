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
$startYear = isset($_POST['start_year']) ? mysqli_real_escape_string($conn, $_POST['start_year']) : null;
$endYear = isset($_POST['end_year']) ? mysqli_real_escape_string($conn, $_POST['end_year']) : null;

// If no academic year is selected, use the first one from the dropdown
if (!$startYear || !$endYear) {
    // Get the latest admission period
    $latestPeriod = getLatestAdmissionPeriod($conn);
    if (!empty($latestPeriod)) {
        $startYear = $latestPeriod['start_year'];
        $endYear = $latestPeriod['end_year'];
    } else {
        // Handle case when no admission periods are available
        // You may set default values or handle the error accordingly
        $startYear = null;
        $endYear = null;
    }
}

// Initialize other variables with default values
$applicantsCount = countApplicants($startYear, $endYear);
$countPersonnel = countPersonnel($startYear, $endYear);
$countPending = countPersonnelPending($startYear, $endYear);
$rejectedAccounts = countRejectedAccounts($startYear, $endYear);
$countRemainingSlots = countRemainingSlots();
$countAllSlots = countALLSlots();
$countAdmitted=countALLAdmitted();
$countNotAdmitted=countNotAdmitted();
?>

<body>
        <!-- MAIN -->
        <main>
<!--Dashboard-->
            <div id="dashboard-content">
                    <div class="head-title">
                        <div class="left">
                            <h1>Dashboard</h1>
                            <ul class="breadcrumb" style="background-color:inherit">
                                <li><a href="#" style="text-decoration:none;">Dashboard</a></li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#top" style="text-decoration:none">Home</a></li>
                            </ul>                            
                        </div>
                        <!--dropdown-->
                        <div class="dropdown">
                            <a class="btn btn-success dropdown-toggle" style="border-radius: 20px;" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar'></i> Admission Period
                            </a>
                            <div class="dropdown-menu " id="admission_periods" style="border-radius: 10px;">
                                <?php generateAdmissionPeriodDropdown($conn); ?>
                            </div>
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#admissionAddModal" style="border-radius: 20px;">
                                    <i class='bx bx-folder-plus'></i> New admission
                                </button>
                            </div>
                        </div>
           
                    </div>
                    <div>
                    <!--Modal-->
                    <div class="modal fade" id="admissionAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Create New Admission Period</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="error" id="err"></p>
                                </div>
                                <form id="saveAdmission">
                                    <div class="modal-body">
                                        <div id="error-message-add" class="alert alert-danger" style="display: none;"></div>
                                        <div id="message-add" class="alert alert-success" style="display: none;"></div>

                                        <!-- Warning Message -->
                                        <div class="alert alert-warning" role="alert">
                                            Warning: Creating a new admission period will archive all previous data of all users.
                                        </div>

                                        <div class="form-group">
                                            <label >Start of Admission</label>
                                            <input type="date" class="form-control" id="start" name="start" placeholder="Enter date">
                                        </div>
                                        <div class="form-group">
                                            <label >End of Admission</label>
                                            <input type="date" class="form-control" id="end" name="end" placeholder="Enter Admission End">
                                        </div>
                                        <div class="form-group">
                                            <label >Select Semester</label>
                                            <select class="custom-select" name="sem" id="sem">
                                                <!-- Add name attribute -->
                                                <option selected>Choose...</option>
                                                <option value="1st Semester">1st Semester</option>
                                                <option value="2nd Semester">2nd Semester</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Academic Year</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="start_year" name="start_year" placeholder="YYYY">
                                                </div>
                                                -
                                                <div class="col">
                                                    <input type="text" class="form-control" id="end_year" name="end_year" placeholder="YYYY">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save Admission</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal End-->
                    <!-- Edit Staff Modal -->
                        <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <p class="error" id="err"></p>
                                        </div>
                                    <form id="updateUser">
                                        <div class="modal-body">
                                            <div id="error-message-edit" class="alert alert-danger" style="display: none;"></div>
                                            <div id="message-edit" class="alert alert-success" style="display: none;"></div>

                                            <input type="hidden" name="staff_id" id="staff_id" >

                                            <div class="mb-3">
                                                <label >First name</label>
                                                <input type="text" name="fname" id="fname" class="form-control" />
                                            </div>
                                            <div class="mb-3">
                                                <label >Middle Name</label>
                                                <input type="text" name="mname" id="mname" class="form-control" />
                                            </div>
                                            <div class="mb-3">
                                                <label >Last Name</label>
                                                <input type="text" name="lname" id="lname" class="form-control" />
                                            </div>
                                            <div class="mb-3">
                                                <label >Email</label>
                                                <input type="text" name="email" id="email" class="form-control" />
                                            </div>
                                            <div class="mb-3">
                                            <label >Department</label>
                                                <input type="text" name="dept" id="dept" class="form-control" placeholder="Enter Designation"/>
                                            </div>
                                            <div class="input-group mb-3">
                                            <label >Designation</label>
                                                <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation"/>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <label >Select Status</label>
                                                    <select class="custom-select" name="status" id="status"> <!-- Add name attribute -->
                                                        <option selected>Choose...</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label >Select Office</label>
                                                <select class="form-control" name="office" id="office"> <!-- Add name attribute -->
                                                    <option selected>Choose...</option>
                                                    <option value="Admin">BSU-OUR Administrator</option>
                                                    <option value="Faculty">BSU- Faculty/Staff</option>
                                                    <option value="Personnel">BSU-OUR Personnel</option>
                                                    <option value="OSS">BSU-OSS</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" >Update </button> 

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- Edit Staff Modal End -->
                    </div>
                    <ul class="box-info">
                        <li id="available-box">
                            <i class='bx bx-clipboard'></i>
                            <span class="text">
                                <h3 id="colleges-with-slots"><?php echo $applicantsCount; ?></h3>
                                <p>Total Applicants</p>
                            </span>
                        </li>

                        <li id="admission-box">
                            <i class='bx bxs-user-account'></i>
                            <span class="text">
                                <h3 id="admission-applicants"><?php echo $countPersonnel; ?></h3>
                                <p>Active Personnels</p>
                            </span>
                        </li>

                        <li id="admitted-box">
                            <i class='bx bx-user-check'></i>
                            <span class="text">
                            <h3 id="personnel"><?php echo $countPending; ?></h3>
                                <p>Pending Accounts</p>
                            </span>
                        </li>

                        <li id="readmitted-box">
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3 id="applicants-with-results"><?php echo $rejectedAccounts; ?></h3>
                                <p>Rejected Accounts</p>                            
                            </span>
                        </li>
                    </ul> 
                    <ul class="box-info">
                        <li id="available-box">
                            <i class='bx bx-clipboard'></i>
                            <span class="text">
                                <h3 id="colleges-with-slots"><?php echo $countRemainingSlots; ?></h3>
                                <p>Total Remaining Slots</p>
                            </span>
                        </li>

                        <li id="admission-box">
                            <i class='bx bxs-user-account'></i>
                            <span class="text">
                                <h3 id="admission-applicants"><?php echo $countAllSlots; ?></h3>
                                <p>Total Slots of all Programs</p>
                            </span>
                        </li>

                        <li id="admitted-box">
                            <i class='bx bx-user-check'></i>
                            <span class="text">
                            <h3 id="personnel"><?php echo $countAdmitted; ?></h3>
                                <p>Total of Admitted Applicants</p>
                            </span>
                        </li>

                        <li id="readmitted-box">
                            <i class='bx bxs-group'></i>
                            <span class="text">
                                <h3 id="applicants-with-results"><?php echo $countNotAdmitted; ?></h3>
                                <p>Total of Not Admitted Applicants</p>                            
                            </span>
                        </li>
                    </ul> 
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
                                    <table class="display responsive wrap" width="100%" id="courses">
                                        <!-- table header -->
                                        <h4>Pending Accounts</h4>
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
                                            $pending = getPendingAccounts();
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
                                                    <button class="approve-btn btn btn-success btn-sm" data-id="<?= $pend['id'] ?>" data-name="Approved">Approve</button>
                                                    <button class="reject-btn btn btn-danger btn-sm" data-id="<?= $pend['id'] ?>" data-name="Rejected">Reject</button>
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
                    <div class="table-data">
                        <div class="order">
                        <canvas id="applicantsChart">
                        </canvas>
                        </div>
                    </div>                <!--Table-->
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
                                    <table class="display responsive wrap " width="100%">
                                        <!-- table header -->
                                        <h4>Archive Logs</h4>
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Archive I.D</th>
                                                <th>Origin</th>
                                                <th>Archive Table</th>
                                                <th>Archive Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                            $archive = getArchiveLogs();
                                            if(mysqli_num_rows($archive )>0)
                                            {
                                                foreach($archive  as $arch){
                                                    ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?=  $arch['id']; ?></td>
                                                <td><?=  $arch['origin']; ?></td>
                                                <td><?=  $arch['archive_table']; ?></td>
                                                <td><?=  $arch['archive_datetime']; ?></td>
                                              
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
                </main>
        <!-- MAIN -->
        </section>
<?php include ('script.php')?>
<script>
$(document).ready(function() {
    $('.approve-btn, .reject-btn').click(function() {
        var id = $(this).data('id');
        var valueName = $(this).data('name');
        
        // Confirmation message
        if (confirm("Are you sure you want to update the user status?")) {
            // Proceed with the AJAX request
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: { id: id, name: valueName },
                success: function(response) {
                    console.log(response); 
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error message
                }
            });
        } else {
            // User canceled the action
            console.log("Action canceled by user.");
        }
    });
});


       // Edit button click event listener
       $(document).on('click', '.editUserBtn', function () {
    // Get the staff ID from the button value
    var staff_id = $(this).val();

    // AJAX request to fetch current data of the staff member
    $.ajax({
        type: "GET",
        url: "dashboard_code.php?staff_id=" + staff_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Populate modal fields with current data
                $('#staff_id').val(res.data.id);
                $('#fname').val(res.data.name);
                $('#mname').val(res.data.mname);
                $('#lname').val(res.data.last_name);
                $('#email').val(res.data.email);
                $('#status').val(res.data.lstatus);
                $('#office').val(res.data.userType);
                $('#dept').val(res.data.Department);
                $('#designation').val(res.data.Designation);
                // Optionally, you can also populate other fields here

                // Show the edit modal
                $('#userEditModal').modal('show');
            }
        }
    });
});
$(document).on('submit', '#updateUser', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_user", true);

    $.ajax({
        type: "POST",
        url: "dashboard_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = JSON.parse(response);

            if (res.status == 422) {
                $('#error-message-edit').text(res.message).show(); // Show error message
                $('#message-edit').hide(); // Hide success message
            } else if (res.status == 200) {
                $('#message').text(res.message).show(); // Show success message
                $('#error-message-edit').hide(); // Hide error message

                // Close the modal after a delay
                setTimeout(function () {
                    $('#userEditModal').modal('hide');
                }, 2000); // Adjust the delay time as needed
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else if (res.status == 500) {
                alert(res.message); // Show any other error messages
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
});
///Save Admission
$(document).on('submit', '#saveAdmission', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_admission", true);

    $.ajax({
        type: "POST",
        url: "create_admission.php",
        data: formData,
        processData: false,
        contentType: false,
        responsive: true,
        success: function (response) {
            console.log("Response:", response);
            var res = JSON.parse(response);
            
            console.log("Status:", res.status);
            if (res.status == 422) {
                $('#error-message-add').text(res.message);
                $('#error-message-add').show();
                $('#message-add').hide(); // Hide success message
            } else if (res.status == 200) {
                if (!res.message) { // If there is no error message
                    console.log("No error message. Closing modal...");
                    setTimeout(function() {
                        $('##saveAdmission').modal('hide'); // Close the modal after 5 seconds
                        console.log("Modal closed");
                    }, 5000); // 5 seconds timeout
                } else {
                    $('#message-add').text(res.message);
                    $('#message-add').show();
                    $('#error-message-add').hide(); // Hide error message

                    setTimeout(function() {
                        $('#saveAdmission').modal('hide'); // Close the modal after 5 seconds
                        console.log("Modal closed");
                    }, 2000);
                    
                    setTimeout(function() {
                        location.reload(); // Refresh the page
                        console.log("Page refreshed");
                    }, 3000);
                }
            } else if (res.status == 500) {
                $('#error-message-add').text(res.message);
                $('#error-message-add').show();
                $('#message-add').hide(); // Hide success message
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});



//Update Stats
    $(document).ready(function() {
    $('.academic-year').click(function() {
        var admissionPeriodId = $(this).data('id');
        updateStatistics(admissionPeriodId);
    });
});

function updateStatistics(admissionPeriodId) {
    $.ajax({
        url: 'update_statistics.php',
        method: 'POST',
        data: { admission_period_id: admissionPeriodId },
        success: function(response) {
            // Update the statistics on the UI with the returned values
            $('#colleges-with-slots').text(response.applicantsCount);
            $('#admission-applicants').text(response.countPersonnel);
            $('#personnel').text(response.countPending);
            $('#applicants-with-results').text(response.rejectedAccounts);
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

 //dataTable
 $('#courses').DataTable( {
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });
   $('#logs').DataTable( {
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });

</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>