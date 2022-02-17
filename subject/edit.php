<?php
	if(isset($_POST['subcode'])){
		//connect to database
		require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
		
		$subrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Subject_Information WHERE Code=".$_POST['subcode']));
		$code = $subrow['Code'];
		$desc = $subrow['Subject_Name'];
	}else{
		$code = "";
		$desc = "";
	}
?>
<div class="form-container">
	<div class="form-heading-container">
		<?php
			if(isset($_POST['subcode'])){
				echo "<h2>Edit Subject</h2>";
			}else{
				echo "<h2>Add Subject</h2>";
			}
		?>
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="subjform">
		
		<div class="editrow">
			<input type="text" name="subcode" value="<?php echo $code; ?>" hidden />
			<input type="text" id="subj" name="subj" value="<?php echo $desc; ?>" placeholder="Enter Subject Name">
			<span class="required-mark">*</span></br>
			<span class="input-error" id="errsubj"></span>
		</div>
		<span class="required-mark">(*) Required Fields</span>
		
		<div class="editrow btn-row">
			<input type="button" id="add" value="Add"/>
			<input type="button" id="edit" value="Edit"/>
			<button type="button" id="cancel">Cancel</button>
		</div>
	</form>
</div>

<script>
	var sub = jquery("#subj");
	var es = jquery("#errsubj");
	
	function checkForm(){
		var isFormGood = true;
		
		if(sub.val() == ""){
			isFormGood = false;
			es.html("Please enter Subject Name");
		}else{
			isFormGood = true;
			es.html("");
		}
		return isFormGood;
	}
	
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type:"POST",
						url: "crudscripts/admin/subject/addsubject.php",
						data: jquery("#subjform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#edit").click(function(){
		if(checkForm()){
			jquery.ajax({type:"POST",
						url: "crudscripts/admin/subject/edit.php",
						data: jquery("#subjform").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>