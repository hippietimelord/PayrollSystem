<?php
   session_start();
   include("confiq.php");
   $query = mysqli_query($conn,"SELECT * FROM employee");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Employee</title>
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
	<script type="text/javascript">
		function deleteConfirm(){
			var result = confirm("Are you sure to delete users?");
			if(result){
				return true;
			}else{
				return false;
			}
		}

		$(document).ready(function(){
			$('#select_all').on('click',function(){
				if(this.checked){
					$('.checkbox').each(function(){
						this.checked = true;
					});
				}else{
					 $('.checkbox').each(function(){
						this.checked = false;
					});
				}
			});
			
			$('.checkbox').on('click',function(){
				if($('.checkbox:checked').length == $('.checkbox').length){
					$('#select_all').prop('checked',true);
				}else{
					$('#select_all').prop('checked',false);
				}
			});
		});
</script>
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
				<a class="active" href="Delete.php"><img src="images/delete.png" alt="Delete">&nbsp;&nbsp;Delete Employee</a>
				<hr>
				<a href="WorkTime.php"><img src="images/clock.png" alt="WorkTime">&nbsp;&nbsp;Work Timetable</a>
				<a href="PaySlip.php"><img src="images/pay.png" alt="PaySlip">&nbsp;&nbsp;Employee Pay Slip</a>
				<a href="Payout.php"><img src="images/payout.png" alt="Payout">&nbsp;&nbsp;Overall Salary Report</a>
			<a href="logout.php"><img src="images/logout.png" alt="Logout">&nbsp;&nbsp;Log Out</a>
			</nav> 
		</div>
		
		<div id="right">
			<h3>Delete Employee Data</h3>
			<p><i>Click on the checkbox(s) to delete employee(s).</i></p>
				<form name="bulk_action_form" action="deleteAction.php" method="post" onsubmit="return deleteConfirm();"/>
					<table style="border: none" cellpadding="5px" cellspacing="0px" border="0">
						<thead>
						<tr>
							<th></th>     
							<th>Employee ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Employee Type</th>
							<th>Employee Title</th>
							<th>Joined Date</th> 
						</tr>
						</thead>
						<?php
							if(mysqli_num_rows($query) > 0){
								while($row = mysqli_fetch_assoc($query)){
						?>
						<tr>
							<td><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['em_id']; ?>"/></td>
							<td><?php echo $row['em_id']; ?></td>			
							<td><?php echo $row['f_name']; ?></td>
							<td><?php echo $row['l_name']; ?></td>
							<td><?php echo $row['em_type']; ?></td>
							<td><?php echo $row['em_title']; ?></td>
							<td><?php echo $row['em_joined']; ?></td>
						</tr> 
						<?php } }else{ ?>
							<tr><td>No records found.</td></tr> 
						<?php } ?>
					</table>
					<input type="submit" class="button" name="bulk_delete_submit" value="Delete"/>
				</form>	
		</div>
	</main>
</body>
</html>