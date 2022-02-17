<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['description']!= "") {
		$description = trim($_POST['description']);
	}
	
	if ($_POST['sdate']!= "") {
		$sdate = date("Y-m-d", strtotime(trim($_POST['sdate'])));
	}
	
	if ($_POST['edate']!= "") {
		$edate = date("Y-m-d", strtotime(trim($_POST['edate'])));
	}
	
	if(mysqli_query($conn, "INSERT INTO SchoolTerm_Information (Description, Start_Date, End_Date) VALUES ('$description','$sdate','$edate')")){
		echo "<span class='alert-response-success'>School Term was set successfully</span>";
	} else {
		echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
	}
?>