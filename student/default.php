<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="page-title-container">
	<h2>Manage Student Details</h2>
</div>
		<!--<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body"></div>
				</div>
			</div>
		</div>-->

<div class="page-container">
	<div class="top-controls-container">
		<div class="top-controls-error"><span class="controls-error"></span></div>
		<form id="std-ctrl-form">
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
				
			<select>
				<option>Select Stream</option>
			</select>
				
			<select id="sectopt" name="sectopt">
				<option value="">Select Section</option>
				<?php
				if (mysqli_num_rows($section_selectsqlresult) > 0) {
					while ($sectionrow = mysqli_fetch_assoc($section_selectsqlresult)){
						echo 
							"<option value='".$sectionrow['ID']."'>".$sectionrow['Description']."</option>";
					}
				}
				?>
			</select>
			
			<button type="button" id="stdlst">List Students</button>
			
			<button type="button" id="add">Add Students</button>
		</form>
	</div>
	
<div class="page-content-container">
	<div class="table-container">
		
	</div>
</div>
</div>



<script>
	jquery("#stdlst").click(function() {
		clsID = jquery("#classopt").val();
		sectID = jquery("#sectopt").val();
		if (clsID == "" || sectID == "" ) {
			jquery(".controls-error").html("Please choose atleast Class and Section to continue")
		} else {
			jquery(".controls-error").html("");
			jquery(".table-container").load("student/student_tabledata", {"classopt":clsID,"sectopt":sectID});
		}
	});
	
	jquery("#add").click(function() {
		clsID = jquery("#classopt").val();
		sectID = jquery("#sectopt").val();
		if (clsID == "" || sectID == "" ) {
			jquery(".controls-error").html("Please choose atleast Class and Section to continue")
		} else {
			jquery(".controls-error").html("");
			jquery('.modal-body').load('student/edit', {"classopt":clsID,"sectopt":sectID}, function() {
				jquery("#editModal").modal({show:true})
			});
		}
	});
	
	/*
	jquery("#add").click(function(){
		jquery.ajax({type: "POST",
		url: "trial.php",
		data: jquery("#std-ctrl-form").serialize()}).done(function(data){
			console.log(data);
		});
	});*/
</script>