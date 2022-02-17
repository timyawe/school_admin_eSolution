<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	
	function validateForm(){
		if($_POST['genderopt'] == ""){
			$isFormGood = false;
		}else{
			$isFormGood = true;
		}
		return $isFormGood;
	}
	
	if (validateForm()) {
		$tchdetailsrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Teacher_Information WHERE ID=".$_POST['tchID']));
			$tchID = $tchdetailsrow['ID'];
			$sName = $tchdetailsrow['SurName'];
			$fName = $tchdetailsrow['FirstName'];
			$gender = $tchdetailsrow['Gender'];
			$pCont = $tchdetailsrow['Primary_Contact'];
			$oCont = $tchdetailsrow['Other_Contact'];
			$dob = date("d/m/Y", strtotime($tchdetailsrow['DOB']));
			$address = $tchdetailsrow['Address'];
			$datejoined = date("d/m/Y", strtotime($tchdetailsrow['Date_Joined']));
			
		/*$classes = mysqli_query($conn, "SELECT * FROM TeacherClass_Information WHERE TeacherID=".$_POST['tchID']);
		$subs = mysqli_query($conn, "SELECT * FROM TeacherSubject_Information WHERE TeacherID=".$_POST['tchID']);
		
		if(!empty($_POST['class'])){
			if(mysqli_num_rows($classes)>0){
				while($clsrow = mysqli_fetch_assoc($classes)){
					foreach($_POST['class'] as $clsID){
						if($clsID != $clsrow['ClassID']){
						*/	
			
		//Array to collect fields which have been edited
		$editedfields = array();
		
		if($_POST['sName'] != $sName){
			$editedfields['SurName'] = $_POST['sName'];
		}
		
		if($_POST['fName'] != $fName){
			$editedfields['FirstName'] = $_POST['fName'];
		}
		
		if($_POST['pCont'] != $pCont){
			$editedfields['Primary_Contact'] = $_POST['pCont'];
		}
	
		if($_POST['oCont'] != $oCont){
			$editedfields['Other_Contact'] = $_POST['oCont'];
		}
		
		if($_POST['genderopt'] != $gender){
			$editedfields['Gender'] = $_POST['genderopt'];
		}
		
		if($_POST['dob'] != $dob){
			$editedfields['DOB'] = $_POST['dob'];
		}
		
		if($_POST['address'] != $address){
			$editedfields['Address'] = $_POST['address'];
		}
		
		if($_POST['datejoined'] != $datejoined){
			$editedfields['Date_Joined'] = $_POST['datejoined'];
		}
		
		require $_SERVER['DOCUMENT_ROOT']."/functions/editrecord.php";
		editrecord($editedfields,$conn,'Teacher_Information','ID',$_POST['tchID'],'Teacher');
	
	}else{
		echo "Please fill all Required fields";
	}
?>