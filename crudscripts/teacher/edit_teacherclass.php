<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(isset($_POST['asgn'])){
		if(isset($_POST['tchID']) and isset($_POST['classID'])){
			$classID = $_POST['classID'];
			$tchID = $_POST['tchID'];
			if (mysqli_query($conn, "INSERT INTO TeacherClass_Information VALUES ($classID, $tchID)")) {
				echo "Teacher was successfully added to class";
			}else{
				echo "Error ". mysqli_error($conn);
			}
		}
	}
	
	if(isset($_POST['unasgn'])){
		if(isset($_POST['tchID']) and isset($_POST['classID'])){
			$classID = $_POST['classID'];
			$tchID = $_POST['tchID'];
			if (mysqli_query($conn, "DELETE FROM TeacherClass_Information WHERE ClassID=$classID LIMIT 1")) {
				echo "Teacher was successfully removed from class";
			}else{
				echo "Error ". mysqli_error($conn);
			}
		}
	}
?>