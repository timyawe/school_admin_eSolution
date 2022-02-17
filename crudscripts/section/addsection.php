<?php
if(isset($_POST['section']) && $_POST['section'] != 'Both'){
	$section = $_POST['section'];
	
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Section_Information WHERE Description = '$section'"))>0){//Section exists
		echo "<span class='alert-response-information'>Section Already Set</span>";
	} else {//Section doesn't exist
		if (mysqli_query($conn, "INSERT INTO Section_Information (Description) VALUES ('$section')")) {
			echo "<span class='alert-response-success'>$section Section is set successfully</span>";
		} else {
			echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
		}
	}
} else {
	echo "<span class='alert-response-information'>Choose an Option</span>";
}
?>