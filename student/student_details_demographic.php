<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['stdID'] != " ") {
		$stdrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Student_Information WHERE ID_No=". $_POST['stdID']));
			$classID = $stdrow['SYClassID'];
			$classrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=$classID"));
			
			$sectID = $stdrow['SectionID'];
			$sectrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Description FROM Section_Information WHERE ID=$sectID"));
			
			$name = $stdrow['SurName']. " ".$stdrow['OtherName']." ".$stdrow['FirstName'];
			$dob = date("d/m/Y", strtotime($stdrow['DOB']));
			$gender = $stdrow['Gender'];
			$address = $stdrow['Address'];
			$nationality = $stdrow['Nationality'];
			$datejoined = date("d/m/Y", strtotime($stdrow['Date_Registered']));
			$stdID = $stdrow['ID_No'];
	} else {
		$classID = $_POST['classopt'];
		$sectID = $_POST['sectopt'];
		$sName = "";
		$fName = "";
		$oName = "";
		$dob = "";
		$gender = "";
		$address = "";
		$nationality = "";
		$datejoined = "";
	}
			
?>
<div class="tab-form-container">
	<div class="tab-form-content">
		<form>
			<div class="detailsrow">
				<label for="id_no">ID No.</label>
				<input type="text" name="id_no" value="<?php echo $stdID ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="stdfullname">Name</label>
				<input type="text" name="stdfullname" value="<?php echo $name ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="dob">Date of Birth</label>
				<input type="text" name="dob" value="<?php echo $dob ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="address">Address</label>
				<input type="text" name="address" value="<?php echo $address ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="gender">Gender</label>
				<input type="text" name="gender" value="<?php echo $gender ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="class">Class</label>
				<input type="text" name="class" value="<?php echo $sectrow['Class_Name'] ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="section">Section</label>
				<input type="text" name="section" value="<?php echo $sectrow['Description'] ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="nationality">Nationality</label>
				<input type="text" name="nationality" value="<?php echo $nationality ?>" />
			</div>
							
			<div class="detailsrow">
				<label for="datereg">Date Registered</label>
				<input type="text" name="datereg" value="<?php echo $datejoined ?>" />
			</div>
		</form>
	</div>
</div>
