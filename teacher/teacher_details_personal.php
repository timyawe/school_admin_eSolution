<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if($_POST['tchID'] != ""){
		$tchrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Teacher_Information WHERE ID=".$_POST['tchID']));
		$id_no = $tchrow['ID'];
		$fullname = $tchrow['SurName']. " ". $tchrow['FirstName'];
		$dob = date("d/m/Y", strtotime($tchrow['DOB']));
		$address = $tchrow['Address'];
		$gender = $tchrow['Gender'];
		$pCont = $tchrow['Primary_Contact'];
		$oCont = $tchrow['Other_Contact'];
		$djoined = $tchrow['Date_Joined'];
	}
?>
<div class="tab-form-container">
	<div class="tab-form-content">
		<form>
			<div class="detailsrow">
				<label for="id_no">ID No.</label>
				<input type="text" name="id_no" value="<?php echo $id_no ?>">
			</div>
			
			<div class="detailsrow">
				<label for="tchfullname">Name</label>
				<input type="text" name="stdfullname" value="<?php echo $fullname ?>">
			</div>
			
			<div class="detailsrow">
				<label for="dob">Date of Birth</label>
				<input type="text" name="dob" value="<?php echo $dob ?>">
			</div>
			
			<div class="detailsrow">
				<label for="address">Address</label>
				<input type="text" name="address" value="<?php echo $address ?>">
			</div>
			
			<div class="detailsrow">
				<label for="gender">Gender</label>
				<input type="text" name="gender" value="<?php echo $gender ?>">
			</div>
			
			<div class="detailsrow">
				<label for="pCont">Primary Contact</label>
				<input type="text" name="pCont" value="<?php echo $pCont ?>">
			</div>
			
			<div class="detailsrow">
				<label for="oCont">Other Contact</label>
				<input type="text" name="oCont" value="<?php echo $oCont ?>">
			</div>
			
			<div class="detailsrow">
				<label for="datejoined">Date Joined</label>
				<input type="text" name="datejoined" value="<?php echo $djoined ?>">
			</div>
		</form>
	</div>
</div>