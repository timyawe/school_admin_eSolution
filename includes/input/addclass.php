<?php
if (!$_POST['clsName']=="") {
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	$clsName = trim($_POST['clsName']);
	$clsindex = trim($_POST['clsindex']);
	
	$assignedIndex = mysqli_query($conn, "SELECT Class_Name,Class_Index FROM Class_Information WHERE Class_Index=$clsindex");
	$classname = mysqli_query($conn, "SELECT * FROM Class_Information WHERE Class_Name='$clsName'");
	if(mysqli_num_rows($assignedIndex)>0){
		$indexrow = mysqli_fetch_assoc($assignedIndex);
		echo "<span class='alert-response-information'>The Order No. entered is already assigned to ".$indexrow['Class_Name']." Please
		enter another number</span>";
	} elseif(mysqli_num_rows($classname)>0){
		echo "<span class='alert-response-information'>The Class Name entered already exists. Please enter another name</span>";
	} else {
		$insertsql = "INSERT INTO Class_Information (Class_Name, Class_Index) VALUES ('$clsName','$clsindex')";
	
		if (mysqli_query($conn, $insertsql)) {
			echo "<span class='alert-response-success'>$clsName was added successfully</span>";
		} else {
			echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
		}
	}
} else {
	echo "<span class='alert-response-error'>There was an error in submission</span>";
}
?>