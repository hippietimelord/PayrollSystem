<?php
    session_start();
   include("confiq.php");
   $query = mysqli_query($conn,"SELECT * FROM employee");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee</title>
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
				<a class="active" href="Edit.php"><img src="images/edit.png" alt="Edit">&nbsp;&nbsp;Edit Employee</a>
				<a href="View.php"><img src="images/view.png" alt="View">&nbsp;&nbsp;View Employee</a>
				<a href="Delete.php"><img src="images/delete.png" alt="Delete">&nbsp;&nbsp;Delete Employee</a>
				<hr>
				<a href="WorkTime.php"><img src="images/clock.png" alt="WorkTime">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Edit Employee Data</h3>
			<p><i>Click on the Employee ID to edit.</i></p>
				<table style="border: none;text-align: left;" cellpadding="5px" cellspacing="0px" border="0">
				<?php
					if (isset($_GET['update'])) {
						$update = $_GET['update'];
						$query1 = mysqli_query($conn, "select * from employee where em_id=$update");

						while ($row1 = mysqli_fetch_assoc($query1)) {
						echo "<form class='form' method='get'>";
						echo "<input class='input' type='hidden' name='em_id' value='{$row1['em_id']}' />";
						echo "<tr><td>" . "First Name :" . "</td>";
						echo "<td><input class='input' type='text' name='f_name' value='{$row1['f_name']}' /></td></tr>";
						echo "<tr><td>" . "Last Name :" . "</td>";
						echo "<td><input class='input' name='l_name' value='{$row1['l_name']}' /></td></tr>";
						echo "<tr><td>" . "Password :" . "</td>";
						echo "<td><input class='input' type='text' name='emp_pass' value='{$row1['em_pw']}' /></td></tr>";
						echo "<tr><td>" . "Address :" . "</td>";
						echo "<td><input class='input' type='text' name='emp_add' value='{$row1['address']}' /></td></tr>";
						echo "<tr><td>" . "Phone :" . "</td>";
						echo "<td><input class='input' type='tel' name='emp_phone' value='{$row1['phone']}' /></td></tr>";
						echo "<tr><td>" . "Job Type :" . "</td>";
						echo "<td><input class='input' type='text' name='emp_type' value='{$row1['em_type']}' /></td></tr>";
						echo "<tr><td>" . "Job Title :" . "</td>";
						echo "<td><input class='input' type='text' name='emp_pos' value='{$row1['em_title']}' /></td></tr>";
						echo "<tr><td>" . "Date Joined :" . "</td>";
						echo "<td><input class='input' type='date' name='emp_join' value='{$row1['em_joined']}' /></td></tr>";
						echo "<tr><td>" . "Salary Type :" . "</td>";
						echo "<td><input class='input' type='text' name='sal_type' value='{$row1['salary_type']}' /></td></tr>";
						echo "<tr><td>" . "Salary :" . "</td>";
						echo "<td><input class='input' type='text' name='salary' value='{$row1['salary']}' /></td></tr>";
						echo "<br /><br />";
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
				<table style="border: none" cellpadding="5px" cellspacing="0px" border="0">
					<thead>
						<tr>      
							<th>Employee ID</th><th></th>
							<th>Full Name</th>
							<th>Employee Title</th>
							<th>Employee Type</th>
							<th>Joined Date</th>
						</tr>
					</thead>
				<?php
				if (isset($_GET['submit'])) {
					$em_id= $_GET['em_id'];
					$f_name=$_GET["f_name"];
					$l_name=$_GET["l_name"];
					$emp_pass=$_GET["emp_pass"];
					$emp_type=$_GET["emp_type"];
					$emp_pos=$_GET["emp_pos"];
					$emp_add=$_GET["emp_add"];
					$emp_phone=$_GET["emp_phone"];
					$emp_join=$_GET["emp_join"];
					$sal_type=$_GET["sal_type"];
					$salary = $_GET["salary"];	
					
				$query = mysqli_query($conn,"UPDATE employee SET f_name='$f_name', l_name='$l_name', em_pw='$emp_pass', em_type='$emp_type', em_title='$emp_pos', address='$emp_add',phone='$emp_phone', em_joined='$emp_join', salary_type='$sal_type',salary='$salary' WHERE em_id='$em_id'");
				}

				$query = mysqli_query($conn,"select * from employee");
					while ($row = mysqli_fetch_assoc($query)) {
						echo "<tr><td><b><a href='Edit.php?update={$row['em_id']}'>{$row['em_id']}</a></b><td>";
						echo "<td>".$row['f_name']." ".$row['l_name']."</td>";
						echo "<td>".$row['em_title']."</td>";
						echo "<td>".$row['em_type']."</td>";
						echo "<td>".$row['em_joined']."</td></tr>";
					}
				?>		
				</table>
		</div>
	</main>
</body>
</html>