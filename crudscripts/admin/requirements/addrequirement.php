<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	
	//Assign fileds to variables and add to the array
	
	if ($_POST['desc']!= "") {
		$desc = trim($_POST["desc"]);
	}
	
	if ($_POST['amount']!= "") {
		$amount = trim($_POST["amount"]);
	}
	
	//Insert data in database & Check wether record was added
	if(mysqli_query($conn,"INSERT INTO `Requirements_Information` (Description, Amount) VALUES ('$desc', '$amount')")) {
		//Get the last inserted record
		$lastID = mysqli_insert_id($conn);
		
		if(!empty($_POST['class'])) {
			foreach($_POST['class'] as $classes){
				if(!mysqli_query($conn, "INSERT INTO ClassRequirements_Information VALUES ('$lastID','$classes')")){
					mysqli_query($conn, "DELETE FROM Requirements_Information WHERE ID = $lastID LIMIT 1");
					die("Error".mysqli_error($conn));
				}
			}
		}
		
		if(!empty($_POST['section'])) {
			foreach($_POST['section'] as $section){
				if(!mysqli_query($conn, "INSERT INTO SectionRequirements_Information VALUES ('$lastID','$section')")){
					//mysqli_query($conn, "DELETE FROM Requirements_Information WHERE ID = $lastID LIMIT 1");
					die("Error".mysqli_error($conn));
				}
			}
		}
		echo "<span class='alert-response-success'>Requirement Added Successfully</span>";
	} else {
		echo "<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>";
	}
	
?>