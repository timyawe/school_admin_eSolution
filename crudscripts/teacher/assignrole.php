<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(isset($_POST['roleopt'])){
		$roleID = $_POST['roleopt'];
	}
	
	if(isset($_POST['clsopt'])){
		$classID = $_POST['clsopt'];
	} else{
		$classID = "NULL";
	}
	
	if(isset($_POST['tchopt'])){
		$tchID = $_POST['tchopt'];
	}
	
	if(isset($_POST['roleopt'])){
		if(mysqli_query($conn, "INSERT INTO TeacherRoles_Information (RoleID,TeacherID,ClassID) VALUES ($roleID,$tchID,$classID)")){
			echo "<span class='alert-response-success'>Role Assigned Successfully</span>";
		} else {
			echo "<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>";
		}
	}
	
?>