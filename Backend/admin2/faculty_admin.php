<?php
include("../config.php");
include("../includes/functions.php");

?>

<?php include ('../template/header_admin.php')?>

<body>
<?php include ('sidebar-admin.php')?>
    <!-- CONTENT -->
    <section id="content">
        <?php include("../template/navBar_admin.php")?>
        <!-- MAIN -->
        <main>
<!-- Faculty List  -->
<div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Faculty</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#top" style="text-decoration:none">Faculty</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="add_Faculty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
                        </div>
                        <form id="addFaculty" method="POST">
                            <div class="modal-body">
                                <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                <div id="message" class="alert alert-success" style="display: none;"></div>
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
                                    <input type="text" name="dept"  class="form-control" placeholder="Enter Department"/>
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
                                        <option value="Personnel">BSU-OUR Personnel/ Staff</option>
                                        <option value="OSS">BSU-OSS</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="department" id="department" class="form-control" placeholder="Enter Department"/>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="add_faculty">Add Faculty</button> <!-- Add name attribute -->
                            </div>
                        </form>

                        </div>
                    </div>
                </div>

                <!-- Edit Staff Modal -->
                <div class="modal fade" id="facultyEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p class="error" id="err"></p>
                        </div>
                        <form id="updateFaculty">
                            <div class="modal-body">
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                            <div id="message" class="alert alert-success" style="display: none;"></div>
                                <input type="hidden" name="faculty_id" id="faculty_id" >

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
                                <div class="mb-3">
                                    <label for="">Department</label>
                                    <input type="text" name="dept" id="dept" class="form-control" />
                                </div>
                                <div class=" mb-3">
                                    <label for="">Designation</label>
                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation"/>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <label for="status">Select User Status</label>
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
                                        <option value="Personnel">BSU-OUR Personnel/ Staff</option>
                                        <option value="OSS">BSU-OSS</option>
                                    </select>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" >Update Faculty</button> 

                        </div>
        </form>
        </div>
    </div>
</div>

                <!-- View Staff Modal -->
                <div class="modal fade" id="facultyViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
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
                                    <label for="">Department</label>
                                    <p id="view_dept" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <p id="view_status" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Office</label>
                                    <p id="view_office" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Designation</label>
                                    <p id="view_designation" class="form-control"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_Faculty" style="border-radius: 20px;">
                                        <i class='bx bx-folder-plus'></i> Add Faculty
                                    </button>
                                </div>
                            </div>

                            <div id="table-container">
                                <!--staff-->                        
                                <table id="faculty" class="display responsive wrap " width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>User Type</th>
                                            <th>Department/College</th>
                                            <th>Designation</th>
                                            <th>Email</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="facultylist">
                                    <?php
                    // Counter for numbering the students
                    $counter = 1;

                        // Display all staff members in the table
                        $facultyMembers = getAllFaculty();
                        if(mysqli_num_rows($facultyMembers)>0)
                        {
                            foreach($facultyMembers as $faculty){
                                ?>
                                <tr>
                                    <td><?= $counter++;?></td>
                                    <td><?= $faculty['last_name']; ?></td>
                                    <td><?= $faculty ['name']; ?></td>
                                    <td><?= $faculty ['mname']; ?></td>
                                    <td><?= $faculty ['userType']; ?></td>
                                    <td><?= $faculty ['Department']; ?></td>
                                    <td><?= $faculty ['Designation']; ?></td>
                                    <td><?= $faculty ['email']; ?></td>
                                    <td><?= $faculty ['created_date']; ?></td>
                                    <td><?= $faculty ['lstatus']; ?></td>

                                    <td>
                                        <button type="button" value="<?=$faculty['id'];?>" class="viewFacultyBtn btn btn-info btn-sm">View</button>
                                        <button type="button" value="<?=$faculty['id'];?>" class="editFacultyBtn btn btn-success btn-sm">Edit</button>
                                        <button type="button" value="<?=$faculty['id'];?>" class="deleteFacultyBtn btn btn-danger btn-sm">Delete</button>
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
<?php include ('profile.php')?>
<?php include ('script.php')?>
<script>
$(document).on('submit', '#addFaculty', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("add_faculty", true);
    $.ajax({
        type: "POST",
        url: "faculty_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = JSON.parse(response);
            if (res.status == 422) {
                $('#error-message').text(res.message).show(); // Show error message
                $('#message').hide(); // Hide success message
            } else if (res.status == 200) {
                $('#message').text(res.message).show(); // Show success message
                $('#error-message').hide(); // Hide error message
                // Reload the page after 2 seconds
                setTimeout(function(){
                    location.reload();
                }, 2000);
            } else if (res.status == 500) {
                alert(res.message); // Show any other error messages
            }
        },
        error: function (xhr, status, error) {
            // Handle AJAX error
            console.error("AJAX Error:", error);
            $('#error-message').text("An error occurred. Please try again.").show();
            $('#message').hide();
        }
    });
});


        // Edit button click event listener
