<?php
if(isset($_POST['section'])){
	$section = $_POST['section'];
	
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if($_POST['section'] != 'Both'){
		if(mysqli_num_rows(mysqli_query($conn,"SELECT Description FROM Section_Information")) == 1){//Section is either Day or Boarding
			if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Section_Information WHERE Description = '$section'"))>0){//Section exists
				echo "<span class='alert-response-information'>Section Already Set</span>";
			}else{
				if (mysqli_query($conn, "UPDATE Section_Information SET Description = '$section'")) {
					echo "<span class='alert-response-success'>$section Section is set successfully</span>";
				}else{//database update error
					echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
				}
			}
		}else{//If section in database is both day and boarding, then delete the section which is not set by user
			if(mysqli_query($conn, "DELETE FROM Section_Information WHERE Description != '$section' LIMIT 1")) {
				echo "<span class='alert-response-success'>$section Section is set successfully</span>";
			}else{//database delete error
				echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
			}
		}
	}else{
		if(mysqli_num_rows(mysqli_query($conn,"SELECT Description FROM Section_Information"))>1){//Section is both Day and Boarding
			echo "<span class='alert-response-information'>Section Already Set</span>";
		}else{
			if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Section_Information WHERE Description = 'Day'"))>0){//
				if (mysqli_query($conn, "INSERT INTO Section_Information (Description) VALUES ('Boarding')")){//add alternative section
					echo "<span class='alert-response-success'>$section Section is set successfully</span>";
				}else{//database insert error
					echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
				}
			}else{
				if (mysqli_query($conn, "INSERT INTO Section_Information (Description) VALUES ('Day')")){//add alternative section
					echo "<span class='alert-response-success'>$section Section is set successfully</span>";
				}else{//database insert error
					echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
				}
			}
		}
	}			
}
?>