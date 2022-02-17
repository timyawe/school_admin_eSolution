<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['stdID'] != ""){
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
		
		if ($_POST['pContact']!= "") {
			$pContact = trim($_POST["pContact"]);
			$addedfields[] = "`Primary_Contact`";
			$addedvalues[] = "'".$pContact."'";
		}
		
		if ($_POST['oContact']!= "") {
			$oContact = trim($_POST["oContact"]);
			$addedfields[] = "`Other_Contact`";
			$addedvalues[] = "'".$oContact."'";
		}
		
		if ($_POST['stdrship']!= "") {
			$stdrship = trim($_POST["stdrship"]);
			$addedfields[] = "`Student_Relationship`";
			$addedvalues[] = "'".$stdrship."'";
		}
		
		if ($_POST['stdID']!= "") {
			$stdID = $_POST["stdID"];
			$addedfields[] = "`StudentID`";
			$addedvalues[] = "'".$stdID."'";
		}
		
		//Check if array has elements
		if (count($addedfields) > 0 && count($addedvalues) > 0 ) {
			if(mysqli_query($conn,"INSERT INTO `StudentKin_Information` "."(".implode(",",$addedfields).")" . "VALUES" . "(".implode(",",$addedvalues).")")){
				echo "<span class='alert-response-success'>Student Kin was added successfully</span>";
			} else {
				echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
			}
		}
	}
?>