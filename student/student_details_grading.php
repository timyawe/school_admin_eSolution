<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	
	if($_POST['stdID'] != ""){
		$gradeclass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ClassID FROM Grading_Information WHERE StudentID=".$_POST['stdID']));
	}
?>
<div class="grading-analysis-button">
	<button>Grading Analysis</button>
</div>

<div class="grading-details-content">
	<div class="grading-details-topcontrols">
	<div class="topcontrols-error"></div>
		<select id="classopt">
			<option value="">Select Class</option>
			<?php 
				if (mysqli_num_rows(mysqli_query($conn, "SELECT ClassID FROM Grading_Information WHERE StudentID=".$_POST['stdID'])) > 0) {
					while($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
						$classID = $gradeclass['ClassID'];
						if($classID == $classrow['ID']){
							echo "<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
						}
					}						
				} else {
					echo "<option value=''>No Grades Added</option>";
				}
			?>
		</select>
		
		<select id="term">
			<option value="">Select Term</option>
			<option value="Term I">Term I</option>
			<option value="Term II">Term II</option>
			<option value="Term III">Term III</option>
		</select>
		
		<button id="view">Show Grades</button>
	</div>
	
	<div class="grading-details-table">
		<!--<table border="1">
			<caption>Heading</caption>
			<tr>
				<th>Subject</th>
				<th>BOT</th>
				<th>MOT</th>
				<th>EOT</th>
			</tr>
			
			<tr>
				<td>English</td>
				<td>82</td>
				<td>67</td>
				<td></td>
			</tr>
		<table>-->
	</div>
</div>

<script>
	jquery("#view").click(function(){
		var stdID = jquery("#stdID").val();
		var classID = jquery("#classopt").val();
		var term = jquery("#term").val();
		
		if (classID != "" && term != ""){
			jquery(".topcontrols-error").html("");
			jquery(".grading-details-table").load("student/grades_tabledata.php", {"stdID":stdID,"classID":classID,"term":term});
		} else {
			jquery(".topcontrols-error").html("Please choose both options to continue");
		}
	});
</script>
