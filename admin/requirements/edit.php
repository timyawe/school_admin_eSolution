<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Add Requirements<h2>
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="req-form">
		<div class="editrow">
			<fieldset>
			<legend>Choose Class *</legend>
				<?php 
					if (mysqli_num_rows($class_selectsqlresult) > 0) {
						while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
							echo "<input type='checkbox' class='clschk' name='class[]' value='".$classrow['ID']."'/>".$classrow['Class_Name']."<br/>";
						}
					}
					
				?>
					<input id="chkall" type="checkbox"/>All</br>
					<span class="input-error"></span>
			</fieldset>
		</div>
		
		<div class="editrow">
			<fieldset>
			<legend>Choose Section*</legend>
				<?php 
					if (mysqli_num_rows($section_selectsqlresult) > 0) {
						while ($sectionrow = mysqli_fetch_assoc($section_selectsqlresult)){
							echo "<input type='checkbox' name='section[]' value='".$sectionrow['ID']."'/>".$sectionrow['Description']."<br/>";
						}
					}
					
				?>
					<input type="checkbox" value="All"/>All</br>
					<span class="input-error"></span>
			</fieldset>
		</div>
		
		<div class="editrow">
			<input type="text" name="desc" placeholder="Enter Description"><span class="required-mark">*</span></br>
			<span class="input-error"></span>
		</div>
		
		<div class="editrow">
			<input type="text" name="amount" placeholder="Enter Amount"><span class="required-mark">*</span></br>
			<span class="input-error"></span>
		</div>
		
		<div class="editrow btn-row">
			<input id="add" type="button" value="Add"/>
			<input type="button" value="Edit"/>
			<button type="button">Cancel</button>
		</div>
	</form>
</div>

<script>
	jquery("#chkall").click(function(){
		jquery(".clschk").prop('checked', jquery(this).prop('checked'));
	});
	
	jquery("#add").click(function(){
		jquery.ajax({type: "POST",
					url: "crudscripts/admin/requirements/addrequirement.php",
					data: jquery("#req-form").serialize()
					}).done(function(msg){
						jquery("#response").html(msg);
					})
	});
</script>