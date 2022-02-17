<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="page-title-container">
	<h2>Manage Grading Details</h2>
</div>

<div class="page-container">
	<div class="page-tabs-container">
		<a href="#!grading/add">Enter Grades</a>
		<a href="#!grading/promote">Promote Students</a>
		<button>Grades Analysis</button>
	</div>
	<div class="top-controls-container">
	<div id="controls-error"></div>
	<form id="gradecontrols">
		<select id="classopt" name="classopt">
			<option value="">Choose Class</option>
			<?php
			if (mysqli_num_rows($class_selectsqlresult) > 0) {
				while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
					echo 
						"<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
				}
			}
			?>
		</select><span class="required-mark">*</span>

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
		
		<select id="for" name="grdfor">
			<option value="">Select For</option>
			<option value="BOT">BOT</option>
			<option value="MOT">MOT</option>
			<option value="EOT">EOT</option>
		</select>
	</form>	
		<button id="view">View Grades</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			<!--<table border="1">
				<caption>Table Heading<span>Search Table</span></caption>
				<tr>
					<th>Name</th>
					<th>Mark</th>
				</tr>
			</table>-->
		</div>
	</div>
</div>

<script>
	jquery("#view").click(function(){
		var classopt = jquery("#classopt").val();
		var subjopt = jquery("#subjopt").val();
		var grdfor = jquery("#for").val();
		
		if(classopt == "" || subjopt == "" || grdfor == ""){
			jquery("#controls-error").html("Please choose all options before you continue");
		} else {
			jquery("#controls-error").html("");
			jquery.ajax({type:"POST",
						url: "crudscripts/grading/viewgrades.php",
						data: jquery("#gradecontrols").serialize()
			}).done(function(msg){
				jquery(".table-container").html(msg);
			})
		}
	});
</script>