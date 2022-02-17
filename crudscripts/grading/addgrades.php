<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/schooltermvar.inc";
	
	/*/Arrays to collect fields which have been filled
	the arrays are to be used to add a record in the database in a FIELDS LIST/VALUE LIST format*/ 
	$addedfields = array();
	$addedvalues = array();
	
	//Assign fileds to variables and add to the array
	
	if ($schtermID != "") {
		$addedfields[] = "`SchoolTermID`";
		$addedvalues[] = $schtermID;
	}
	
	if ($_POST['subjCode'] != "") {
		$subjCode = $_POST['subjCode'];
		$addedfields[] = "`SubjectCode`";
		$addedvalues[] = $subjCode;
	}
	
	if ($_POST['classID'] != "") {
		$classID = $_POST['classID'];
		$addedfields[] = "`ClassID`";
		$addedvalues[] = $classID;
	}
	
	if ($_POST['markfor'] != "") {
		$markfor = $_POST['markfor'];
		$addedfields[] = "`MarkFor`";
		$addedvalues[] = "'".$markfor."'";
	}
	
	if (!empty($_POST['id'])) {
		$stdID = $_POST['id'];
		$addedfields[] = "`StudentID`";
		//$addedvalues[] = "'".$stdID."'";
	}
	
	if (!empty($_POST['mark'])) {
		$mark = $_POST['mark'];
		$addedfields[] = "`Marks`";
		//$addedvalues[] = "'".$mark."'";
	}
	
	
	if (count($_POST['id']) == count($_POST['mark'])) {
		for($ids = 0, $mks = 0; $ids<count($_POST['id']), $mks<count($_POST['mark']); $ids++,$mks++) {
			mysqli_query($conn, "INSERT INTO  Grading_Information (".implode(",",$addedfields).") values (".implode(",",$addedvalues). ",". 
			$_POST['id'][$ids]. ",".$_POST['mark'][$mks]. ")");
				//echo mysqli_error($conn);
		}
		echo "<span class='alert-response-success'>Marks added successfully</span>";
	}
	
	/*if (count($_POST['id']) == count($_POST['mark'])) {
	for($ids = 0, $mks = 0; $ids<count($_POST['id']), $mks<count($_POST['mark']); $ids++,$mks++) {
		echo "INSERT INTO  Table (schooltermID,subjCode, classID, markfor, stdID, marks) values ($schtermID,$subjCode,$classID,$markfor"; 
		print_r ($_POST['id'][$ids]); echo ",";
		
		print_r($_POST['mark'][$mks]); echo ")";
	}
	}*/
	
	//print_r( $_POST['id']);
	//print_r( $_POST['mark']);
	
	/*$stdIDs = array();
	$marks = array();
	
	foreach($_POST['id'] as $stdID){
		$stdIDs[] = $stdID;
	}
	
	foreach($_POST['mark'] as $mark) {
		$marks[] = $mark;
	}
	echo implode(",",$stdIDs)."<br/>".
	implode(",",$marks);*/
	
	/*$grades = array(implode(",",$_POST['id']) => implode(",",$_POST['mark']));
	print_r($grades);*/
	/*$grades = array();
	if($_POST['id'] != " " && $_POST['id'] != " ") {
		foreach($_POST['id'] as $id) {
		$grades[$id]= $_POST['mark'];
		}
	}
	print_r( $grades);*/
?>