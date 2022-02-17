<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$fees_class_sql = mysqli_query($conn, "SELECT ClassID FROM ClassSectionFees");
	if($fees_class_sql){
		$clses = array();
		while($fcrow = mysqli_fetch_assoc($fees_class_sql)){
			array_push($clses, $fcrow['ClassID']);
		}
	}
	$x = [1,2];
	$clsIDName = array();
	while($clsIDNamerow = mysqli_fetch_assoc($class_selectsqlresult)){
		$clsIDName[$clsIDNamerow['ID']] = $clsIDNamerow['Class_Name'];
	}
	//print_r($clsIDName);
	//echo json_encode($clsIDName);
	
	 if($_POST['warning'] != "" ){$warning = $_POST['warning']; $checked = $_POST['checkedbox'];}else{$warning = 0; $checked = 0;}
	 
	
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Add Fees</h2>
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="fees-form">
		<div class="editrow">
			<fieldset id="chooseclass">
			<legend>Choose Class *</legend>
				<?php 
					/*if (mysqli_num_rows($class_selectsqlresult) > 0) {
						$clsID_array = array();
						while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
							array_push($clsID_array, $classrow['ID']);
						}
							foreach($x as $y){
								if($y == $classrow['ID']){
							echo "<input type='checkbox' id='clschk' class='clschk' name='class[]' value='".$classrow['ID']."' checked />".$classrow['Class_Name']."<br/>";
								}else{
									echo "<input type='checkbox' id='clschk' class='clschk' name='class[]' value='".$classrow['ID']."'/>".$classrow['Class_Name']."<br/>";
								}
							}
						}*/
						
					
				?>
				<input type='checkbox' id='clschk' class='clschk' name='class[]' value='1'/>Baby</br>
				<input type='checkbox' id='clschk' class='clschk' name='class[]' value='3'/>Top</br>
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
			<input type="text" id="amnt" name="amount" placeholder="Enter Amount"><span class="required-mark">*</span></br>
			<span class="input-error"></span>
		</div>
		
		<div class="editrow btn-row">
			<input type="button" id="add" value="Add"/>
			<button type="button" id="cancel">Cancel</button>
		</div>
	</form>
</div>

<script>
	jquery("#chkall").click(function(){
		jquery(".clschk").prop('checked', jquery(this).prop('checked'));
	});
	
	jquery("#add").click(function(){
		jquery.ajax({type: "POST",
					url: "crudscripts/admin/fees/addfees.php",
					data: jquery("#fees-form").serialize()
		}).done(function(msg){
			jquery("#response").html(msg);
		});
	});
	
	jquery("#cancel").click(function(){
		var cls = [];
		jquery('.clschk:checked').each(function(x,y){
			cls.push(jquery(y).val()); //add checked checkboxes to array
		})
		
		var feescls = <?php echo json_encode($clses) ?>; 
		
		
		if(feescls.some(x => cls.indexOf(x) >=0)){ //checking if similar elements exist in both arrays
			var clsIDs = feescls.filter(function(y){ //finding equal elements in both arrays
				return cls.indexOf(y) !== -1;
			});
			
			var no_feescls = cls.filter(function(z){ //finding not equal elements in both arrays
				return feescls.indexOf(z) <0;
			});
			
			jquery(".modal-body").load("admin/fees/class_with_fees_warning.php", {"clsfeesIDs":clsIDs, "no_feescls":no_feescls},function(){
				jquery("#editModal").modal({show:true});
			});
			//alert("True " + clsIDs + " : " + no_feescls );
		}else{
			alert("False");
		}
		//alert(cls + " : " + feescls);
		
	});
	
	
	jquery(document).ready(function(){
		var warning = <?= $warning ?>;  
		var clsIDName = <?php echo json_encode($clsIDName); ?>;
		
		if(!warning){
			jquery.each(clsIDName, function(key, value){ 
			jquery("<input type='checkbox' class='clschk' value='" + key + "' >" + value + "</br>").insertBefore(jquery("#chkall"));
			//console.log(key, value);
			});
		}else{
			var checked = <?= json_encode($checked) ?>;
			jquery.each(clsIDName, function(key, value){
			//This option uses the includes function
			/*if(checked.includes(key)){
				jquery("<input type='checkbox' class='clschk' checked value='" + key + "' >" + value + "</br>").insertBefore(jquery("#chkall"));
			//console.log(key, value);
			}else{
				jquery("<input type='checkbox' class='clschk' value='" + key + "' >" + value + "</br>").insertBefore(jquery("#chkall"));
			}*/ 
			
			if(jquery.inArray(key, checked) !== -1){
				jquery("<input type='checkbox' class='clschk' checked value='" + key + "' >" + value + "</br>").insertBefore(jquery("#chkall"));
			}else{
				jquery("<input type='checkbox' class='clschk' value='" + key + "' >" + value + "</br>").insertBefore(jquery("#chkall"));
			}
			});
			
		}
		
	});
</script>	