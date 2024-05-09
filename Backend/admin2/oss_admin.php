<?php

include("../config.php");
include "../includes/functions.php";
include "../includes/fetch_data.php";
include "../template/header_admin.php";
include "../template/sidebar-admin.php";

?>
<body>
        <!-- MAIN -->
        <main>
          <!-- Personnel List  -->
          <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Office of Student Services</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#top" style="text-decoration:none">OSS</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="add_OSS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add OSS staff</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
                        </div>
                        <form id="addOSS" method="POST">
                            <div class="modal-body">
                                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                                <div class="form-group">
                                    <input type="text" name="lname"  class="form-control" placeholder="Enter Last Name"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="fname" class="form-control" placeholder="Enter First Name"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email"  class="form-control" placeholder="Enter Email"/>
                                </div>
                                <div class="form-group">
                                <label for="status" class="mr-sm-2">Select User Status</label>
                                        <select class="custom-select" name="status" > <!-- Add name attribute -->
                                            <option selected>Choose...</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="office" class="mr-sm-2">Select User Office</label>
                                    <select class="form-control" name="office" > <!-- Add name attribute -->
                                        <option selected>Choose...</option>
                                        <option value="Admin">BSU-OUR Administrator</option>
                                        <option value="Faculty">BSU-College</option>
                                        <option value="Staff">BSU-OUR Personnel/ Staff</option>
                                        <option value="OSS">BSU-OSS</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="temp_pass" id="temp_pass" class="form-control" placeholder="Enter Temporary Password"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="add_OSS">Add User</button> <!-- Add name attribute -->
                            </div>
                        </form>

                        </div>
                    </div>
                </div>

                <!-- Edit Staff Modal -->
                <div class="modal fade" id="OSSEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit OSS Staff</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
                        </div>
                        <form id="updateOSS">
                            <div class="modal-body">

                                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="OSS_id" id="OSS_id" >

                                <div class="mb-3">
                                    <label for="">First name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Middle Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label for="office">Select User Status</label>
                                        <select class="custom-select" name="status" id="status"> <!-- Add name attribute -->
                                            <option selected>Choose...</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="office">Select User Office</label>
                                    <select class="form-control" name="office" id="office"> <!-- Add name attribute -->
                                        <option selected>Choose...</option>
                                        <option value="Admin">BSU-OUR Administrator</option>
                                        <option value="Faculty">BSU-College</option>
                                        <option value="Staff">BSU-OUR Personnel/ Staff</option>
                                        <option value="OSS">BSU-OSS</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Temporary Password"/>
                                </div>
            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" >Update OSS Staff</button> 

                        </div>
        </form>
        </div>
    </div>
