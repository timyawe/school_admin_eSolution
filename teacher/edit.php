<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	
	if ($_POST['tchID'] != "") {
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
		$tchclassIDs = array();
		$no_tchclassIDs = array();
		$clsIDs = array();
		
		$tchsql = mysqli_query($conn, "SELECT ClassID FROM TeacherClass_Information WHERE TeacherID=".$_POST['tchID']);
		while($tclrw = mysqli_fetch_assoc($tchsql)){
			array_push($tchclassIDs, $tclrw['ClassID']);
		}
		
		$cls_sql = mysqli_query($conn, "SELECT ID FROM Class_Information");
		while($clrw = mysqli_fetch_assoc($cls_sql)){
			array_push($clsIDs, $clrw['ID']);
		}
		
		foreach($clsIDs as $classID){
			if(!in_array($classID, $tchclassIDs)){
				array_push($no_tchclassIDs, $classID);
			}
		}
		/*try{
		while($tchclassrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ClassID FROM TeacherClass_Information WHERE TeacherID=".$_POST['tchID']))){
		
		
			array_push($tchclassIDs, $tchclassrow['ClassID']);
			//echo $tchclassrow['ClassID'];
			throw new Exception("Not Viable");
		}}
		catch(Exception $exception){
			echo "Denied";
		}*/
		
		$tchsubjsIDs = array();
		$no_tchsubjsIDs = array();
		$subjIDs = array();
		$tchsubjsql = mysqli_query($conn, "SELECT SubjectCode FROM TeacherSubject_Information WHERE TeacherID=".$_POST['tchID']);
		while($tchsubjrow = mysqli_fetch_assoc($tchsubjsql)){
			array_push($tchsubjsIDs, $tchsubjrow['SubjectCode']);
		}
		
		$subjCodesql = mysqli_query($conn, "SELECT Code FROM Subject_Information");
		while($subjrow = mysqli_fetch_assoc($subjCodesql)){
			array_push($subjIDs, $subjrow['Code']);
		}
		
		foreach($subjIDs as $subjCode){
			if(!in_array($subjCode,$tchsubjsIDs)){
				array_push($no_tchsubjsIDs, $subjCode);
			}
		}
	} else {
		$sName = "";
		$fName = "";
		$gender = "";
		$pCont = "";
		$oCont = "";
		$dob = "";
		$address = "";
		$datejoined = "";
		$tchID = "";
	
		$tchclassrow = null;
		$tchsubjrow = null;
	}
