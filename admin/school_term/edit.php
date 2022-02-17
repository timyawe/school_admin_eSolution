<?php
	if(isset($_POST['schtermID'])){
		//connect to database
		require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
		
		$schtermrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SchoolTerm_Information WHERE ID=".$_POST['schtermID']));
		$ID = $schtermrow['ID'];
		$desc = $schtermrow['Description'];
		$sdate = date("d/m/Y", strtotime($schtermrow['Start_Date']));
		$edate = date("d/m/Y", strtotime($schtermrow['End_Date']));
	}else{
		$ID = "";
		$desc = "";
		$sdate = "";
		$edate = "";
	}
	
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>School Term Details<h2>
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="schtermForm">			
		<div class="editrow">
		<input type="text" name="schtermID" value="<?php echo $ID; ?>" hidden />
			<select id="description" name="description">
				<option value="" <?php if($desc == ""){echo "selected";} ?>>Choose Term</option>
				<option value="Term I" <?php if($desc == "Term I"){echo "selected";} ?>>Term I</option>
				<option value="Term II" <?php if($desc == "Term II"){echo "selected";} ?>>Term II</option>
				<option value="Term III" <?php if($desc == "Term III"){echo "selected";} ?>>Term III</option>
			</select>
			<span class="required-mark">*</span></br>
			<span id="errdesc" class="input-error"></span>
		</div>
		
		<div class="editrow">
			<input type="text" id="sdate" name="sdate" value="<?php echo $sdate; ?>" placeholder="Enter Start Date">
			<span class="required-mark">*</span></br>
			<span id="errsdate" class="input-error"></span>
		</div>
		
		<div class="editrow">
			<input type="text" id="edate" name="edate" value="<?php echo $edate; ?>" placeholder="Enter End Date">
			<span class="required-mark">*</span></br>
			<span id="erredate" class="input-error"></span>
		</div>
		<span class="required-mark">(*) Required Fields</span>
		
		<div class="editrow btn-row">
			<input id="add" type="button" value="Add"/>
			<input type="button" id="edit" value="Edit"/>
			<button type="button">Cancel</button>
		</div>
	</form>
</div>

<script>
	var desc = jquery("#description");
	var sdate = jquery("#sdate");
	var edate = jquery("#edate");
	var ed = jquery("#errdesc");
	var esd = jquery("#errsdate");
	var eed = jquery("#erredate");
	
	function checkForm(){
		var isFormGood = true;
		
		if(desc.val() == ""){
			isFormGood = false;
			ed.html("Please choose description");
		}else{
			isFormGood = true;
			ed.html("");
		}
		
		if(sdate.val() == ""){
			isFormGood = false;
			esd.html("Please enter Start Date");
		}else if(!/^\d{2}\/\d{2}\/\d{4}$/.test(sdate.val())){
			isFormGood = false;
			esd.html('Please enter date in "dd/mm/yyyy" format');
		}else{
			isFormGood = true;
			esd.html("");
		}
		
		if(edate.val() == ""){
			isFormGood = false;
			eed.html("Please enter End Date");
		}else if(!/^\d{2}\/\d{2}\/\d{4}$/.test(edate.val())){
			isFormGood = false;
			eed.html('Please enter date in "dd/mm/yyyy" format');
		}else{
			isFormGood = true;
			eed.html("");
		}
		
		return isFormGood;
	}
			
	jquery("#add").click(function(){
		if(checkForm()){
			jquery.ajax({type:"POST",
						url: "crudscripts/admin/schoolterm/add.php",
						data: jquery("#schtermForm").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#edit").click(function(){
		
		if(checkForm()){
			jquery.ajax({type:"POST",
					url: "crudscripts/admin/schoolterm/edit.php",
					data: jquery("#schtermForm").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
</script>