$(document).on('click', '.editFacultyBtn', function () {
    // Get the faculty ID from the button value
    var faculty_id = $(this).val();

    // AJAX request to fetch current data of the faculty member
    $.ajax({
        type: "GET",
        url: "faculty_code.php?faculty_id=" + faculty_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Populate modal fields with current data
                $('#faculty_id').val(res.data.id);
                $('#fname').val(res.data.name);
                $('#mname').val(res.data.mname);
                $('#lname').val(res.data.last_name);
                $('#email').val(res.data.email);
                $('#dept').val(res.data.Department);
                $('#designation').val(res.data.Designation);
                $('#status').val(res.data.lstatus);
                $('#office').val(res.data.userType);
                // Optionally, you can also populate other fields here

                // Show the edit modal
                $('#facultyEditModal').modal('show');
            }
        }
    });
});

$(document).on('submit', '#updateFaculty', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_faculty", true);
    $.ajax({
        type: "POST",
        url: "faculty_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = JSON.parse(response);

            if (res.status == 422) {
                $('#error-message').text(res.message).show(); // Show error message
                $('#message').hide(); // Hide success message
            } else if (res.status == 200) {
                $('#message').text(res.message).show(); // Show success message
                $('#error-message').hide(); // Hide error message

                // Close the modal after a delay
                setTimeout(function () {
                    $('#facultyEditModal').modal('hide');
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
            console.error("AJAX Error:", error);
            $('#error-message').text("An error occurred. Please try again.").show();
            $('#message').hide();
        }
    });
});


$(document).on('click', '.viewFacultyBtn', function () {

var faculty_id = $(this).val();
$.ajax({
    type: "GET",
    url: "faculty_code.php?faculty_id=" +faculty_id,
    success: function (response) {

        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#view_fname').text(res.data.name);
            $('#view_mname').text(res.data.mname);
            $('#view_lname').text(res.data.last_name);
            $('#view_email').text(res.data.email);
            $('#view_dept').text(res.data.Department);
            $('#view_status').text(res.data.lstatus);
            $('#view_office').text(res.data.userType);
            $('#view_designation').text(res.data.Designation);

            $('#facultyViewModal').modal('show');
        }
    }
});
});

$(document).on('click', '.deleteFacultyBtn', function (e) {
e.preventDefault();

if(confirm('Are you sure you want to delete this data?'))
{
    var faculty_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "faculty_code.php",
        data: {
            'delete_student': true,
            'faculty_id': faculty_id
        },
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 500) {

                alert(res.message);
            }else{
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#faculty').load(location.href + " #faculty");
            }
        }
    });
}
});

 //dataTable
 $('#faculty').DataTable( {
    responsive: true,
    lengthMenu: [ 
        [10, 25, 50, -1], 
        [10, 25, 50, "All"] 
    ]
   });


</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>