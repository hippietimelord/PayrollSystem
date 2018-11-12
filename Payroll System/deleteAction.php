<?php
	session_start();
	include("confiq.php");
	
	if(isset($_POST['bulk_delete_submit'])){
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
            mysqli_query($conn,"DELETE FROM employee WHERE em_id=".$id);
			mysqli_query($conn,"DELETE FROM history WHERE em_id=".$id);
			mysqli_query($conn,"DELETE FROM work_hours WHERE em_id=".$id);
        }
        $_SESSION['success_msg'] = 'Users have been deleted successfully.';
        header("Location:Delete.php");
    }
	
?>