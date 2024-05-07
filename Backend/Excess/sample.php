
<?php
include("config.php");



// Fetch courses from the programs table
$courses_query = "SELECT DISTINCT Courses FROM programs";
$courses_result = $conn->query($courses_query);

$courses = array();
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row['Courses'];
}

$colleges_query = "SELECT DISTINCT College FROM programs";
$colleges_result = $conn->query($colleges_query);

$colleges = array();
while ($row = $colleges_result->fetch_assoc()) {
    $colleges[] = $row['College'];
}

// Fetch classifications from the academicclassification table
$classifications_query = "SELECT Classification FROM academicclassification";
$classifications_result = $conn->query($classifications_query);

$classifications = array();
while ($row = $classifications_result->fetch_assoc()) {
    $classifications[] = $row['Classification'];
}

// Retrieve admission data from the database with date filter
$filterDate = isset($_GET['appointment_date']) ? $_GET['appointment_date'] : '';

if (isset($_GET['search'])) {
    $search = $_GET["search"];
    $query = "SELECT * FROM admission_data WHERE 
                ( 
                `Name` LIKE '$search' OR 
                `Middle_Name` LIKE '$search' OR 
                `Last_Name` LIKE '$search' OR 
                `applicant_number` LIKE '$search' OR 
                `academic_classification` LIKE '$search' OR 
                `email` LIKE '$search' OR 
                `Admission_Result` LIKE '$search' OR 
                `nature_of_degree` LIKE '$search' OR 
                `appointment_status` LIKE '$search' OR 
                `degree_applied` LIKE '$search'
                )
                AND (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
                AND `appointment_date` IS NOT NULL
                ORDER BY `appointment_date` ASC, `appointment_time` ASC";
} else {
    $query = "SELECT * FROM admission_data WHERE 
                (DATE(appointment_date) = '$filterDate' OR '$filterDate' = '')
                AND `appointment_date` IS NOT NULL
                ORDER BY `appointment_date` ASC, `appointment_time` ASC";
}

$result = $conn->query($query);

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

		

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
<thead>
    <tr>
        <th>#</th>
        <th>Applicant #</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Appointment Date</th>
        <th>Application Time</th>
        <th>Status</th>
        <th>Action</th>
        <th style="display: none;" id="selectColumn">
            <input type="checkbox" id="selectAllCheckbox">
        </th>
    </tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='editRow' data-id='" . $row['id'] . "' data-date='" . $row['application_date'] . "'>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . $row['applicant_number'] . "</td>";
        echo "<td>" . $row['Last_Name'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Middle_Name'] . "</td>";

        $appointmentDate = $row['appointment_date'];
        echo "<td>" . ($appointmentDate ? date('F d, Y', strtotime($appointmentDate)) : '') . "</td>";
        $appointmentTime = $row['appointment_time'];
        echo "<td>" . ($appointmentTime ? date('g:i A', strtotime($appointmentTime)) : '') . "</td>";
        echo "<td  data-field='appointment_status'>{$row['appointment_status']}</td>";
        echo "<td>
                <div class='button-container'>
                    <button type='button' class='button inc-btn' data-tooltip='Incomplete' onclick='updateStatus({$row['id']}, \"Incomplete\")'><i class='bx bxs-no-entry'></i></button>
                    <button type='button' class='button check-btn' data-tooltip='Complete' onclick='updateStatus({$row['id']}, \"Complete\")'><i class='bx bxs-check-circle'></i></button>
                </div>
              </td>";
        echo "<td id='checkbox-{$row['id']}'><input type='checkbox'style='display: none;' class='select-checkbox'></td>";
        echo "</tr>";
        $counter++;
    }
    ?>
</tbody>

					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>