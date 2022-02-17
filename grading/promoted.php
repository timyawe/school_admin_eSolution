<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$cls = mysqli_query($conn, "SELECT * FROM Class_Information");
	$currsy = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SchoolYear_Information WHERE FromPeriod = year(curdate())"));
	$nxtsy = mysqli_query($conn, "SELECT ID,FromPeriod,ToPeriod FROM SchoolYear_Information WHERE FromPeriod=".$currsy['ToPeriod']);
	$nxtsyrow = mysqli_fetch_assoc($nxtsy);
?>
<div class="promoted-container">
	<div class="controls-error"></div>
	<div>
		<div><label>Promoted From</label></div>
		<div><label>Current School Year:</label> 
		<?php echo "<input type='radio' id='cursy' value='".$currsy['ID']."' checked/>".$currsy['FromPeriod']. " - ". $currsy['ToPeriod']?></div>
		<div><select id="fcls">
			<option value="">Choose Class</option>
			<?php
				if(mysqli_num_rows($class_selectsqlresult)>0){
					while($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
						echo "<option value='".$classrow['Class_Index']."'>".$classrow['Class_Name']."</option>";
					}
				} else {
					echo "<option value=''>No Class</option>";
				}
			?>
		</select></div>
	</div><br>
	
	<div>
		<div><label>Promoted To</label></div>
		<div><select id="tcls">
			<option value="">Choose Class</option>
			<?php
				if(mysqli_num_rows($cls)>0){
					while($classrowt = mysqli_fetch_assoc($cls)){
						echo "<option value='".$classrowt['Class_Index']."'>".$classrowt['Class_Name']."</option>";
					}
				} else {
					echo "<option value=''>No Class</option>";
				}
			?>
		</select></div>
		<div><label>Select Next School Year</label></div>
		<?php 
			if(mysqli_num_rows($nxtsy)>0){
				echo "<input id='syopt' type='radio' value='".$nxtsyrow['ID']."'>".$nxtsyrow['FromPeriod']. " - ". $nxtsyrow['ToPeriod'];
			} else {
				echo "<button id='sy'>Set New School Year</button>";
			}
		?>
	</div>
	
	<div>
		<button id="cont">Continue</button>
	</div>
</div>

<script>
	jquery("#cont").click(function(){
		var cursy = jquery("#cursy").val();
		var fclsidx = jquery("#fcls").val();
		var tclsidx = jquery("#tcls").val();
		var syopt = jquery("#syopt").val();
		
		if(fclsidx == "" || tclsidx == "" || document.getElementById("syopt").checked == false){
			jquery(".controls-error").html("Please choose all options before you continue");
		} else if(fclsidx >= tclsidx){
			jquery(".controls-error").html("The Promoted To Class cannot be below or the same as the Promoted From Class");
		} else if(tclsidx - fclsidx > 1){
			jquery(".modal-body").load("grading/class_ahead_warning.php",  {"cursy":cursy,"fclsidx":fclsidx,"tclsidx":tclsidx,"syopt":syopt},function(){
				jquery("#editModal").modal({show:true});
			});
		} else{
			jquery(".controls-error").html("");
			jquery(".page-content-container").load("grading/promotion_tabledata.php", {"cursy":cursy,"fclsidx":fclsidx,"tclsidx":tclsidx,"syopt":syopt});
		}
		
	});
	
	jquery("#sy").click(function(){
		jquery(".modal-body").load("admin/school_year/edit.php", function(){
			jquery("#editModal").modal({show:true});
		});
	});
</script>