?>
<div class="form-container">
	<div class="form-heading-container">
		<?php
			if(empty($_POST['tchID'])){
				echo "<h2>Add Teacher</h2>";
			}else{
				echo "<h2>Edit Teacher</h2>";
			}
		?>
		<div id="response"></div>
	</div>
	
	<div class="form-content">
		<form id="teacherform">
			<div class="editrow">
				<input type="text" id="tchID" name="tchID" value="<?php echo $tchID ?>" />
				<input type="text" id="sName" name="sName" value="<?php echo $sName ?>" placeholder="Enter SurName">
				<span class="required-mark">*</span></br>
				<span id="errsName" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="fName" name="fName" value="<?php echo $fName ?>" placeholder="Enter First Name">
				<span class="required-mark">*</span></br>
				<span id="errfName" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<select id="genderopt" name="genderopt">
					<option value="">Choose Gender</option>
					<option value="Male" <?php if($gender == "Male") { echo "selected";}?>>Male</option>
					<option value="Female" <?php if($gender == "Female") { echo "selected";}?>>Female</option>
				</select><span class="required-mark">*</span></br>
				<span id="errgenderopt" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="dob" name="dob" value="<?php echo $dob ?>" placeholder="Enter Date of Birth">
				<span class="required-mark">*</span>
				<span class="format">Format (dd/mm/yyyy)</span></br>
				<span id="errdob" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="pCont" name="pCont" value="<?php echo $pCont ?>" placeholder="Enter Primary Contact">
				<span class="required-mark">*</span></br>
				<span id="errpCont" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="oCont" name="oCont" value="<?php echo $oCont ?>" placeholder="Enter Other Contact"></br>
				<span id="erroCont" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="address" name="address" value="<?php echo $address ?>" placeholder="Enter Address">
				<span class="required-mark">*</span></br>
				<span id="erraddr" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="datejoined" name="datejoined" value="<?php echo $datejoined ?>" placeholder="Enter Date Joined">
				<span class="required-mark">*</span>
				<span class="format">Format (dd/mm/yyyy)</span></br>
				<span id="errdj" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<fieldset>
				<legend>Assign Class *</legend>
					<?php 
						/*if (mysqli_num_rows($class_selectsqlresult) > 0) {
							
							if($_POST['tchID'] == ""){
								while ($classrow = mysqli_fetch_assoc($class_selectsqlresult) /*&& $tchclassrow ){
									$classID = $tchclassrow['ClassID'];
									if ($classID == $classrow['ID']) {
										echo "<input type='checkbox' class='classchk' name='class[]' value='".$classrow['ID']."' checked />".$classrow['Class_Name']."<br/>";
									} else {
										echo "<input type='checkbox' name='class[]' value='".$classrow['ID']."'/>".$classrow['Class_Name']."<br/>";
									}
								}
							}else{
								echo "<table border='1'><tr><th>Class</th><th>Assigned</th><th>Action</th></tr>";
								//$classID = $tchclassrow['ClassID'];
								$counter = 1;
									//echo $classID;
									foreach($tchclassIDs as $classID){
									while ($classrow = mysqli_fetch_assoc($class_selectsqlresult) /*&& $tchclassrow ){
										
										if ($classID == $classrow['ID']) {//echo $classrow['ID'];
											echo "<tr><td hidden>".$classrow['ID']."</td><td>".$classrow['Class_Name']."</td><td style='text-align:center'>Yes</td><td style='text-align:center'><span class='tbl-btn unasgn'>&times;</span></td></tr>";
											//echo "<input type='checkbox' class='classchk' name='class[]' value='".$classrow['ID']."' checked />".$classrow['Class_Name']."<br/>";
										} else {echo $counter."fuck<br/>";
											//echo "<tr><td hidden>".$classrow['ID']."</td><td>".$classrow['Class_Name']."</td><td style='text-align:center'>No</td><td style='text-align:center'><span class='tbl-btn asgn'>+</span></td></tr>";
											//echo "<input type='checkbox' name='class[]' value='".$classrow['ID']."'/>".$classrow['Class_Name']."<br/>";
										}$counter++;
									}
								}
								echo "</table>";
							}
							
						}*/
						//$counter = 1;
						echo "<table border='1'><tr><th>Class</th><th>Assigned</th><th>Action</th></tr>";
						if(count($tchclassIDs)>0){
							foreach($tchclassIDs as $yesIDs){
								$tchclsrw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=$yesIDs"));
								echo "<tr><td hidden>$yesIDs</td><td>".$tchclsrw['Class_Name']."</td><td style='text-align:center'>Yes</td><td style='text-align:center'><span class='tbl-btn unasgn'>&times;</span></td></tr>";
							}
						}
						if(count($no_tchclassIDs)>0){
							foreach($no_tchclassIDs as $noIDs){
								$no_tchclsrw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=$noIDs"));
								echo "<tr><td hidden>$noIDs</td><td>".$no_tchclsrw['Class_Name']."</td><td style='text-align:center'>No</td><td style='text-align:center'><span class='tbl-btn asgn'>+</span></td></tr>";
							}
						}
						echo "</table>";
					?>
					</br>
						<span id="errcls" class="input-error"></span>
				</fieldset>
			</div>
			
			<div class="editrow">
				<fieldset>
				<legend>Assign Subject *</legend>
					<?php 
						/*if (mysqli_num_rows($subject_selectsqlresult) > 0) {
							while ($subjectrow = mysqli_fetch_assoc($subject_selectsqlresult) /*&& $tchsubjrow){
								$subjID = $tchsubjrow['SubjectCode'];
								if ($subjID == $subjectrow['Code']) {
									echo "<input type='checkbox' class='subjchk'  name='subj[]' value='".$subjectrow['Code']."' checked/>".$subjectrow['Subject_Name']."<br/>";
								} else {
									echo "<input type='checkbox' name='subj[]' value='".$subjectrow['Code']."'/>".$subjectrow['Subject_Name']."<br/>";
								}
							}							
						}*/
						echo "<table border='1'><tr><th>Subject</th><th>Assigned</th><th>Action</th></tr>";
						if(count($tchsubjsIDs)>0){
							foreach($tchsubjsIDs as $yesCodes){
								$tchsubjrw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Subject_Name FROM Subject_Information WHERE Code=$yesCodes"));
								echo "<tr><td hidden>$yesCodes</td><td>".$tchsubjrw['Subject_Name']."</td><td style='text-align:center'>Yes</td><td style='text-align:center'><span class='tbl-btn unasgnsub'>&times;</span></td></tr>";
							}
						}
						if(count($no_tchsubjsIDs)>0){
							foreach($no_tchsubjsIDs as $noCodes){
								$no_tchsubjrw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Subject_Name FROM Subject_Information WHERE Code=$noCodes"));
								echo "<tr><td hidden>$noCodes</td><td>".$no_tchsubjrw['Subject_Name']."</td><td style='text-align:center'>No</td><td style='text-align:center'><span class='tbl-btn asgnsub'>+</span></td></tr>";
							}
						}
						echo "</table>";
					?>
					</br>
						<span id="errsbj" class="input-error"></span>
				</fieldset>
			</div><br/>		
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
	var pCont = jquery("#pCont");
	var oCont = jquery("#oCont");
	var gndopt = jquery("#genderopt");
	var dob = jquery("#dob");
	var addr = jquery("#address");
	var dj = jquery("#datejoined");
	var sne = jquery("#errsName");
	var fne = jquery("#errfName");
	var pce = jquery("#errpCont");
	var oce = jquery("#erroCont");
	var gde = jquery("#errgenderopt");
	var dobe = jquery("#errdob");
	var dje = jquery("#errdj");
	var ade = jquery("#erraddr");
	
	var classchk = jquery(".classchk");
	var subjchk = jquery(".subjchk");
	var countclasschk = 0;
	var countsubjchk = 0;
	
	/*function clsChks(){
		for(var x = 0; x < classchk.length; x++){
			if(classchk[x].checked){
				countclasschk++;
			}
		}
		if(countclasschk > 0){
			var clschkd = true;
		}else{
			clschkd = false;
		}
		return clschkd;
		/*for(var y = 0; y < subjchk.length; y++){
			if(subjchk[y].checked){
				countsubjchk++;
			}
		}
	}
	
	/*function subjchks(){
		for(var y = 0; y < subjchk.length; y++){
			if(subjchk[y].checked){
				countsubjchk++;
			}
		}
	}*/
	
	function checkForm(){
		var isFormGood = true;
		
		if(sName.val() == ""){
			isFormGood = false;
			sne.html("Please enter SurName");
		}else{
			isFormGood = true;
			sne.html("");
		}
		
		if(fName.val() == ""){
			isFormGood = false;
			fne.html("Please enter FirstName");
		}else{
			isFormGood = true;
			fne.html("");
		}
		
		if(pCont.val() == ""){
			pce.html("Please enter Primary Contact");
			isFormGood = false;
		}else if(pCont.val().length < 10){
			pce.html("Phone number is missing " + (10 - pCont.val().length) + " digit(s)");
			isFormGood = false;
		}else if(pCont.val().length > 10){
			pce.html("Phone number has " + (pCont.val().length - 10) + " more digit(s) than required");
			isFormGood = false;
		}else if(isNaN(pCont.val()) == true){
			pce.html("Please enter digits only");
			isFormGood = false;
		}else{
			pce.html("");
			isFormGood = true;
		}
		
		if(oCont.val() != "" && oCont.val().length < 10){
			oce.html("Phone number is missing " + (10 - oCont.val().length) + " digit(s)");
			isFormGood = false;
		}else if(oCont.val().length > 10){
			oce.html("Phone number has " + (oCont.val().length - 10) + " more digit(s) than required");
			isFormGood = false;
		}else if(isNaN(oCont.val()) == true){
			oce.html("Please enter digits only");
			isFormGood = false;
		}else{
			oce.html("");
			isFormGood = true;
		}
		
		if(gndopt.val() == ""){
			isFormGood = false;
			gde.html("Please choose Gender");
		}else{
			isFormGood = true;
			gde.html("");
		}
		
		if(dj.val() == ""){
			isFormGood = false;
			dje.html("Please enter Date Joined");
		}else if(!/^\d{2}\/\d{2}\/\d{4}$/.test(dj.val())){
			isFormGood = false;
			dje.html('Please enter date in "dd/mm/yyyy" format');
		}else{
			isFormGood = true;
			dje.html("");
		}
		
		if(dob.val() == ""){
			isFormGood = false;
			dobe.html("Please enter Date of Birth");
		}else if(!/^\d{2}\/\d{2}\/\d{4}$/.test(dob.val())){
			isFormGood = false;
			dobe.html('Please enter date in "dd/mm/yyyy" format');
		}else{
			isFormGood = true;
			dobe.html("");
		}
		/*clsChks()
		for(var y = 0; y < subjchk.length; y++){
			if(subjchk[y].checked){
				countsubjchk++;
			}
		}
		
		if(countclasschk == 0){
			isFormGood = false;
			jquery("#errcls").html("Please select atleast one Class");
		}else{
			isFormGood = true;
			jquery("#errcls").html("");
		}
		
		if(countsubjchk == 0){
			isFormGood = false;
			jquery("#errsbj").html("Please select atleast one Subject");
		}else{
			isFormGood = true;
			jquery("#errsbj").html("");
		}
		if(!clsChks()){
			isFormGood = false;
		}else{
			isFormGood = true;
		}*/
		return isFormGood;
	}
	
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
					url: "crudscripts/teacher/addteacher.php",
					data: jquery("#teacherform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#edit").click(function(){
		if(checkForm()){
			/*jquery.ajax({type: "POST",
					url: "crudscripts/teacher/edit_teacher.php",
					data: jquery("#teacherform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});*/
			alert(checkForm());
		}
	});
	
	jquery(".unasgn").click(function(){
		var unasgn = 1;
		var tchID = jquery("#tchID").val();
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var classID = jquery(col[0]).text();
		if(jquery(".unasgn").length <= 0){
			//jquery(".form-container").load("teacher/edit.php", {"tchID":tchID});
			jquery("#response").html("Each teacher should have atleast one class. Assign another class before removing this one");
			
		}else{
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/edit_teacherclass.php",
						data: {"unasgn":unasgn, "classID":classID, "tchID":tchID}
			}).done(function(msg){
				jquery("#response").html(msg);
			});
			//alert(roleID);
		}
	});
	
	jquery(".asgn").click(function(){
		var asgn = 1;
		var tchID = jquery("#tchID").val();
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var classID = jquery(col[0]).text();
		//alert(jquery(".asgn").length);
		jquery.ajax({type:"POST",
						url: "crudscripts/teacher/edit_teacherclass.php",
						data: {"asgn":asgn, "classID":classID, "tchID":tchID}
		}).done(function(msg){
			jquery("#response").html(msg);
		});
		
	});
	
	jquery(".unasgnsub").click(function(){
		var unasgnsub = 1;
		var tchID = jquery("#tchID").val();
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var subjCode = jquery(col[0]).text();
		if(jquery(".unasgnsub").length <= 0){
			jquery("#response").html("Each teacher should have atleast one subject. Assign another subject before removing this one");
		}else{
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/edit_teachersubject.php",
						data: {"unasgnsub":unasgnsub, "subjCode":subjCode, "tchID":tchID}
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery(".asgnsub").click(function(){
		var asgnsub = 1;
		var tchID = jquery("#tchID").val();
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var subjCode = jquery(col[0]).text();
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/edit_teachersubject.php",
						data: {"asgnsub":asgnsub, "subjCode":subjCode, "tchID":tchID}
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>