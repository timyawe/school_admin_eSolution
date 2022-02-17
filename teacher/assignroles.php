<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Assign Role</h2>
		<div id="response"></div>
	</div>
	<div class="form-content">
		<form id="assignroleform">
			<div class="editrow">
				<select id="roleopt" name="roleopt">
					<option value="">Choose Role</option>
					<?php
						if($teacher_roles_selectsqlresult){
							if(mysqli_num_rows($teacher_roles_selectsqlresult)>0){
								while($rolesrow = mysqli_fetch_assoc($teacher_roles_selectsqlresult)){
									echo "<option value='".$rolesrow['ID']."'>".$rolesrow['Description']."</option>";
								}
							}
						}
					?>
				</select>
				<span class="required-mark">*</span></br>
				<span id="err-role" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<label>Assigned Teachers</label></br>
				<div id="tchasgnd"></div>
			</div>
			
			<div class="editrow">
				<select id="clsopt" name="clsopt">
					<option value="">Choose Class</option>
					<?php
						if($class_selectsqlresult){
							if(mysqli_num_rows($class_selectsqlresult)>0){
								while($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
									echo "<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
								}
							}
						}
					?>
				</select><br/>
				<span id="errcls" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<select id="tchopt" name="tchopt">
					<option value="">Choose Teacher</option>
					<?php
						if($teacher_selectsqlresult){
							if(mysqli_num_rows($teacher_selectsqlresult)>0){
								while($tchrow = mysqli_fetch_assoc($teacher_selectsqlresult)){
									echo "<option value='".$tchrow['ID']."'>".$tchrow['SurName']." ".$tchrow['FirstName']."</option>";
								}
							}
						}
					?>
				</select>
				<span class="required-mark">*</span></br>
				<span id="errtch" class="input-error"></span>
			</div>
			
			<div class="editrow btn-row">
				<input type="button" id="assign" value="Assign"/>
				<button type="button" id="cancel">Cancel</button>
			</div>
		</form>
	</div>
</div>

<script>
	var roleopt = jquery("#roleopt");
	var clsopt = jquery("#clsopt");
	var tchopt = jquery("#tchopt");
	var err_role = jquery("#err-role");
	var errcls = jquery("#errcls");
	var errtch = jquery("#errtch");
	var isFormGood = true;
	
	function checkForm(){
		if(roleopt.val() == ""){
			isFormGood = false;
			err_role.html("Please choose Role");
		}else{
			isFormGood = true;
			err_role.html("");
		}
		
		if(roleopt.val() == 2 && clsopt.val() == ""){
			isFormGood = false;
			errcls.html("Please choose Class");
		}else{
			isFormGood = true;
			errcls.html("");
		}
		
		if(tchopt.val() == ""){
			isFormGood = false;
			errtch.html("Please choose Teacher");
		}else{
			isFormGood = true;
			errtch.html("");
		}
		return isFormGood;
	}
	
	jquery("#roleopt").change(function(){
		var roleopt = jquery("#roleopt").val();
		if(roleopt != ""){
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/assignedteachers.php",
						data: {"roleopt":roleopt}
			}).done(function(msg){
				jquery("#tchasgnd").html(msg);
				//jquery("#tchasgnd").append("</br>");
			});
		}
	});
	
	jquery("#assign").click(function(){
		if(checkForm()){
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/assignrole.php",
						data: jquery("#assignroleform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>