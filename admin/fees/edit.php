<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	$feesrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Fees_Structure WHERE ID=". $_POST['feesID']));
	
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Edit Fees</h2>
		<div id="response"></div>
	</div>
	<form id="feesedit-form">
	<div class="editrow">
			<input type="text" name="feesID" value="<?php echo $feesrow['ID'] ?>" /></br>
		</div>
		<div class="editrow">
			<input type="text"value="<?php echo $feesrow['Class_Name'] ?>" readonly /></br>
		</div>
		<div class="editrow">
			<input type="text" name="amount" value="<?php echo number_format($feesrow['Amount']) ?>" placeholder="Enter Amount"><span class="required-mark">*</span></br>
			<span class="input-error"></span>
		</div>
		
		<div class="editrow btn-row">
			<input type="button" id="edit" value="Edit"/>
			<button type="button" id="cancel">Cancel</button>
		</div>
	</form>
</div>

<script>
	jquery("#edit").click(function(){ 
		jquery.ajax({type:"POST",
					url:"crudscripts/admin/fees/edit.php",
					data: jquery("#feesedit-form").serialize()
		}).done(function(msg){
			jquery("#response").html(msg);
		});
		
	});

	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
	
</script>