<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(!empty($_POST['role'])) {
		$checkrole = mysqli_query($conn, "SELECT * FROM Roles WHERE Description='".$_POST['role']."'");
		
		if(mysqli_num_rows($checkrole) > 0 ){
			echo "<span class='alert-response-information'>This role already exists</span>";
		} else {
			$rolerow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Description FROM Roles WHERE ID=". $_POST['roleID']));
			$role = $rolerow['Description'];
			
			//Array to collect fields which have been edited
			$editedfields = array();
	
			if($_POST['role'] != $role){
				$editedfields['Description'] = $_POST['role'];
			}
			
			require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
			editrecord($editedfields,$conn,'Roles','ID',$_POST['roleID'],'Role');
		}
	}
	
?>