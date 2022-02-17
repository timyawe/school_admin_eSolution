<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if($_POST['grdnID'] != ""){
		$stdkinrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM StudentKin_Information WHERE ID=". $_POST['grdnID']));
		$fullname = $stdkinrow['SurName']. " ". $stdkinrow['FirstName'];
		$pContact = $stdkinrow['Primary_Contact'];
		$oContact = $stdkinrow['Other_Contact'];
		$stdrship = $stdkinrow['Student_Relationship'];
	} else {
		$fullname = "";
		$pContact = "";
		$oContact = "";
		$stdrship = "";
	}
?>
<div class="tab-form-content">
		<form>
			<div class="detailsrow">
				<label for="grdfullname">Name</label>
				<input type="text" value="<?php echo $fullname ?>">
			</div>
			
			<div class="detailsrow">
				<label for="pricontact">Primary Contact</label>
				<input type="text" value="<?php echo $pContact ?>">
			</div>
			
			<div class="detailsrow">
				<label for="othcontact">Other Contact</label>
				<input type="text" value="<?php echo $oContact ?>">
			</div>
			
			<div class="detailsrow">
				<label for="stdrship">Student Relationship</label>
				<input type="text" value="<?php echo $stdrship ?>">
			</div>
		</form>
	</div>