<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['amount']!= "") {
		$amount = trim($_POST["amount"]);
	}
	
	//Insert data in database & Check wether record was added
	if(mysqli_query($conn,"INSERT INTO `SchoolFees_Information` (Amount) VALUES ('$amount')")) {
		//Get the last inserted record
		$lastID = mysqli_insert_id($conn);
		
		if(!empty($_POST['class'])) {
			foreach($_POST['class'] as $classes){
				if(!mysqli_query($conn, "INSERT INTO ClassFees_Information VALUES ('$lastID','$classes')")){
					mysqli_query($conn, "DELETE FROM SchoolFees_Information WHERE ID = $lastID LIMIT 1");
					die("Error".mysqli_error($conn));
				}
			}
		}
		
		if(!empty($_POST['section'])) {
			foreach($_POST['section'] as $section){
				if(!mysqli_query($conn, "INSERT INTO SectionFees_Information VALUES ('$lastID','$section')")){
					//mysqli_query($conn, "DELETE FROM Requirements_Information WHERE ID = $lastID LIMIT 1");
					die("Error".mysqli_error($conn));
				}
			}
		}
		echo "<span class='alert-response-success'>Fees Added Successfully</span>";
	} else {
		echo "<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>";
	}
	
?>