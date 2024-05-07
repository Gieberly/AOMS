<?php
include("admin_cover.php");
include("../includes/functions.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSU OUR Admission Unit Personnel</title>
    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!--DataTables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Custom CSS-->
    <link rel="icon" href="..\assets_admin\images\BSU Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="..\assets_admin\css\admin.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <!-- CONTENT -->
    <section id="content">
        <!-- MAIN -->
        <main>
            <!-- Personnel List  -->
            <div id="student-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Users</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Admin</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#top" style="text-decoration:none">Pesonnels</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Add User Modal -->
                <div class="modal fade" id="add_Staff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Personnel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="error" id="err"></p>
                            </div>
                            <form id="addStaff" method="POST">
                                <div class="modal-body">
                                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                    <div id="message" class="alert alert-success" style="display: none;"></div>
                                    <div class="form-group">
                                        <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="fname" class="form-control" placeholder="Enter First Name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Enter Email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="mr-sm-2">Select User Status</label>
                                        <select class="custom-select" name="status"> <!-- Add name attribute -->
                                            <option selected>Choose...</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="office" class="mr-sm-2">Select User Office</label>
                                        <select class="form-control" name="office"> <!-- Add name attribute -->
                                            <option selected>Choose...</option>
                                            <option value="Admin">BSU-OUR Administrator</option>
                                            <option value="Faculty">BSU-College/Faculty</option>
                                            <option value="Personnel">BSU-OUR Personnel</option>
                                            <option value="OSS">BSU-OSS</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" name="designation" class="form-control" placeholder="Enter Designation" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="add_users">Add User</button> <!-- Add name attribute -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Edit Staff Modal -->
                <div class="modal fade" id="staffEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Personnel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="error" id="err"></p>
                            </div>
                            <form id="updateStaff">
                                <div class="modal-body">
                                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                    <div id="message" class="alert alert-success" style="display: none;"></div>

                                    <input type="hidden" name="staff_id" id="staff_id">

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
                                        <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation" />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <label for="status">Select Personnel Status</label>
                                            <select class="custom-select" name="status" id="status"> <!-- Add name attribute -->
                                                <option selected>Choose...</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="office">Select Personnel Office</label>
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
                                    <button type="submit" class="btn btn-success">Update Personnel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- View Staff Modal -->
                <div class="modal fade" id="staffViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View Personnel</h5>
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
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
                                    <label for="">User Type</label>
                                    <p id="view_office" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="">Designation</label>
                                    <p id="view_designation" class="form-control"></p>
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
                                <!-- <div class="btn-group mr-2"> -->
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_Staff" style="border-radius: 20px;">
                                        <i class='bx bx-folder-plus'></i> Add Personnel
                                    </button> -->
                                <!-- </div> -->
                            </div>

                            <div id="table-container">
                                <!--staff-->
                                <table id="personnel" class="display responsive wrap " width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Email</th>
                                            <th>Created Date</th>
                                            <th>User Type</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="stafflist">
                                        <?php
                                        // Counter for numbering the staff members
                                        $counter = 1;

                                        // Display all staff members in the table
                                        $staffMembers = getAllStaff();
                                        if ($staffMembers->num_rows > 0) {
                                            while ($staff = $staffMembers->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?= $counter++; ?></td>
                                                    <td><?= $staff['last_name']; ?></td>
                                                    <td><?= $staff['name']; ?></td>
                                                    <td><?= $staff['mname']; ?></td>
                                                    <td><?= $staff['email']; ?></td>
                                                    <td><?= $staff['created_date']; ?></td>
                                                    <td><?= $staff['userType']; ?></td>
                                                    <td><?= $staff['Department']; ?></td>
                                                    <td><?= $staff['Designation']; ?></td>
                                                    <td><?= $staff['lstatus']; ?></td>
                                                    <td>
                                                        <button type="button" value="<?= $staff['id']; ?>" class="viewStaffBtn btn btn-info btn-sm">View</button>
                                                        <button type="button" value="<?= $staff['id']; ?>" class="editStaffBtn btn btn-success btn-sm">Edit</button>
                                                        <button type="button" value="<?= $staff['id']; ?>" class="deleteStaffBtn btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            // Display a message if no staff members found
                                            ?>
                                            <tr>
                                                <td colspan="10">No staff members found</td>
                                            </tr>
                                        <?php
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
    <?php include('script.php') ?>
    <script>
        $(document).on('submit', '#addStaff', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("add_staff", true);

            $.ajax({
                type: "POST",
                url: "add_user.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = JSON.parse(response);

                    if (res.status == 422) {
                        $('#error-message').text(res.message).show(); // Show error message
                        $('#message').hide(); // Hide success message
                    } else if (res.status == 200) {
                        $('#message').text(res.message).show(); // Show success message
                        $('#error-message').hide(); // Hide error message

                        // Close the modal after a delay
                        setTimeout(function() {
                            $('#add_Staff').modal('hide');
                        }, 2000); // Adjust the delay time as needed
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else if (res.status == 500) {
                        alert(res.message); // Show any other error messages
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });

        // Edit button click event listener
        $(document).on('click', '.editStaffBtn', function() {
            // Get the staff ID from the button value
            var staff_id = $(this).val();

            // AJAX request to fetch current data of the staff member
            $.ajax({
                type: "GET",
                url: "user_code.php?staff_id=" + staff_id,
                success: function(response) {
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
                        $('#dept').val(res.data.Department);
                        $('#designation').val(res.data.Designation);
                        $('#status').val(res.data.lstatus);
                        $('#office').val(res.data.userType);
                        // Show the edit modal
                        $('#staffEditModal').modal('show');
                    }
                }
            });
        });
        $(document).on('submit', '#updateStaff', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_staff", true);

            $.ajax({
                type: "POST",
                url: "user_code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = JSON.parse(response);

                    if (res.status == 422) {
                        $('#error-message').text(res.message).show(); // Show error message
                        $('#message').hide(); // Hide success message
                    } else if (res.status == 200) {
                        $('#message').text(res.message).show(); // Show success message
                        $('#error-message').hide(); // Hide error message

                        // Close the modal after a delay
                        setTimeout(function() {
                            $('#staffEditModal').modal('hide');
                        }, 2000); // Adjust the delay time as needed
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else if (res.status == 500) {
                        alert(res.message); // Show any other error messages
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });



        $(document).on('click', '.viewStaffBtn', function() {

            var staff_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "user_code.php?staff_id=" + staff_id,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#view_fname').text(res.data.name);
                        $('#view_mname').text(res.data.mname);
                        $('#view_lname').text(res.data.last_name);
                        $('#view_email').text(res.data.email);
                        $('#view_status').text(res.data.lstatus);
                        $('#view_office').text(res.data.userType);
                        $('#view_designation').text(res.data.Designation);


                        $('#staffViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteStaffBtn', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var staff_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "user_code.php",
                    data: {
                        'delete_staff': true,
                        'staff_id': staff_id
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#personnel').load(location.href + " #personnel");
                        }
                    }
                });
            }
        });

        $('#personnel').DataTable({
            responsive: true,
            columnDefs: [{
                    width: '300px',
                    targets: -1
                } // Adjust the width of the last column (action column)
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    </script>
    <!-- CONTENT -->