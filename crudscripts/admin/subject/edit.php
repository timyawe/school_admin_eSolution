<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	$subrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Subject_Information WHERE Code=".$_POST['subcode']));
	
	$editedfields = array();
		
	if($_POST['subj'] != $subrow['Subject_Name']){
		$editedfields['Subject_Name'] = $_POST['subj'];
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
	editrecord($editedfields,$conn,'Subject_Information','Code',$_POST['subcode'],'Subject');
?>