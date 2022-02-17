<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
		
	$stdrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Student_Information WHERE ID_No=".$_POST['stdID']));
	$classID = $stdrow['SYClassID'];
	$oldsectID = $stdrow['SectionID'];
	$oldsName = $stdrow['SurName'];
	$oldfName = $stdrow['FirstName'];
	$oldoName = $stdrow['OtherName'];
	$olddob = date("d/m/Y", strtotime($stdrow['DOB']));
	$oldgender = $stdrow['Gender'];
	$oldaddress = $stdrow['Address'];
	$oldnationality = $stdrow['Nationality'];
	$olddatejoined = date("d/m/Y", strtotime($stdrow['Date_Registered']));
	
	//Array to collect fields which have been edited
	$editedfields = array();
	
	if($_POST['sect'] != $oldsectID){
		$editedfields['SectionID'] = $_POST['sect'];
	}
	
	if($_POST['sName'] != $oldsName){
		$editedfields['SurName'] = trim($_POST['sName']);
	}
	
	if($_POST['fName'] != $oldfName){
		$editedfields['FirstName'] = trim($_POST['fName']);
	}
	
	if($_POST['oName'] != $oldoName){
		$editedfields['OtherName'] = trim($_POST['oName']);
	}

	if($_POST['dob'] != $olddob){
		$editedfields['DOB'] = date("Y-m-d", strtotime($_POST['fName']));
	}
	
	if($_POST['genderopt'] != $oldgender){
		$editedfields['Gender'] = trim($_POST['genderopt']);
	}
	
	if($_POST['address'] != $oldaddress){
		$editedfields['Address'] = trim($_POST['address']);
	}
	
	if($_POST['nationality'] != $oldnationality){
		$editedfields['Nationality'] = trim($_POST['nationality']);
	}
	
	if($_POST['datejoined'] != $olddatejoined){
		$editedfields['Date_Registered'] = date("Y-m-d", strtotime($_POST['datejoined']));
	}
	
	if(count($editedfields)>0){
		foreach($editedfields as $fieldname => $value){
			if(mysqli_query($conn, "UPDATE Student_Information SET $fieldname = '$value' WHERE ID_No=".$_POST['stdID'])){
				$flagraised = true;
			} else {
				$flagraised = false;
			}
		}
		
		if($flagraised){
			echo "<span class='alert-response-success'>Student details were edited successfully</span>";
		} else {
			echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
		}
	} else {
		echo "<span class='alert-response-information'>No Field was edited</span>";
	}	

?>