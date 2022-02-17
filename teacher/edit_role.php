<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(!empty($_POST['roleID'])){
		$rolerow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Roles WHERE ID =".$_POST['roleID']));
		$role = $rolerow['Description'];
		$roleID = $rolerow['ID'];
	} else{
		$role = "";
		$roleID = "";
	}
?>
<script>
	jquery(document).ready(function(){
		/*var roleID = <?php echo $roleID ?>;
		if(!<?php echo $roleID ?>){
			alert("no");
		}else {
			alert("yes");
		}*/
	});
</script>

<div class="form-container">
	<div class="form-heading-container">
		<?php
			if(!$roleID){
				echo "<h2>Add Role</h2>";
			}else{
				echo "<h2>Edit Role</h2>";
			}
		?>
		<div id="response"></div>
	</div>
	
	<div class="form-content">
		<form id="teacher_roleform">
			<div class="editrow">
				<input type="text" name="roleID" value="<?php echo $roleID ?>" hidden /><br/>
				<input type="text" id="role" name="role" value="<?php echo $role ?>" placeholder="Enter Role">
				<span class="required-mark">*</span></br>
				<span id="err_role" class="input-error"></span>
			</div>
			
			<div class="editrow btn-row">
				<input type="button" id="add" value="Add"/>
				<input type="button" id="edit" value="Edit"/>
				<button type="button" id="cancel">Cancel</button>
			</div>
		</form>
<div>

<script>
		function checkForm(){
			if(!jquery("#role").val()){
				isFormGood = false;
				jquery("#err_role").html("Please enter Role");
			}else{
				isFormGood = true;
				jquery("#err_role").html("");
			}
			return isFormGood;
		}
		
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type:"POST",
						url: "crudscripts/teacher/addrole.php",
						data: jquery("#teacher_roleform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#edit").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/teacher/editrole.php",
						data: jquery("#teacher_roleform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>