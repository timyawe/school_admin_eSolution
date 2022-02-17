<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if (!empty($_POST['pymtID'])){
		$pymtrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM StudentPayments WHERE ID=".$_POST['pymtID']));
		$paidfor = $pymtrow['PaidFor'];
		$datepaid = date("d/m/Y", strtotime($pymtrow['Payment_Date']));
		$datercvd = date("d/m/Y", strtotime($pymtrow['Recieved_Date']));
		$ptype = $pymtrow['Payment_Type'];
		$amount = number_format($pymtrow['Amount_Paid']);
		$pymtID = $pymtrow['ID'];
	}
	
	//Array to collect fields which have been edited
	$editedfields = array();
	
	if($_POST['paidfor'] != $paidfor){
		$editedfields['PaidFor'] = $_POST['paidfor'];
	}
	
	if($_POST['datepaid'] != $datepaid){
		$editedfields['Payment_Date'] = $_POST['datepaid'];
	}
	
	if($_POST['datercvd'] != $datercvd){
		$editedfields['Recieved_Date'] = $_POST['datercvd'];
	}
	
	if($_POST['ptype'] != $ptype){
		$editedfields['Payment_Type'] = $_POST['ptype'];
	}
	
	if($_POST['amount'] != $amount){
		$editedfields['Amount_Paid'] = $_POST['amount'];
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
	editrecord($editedfields,$conn,'PaymentsIn_Information','ID',$_POST['pymtID'],'Payment');
	
	
	
?>