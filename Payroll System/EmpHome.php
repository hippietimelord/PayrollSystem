<?php
   session_start();
   include("confiq.php");
   $EID=$_SESSION['eid'];
   $sql="SELECT * FROM employee where em_id='$EID'";
  // $result=$conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
		}
		td {
			font-size: 15px;
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
		table {
			font-family: 'Arial';
			font-size: 20px;
			color: black;
		}
	</style>

</head>
<body>
	<main>
		<li><img src="images/Logo.png" alt="Logo" style="width: 30px;"><b>Floof</b></li>
		<div id="left">
			<nav>
				<a class="active" href="EmpHome.php"><img src="images/users.png" alt="Profile">&nbsp;&nbsp;Employee Profile</a>
				<a href="Timetable.php"><img src="images/clock.png" alt="Timetable">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlipEmp.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Welcome  <?echo $EID?> </h3>
			<?	
				mysql_connect("$server", "$user_name", "$pass_word")or die("cannot connect"); 
				mysql_select_db("$dbname")or die("cannot select DB");		
				$sql="SELECT * FROM employee where em_id='$EID'";
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
							echo "<th>".$row[0]."</th>";
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
					echo "</td>";
					echo "</table>";
			?>	
		</div>
	</main>
</body>
</html>