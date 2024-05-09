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
        <div id="auditTrailContainer">
            <div class="head-title">
                <div class="left">
                    <h1>Audit Trail Logs</h1>
                    <ul class="breadcrumb" style="background-color:inherit">
                        <li><a href="#" style="text-decoration:none">Admin</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#master-list-content" style="text-decoration:none">Logs</a></li>
                    </ul>
                </div>
                <div class="btn-group mr-2">
                        <button type="button" class="btn btn-danger" id="deleteLogBtn" style="border-radius: 20px;">
                        <i class='bx bxs-trash'></i> Delete All data
                        </button>
                    </div> 
            </div>
            <!--master list-->
            <div id="master-list">
            <div class="table-data">
                <div class="order">
                    <div id="table-container">
                        <!-- Table for displaying student data -->
                        <table class="display responsive wrap " width="100%" id="auditTrail">
                            <!-- table header -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Timestamp</th>
                                    <th>Email</th>
                                    <th>IP Address</th>
                                    <th>User Type</th>
                                    <th>Operation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <!-- table body -->
                            <tbody id="contents">
                                <?php
                                $counter = 1;
                                $auditTrail = getAuditLogs();
                                if ($auditTrail !== false) {
                                    while ($logs = $auditTrail->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?= $logs['timestamp']; ?></td>
                                    <td><?= $logs['email']; ?></td>
                                    <td><?= $logs['ip_address']; ?></td>
                                    <td><?= $logs['userType']; ?></td>
                                    <td><?= $logs['action']; ?></td>
                                    <td>
                                    <button type="button" value="<?=$logs['id'];?>" class="deleteBtn btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Timestamp</th>
                                    <th>Email</th>
                                    <th>IP Address</th>
                                    <th>User Type</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                         </tfoot>
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
//Data Tables initialization
$(document).ready(function() {
    $('#auditTrail').DataTable({
        layout: {
        top1Start: {
            buttons:['colvis','copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
        }
    },     
    paging: true,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    scrollCollapse: true,
    scrollY: '50vh'
    });
});

// Delete all data button click event handler
$(document).on('click', '#deleteLogBtn', function (e) {
    e.preventDefault();

    if (confirm('Are you sure you want to delete all data?')) {
        $.ajax({
            type: "POST",
            url: "audit_code.php",
            data: {
                'delete_all_logs': true
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                    alert(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);
                    fetchAndDisplayAuditLogs(); 
                }
            }
        });
    }
});

// Delete button click event handler
$(document).on('click', '.deleteBtn', function (e) {
    e.preventDefault();

    if (confirm('Are you sure you want to delete this data?')) {
        var log_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "audit_code.php",
            data: {
                'delete_log': true,
                'log_id': log_id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 500) {
                    alert(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);
                    fetchAndDisplayAuditLogs(); 
                }
            }
        });
    }
});
function fetchAndDisplayAuditLogs() {
    $.ajax({
        url: 'record_log.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#contents').empty();
            data.reverse();
            $.each(data, function (index, logs) {
                $('#contents').append(
                    '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + logs.timestamp + '</td>' +
                    '<td>' + logs.email + '</td>' +
                    '<td>' + logs.ip_address + '</td>' +
                    '<td>' + logs.userType + '</td>' +
                    '<td>' + logs.action + '</td>' +
                    '<td>' +
                    '<button type="button" value="' + logs.id + '" class="deleteBtn btn btn-danger btn-sm">Delete</button>' +
                    '</td>' +
                    '</tr>'
                );
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}
fetchAndDisplayAuditLogs();
setInterval(fetchAndDisplayAuditLogs, 5000);
</script>

<?php include("../template/footer.php")?>