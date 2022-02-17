<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	$sectsqlrst = mysqli_query($conn,"SELECT Description FROM Section_Information");
	if(mysqli_num_rows($sectsqlrst)>1){
		$sectopt = "Both";
	}else{
		$sectrow = mysqli_fetch_assoc($sectsqlrst);
		$sectopt = $sectrow['Description'];
	}
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Set Section<h2>
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="sectionForm">			
		<div class="editrow">
			<p>Select Section</p>
			<input type="radio" name="section" value="Day" <?php if($sectopt == "Day"){echo "checked";} ?> />Day
			<input type="radio" name="section" value="Boarding" <?php if($sectopt == "Boarding"){echo "checked";} ?> />Boarding
			<input type="radio" name="section" value="Both" <?php if($sectopt == "Both"){echo "checked";} ?> />Both
		</div>
		
		<div class="editrow btn-row">
			<input id="add" type="button" value="Confirm"/>
			<input type="button" id="edit" value="Edit"/>
			<button type="button" id="cancel">Cancel</button>
		</div>
	</form>
</div>

<script>
	jquery("#add").click(function(){ 
		jquery.ajax({type: "POST",
					url: "crudscripts/section/addsection.php",
					data: jquery("#sectionForm").serialize(),
					}).done(function(msg) {
						jquery("#response").html(msg);
					});
	});
	
	jquery("#edit").click(function(){ 
		jquery.ajax({type: "POST",
					url: "crudscripts/section/editsection.php",
					data: jquery("#sectionForm").serialize(),
					}).done(function(msg) {
						jquery("#response").html(msg);
					});
	});
	
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>