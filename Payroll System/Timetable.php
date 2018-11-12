<?php
   session_start();
   include("confiq.php");
   $EID=$_SESSION['eid'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Work Timetable</title>
	<meta charset="UTF-8">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="nav.css">
	
	<style>
		table {
			width: 100%;
			margin: auto;
			padding: 5px 12px;
			text-alignment: left;
			font-family: 'Arial';
			font-size: 15px;
			color: black;
			text-align: center;
		}
		h3 {
			font-size: 35px;
			color: black;
			padding: 5px 12px;
			font-family: 'Arial';
		}
		.button {
			background-color: rgb(12,206,180);
			border: none;
			color: white;
			padding: 5px 12px;
			font-family: 'Arial';
			font-size: 15px;
			text-align: right;
			font-weight: bold;
			text-decoration: none;
			display: inline-block;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<main>
		<li><img src="images/Logo.png" alt="Logo" style="width: 30px;"><b>Floof</b></li>
		<div id="left">
			<nav>
				<a href="EmpHome.php"><img src="images/users.png" alt="Profile">&nbsp;&nbsp;Employee Profile</a>
				<a class="active" href="Timetable.php"><img src="images/clock.png" alt="Timetable">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlipEmp.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Time Table</h3>
			<table style="border: none;text-align: left;" cellpadding="5px" cellspacing="0px" border="0">
			<?php	
				$query1 = mysqli_query($conn, "select *from employee where em_id='$EID'");
				while ($row1 = mysqli_fetch_assoc($query1)) {
					echo "<form class='form' method='get'>";
					echo "<tr><td><b>COMPANY NAME</b></tr></td>";
					echo "<tr><td>Name : {$row1['f_name']} {$row1['l_name']}</tr></td>";
					echo "<tr><td>Employee ID : {$row1['em_id']}</tr></td>";
					echo "<tr><td>Employee Title : {$row1['em_title']}</tr></td>";
					echo "<tr><td>Employee Type : {$row1['em_type']}</tr></td>";
					echo "<tr><td>Salary Type : {$row1['salary_type']} </label><br>";
					echo "<tr><td>Phone : {$row1['phone']} </label><br><br>";
				}
				?>
			<?php
				$query2 = mysqli_query($conn, "select * from work_hours where em_id='$EID'");
				while ($row2 = mysqli_fetch_assoc($query2)) {
					echo"<tr><td>Start Time : {$row2['start']}</tr></td>";
					echo"<tr><td>End Time : {$row2['end']}</tr></td>";
					echo"<tr><td>Annual Leave : {$row2['annualleave']}</tr></td>";
					echo "</table>";
				}	
			?>
		</div>
	</main>
</body>
</html>