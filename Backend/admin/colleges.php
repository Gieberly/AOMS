<?php
include("admin_cover.php");
include "../includes/functions.php";
include "../includes/fetch_data.php";

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
    
<section id="content">

    <!-- MAIN -->
        <main>
            <div id="data-result-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Programs</h1>
                        <ul class="breadcrumb" style="background-color:inherit">
                            <li><a href="#" style="text-decoration:none">Home</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="#" style="text-decoration:none">Programs</a></li>
                        </ul>
                                
                    </div>
                </div>
                 <!--Modal-->
                 <div class="modal fade" id="add_Course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <p class="error" id="err"></p>
                            </div>
                            <form id="addCourse" method="POST">
                                <div class="modal-body ">
                                    <div class="alert alert-warning d-none"></div>
                                    <div class="form-group ">
                                        <label for="college">College Name: </label>
                                        <input type="text" class="form-control" id="college" name="college" placeholder="Enter College Name">
                                    </div>
                                    <div class="form-group ">
                                        <label for="desc">Program Name</label>
                                        <input type="text" class="form-control" id="course" name="course" placeholder="Example: Bachelor of Science in Information technology">
                                    </div>
                                    <div class="form-group">
                                        <label for="nature">Program Nature</label>
                                        <select class="custom-select mr-sm-2" id="nature" name="nature">
                                            <option selected>Choose...</option>
                                            <option value="Board">Board</option>
                                            <option value="Non-Board">Non-Board</option>
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="">Enter Number of Students</label>
                                        <input type="text" class="form-control" id="students" name="students" placeholder="Enter number of Students">
                                    </div>
                                    <div class="form-group ">
                                        <label for="">Enter Number of Sections</label>
                                        <input type="text" class="form-control" id="sections" name="sections" placeholder="Enter number of Sections">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit"  class="btn btn-success">Add Program</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--MOdal End-->
                    <!-- Edit Staff Modal -->
                <div class="modal fade" id="programEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
                        </div>
                        <form id="updateProgram">
                            <div class="modal-body">

                                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                                <input type="hidden" name="program_id" id="program_id" >

                                <div class="mb-3">
                                    <label for="">College name</label>
                                    <input type="text" name="colleges" id="colleges" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Program Name</label>
                                    <input type="text" name="courses" id="courses" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="nature">Select Program Nature</label>
                                        <select class="custom-select" name="program_nature" id="program_nature"> <!-- Add name attribute -->
                                            <option selected>Choose...</option>
                                            <option value="Board">Board</option>
                                            <option value="Non-Board">Non-Board</option>
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Number of Sections</label>
                                    <input type="text" name="number_sections" id="number_sections" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Number of Students Per Section</label>
                                    <input type="text" name="number_students" id="number_students" class="form-control" />
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" >Update Program</button> 

                        </div>
                    </form>
                    </div>
                </div>
            </div>

                <!-- View Staff Modal -->
                <div class="modal fade" id="programViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            <p class="error" id="err"></p>
                        </div>
                        <div class="modal-body">

                            <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                            <input type="hidden" name="program_id" id="program_id" >

                                <div class="mb-3">
                                    <label for="">College name</label>
                                    <input type="text" name="college" id="view_college" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Progam Name</label>
                                    <input type="text" name="course" id="view_course" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Nature of Degree</label>
                                    <input type="text" name="nature" id="view_nature" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Available Slots</label>
                                    <input type="text" name="slots" id="view_slots" class="form-control" />
                                </div><div class="mb-3">
                                    <label for="">Remaining Slots</label>
                                    <input type="text" name="remaining_slots" id="view_remaining_slots" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Number of Admitted</label>
                                    <input type="text" name="admitted" id="view_admitted" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Number of Admitted But Not Qualified</label>
                                    <input type="text" name="not_qualified" id="view_not_qualified" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Possible Qualifier</label>
                                    <input type="text" name="possible" id="view_possible" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Not Admitted and Not Qualified</label>
                                    <input type="text" name="not_admitted" id="view_not_admitted" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Total of Not Admitted</label>
                                    <input type="text" name="not_admitted_total" id="view_not_admitted_total" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Total Applicants</label>
                                    <input type="text" name="total" id="view_total" class="form-control" />
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!--Courses List Table -->
                <div id="data-list">
                    <div class="table-data">
                        <div class="order">
                            <div class="head">
                                <div class="btn-group mr-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_Course" style="border-radius: 20px;">
                                        <i class='bx bx-folder-plus'></i> Add Progam
                                    </button>
                                </div>
                                <!--div class="btn-group mr-2" role="group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_Course" style="border-radius: 20px;">
                                        <i class='bx bx-folder-plus'></i> Add Course
                                    </button>
                                </div-->
                            </div>

                        <!--ADDEDD TABS AND CONTENTS-->
                                <div class="tab-pane fade show active" id="dataListView">
                                    <div id="table-container">                                        
                                    <table id="program" class="display responsive wrap " width="100%">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                                <th>College</th>
                                                <th>Program</th>
                                                <th>No. of Sections</th>
                                                <th>No. of students per section</th>
                                                <th>No. of Available Slots</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                            <?php
                                            // Counter for numbering the students
                                            $counter = 1;
                                        // Display all staff members in the table
                                        $programMembers = getAllDept();
                                        if(mysqli_num_rows($programMembers)>0)
                                        {
                                            foreach($programMembers as $program){
                                                ?>
 <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?=  $program['College']; ?></td>
                                                <td><?=  $program['Courses']; ?></td>
                                                <td><?=  $program['No_of_Sections']; ?></td>
                                                <td><?=  $program['No_of_Students_Per_Section']; ?></td>
                                                <td><?= $program['No_of_Sections'] * $program['No_of_Students_Per_Section']; ?></td>

                                                
                                                    <td>
                                                        <button type="button" value="<?=$program['ProgramID'];?>" class="viewProgramBtn btn btn-info btn-sm">View</button>
                                                        <button type="button" value="<?=$program['ProgramID'];?>" class="editProgramBtn btn btn-success btn-sm">Edit</button>
                                                        <button type="button" value="<?=$program['ProgramID'];?>" class="deleteProgramBtn btn btn-danger btn-sm">Delete</button>
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
                </div>
            </div>
            </main>
        <!-- MAIN -->
</section>
<?php include ('script.php')?>
<script>
        $(document).on('submit', '#addCourse', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("add_course", true);

        $.ajax({
            type: "POST",
            url: "add_courses.php",
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
                    jQuery('#add_Course').modal('hide');
                    jQuery('#addCourse')[0].reset();
                    location.reload();
                } else if(res.status == 500) {
                    alert(res.message);
                }
            }
    });

});

