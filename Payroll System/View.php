<?php
   session_start();
   include("confiq.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Employee</title>
	<meta charset="UTF-8">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="nav.css">
	
	<style>
		table {
			width: 100%;
			margin: auto;
			font-family: 'Arial';
			color: black;
			border: 1px solid;
			border-collapse: collapse;
			font-size: 13px;
		}
		td {
			padding: 5px;
		}
		tr:nth-child(even) {
			background-color: white;
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
			<a style="background-color: rgba(255,255,255,0.4);"><b>Admin Management</b></a>
				<a href="Add.php"><img src="images/add.png" alt="Add">&nbsp;&nbsp;Add Employee</a>
				<a href="Edit.php"><img src="images/edit.png" alt="Edit">&nbsp;&nbsp;Edit Employee</a>
				<a class="active" href="View.php"><img src="images/view.png" alt="View">&nbsp;&nbsp;View Employee</a>
				<a href="Delete.php"><img src="images/delete.png" alt="Delete">&nbsp;&nbsp;Delete Employee</a>
				<hr>
				<a href="WorkTime.php"><img src="images/clock.png" alt="WorkTime">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>View Employee Data</h3>
			<?php 	
				mysql_connect("$server", "$user_name", "$pass_word")or die("cannot connect"); 
				mysql_select_db("$dbname")or die("cannot select DB");	
				$sql = "SELECT * FROM employee ORDER BY `employee`.`em_id` ASC";
				$result=mysql_query($sql) or die("Failed SQL query");
					echo "<table>";
					echo "<tr>
						<th>EID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Password</th>
						<th>Employee Type</th>
						<th>Employee title</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Joined Date </th>
						<th>Salary Type</th>
						<th>Salary</th></tr>";
					while ($row = mysql_fetch_array($result)) {
						echo "<tr><td>".$row[0]."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td>".$row[3]."</td>";
						echo "<td>".$row[4]."</td>";
						echo "<td>".$row[5]."</td>";
						echo "<td>".$row[6]."</td>";
						echo "<td>".$row[7]."</td>";
						echo "<td>".$row[8]."</td>";
						echo "<td>".$row[9]."</td>";
						echo "<td>".$row[10]."</td>";
						echo "\n";
					} //end while loop
				echo "</td></tr>";
				echo "</table>";
			?>	
		</div>
	</main>
</body>
</html>