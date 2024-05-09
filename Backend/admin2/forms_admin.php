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
                            <h1>Forms</h1>
                            <ul class="breadcrumb" style="background-color:inherit">
                                <li><a href="#" style="text-decoration:none;">Admin</a></li>
                                <li><i class='bx bx-chevron-right'></i></li>
                                <li><a class="active" href="#top" style="text-decoration:none">Forms</a></li>
                            </ul>                            
                    </div>
                        <!--dropdown-->
                        <div class="dropdown">
                            <div class="btn-group mr-2" role="group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadFile" style="border-radius: 20px;">
                                <i class='bx bx-upload' ></i> Upload New File
                                </button>
                            </div>
                        </div>           
                </div>
            </div>
                    <!--Upload File Modal-->
                <div class="modal fade bd-example-modal-lg" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Files</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                           <form id="uploadForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="classification">File Classification</label>
                                        <select class="custom-select" name="classification" id="classification">
                                            <option selected>Choose...</option>
                                            <option value="Notice of Admission">Notice of Admission</option>
                                            <option value="Notice of Results">Notice of Results</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Academic Year</label>
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
                                    <div class="form-group">
                                        <label for="sem">Semester</label>
                                        <select class="custom-select" name="sem" id="sem">
                                            <option selected>Choose...</option>
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <label for="name">File Name</label>
                                            <input type="text" name="name" id="name" class="form-control" />
                                        </div>
                                        <div class="custom-file mt-3">
                                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="file" onchange="updateFileNameLabel()">
                                            <label class="custom-file-label" for="inputGroupFile02" id="fileInputLabel">Choose file</label>
                                        </div>
                                     </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="uploadBtn">Upload Files</button>
                                </div>
                            </form>
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
                                    <table class="display responsive wrap" width="100%" id="files">
                                        <!-- table header -->
                                        <h4>Forms</h4>
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Classification</th>
                                                <th>Academic Start Year</th>
                                                <th>Academic End Year</th>
                                                <th>Semester</th>
                                                <th>File Name</th>
                                                <th>File</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                        <?php
                                        // Counter for numbering the files
                                        $counter = 1;
                                        $files = getfiles();
                                        if(mysqli_num_rows($files) > 0) {
                                            foreach($files as $fls) {
                                        ?>
                                        <tr>
                                            <td><?= $counter++;?></td>
                                            <td><?=  $fls['classification']; ?></td>
                                            <td><?=  $fls['start_year']; ?></td>
                                            <td><?=  $fls['end_year']; ?></td>
                                            <td><?=  $fls['sem']; ?></td>
                                            <td><?=  $fls['file_name']; ?></td>
                                            <td>
                                            <a href="preview_file.php?file_id=<?= $fls['id']; ?>" target="_blank">Download File</a>

                                            </td>
                                            <td>
                                                <button type="button" value="<?=$fls['id'];?>" class="deleteFileBtn btn btn-danger btn-sm">Delete</button>
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
            </div>
            </main>
        <!-- MAIN -->

</section>
<?php include ('script.php')?>
<script>
$(document).ready(function() {
    $('#uploadForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Create FormData object to send form data including files via AJAX
        var formData = new FormData(this);

        $.ajax({
            url: 'upload_files.php', // PHP script to handle form submission
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response
                console.log(response);
                alert('File uploaded successfully!');
                $('#uploadFile').modal('hide'); // Hide modal after successful upload

                // Reload the page after 3 seconds
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
$(document).on('click', '.deleteFileBtn', function (e) {
e.preventDefault();

if(confirm('This will permanently delete the file. Are you sure you want to delete this data?'))
{
    var file_id = $(this).val();
    $.ajax({
        type: "POST",
        url: "forms_code.php",
        data: {
            'delete_file': true,
            'file_id': file_id
        },
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 500) {

                alert(res.message);
            }else{
                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#files').load(location.href + " #files");
            }
        }
    });
}
});
function updateFileNameLabel() {
    var fileName = $('#inputGroupFile02').val().split('\\').pop();
    $('#fileInputLabel').text(fileName);
}
function changeFileNameLabel() {
    var fileName = $('#file').val().split('\\').pop();
    $('#fileInputLabel').text(fileName);
}


 //dataTable
 $('#files').DataTable( {
    responsive: true,
    lengthMenu: [ 
        [10, 25, 50, -1], 
        [10, 25, 50, "All"] 
    ]
   });
</script>
<!-- CONTENT -->
<?php include("../template/footer.php")?>