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
        <div id="master-list-content">
            <div class="head-title">
                <div class="left">
                    <h1>Master List</h1>
                    <ul class="breadcrumb" style="background-color:inherit">
                        <li><a href="#" style="text-decoration:none">Admin</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#master-list-content" style="text-decoration:none">Masterlist</a></li>
                    </ul>
                </div>
            </div>
            <!-- View Applicant Modal -->
                <div class="modal fade" id="applicantViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">View Applicant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                <p class="error" id="err"></p>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>Application Number</label>
                                    <p id="view_num" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label >Last Name</label>
                                    <p id="view_lname" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>First Name</label>
                                    <p id="view_fname" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Birthplace</label>
                                    <p id="view_birthplace" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>College</label>
                                    <p id="view_college" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Program</label>
                                    <p id="view_program" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Grade 11 GWA</label>
                                    <p id="view_g11" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Grade 12 GWA</label>
                                    <p id="view_g12" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Interview Result</label>
                                    <p id="view_interview" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>OSS Admission Score</label>
                                    <p id="view_score" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>OSS Endorsement Slip</label>
                                    <p id="view_endorsed" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Personnel Result</label>
                                    <p id="view_personnel" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Result</label>
                                    <p id="view_result" class="form-control"></p>
                                </div>
                                <div class="mb-3">
                                <label>Confirmation</label>
                                    <p id="view_confirm" class="form-control"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Applicant Modal -->
            <div class="modal fade" id="applicantEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Personnel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="error" id="err"></p>
                                </div>
                        <form id="updateApp">
                            <div class="modal-body">
                                <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                <div id="message" class="alert alert-success" style="display: none;"></div>

                                <input type="hidden" name="app_id" id="app_id" >
                                <div class="mb-3">
                                <label for="app_num">Applicant Number</label>
                                    <input type="text" name="app_num" id="app_num" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="fname">Last name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="mname">First Name</label>
                                    <input type="text" name="mname" id="mname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="lname">Middle Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="bp">Birthplace</label>
                                    <input type="text" name="bp" id="bp" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="college">College</label>
                                    <input type="text" name="college" id="college" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="program">Degree Program</label>
                                    <input type="text" name="program" id="program" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="gr_11">Grade 11 GWA</label>
                                    <input type="text" name="gr_11" id="gr_11" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="gr_12">Grade 12 GWA</label>
                                    <input type="text" name="gr_12" id="gr_12" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label FOR="interview">Interview Result</label>
                                    <input type="text" name="interview" id="interview" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="score">Admission Exam Score</label>
                                    <input type="text" name="score" id="score" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="endorsed">OSS Endorsement</label>
                                    <input type="text" name="endorsed" id="endorsed" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="personnel">Personnel Result</label>
                                    <input type="text" name="personnel" id="personnel" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="result">Admission Result</label>
                                    <input type="text" name="result" id="result" class="form-control" />
                                </div>
                                <div class="mb-3">
                                <label for="confirm">Confirmation</label>
                                    <input type="text" name="confirm" id="confirm" class="form-control" />
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" >Update Applicant</button> 
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!--master list-->
            <div id="master-list">
            <div class="table-data">
                <div class="order">
                    <div id="table-container">
                        <!-- Table for displaying student data -->
                        <table class="display responsive wrap " width="100%" id="masterlist">
                            <!-- table header -->
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
                            <!-- table body -->
                            <tbody id="contents">
                                <?php
                                // Counter for numbering the students
                                $counter = 1;
                                if(mysqli_num_rows($studentFormData) > 0) {
                                    foreach($studentFormData as $data) {
                                ?>
                                 <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?=  $data['applicant_number']; ?></td>
                                    <td><?= $data['Last_Name']; ?></td>
                                    <td><?=  $data['Name']; ?></td>
                                    <td><?=  $data['Middle_Name']; ?></td>
                                    <td><?=  $data['birthplace']; ?></td>
                                    <td><?=  $data['college']; ?></td>
                                    <td><?=  $data['degree_applied']; ?></td>
                                    <td><?=  $data['Gr11_GWA']; ?></td>
                                    <td><?=  $data['Gr12_GWA']; ?></td>
                                    <td><?=  $data['Interview_Result']; ?></td>
                                    <td><?=  $data['OSS_Admission_Test_Score']; ?></td>
                                    <td><?=  $data['Endorsed']; ?></td>
                                    <td><?=  $data['Personnel_Result']; ?></td>
                                    <td><?=  $data['Admission_Result']; ?></td>
                                    <td><?=  $data['Confirmed_Slot']; ?></td>
                                    <td>
                                        <button type="button" value="<?=$data['id'];?>" class="viewDataBtn btn btn-primary btn-sm">View</button>
                                        <button type="button" value="<?=$data['id'];?>" class="editDataBtn btn btn-success btn-sm">Edit</button>
                                        <button type="button" value="<?=$data['id'];?>" class="deleteDataBtn btn btn-danger btn-sm">Delete</button>
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
<!--Scripts-->
<?php include ('script.php')?>
<script>
//Data TAbles
$(document).ready(function() {
    $('#masterlist').DataTable({
        layout: {
        top1Start: {
            buttons:['colvis','copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },     
    paging: true,
    scrollCollapse: true,
    scrollY: '50vh'
    });
});


//view masterlist
$(document).on('click', '.viewDataBtn', function () {

var app_id = $(this).val();
$.ajax({
    type: "GET",
    url: "masterlist_code.php?app_id=" +app_id,
    success: function (response) {

        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#view_num').text(res.data.applicant_number);
            $('#view_lname').text(res.data.Last_Name);
            $('#view_fname').text(res.data.Name);
            $('#view_mname').text(res.data.Middle_Name);
            $('#view_birthplace').text(res.data.birthplace);
            $('#view_college').text(res.data.college);
            $('#view_program').text(res.data.degree_applied);
            $('#view_g11').text(res.data.Gr11_GWA);
            $('#view_g12').text(res.data.Gr12_GWA);
            $('#view_interview').text(res.data.Interview_Result);
            $('#view_score').text(res.data.OSS_Admission_Test_Score);
            $('#view_endorsed').text(res.data.Endorsed);
            $('#view_personnel').text(res.data.Personnel_Result);
            $('#view_result').text(res.data.Admission_Result);
            $('#view_confirm').text(res.data.Confirmed_Slot);

            $('#applicantViewModal').modal('show');
        }
    }
});
});

        // Edit button click event listener
        $(document).on('click', '.editDataBtn', function () {
    // Get the staff ID from the button value
    var app_id = $(this).val();

    // AJAX request to fetch current data of the staff member
    $.ajax({
        type: "GET",
        url: "masterlist_code.php?app_id=" + app_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Populate modal fields with current data
                $('#app_id').val(res.data.id);
                $('#app_num').val(res.data.applicant_number);
                $('#lname').val(res.data.Last_Name);
                $('#fname').val(res.data.Name);
                $('#mname').val(res.data.Middle_Name);
                $('#bp').val(res.data.birthplace);
                $('#college').val(res.data.college);
                $('#rogram').val(res.data.degree_applied);
                $('#gr_11').val(res.data.Gr11_GWA);
                $('#gr_12').val(res.data.Gr12_GWA);
                $('#interview').val(res.data.Interview_Result);
                $('#score').val(res.data.OSS_Admission_Test_Score);
                $('#endorsed').val(res.data.Endorsed);
                $('#personnel').val(res.data.Personnel_Result);
                $('#result').val(res.data.Admission_Result);
                $('#confirm').val(res.data.Confirmed_Slot);

                $('#applicantEditModal').modal('show');
            }
        }
    });
});
$(document).on('submit', '#updateApp', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_app", true);

    $.ajax({
        type: "POST",
        url: "masterlist_code.php",
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
                    $('#applicantEditModal').modal('hide');
                }, 10000); // Adjust the delay time as needed
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

$(document).on('click', '.deleteDataBtn', function (e) {
e.preventDefault();

if(confirm('Are you sure you want to delete this data?'))
{
    var app_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "masterlist_code.php",
        data: {
            'delete_applicant': true,
            'app_id': app_id
        },
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 500) {

                alert(res.message);
            }else{
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#masterlist').load(location.href + " #masterlist");
            }
        }
    });
}
});

</script>

<?php include("../template/footer.php")?>