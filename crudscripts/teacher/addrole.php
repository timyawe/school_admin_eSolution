<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(!empty($_POST['role'])) {
		$checkrole = mysqli_query($conn, "SELECT * FROM Roles WHERE Description='".$_POST['role']."'");
		
		if(mysqli_num_rows($checkrole) > 0 ){
			echo "<span class='alert-response-information'>This role already exists</span>";
		} else {
			if(mysqli_query($conn, "INSERT INTO Roles (Description) VALUES ('".$_POST['role']."')")){
				echo "<span class='alert-response-success'>Role added successfully</span>";
			} else {
				echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
			}
		}
	}
?>