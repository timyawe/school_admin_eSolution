<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	$schtermrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SchoolTerm_Information WHERE ID=".$_POST['schtermID']));
	
	$editedfields = array();
		
	if($_POST['description'] != $schtermrow['Description']){
		$editedfields['Description'] = $_POST['description'];
	}
	
	if($_POST['sdate'] != date("d/m/Y", strtotime($schtermrow['Start_Date']))){
		$editedfields['Start_Date'] = $_POST['sdate'];
	}
	
	if($_POST['edate'] != date("d/m/Y", strtotime($schtermrow['End_Date']))){
		$editedfields['End_Date'] = $_POST['edate'];
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
	editrecord($editedfields,$conn,'SchoolTerm_Information','ID',$_POST['schtermID'],'School Term');
	
	
?>