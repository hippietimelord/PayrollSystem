<?php
   session_start();
   include("confiq.php");
   
   //check if submitted only run
   if(isset($_POST['submit']))
	{
	   // Connect to server and select databse.
		mysql_connect("$server", "$user_name", "$pass_word")or die("cannot connect"); 
		mysql_select_db("$dbname")or die("cannot select DB");	
	
		// username and password sent from form 
		$username= $_POST['username']; 
		$password= $_POST['password']; 
	
		// To protect MySQL injection 
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$sql="SELECT * FROM $tblname WHERE ad_username='$username' and ad_pw='$password'";
		$result=mysql_query($sql);
	
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
	
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1){
	
		// Register $myusername, $mypassword and redirect to file "login_success.php"
		$_SESSION['username']=$username;
		
		header("location:AdminHome.php");
	
		}
		else {
		$msg="Wrong input(s). Try again.";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration Log In</title>
	<meta charset="UTF-8">
	
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="background.css">
	
	<style>
		h1 {
			font-size: 65px;
			text-indent: 70px;
			color: rgb(12,206,180);
			font-family: 'Arial';
		}
		p {
			font-family: 'Arial';
			font-size: 15px;
		}
		form {
			border-radius: 15px;
			width: 350px;
			margin: auto;
			text-align: center;
			font-family: 'Arial';
			font-size: 20px;
			color: rgba(41,44,61);
			background-color: rgba(255,255,255,0.4);
		}
		.button {
			background-color: rgb(12,206,180);
			border: none;
			color: white;
			padding: 5px 12px;
			font-family: 'Arial';
			font-size: 15px;
			text-align: center;
			font-weight: bold;
			text-decoration: none;
			display: inline-block;
			cursor: pointer;
		}
		footer {
			padding: 1px 10px 1px 0px;
			background-color: rgba(255,255,255,0.4);
			position: fixed;
			clear: both;
			left: 0px;
			bottom: 0px;
			right: 0px;
		}
	</style>
</head>
<body>
	<header>
		<h1><img src="images/Logo.png" alt="Logo" style="width: 120px;">Floof</h1>
	</header>
	
	<main>
		<form action="" method="POST">
			<fieldset style="border: 0px;">
				Administration Log In<br><br>
				Username  :&nbsp;<input type="text" name="username"><br><br>
				Password  :&nbsp;<input type="password" name="password"><br>
				<br><input type="submit" name="submit" value="Log In" class="button">&nbsp;&nbsp;&nbsp;
				<p style ="color:yellow;"><? echo $msg; ?> </p>
			</fieldset>
		</form>
	</main>
	
	<footer>
		<p style="font-family: 'Arial';">&nbsp;&nbsp;&copy 2017 Floof. Created by CAFSU. All rights reserved.
		<a style="float: right;font-family: 'Arial';color: black;" href="EmpLogin.php">You can login as Employee&nbsp;&nbsp;</a></p>
	</footer>
</body>
</html>