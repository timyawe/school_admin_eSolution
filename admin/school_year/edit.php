<div class="form-container">
	<div class="form-heading-container">
		<h2>School Year Details<h2>
		<div id="response"></div>
	</div>
	
	<div class="form-content">
		<form id="schyrForm">
			<div class="editrow">
				<div><label>From</label></div>
				<input type="text" name="fyr" placeholder="Enter Start Year">
				<span class="required-mark">*</span></br>
				<span id="errfyr" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<div><label>To</label></div>
				<input type="text" name="tyr" placeholder="Enter End Year">
				<span class="required-mark">*</span></br>
				<span id="errtyr" class="input-error"></span>
			</div>
			
			<div class="editrow btn-row">
			<input id="add" type="button" value="Add"/>
			<input type="button" name="edit" value="Edit"/>
			<button type="button">Cancel</button>
		</div>
		</form>
	</div>
</div>

<script>
	jquery("#add").click(function(){
		jquery.ajax({type:"POST",
					url: "crudscripts/admin/schoolyear/add.php",
					data: jquery("#schyrForm").serialize()
		}).done(function(msg){
			jquery("#response").html(msg);
		});
	});
</script>