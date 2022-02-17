<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['fyr']!= "") {
		$fyr = trim($_POST['fyr']);
	}
	
	if ($_POST['tyr']!= "") {
		$tyr = trim($_POST['tyr']);
	}
	
	if(mysqli_query($conn, "INSERT INTO SchoolYear_Information (FromPeriod, ToPeriod) VALUES ('$fyr','$tyr')")){
		echo "<span class='alert-response-success'>School Year was set successfully</span>";
	} else {
		echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
	}
?>