<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['grdnID'] != "") {
		$stdkinrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM StudentKin_Information WHERE ID=". $_POST['grdnID']));
		$grdnID = $stdkinrow['ID'];
		$stdID = $stdkinrow['StudentID'];
		$sName = $stdkinrow['SurName'];
		$fName = $stdkinrow['FirstName'];
		$pContact = $stdkinrow['Primary_Contact'];
		$oContact = $stdkinrow['Other_Contact'];
		$email = $stdkinrow['Email'];
		$stdrship = $stdkinrow['Student_Relationship'];
	} else {
		$grdnID = "";
		$stdID = $_POST['stdID'];
		$sName = "";
		$fName = "";
		$pContact = "";
		$oContact = "";
		$email = "";
		$stdrship = "";
	}
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Add Student Guardian</h2>
		<div id="response"></div>
	</div>
	
	<div class="form-content">
		<form id="grdnform">
			<div class="editrow">
				<input type="text" name="grdnID" value="<?php echo $grdnID ?>" />
			</div>
			
			<div class="editrow">
				<input type="text" name="stdID" value="<?php echo $stdID ?>" />
			</div>
			
			<div class="editrow">
				<input type="text" id="sName" name="sName" value="<?php echo $sName ?>" placeholder="Enter SurName">
				<span class="required-mark">*</span></br>
				<span id="sName-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="fName" name="fName" value="<?php echo $fName ?>" placeholder="Enter First Name">
				<span class="required-mark">*</span></br>
				<span id="fName-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="pContact" name="pContact" value="<?php echo $pContact ?>" placeholder="Enter 1st Phone No.">
				<span class="required-mark">*</span></br>
				<span id="pContact-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="oContact" name="oContact" value="<?php echo $oContact ?>" placeholder="Enter 2nd Phone No."></br>
				<span id="oContact-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="email" name="email" value="<?php echo $email ?>" placeholder="Enter Email"></br>
				<span id="email-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="stdrship" name="stdrship" value="<?php echo $stdrship ?>" placeholder="Enter Student Relationship">
				<span class="required-mark">*</span></br>
				<span id="stdrship-error" class="input-error"></span>
			</div>
			<span class="required-mark">(*) Required Fields</span>
			
			<div class="editrow btn-row">
				<input type="button" id="add" value="Add"/>
				<input type="button" id="edit" value="Edit"/>
				<button type="button" id="cancel">Cancel</button>
			</div>
		</form>
	</div>
</div>

<script>
	var sName = jquery("#sName");
	var fName = jquery("#fName");
	var pContact = jquery("#pContact");
	var oContact = jquery("#oContact");
	var email = jquery("#email");
	var stdrship = jquery("#stdrship");
	var sne = jquery("#sName-error");
	var fne = jquery("#fName-error");
	var pce = jquery("#pContact-error");
	var oce = jquery("#oContact-error");
	var eme = jquery("#email-error");
	var stre = jquery("#stdrship-error");
	var isFormGood = true;
	
	function checkForm(){
		if(sName.val() == ""){
			sne.html("Please enter SurName");
			isFormGood = false;
		}else{
			sne.html("");
			isFormGood = true;
		}
		
		if(fName.val() == ""){
			fne.html("Please enter First Name");
			isFormGood = false;
		}else{
			fne.html("");
			isFormGood = true;
		}
		
		if(pContact.val() == ""){
			pce.html("Please enter Primary Contact");
			isFormGood = false;
		}else if(pContact.val().length < 10){
			pce.html("Phone number is missing " + (10 - pContact.val().length) + " digit(s)");
			isFormGood = false;
		}else if(pContact.val().length > 10){
			pce.html("Phone number has " + (pContact.val().length - 10) + " more digit(s) than required");
			isFormGood = false;
		}else if(isNaN(pContact.val()) == true){
			pce.html("Please enter digits only");
			isFormGood = false;
		}else{
			pce.html("");
			isFormGood = true;
		}
		
		if(oContact.val() != "" && oContact.val().length < 10){
			oce.html("Phone number is missing " + (10 - oContact.val().length) + " digit(s)");
			isFormGood = false;
		}else if(oContact.val().length > 10){
			oce.html("Phone number has " + (oContact.val().length - 10) + " more digit(s) than required");
			isFormGood = false;
		}else if(isNaN(oContact.val()) == true){
			oce.html("Please enter digits only");
			isFormGood = false;
		}else{
			oce.html("");
			isFormGood = true;
		}
		
		if(!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(email.val()) && email.val() != "" ){
			eme.html("The email entered is not valid.");
			isFormGood = false;
		}else{
			eme.html("");
			isFormGood = true;
		}
		
		if(stdrship.val() == ""){
			stre.html("Please enter Student Relationship");
			isFormGood = false;
		}else{
			stre.html("");
			isFormGood = true;
		}
		return isFormGood;
	}
	
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/student/addguardian.php",
						data: jquery("#grdnform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#edit").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
					url: "crudscripts/student/editguardian.php",
					data: jquery("#grdnform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>