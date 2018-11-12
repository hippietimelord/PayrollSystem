<?php
   session_start();
   include("confiq.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Work Timetable</title>
	<meta charset="UTF-8">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="nav.css">
	
	<style>
		form {
			width: 100%;
			margin: auto;
			padding: 5px 12px;
			font-family: 'Arial';
			font-size: 20px;
			color: black
		}
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
		p {
			font-family: 'Arial';
			font-size: 15px;
			padding: 5px 12px;
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
			<a style="background-color: rgba(255,255,255,0.4);"><b>Admin Management</b></a>
				<a href="Add.php"><img src="images/add.png" alt="Add">&nbsp;&nbsp;Add Employee</a>
				<a href="Edit.php"><img src="images/edit.png" alt="Edit">&nbsp;&nbsp;Edit Employee</a>
				<a href="View.php"><img src="images/view.png" alt="View">&nbsp;&nbsp;View Employee</a>
				<a href="Delete.php"><img src="images/delete.png" alt="Delete">&nbsp;&nbsp;Delete Employee</a>
				<hr>
				<a href="WorkTime.php"><img src="images/clock.png" alt="Timetable">&nbsp;&nbsp;Work Timetable</a>
				<a class="active" href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Employees Pay Slip</h3>
			<p><i>Click on the Employee ID to view pay slip.</i></p>
				<table style="border: none;text-align: left;" cellpadding="5px" cellspacing="0px" border="0">
					<?php
						if (isset($_GET['update'])) {
							$update = $_GET['update'];
							$query1 = mysqli_query($conn, "select *from employee where em_id=$update");
							$query2 = mysqli_query($conn, "select *from history where em_id=$update");

							while ($row1 = mysqli_fetch_assoc($query1)) {
								echo "<form class='form' method='get'>";
								echo "<tr><td><b>COMPANY NAME</b></tr></td>";
								echo "<tr><td>Name : {$row1['f_name']} {$row1['l_name']}</tr></td>";
								echo "<tr><td>Employee ID : {$row1['em_id']}</tr></td>";
								echo "<tr><td>Employee Title : {$row1['em_title']}</tr></td>";
								echo "<tr><td>Employee Type : {$row1['em_type']}</tr></td>";
								echo "<tr><td>Salary Type : {$row1['salary_type']}</tr></td>";
								echo "<tr><td>Phone : {$row1['phone']}</tr></td>";
							}
							while ($row2 = mysqli_fetch_assoc($query2)) {
								echo"<tr><td><b>Earnings : </b></tr></td>";
								echo"<tr><td>Worked Days : {$row2['worked_days']}</tr></td>";
								echo"<tr><td>Worked Hours : {$row2['worked_hours']}</tr></td>";
								echo"<tr><td><b>Basic Salary:</b>RM{$row2['salary']}</tr></td>";
								echo"<tr><td><b>Overtime:<b></b></tr></td>";
								echo"<tr><td>Overtime Hours : {$row2['overtime_hours']}</tr></td>";
								echo"<tr><td>Pay Per Hour:  {$row2['overtime']}</tr></td>";
								echo"<tr><td>Total : RM{$row2['total_ot']}</tr></td>";
								echo"<tr><td>Tax : {$row2['tax']}</tr></td>";
								echo"<tr><td>EPF : {$row2['epf']}</tr></td>";
								echo"<tr><td><b>Total Earnings : </b></tr></td>";
								echo"<tr><td>NET PAY : RM {$row2['final_pay']}</tr></td>";
							}
					}
					?>
				</table>
				<hr/>
				<table style="border: none;" cellpadding="5px" cellspacing="0px" border="0">
					<thead>
					<tr>      
						<th>Employee ID</th><th> </th>
						<th>Name</th>
						<th>Employee Title</th>
						<th>Employee Type</th>
						<th>Joined Date</th>
						<?php 
							$query = mysqli_query($conn,"select * from employee");
							while ($row = mysqli_fetch_assoc($query)) {
								echo "<tr><td><b><a href='PaySlip.php?update={$row['em_id']}'>{$row['em_id']}</a></b><td>";
								echo "<td>".$row['f_name']." ".$row['l_name']."</td>";
								echo "<td>".$row['em_title']."</td>";
								echo "<td>".$row['em_type']."</td>";
								echo "<td>".$row['em_joined']."</td></tr>";	
							}
						?>
					</tr>
					</thead>
					<?php
						if (isset($_GET['submit'])) {
							$em_id = $_GET['em_id'];
							$salary = $_GET["salary"];
							$worked_days= $_GET['worked_days'];
							$worked_hours=$_GET["worked_hours"];
							$overtime=$_GET["overtime"];
							$overtime_hours=$_GET["overtime_hours"];
							$epf=$_GET["epf"];
							$tax=$_GET["tax"];
							$pay_date=$_GET["pay_date"];
							$final_pay = $salary -($salary -$epf) +($overtime*$overtime_hours) - $tax; 		
							
							$sql= "INSERT INTO history(em_id,salary,worked_days,worked_hours,overtime,overtime_hours,epf,tax,pay_date,final_pay) 
								   VALUES('$em_id','$salary','$worked_days','$worked_hours','$overtime','$overtime_hours','epf','$tax','$pay_date','$final_pay')";
										
							if ($conn->query($sql) === TRUE) {
								echo "<table><tr><td>New record created successfully</td></tr></table>";
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
							$conn->close();
						}
					?>	
			</table>
		</div>
	</main>
</body>
</html>