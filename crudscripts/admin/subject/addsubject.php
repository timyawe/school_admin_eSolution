<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['subj']!= "") {
		$subj = trim($_POST["subj"]);
		
		if(mysqli_num_rows(mysqli_query($conn, "SELECT Subject_Name FROM Subject_Information WHERE Subject_Name=$subj"))>0){
			echo "<span class='alert-response-information'>$subj Already Exists</span>";
		}else{
			if (mysqli_query($conn, "INSERT INTO Subject_Information (Subject_Name) VALUES ('$subj')")) {
				echo "<span class='alert-response-success'>$subj Added Successfully</span>";
			} else {
				echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
			}
		}
	}
?>