</div>

                <!-- View Staff Modal -->
                <div class="modal fade" id="OSSViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View OSS Staff</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="">Last Name</label>
                                    <p id="view_lname" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">First Name</label>
                                    <p id="view_fname" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Middle Name</label>
                                    <p id="view_mname" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <p id="view_email" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <p id="view_status" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Office</label>
                                    <p id="view_office" class="form-control"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff List Table -->
                <div id="master-listpersonnel">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                            <div class="btn-group mr-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_OSS" style="border-radius: 20px;">
                                        <i class='bx bx-folder-plus'></i> Add OSS Staff
                                    </button>
                                </div>
                            </div>

                            <div id="table-container">
                                <!--staff-->                        
                                <table id="OSS" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="stafflist">
                                    <?php
                    // Counter for numbering the students
                    $counter = 1;

                        // Display all staff members in the table
                        $OSSMembers = getAllOss();
                        if(mysqli_num_rows($OSSMembers)>0)
                        {
                            foreach($OSSMembers as $OSS){
                                ?>
                                <tr>
                                    <td><?= $OSS['id'];?></td>
                                    <td><?= $OSS['last_name']; ?></td>
                                    <td><?=$OSS['name']; ?></td>
                                    <td><?= $OSS ['mname']; ?></td>
                                    <td><?= $OSS ['userType']; ?></td>
                                    <td><?= $OSS ['email']; ?></td>                                
                                    <td><?= $OSS['created_date']; ?></td>
                                    <td><?= $OSS ['lstatus']; ?></td>
                                    <td>
                                        <button type="button" value="<?=$OSS['id'];?>" class="viewOSSBtn btn btn-info btn-sm">View</button>
                                        <button type="button" value="<?=$OSS['id'];?>" class="editOSSBtn btn btn-success btn-sm">Edit</button>
                                        <button type="button" value="<?=$OSS['id'];?>" class="deleteOSSBtn btn btn-danger btn-sm">Delete</button>
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

    $(document).on('submit', '#addOSS', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("add_OSS", true);

            $.ajax({
                type: "POST",
                url: "oss_code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                
                var res = JSON.parse(response);

                if(res.status == 422) {
                    jQuery('#errorMessage').removeClass('d-none');
                    jQuery('#errorMessage').text(res.message);
                } else if(res.status == 200){
                    jQuery('#errorMessage').addClass('d-none');
                    jQuery('#addOSS').modal('hide');
                    jQuery('#addOSS')[0].reset();
                    location.reload();
                } else if(res.status == 500) {
                    alert(res.message);
                }
             }
            });

        });
        // Edit button click event listener
$(document).on('click', '.editOSSBtn', function () {
    // Get the staff ID from the button value
    var OSS_id = $(this).val();

    // AJAX request to fetch current data of the staff member
    $.ajax({
        type: "GET",
        url: "oss_code.php?OSS_id=" + OSS_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Populate modal fields with current data
                $('#OSS_id').val(res.data.id);
                $('#fname').val(res.data.name);
                $('#mname').val(res.data.mname);
                $('#lname').val(res.data.last_name);
                $('#email').val(res.data.email);
                $('#status').val(res.data.lstatus);
                $('#office').val(res.data.userType);
                // Optionally, you can also populate other fields here

                // Show the edit modal
                $('#OSSEditModal').modal('show');
            }
        }
    });
});


$(document).on('submit', '#updateOSS', function (e) {
e.preventDefault();

var formData = new FormData(this);
formData.append("update_OSS", true);

$.ajax({
    type: "POST",
    url: "oss_code.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
        
        var res = jQuery.parseJSON(response);
        if(res.status == 422) {
            $('#errorMessageUpdate').removeClass('d-none');
            $('#errorMessageUpdate').text(res.message);

        }else if(res.status == 200){

            $('#errorMessageUpdate').addClass('d-none');

            alertify.set('notifier','position', 'top-right');
            alertify.success(res.message);
            
            $('#OSSEditModal').modal('hide');
            $('#updateOSS')[0].reset();

            $('#OSS').load(location.href + " #OSS");

        }else if(res.status == 500) {
            alert(res.message);
        }
    }
});

});

$(document).on('click', '.viewOSSBtn', function () {

var OSS_id = $(this).val();
$.ajax({
    type: "GET",
    url: "oss_code.php?OSS_id=" +OSS_id,
    success: function (response) {

        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#view_fname').text(res.data.name);
            $('#view_mname').text(res.data.mname);
            $('#view_lname').text(res.data.last_name);
            $('#view_email').text(res.data.email);
            $('#view_status').text(res.data.lstatus);
            $('#view_office').text(res.data.userType);

            $('#OSSViewModal').modal('show');
        }
    }
});
});

$(document).on('click', '.deleteOSSBtn', function (e) {
e.preventDefault();

if(confirm('Are you sure you want to delete this data?'))
{
    var OSS_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "user_code.php",
        data: {
            'delete_student': true,
            'OSS_id': OSS_id
        },
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 500) {

                alert(res.message);
            }else{
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#OSS').load(location.href + " #OSS");
            }
        }
    });
}
});

        //dataTable
//dataTable
$('#OSS').DataTable( {
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
   });


</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>