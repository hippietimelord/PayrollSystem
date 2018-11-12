<?php
   session_start();
   include("confiq.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<meta charset="UTF-8">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" type="text/css" href="nav.css">
	
	<style>
		form {
			width: 100%;
			margin: auto;
			padding: 5px 12px;
			text-alignment: left;
			font-family: 'Arial';
			font-size: 20px;
			color: black
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
				<a class="active" href="Add.html"><img src="images/add.png" alt="Add">&nbsp;&nbsp;Add Employee</a>
				<a href="Edit.php"><img src="images/edit.png" alt="Edit">&nbsp;&nbsp;Edit Employee</a>
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
			<h3>Add Employee Data</h3>
			<p><i>Fill in the form to add new employee.</i></p>
			<form name="Add" method="POST" action="Add.php">
				<table style="border: none" cellpadding="5px" cellspacing="0px" border="0">
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<tr><td>First Name:</td><td><input type="text" name="f_name" value="" size="30"></td></tr>
					<tr><td>Last Name:</td><td><input type="text" name="l_name" value="" size="30"></td></tr>
					<tr><td>Password (Default: pass1word):</td><td><input type="text" name="emp_pass" size="30"></td></tr>
					<tr><td>Address:</td><td><textarea name="emp_add" rows="5" cols="20"></textarea></td>
					<tr><td>Phone no.:</td><td><input type="tel" name="emp_phone" value="" size="30"></td>
					<tr><td>Job Type:</td>
						<td><select name="emp_type" required>
							<option value="Permanent">Permanent</option>
							<option value="Temporary">Temporary</option>
						</select></td>
					<tr><td>Job Title:</td><td><input type="text" name="emp_pos" value="" size="30"></td>
					<tr><td>Date Joined:</td><td><input type="date" name="emp_join" size="30"></td>
					<tr><td>Salary Type:</td>
						<td><select name="sal_type" required>
							<option value="Fixed">Fixed</option>
							<option value="Commission">Commission</option>
						</select></td>
					<tr><td>Salary:</td><td><input type="text" name="salary" value="" size="30"></td></tr>
				</tr>
				<?php 
					mysql_connect("$server", "$user_name", "$pass_word")or die("cannot connect"); 
					mysql_select_db("$dbname")or die("cannot select DB");	
					if(isset($_POST['Add']))
					{	
						//$EM_ID = $_POST["em_id"];
						$F_NAME=$_POST["f_name"];
						$L_NAME=$_POST["l_name"];
						$PASSWORD=$_POST["emp_pass"];
						$EMP_TYPE=$_POST["emp_type"];
						$EMP_POS=$_POST["emp_pos"];
						$EMP_ADD=$_POST["emp_add"];
						$EMP_PHONE=$_POST["emp_phone"];
						$EMP_JOIN=$_POST["emp_join"];
						$SALARY_TYPE=$_POST["sal_type"];
						$SALARY = $_POST["salary"];
						
						$sql= "INSERT INTO employee(f_name, l_name, em_pw, em_type, em_title, address, phone, em_joined, salary_type,salary) 
						VALUES('$F_NAME','$L_NAME','$PASSWORD','$EMP_TYPE','$EMP_POS','$EMP_ADD','$EMP_PHONE','$EMP_JOIN','$SALARY_TYPE','$SALARY')";
						
						if ($conn->query($sql) === TRUE) {
							echo "<table><tr><td><b>Data Added Successfully!</b></td></tr></table>";
						} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
						$conn->close();
					}
				?>
				<tr>
					<td colspan="4">
					<br>
					<input type="submit" class="button" name="Add" value="Add"></td>
				</tr>
				</table>
			</form>	
		</div>
	</main>
</body>
</html>