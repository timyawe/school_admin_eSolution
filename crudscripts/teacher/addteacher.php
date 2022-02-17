<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	/*/Arrays to collect fields which have been filled
	the arrays are to be used to add a record in the database in a FIELDS LIST/VALUE LIST format*/ 
	$addedfields = array();
	$addedvalues = array();
	
	//Assign fileds to variables and add to the array
	
	if ($_POST['sName']!= "") {
		$surname = trim($_POST["sName"]);
		$addedfields[] = "`SurName`";
		$addedvalues[] = "'".$surname."'";
	}
	
	if ($_POST['fName']!= "") {
		$firstname = trim($_POST["fName"]);
		$addedfields[] = "`FirstName`";
		$addedvalues[] = "'".$firstname."'";
	}
	
	if ($_POST['dob'] != "") {
		//Change date format for mysql date compatibility
		$birthdate = date("Y-m-d", strtotime(trim($_POST['dob'])));
		$addedfields[] = "`DOB`";
		$addedvalues[] = "'".$birthdate."'";
	}
	
	if ($_POST['genderopt']!= "") {
		$gender = $_POST["genderopt"];
		$addedfields[] = "`Gender`";
		$addedvalues[] = "'".$gender."'";
	}
	
	if ($_POST['address']!= "") {
		$addr = trim($_POST["address"]);
		$addedfields[] = "`Address`";
		$addedvalues[] = "'".$addr."'";
	}
	
	if ($_POST['pCont']!= "") {
		$pCont = trim($_POST["pCont"]);
		$addedfields[] = "`Primary_Contact`";
		$addedvalues[] = "'".$pCont."'";
	}
	
	if ($_POST['oCont']!= "") {
		$oCont = trim($_POST["oCont"]);
		$addedfields[] = "`Other_Contact`";
		$addedvalues[] = "'".$oCont."'";
	}
	
	if ($_POST['datejoined'] != "") {
		//Change date format for mysql date compatibility
		$datejoined = date("Y-m-d", strtotime(trim($_POST['datejoined'])));
		$addedfields[] = "`Date_Joined`";
		$addedvalues[] = "'".$datejoined."'";
	}
	
	if (count($addedfields) > 0 && count($addedvalues) > 0 ) {
		if (mysqli_query($conn, "INSERT INTO Teacher_Information (". implode(",", $addedfields).") VALUES (". implode(",", $addedvalues).")")) {
			//Get the inserted record
			$lastID = mysqli_insert_id($conn);
			
			if (!empty($_POST['class'])) {
				foreach($_POST['class'] as $classID) {
					if (!mysqli_query($conn, "INSERT INTO TeacherClass_Information VALUES ($classID, $lastID)")) {
						echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
						mysqli_query($conn, "DELETE FROM Teacher_Information WHERE ID = $lastID");
						die();
					}
				}
			}
			
			if (!empty($_POST['subj'])) {
				foreach($_POST['subj'] as $subjCode) {
					if (!mysqli_query($conn, "INSERT INTO TeacherSubject_Information VALUES ($lastID, $subjCode)")) {
						//mysqli_query($conn, "DELETE FROM Teacher_Information WHERE ID = $lastID");
						die("Error: ".mysqli_error($conn));
					}
				}
			}
			
			echo "<span class='alert-response-success'>Teacher Added Successfully</span>";
		} else {
			echo "<span class='alert-response-error'>Error: ". mysqli_error($conn)."</span>";
		}
	} else {
		echo "<span class='alert-response-error'>Error: Some of the fields are not filled</span>";
	}
?>