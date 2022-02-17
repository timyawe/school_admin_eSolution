<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="page-title-container">
	<h2>Enter Grade Details</h2>
</div>

<div class="page-container">
<div><button id="back">Back</button></div>
	<div id="controls-error"></div>
	<div class="top-controls-container">
		<select id="classopt" name="classopt">
			<option value="">Select Class</option>
			<?php
			if (mysqli_num_rows($class_selectsqlresult) > 0) {
				while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
					echo 
						"<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
				}
			}
			?>
		</select>
		
		<select id="subjopt" name="subjopt">
			<option value="">Select Subject</option>
			<?php
			if (mysqli_num_rows($subject_selectsqlresult) > 0) {
				while ($subjrow = mysqli_fetch_assoc($subject_selectsqlresult)){
					echo 
						"<option value='".$subjrow['Code']."'>".$subjrow['Subject_Name']."</option>";
				}
			}
			?>
		</select>
		
		<select id="for" name="for">
			<option value="">Select For</option>
			<option value="BOT">BOT</option>
			<option value="MOT">MOT</option>
			<option value="EOT">EOT</option>
		</select>
		
		<button id="addgrades">Add Grades</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			
		</div>
	</div>
</div>

<script>
	jquery("#back").click(function() {
		window.history.back();
	});
	
	document.getElementById("addgrades").addEventListener("click", function() {
		var isFormGood = true;
		var classID = jquery("#classopt").val();
		var subjCode = jquery("#subjopt").val();
		var markfor = jquery("#for").val();
		if (classID == "" || subjCode == "" || markfor == "") {
			isFormGood = false;
		}
		if (isFormGood) {
			jquery(".table-container").load("grading/add_grades_table", {"classID":classID, "subjCode":subjCode, "markfor":markfor} );
			jquery("#controls-error").html("");
		} else {
			jquery("#controls-error").html("Please choose all options before you continue");
		}
	});
</script>