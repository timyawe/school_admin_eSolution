<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	$schfeesrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Amount FROM SchoolFees_Information WHERE ID=".$_POST['feesID']));
	
	$editedfields = array();
		
	if($_POST['amount'] != $schfeesrow['Amount']){
		$editedfields['Amount'] = str_replace(",","",$_POST['amount']);
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
	editrecord($editedfields,$conn,'SchoolFees_Information','ID',$_POST['feesID'],'Fees Amount');
	
?>