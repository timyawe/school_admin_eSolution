<?php
	//Check school term
	$schtermsqlresult = mysqli_query($conn, "SELECT ID FROM SchoolTerm_Information WHERE End_Date > curdate()");
	if (mysqli_num_rows($schtermsqlresult) > 0) {
		while($schtermrow = mysqli_fetch_assoc($schtermsqlresult)){
			$schtermID = $schtermrow['ID'];
		}
	} else {
		//header("Location: ");
		die("Current School Term  is not set");
	}
?>