// Edit button click event listener
$(document).on('click', '.editProgramBtn', function () {
    // Get the faculty ID from the button value
    var program_id = $(this).val();

    // AJAX request to fetch current data of the faculty member
    $.ajax({
        type: "GET",
        url: "add_courses.php?program_id=" + program_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Populate modal fields with current data
                $('#program_id').val(res.data.ProgramID);
                $('#colleges').val(res.data.College);
                $('#courses').val(res.data.Courses);
                $('#program_nature').val(res.data.Nature_of_Degree);
                $('#number_sections').val(res.data.No_of_Sections);
                $('#number_students').val(res.data.No_of_Students_Per_Section);
                // Optionally, you can also populate other fields here

                // Show the edit modal
                $('#programEditModal').modal('show');
            }
        }        
    });
});


$(document).on('submit', '#updateProgram', function (e) {
e.preventDefault();

var formData = new FormData(this);
formData.append("update_program", true);

$.ajax({
    type: "POST",
    url: "add_courses.php",
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
            
            $('#programEditModal').modal('hide');
            $('#updateProgram')[0].reset();

            $('#program').load(location.href + " #program");

        }else if(res.status == 500) {
            alert(res.message);
        }
    }
});

});

$(document).on('click', '.viewProgramBtn', function () {

var program_id = $(this).val();
$.ajax({
    type: "GET",
    url: "add_courses.php?program_id=" +program_id,
    success: function (response) {

        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){
                // Populate modal fields with fetched data
                $('#view_college').val(res.data.College);
                $('#view_course').val(res.data.Courses);
                $('#view_nature').val(res.data.Nature_of_Degree);
                $('#view_slots').val(res.data.Number_of_Available_Slots);
                $('#view_remaining_slots').val(res.data.Remaining_Slots);
                $('#view_admitted').val(res.data.Admitted_Qualified);
                $('#view_not_qualified').val(res.data.Admitted_Not_Qualified);
                $('#view_possible').val(res.data.PQ_NB);
                $('#view_not_admitted').val(res.data.Not_Admitted_Not_Qualified);
                $('#view_not_admitted_total').val(res.data.Not_Admitted_Total);
                $('#view_total').val(res.data.Overall_Total);
                // Show the view modal
                $('#programViewModal').modal('show');
        }
    }
});
});

$(document).on('click', '.deleteProgramBtn', function (e) {
e.preventDefault();

if(confirm('Are you sure you want to delete this data?'))
{
    var program_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "add_courses.php",
        data: {
            'delete_program': true,
            'program_id': program_id
        },
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 500) {

                alert(res.message);
            }else{
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#program').load(location.href + " #program");
            }
        }
    });
}
});
//dataTable
$('#program').DataTable({
    responsive: true,
    lengthMenu: [ 
        [10, 25, 50, -1], 
        [10, 25, 50, "All"] 
    ]
});

</script>

<?php include("../template/footer.php")?>