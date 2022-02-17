<div id="replace">
<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$currsy = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SchoolYear_Information WHERE FromPeriod = year(curdate())"));
	if(!empty($_POST['classopt'])){$class = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Class_Information WHERE ID=".$_POST['classopt']));}
	if(!empty($_POST['sectopt'])){$sect = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Section_Information WHERE ID=".$_POST['sectopt']));}
	
	if ($_POST['stdID'] != "") {
		$stdrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Student_Information WHERE ID_No=". $_POST['stdID']));
			
		$classID = $stdrow['SYClassID'];
		$sectID = $stdrow['SectionID'];
		$sName = $stdrow['SurName'];
		$fName = $stdrow['FirstName'];
		$oName = $stdrow['OtherName'];
		$dob = date("d/m/Y", strtotime($stdrow['DOB']));
		$gender = $stdrow['Gender'];
		$address = $stdrow['Address'];
		$nationality = $stdrow['Nationality'];
		$datejoined = date("d/m/Y", strtotime($stdrow['Date_Registered']));
		$stdID = $stdrow['ID_No'];
		
		$section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Description FROM Section_Information WHERE ID=$sectID"));
		$othsection = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Section_Information WHERE ID !=$sectID"));
		
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
		$stdID = "";
		
	}
?>

<div class="form-container">
	<div class="form-heading-container">
		<?php if($stdID == ""){
			echo "<h2>Add Student</h2>";
			echo "<p>You have chosen to add student to ".$class['Class_Name']. " in ".$sect['Description']." section. If this is incorrect, click 
				Cancel and choose different options</p>";
		} else {
			echo "<h2>Edit Student</h2>";
		}
		?>
		<div>
			<?php
				if ($_POST['stdID'] == "") {
					if($_POST['classopt'] == "" || $_POST['sectopt'] == ""){
						echo "<p>Choose Class and Section before you continue</p>";
					}
				}
			?>
		</div>
		<div id="response"></div>
		<div id="grdn-response"></div>
	</div>
	
	<div class="form-content">
		<form id="std-form">
			<div class="editrow">
				<input type="text" id="stdID" name="stdID" value="<?php echo $stdID ?>" hidden />
			</div>
			
			<div class="editrow">
				<input type="text" name="clsID" value="<?php echo $classID ?>" hidden />
			</div>
			
			<div class="editrow">
				<input type="text" name="sectID" value="<?php echo $sectID ?>" hidden />
			</div>
			
			<?php
			if($stdID == ""){
				echo 
				"<div class='editrow'>
					<div><label>School Year:</label>". 
						"<input type='radio' name='cursy' value='".$currsy['ID']."' checked/>".$currsy['FromPeriod']. " - ". $currsy['ToPeriod'].
					"</div>
					<p>To add student to a new School Year, click Cancel and create new School Year</p>
				</div>";
			}
			
			if($stdID != ""){
				echo "<div class='editrow'>
						<label>Section:</label></br>";
				echo 	"<input type='radio' name='sect' value='$sectID' checked/>".$section['Description']. " (current)</br>";
				if($othsection){
					if(mysqli_num_rows($othsection)>0){
						echo "<input type='radio' name='sect' value=".$othsection['ID']."  />".$othsection['Description'];
					}
					echo "</div>";
				}
			}
			?>
			
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
				<input type="text" id="oName" name="oName" value="<?php echo $oName ?>" placeholder="Enter Other Name"></br>
				<span id="oName-error" class="input-error"></span>
			</div>
			
			
			<div class="editrow">
				<input type="text" id="dob" name="dob" value="<?php echo $dob ?>" placeholder="Enter Date of Birth">
				<span class="required-mark">*</span></br>
				<span id="dob-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<select id="genderopt" name="genderopt">
					<option value="">Choose Gender</option>
					<option value="Male" <?php if($gender == "Male") { echo "selected";}?>>Male</option>
					<option value="Female" <?php if($gender == "Female") { echo "selected";}?>>Female</option>
				</select><span class="required-mark">*</span></br>
				<span id="genderopt-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="address" name="address" value="<?php echo $address ?>" placeholder="Enter Address">
				<span class="required-mark">*</span></br>
				<span id="address-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="nationality" name="nationality" value="<?php echo $nationality ?>" placeholder="Enter Nationality">
				<span class="required-mark">*</span></br>
				<span id="nationality-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<input type="text" id="datejoined" name="datejoined" value="<?php echo $datejoined ?>" placeholder="Enter Date Joined">
				<span class="required-mark">*</span></br>
				<span id="datejoined-error" class="input-error"></span>
			</div>
			<span class="required-mark">(*) Required Fields</span>
			
			<div class="editrow btn-row">
				<input id="add" type="button" value="Add"/>
				<input type="button" id="edit" value="Edit"/>
				<button id="grdnbtn" type="button">Add Guardian</button>
				<button type="button" id="cancel">Cancel</button>
			</div>
		</form>
	</div>
</div>


<script>
	jquery(document).ready(function(){
		<?php
			if($stdID == ""){
				echo "jquery('#edit').attr('disabled','disabled');";
			}else{
				echo "jquery('#add').attr('disabled','disabled');";
			}
		?>
	});
	
	var stdID = jquery("#stdID");
	var sName = jquery("#sName");
	var fName = jquery("#fName");
	var oName = jquery("#oName");
	var dob = jquery("#dob");
	var genderopt = jquery("#genderopt");
	var address = jquery("#address");
	var nationality = jquery("#nationality");
	var datejoined = jquery("#datejoined");
	var sne = jquery("#sName-error");
	var fne = jquery("#fName-error");
	var one = jquery("#oName-error");
	var dobe = jquery("#dob-error");
	var gde = jquery("#genderopt-error");
	var ade = jquery("#address-error");
	var nate = jquery("#address-error");
	var dje = jquery("#datejoined-error");
	var isFormGood = true;
	
	function checkForm(){
		if(sName.val() == ""){
			isFormGood = false;
			sne.html("Please enter Sur Name");
		}/*else if(isNaN(sName.val())== true){
			isFormGood = false;
			sne.html("Please enter letters only");
		}*/else {
			isFormGood = true;
			sne.html("");
		}
		
		if(fName.val() == ""){
			isFormGood = false;
			fne.html("Please enter First Name");
		}/*else if(isNaN(fName.val())){
			isFormGood = false;
			fne.html("Please enter letters only");
		}*/else {
			isFormGood = true;
			fne.html("");
		}
		
		if(isNaN(oName.val()) && oName != ""){
			isFormGood = false;
			one.html("Please enter letters only");
		}else {
			isFormGood = true;
			one.html("");
		}
		
		if(dob.val() == ""){
			isFormGood = false;
			dobe.html("Please enter Date of Birth");
		}/*else if(!/^\d{2}-\d{2}-\d{4}$/i.test(dob.val())){
			isFormGood = false;
			dobe.html("Please enter date in 'dd-mm-yyyy' format");
		}*/else {
			isFormGood = true;
			dobe.html("");
		}
		
		if(genderopt.val() == ""){
			isFormGood = false;
			gde.html("Please choose Gender");
		}else {
			isFormGood = true;
			gde.html("");
		}
		
		if(address.val() == ""){
			isFormGood = false;
			ade.html("Please enter address");
		}/*else if(isNaN(address.val())){
			isFormGood = false;
			ade.html("Please enter letters only");
		}*/else {
			isFormGood = true;
			ade.html("");
		}
		
		if(nationality.val() == ""){
			isFormGood = false;
			nate.html("Please enter Nationality");
		}/*else if(isNaN(nationality.val())){
			isFormGood = false;
			nate.html("Please enter letters only");
		}*/else {
			isFormGood = true;
			nate.html("");
		}
		
		if(datejoined.val() == ""){
			isFormGood = false;
			dje.html("Please enter Date Joined");
		}/*else if(!/^\d{2}-\d{2}-\d{4}$/i.test(datejoined.val())){
			isFormGood = false;
			dje.html("Please enter date in 'dd-mm-yyyy' format");
		}*/else {
			isFormGood = true;
			dje.html("");
		}
		return isFormGood;
	}
	
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/student/addstudent.php",
						data: jquery("#std-form").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
				jquery("#add").attr("disabled","disabled");
			});
		}
	});
	
	jquery("#edit").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/student/editstudent.php",
						data: jquery("#std-form").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
		//location.reload();
	});
	
	jquery("#grdnbtn").click(function(){
		if(stdID.val() == "" && jquery("#response").html() == ""){
			jquery("#grdn-response").html("Please add student before adding guardian");
		}else{
			jquery("#replace").load("student/guardian.php", {"stdID":stdID.val()});
		}
		//jquery("#editModal").modal("hide");
		//jquery("#add").attr("href","#!student/details/guardian");
		//jquery("#editModal").on('hidden.bs.modal',function(e){
			//alert("ok");
			/*jquery(".modal-body").load("student/guardian.php",function(){
				jquery("#editModal").modal({show:true});
			});*/
		//});
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal("hide");
	});
</script>
</div>