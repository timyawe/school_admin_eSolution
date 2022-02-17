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
	
	if ($_POST['oName']!= "") {
		$othername = trim($_POST["oName"]);
		$addedfields[] = "`OtherName`";
		$addedvalues[] = "'".$othername."'";
	}
	
	if ($_POST['dob'] != "") {
		//Change date format for mysql date compatibility
		$birthdate = date("Y-m-d", strtotime($_POST['dob']));
		$addedfields[] = "`DOB`";
		$addedvalues[] = "'".$birthdate."'";
	}
	
	if ($_POST['genderopt']!= "") {
		$gender = $_POST["genderopt"];
		$addedfields[] = "`Gender`";
		$addedvalues[] = "'".$gender."'";
	}
	
	if ($_POST['address']!= "") {
		$addr = $_POST["address"];
		$addedfields[] = "`Address`";
		$addedvalues[] = "'".$addr."'";
	}
	
	if ($_POST['nationality']!= "") {
		$nat = trim($_POST["nationality"]);
		$addedfields[] = "`Nationality`";
		$addedvalues[] = "'".$nat."'";
	}
	
	if ($_POST['datejoined'] != "") {
		//Change date format for mysql date compatibility
		$datejoined = date("Y-m-d", strtotime($_POST['datejoined']));
		$addedfields[] = "`Date_Registered`";
		$addedvalues[] = "'".$datejoined."'";
	}
	
	if ($_POST['clsID']!= "" && $_POST['cursy']!= "") {
		$clsID = $_POST['clsID'];
		$cursy = $_POST['cursy'];
		
		$ID = mysqli_query($conn, "SELECT ID FROM SchoolYearClass_Information WHERE SchoolYearID=$cursy AND ClassID=$clsID");
		if(mysqli_num_rows($ID)>0){
			$IDrow = mysqli_fetch_assoc($ID);
			$SYClassID = $IDrow['ID'];
			$flag = true;
		} else {
			if(mysqli_query($conn, "INSERT INTO SchoolYearClass_Information (SchoolYearID, ClassID) VALUES ($cursy,$clsID)")){
				//Get the inserted record
				$SYClassID = mysqli_insert_id($conn);
				$flag = true;
			}
		}
		if($flag){
			$addedfields[] = "`SYClassID`";
			$addedvalues[] = "'".$SYClassID."'";
	}
	
	if ($_POST['sectID']!= "") {
		$sectID = $_POST['sectID'];
		$addedfields[] = "`SectionID`";
		$addedvalues[] = "'".$sectID."'";
	}
	
//Check if array has elements
	if (count($addedfields) > 0 && count($addedvalues) > 0 ) {
		if(mysqli_query($conn,"INSERT INTO `Student_Information` "."(".implode(",",$addedfields).")" . "VALUES" . "(".implode(",",$addedvalues).")")){
			//unset($_SESSION['classopt']);
			//unset($_SESSION['sectopt']);
			echo "<span class='alert-response-success'>Student was added successfully</span>";
		} else {
			
			echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
		}
	}
?>