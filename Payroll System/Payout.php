<?php
   session_start();
   include("confiq.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Pay Slip</title>
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
			font-size: 25px;
			color: black;
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
				<a href="View.php"><img src="images/view.png" alt="View">&nbsp;&nbsp;View Employees</a>
				<a href="Delete.php"><img src="images/delete.png" alt="Delete">&nbsp;&nbsp;Delete Employee</a>
				<hr>
				<a href="WorkTime.php"><img src="images/clock.png" alt="WorkTime">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a class="active" href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Overall Salary Report</h3>	
			<?php 	
				mysql_connect("$server", "$user_name", "$pass_word")or die("cannot connect"); 
				mysql_select_db("$dbname")or die("cannot select DB");	
				$sql = "SELECT MONTHNAME(pay_date),SUM(tax),SUM(salary*epf),SUM(final_pay) FROM history GROUP BY MONTH(pay_date)";
			
				$result=mysql_query($sql) or die("Failed SQL query");
					echo "<table>";
					while ($row = mysql_fetch_array($result)) {
						
						echo "<tr><td><b><hr>Month : </b>".$row[0]."</td></tr>"; //Show the month 
						echo "<tr><td><b>Total tax : </b> RM".$row[1]."</td></tr>"; //Show tax
						echo "<tr><td><b>Total epf : </b> RM ".$row[2]."</td></tr>"; //Shows epf
						echo "<tr><td><b>Total payout : RM </b>".$row[3]."</td></tr>"; // Shows total salary for all
					} 
			?>
			</table>
		</div>	
	</main>
</body>
</html>