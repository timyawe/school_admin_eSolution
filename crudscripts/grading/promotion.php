<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['tcls']!= "") {
		$tcls = trim($_POST['tcls']);
	}
	
	if ($_POST['syopt']!= "") {
		$syopt = trim($_POST['syopt']);
	}
	
	$ID = mysqli_query($conn, "SELECT ID FROM SchoolYearClass_Information WHERE SchoolYearID=$syopt AND ClassID=$tcls");
	if(mysqli_num_rows($ID)>0){
		$IDrow = mysqli_fetch_assoc($ID);
		$lastID = $IDrow['ID'];
		
		if (!empty($_POST['stdprmtdIDs'])) {
			foreach($_POST['stdprmtdIDs'] as $stdIDs){
				if(!mysqli_query($conn, "UPDATE Student_Information SET SYClassID = $lastID WHERE ID_No = $stdIDs")){
					die("<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>");
				}
				$pass = true;
			}
		}else{
			//mysqli_query($conn, "DELETE FROM SchoolYear_Information WHERE ID= $lastID LIMIT 1");
			die("<span class='alert-response-error'>Error: No Student Selected For Promotion</span>");
		}
		
		if($pass){echo "<span class='alert-response-success'>Student(s) Promoted Successfully</span>";}
	}else{
		
		if(mysqli_query($conn, "INSERT INTO SchoolYearClass_Information (SchoolYearID, ClassID) VALUES ($syopt,$tcls)")){
			//Get the inserted record
			$lastID = mysqli_insert_id($conn);
		
			if (!empty($_POST['stdprmtdIDs'])) {
				foreach($_POST['stdprmtdIDs'] as $stdIDs){
					mysqli_query($conn, "UPDATE Student_Information SET SYClassID = $lastID WHERE ID_No = $stdIDs");
				}
			}else{
				mysqli_query($conn, "DELETE FROM SchoolYear_Information WHERE ID= $lastID LIMIT 1");
				die("<span class='alert-response-error'>Error: No Student Selected For Promotion</span>");
			}
		
			echo "<span class='alert-response-success'>Student(s) Promoted Successfully</span>";
		}else {
			echo "<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>";
		}
	}
	
?>