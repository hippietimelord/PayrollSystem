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
				<a class="active" href="WorkTime.php"><img src="images/clock.png" alt="Timetable">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Employee Work Timetable</h3>
			<p><i>Click on the Employee ID to edit.</i></p>
				<table style="border: none;text-align: left;" cellpadding="5px" cellspacing="0px" border="0">
					<?php
						if (isset($_GET['update'])) {
							$update = $_GET['update'];
							$query1 = mysqli_query($conn, "select *from employee where em_id=$update");

							while ($row1 = mysqli_fetch_assoc($query1)) {
								echo "<form class='form' method='get'>";
								echo "<tr><td><b>EID {$row1['em_id']} : {$row1['f_name']} {$row1['l_name']}</b></td></tr>";
								echo "<tr><td><b>Salary Type : {$row1['salary_type']}</b></td></tr>";
								echo "<tr><td><b>Salary : RM{$row1['salary']}</b></td></tr>";
								echo "<hr/>";
								echo "<input class='input' type='hidden' name='em_id' value='{$row1['em_id']}' />";
								echo "<input class='input' type='hidden' name='salary' value='{$row1['salary']}' />";
								echo "<tr><td>" . "Start :" . "</td>";
								echo "<td><input class='input' type='time' name='start'/>";
								echo "<tr><td>" . "End :" . "</td>";
								echo "<td><input class='input' type='time' name='end'/>";
								echo "<tr><td>" . "Entitled Annual leave :" . "</td>";
								echo "<td><input class='input' type='text' name='leave'/>";
								echo "<tr><td>" . "Worked Days :" . "</td>";
								echo "<td><input class='input' type='text' name='worked_days'/>";
								echo "<tr><td>" . "Worked Hours :" . "</td>";
								echo "<td><input class='input' type='text' name='worked_hours'/>";
								echo "<tr><td>" . "Overtime :" . "</td>";
								echo "<td><input class='input' type='text' name='overtime'/>";
								echo "<tr><td>" . "Overtime Hours :" . "</td>";
								echo "<td><input class='input' type='text' name='overtime_hours'/>";
								echo "<tr><td>" . "EPF :" . "</td>";
								echo "<td><input class='input' type='text' name='epf' value='0.11'/>";
								echo "<tr><td>" . "Tax Reduction :" . "</td>";
								echo "<td><input class='input' type='text' name='tax' value='0.00'/>";
								echo "<tr><td>" . "Pay Date :" . "</td>";
								echo "<td><input class='input' type='date' name='pay_date'/>";
								echo "<tr><td><input class='button' type='submit' name='submit' value='Update' /></td></tr>";
								echo "</form>";
							}
						}
						if (isset($_GET['submit'])) {
						echo '<div class="form" id="form3"><br><br><br><br><br><br>
							<span><p style="font-family: Arial; font-size: 20px;"><b>Data Updated Successfully!</b></p></span></div>';
						}
					?>	
				</table>
				<hr/>
				<table style="border: none;" cellpadding="5px" cellspacing="0px" border="0">
					<thead>
					<tr><th>Employee ID</th><th></th>
						<th>Full Name</th>
						<th>Employee Title</th>
						<th>Employee Type</th>
						<th>Joined Date</th>
						<?php 
							$query = mysqli_query($conn,"select * from employee");
							while ($row = mysqli_fetch_assoc($query)) {
								echo "<tr><td><b><a href='WorkTime.php?update={$row['em_id']}'>{$row['em_id']}</a></b><td>";
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
							$total_ot = $overtime*$overtime_hours;
							$epfamt = $salary*$epf;
							$final_pay = $salary -($epfamt) +($overtime*$overtime_hours) - $tax; 	
							$start = $_GET["start"];
							$end = $_GET["end"];
							$anual = $_GET["leave"];
							
							$sql= "INSERT INTO history(em_id,salary,worked_days,worked_hours,overtime,overtime_hours,total_ot,epf,tax,pay_date,final_pay) 
								   VALUES('$em_id','$salary','$worked_days','$worked_hours','$overtime','$overtime_hours',$total_ot,'$epf','$tax','$pay_date','$final_pay')";
								   
							$sql2 = "INSERT INTO work_hours(em_id, start, end, annualleave) VALUES ('$em_id','$start','$end','$anual')";
										
							if ($conn->query($sql) === TRUE) {
								echo "<table><tr><td>New record created successfully</td></tr></table>";
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
							if ($conn->query($sql2) === TRUE) {
								echo"";
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