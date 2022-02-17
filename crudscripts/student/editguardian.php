<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	$stdkinrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM StudentKin_Information WHERE ID=".$_POST['grdnID']));
		$grdnID = $stdkinrow['ID'];
		$stdID = $stdkinrow['StudentID'];
		$sName = $stdkinrow['SurName'];
		$fName = $stdkinrow['FirstName'];
		$pContact = $stdkinrow['Primary_Contact'];
		$oContact = $stdkinrow['Other_Contact'];
		$email = $stdkinrow['Email'];
		$stdrship = $stdkinrow['Student_Relationship'];
		
		//Array to collect fields which have been edited
		$editedfields = array();
		
	if($_POST['sName'] != $sName){
		$editedfields['SurName'] = $_POST['sName'];
	}
	
	if($_POST['fName'] != $fName){
		$editedfields['FirstName'] = $_POST['fName'];
	}
	
	if($_POST['pContact'] != $pContact){
		$editedfields['Primary_Contact'] = $_POST['pContact'];
	}
	
	if($_POST['oContact'] != $oContact){
		$editedfields['Other_Contact'] = $_POST['oContact'];
	}
	
	if($_POST['email'] != $email){
		$editedfields['Email'] = $_POST['email'];
	}
	
	if($_POST['stdrship'] != $stdrship){
		$editedfields['Student_Relationship'] = $_POST['stdrship'];
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
	editrecord($editedfields,$conn,'StudentKin_Information','ID',$_POST['grdnID'],'Guardian');
	
	
	
?>