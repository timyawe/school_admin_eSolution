<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['classopt']!= "") {
		$classopt = trim($_POST['classopt']);
	}
	
	$stdsqlresult = mysqli_query($conn, "SELECT ID_No,SurName,FirstName,OtherName FROM Student_Information WHERE ClassID = $classopt");
	if (mysqli_num_rows($stdsqlresult) > 0){
		/*echo "<select id='stdopt' name='stdopt'><!--<span class='required-mark'>*</span>-->";
		echo "<option value=''>Choose Student</option>";
		while($stdrow = mysqli_fetch_assoc($stdsqlresult)){
			echo "<option value='".$stdrow['ID_No']."'>".$stdrow['SurName']." ".$stdrow['FirstName']." ".$stdrow['OtherName']."</option>";
		}
		echo "</select>";*/
	} else {
		echo "No match";
	}

?>