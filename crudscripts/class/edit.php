<?php
if (!$_POST['clsName']=="" && $_POST['clsindex']!="") {
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	$clsName = trim($_POST['clsName']);
	$clsindex = trim($_POST['clsindex']);
	$clsID = $_POST['classID'];
	
	$cls = mysqli_query($conn, "SELECT * FROM Class_Information WHERE ID=$clsID");
	if(mysqli_num_rows($cls)>0){
		$clsrow = mysqli_fetch_assoc($cls);
		$oldclsname = $clsrow['Class_Name'];
		$oldclsindex = $clsrow['Class_Index'];
	}
	//Array to collect fields which have been edited
	$editedfields = array();
	
	if($clsName != $oldclsname){
		$editedfields["Class_Name"] = $clsName;
		$classname = mysqli_query($conn, "SELECT * FROM Class_Information WHERE Class_Name='$clsName'");
	}
	if($clsindex != $oldclsindex){
		$editedfields["Class_Index"] = $clsindex;
		$assignedIndex = mysqli_query($conn, "SELECT Class_Name,Class_Index FROM Class_Information WHERE Class_Index=$clsindex");
	}
	
	if($assignedIndex && mysqli_num_rows($assignedIndex)>0){
		$indexrow = mysqli_fetch_assoc($assignedIndex);
		echo "<span class='alert-response-information'>The Order No. entered is already assigned to ".$indexrow['Class_Name']." Please
		enter another number</span>";
	} elseif($classname && mysqli_num_rows($classname)>0){
		echo "<span class='alert-response-information'>The Class Name entered already exists. Please enter another name</span>";
	} else {
		if(count($editedfields)>0){
			foreach($editedfields as $fieldname => $value){
				if(mysqli_query($conn, "UPDATE Class_Information SET $fieldname = '$value' WHERE ID=$clsID")){
					$flagraised = true;
				} else {
					$flagraised = false;
				}
			}
			
			if($flagraised){
				echo "<span class='alert-response-success'>$clsName was edited successfully</span>";
			} else {
				echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
			}
		} else {
			echo "<span class='alert-response-information'>No Field was edited</span>";
		}
	}
}
?>