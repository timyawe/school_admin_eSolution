<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$currsy = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM SchoolYear_Information WHERE FromPeriod = year(curdate())"));
	$nxtsy = mysqli_query($conn, "SELECT ID,FromPeriod,ToPeriod FROM SchoolYear_Information WHERE FromPeriod=".$currsy['ToPeriod']);
	$nxtsyrow = mysqli_fetch_assoc($nxtsy);
	
?>
<div class="promoted-container">
	<div class="controls-error"></div>
	<div>
		<div><label>Current School Year:</label> 
		<?php echo "<input type='radio' id='cursy' value='".$currsy['ID']."' checked/>".$currsy['FromPeriod']. " - ". $currsy['ToPeriod']?></div>
		<div><label>Remained In</label></div>
		<div>
		<select id="tcls">
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
		</select>
		</div>
		<div><label>Select School Year</label></div>
		<?php 
			if(mysqli_num_rows($nxtsy)>0){
				echo "<input type='radio' id='syopt' value='".$nxtsyrow['ID']."'>".$nxtsyrow['FromPeriod']. " - ". $nxtsyrow['ToPeriod'];
			} else {
				echo "<button id='set_sy'>Set New School Year</button>";
			}
		?>
	</div>
	
	<div>
		<button id="cont">Continue</button>
	</div>
</div>

<script>
	jquery("#set_sy").click(function(){
		jquery(".modal-body").load("admin/school_year/edit.php", function(){
			jquery("#editModal").modal({show:true});
		});
	});
	
	jquery("#cont").click(function(){
		var cursy = jquery("#cursy").val();
		var fclsidx = jquery("#tcls").val();
		var tclsidx = jquery("#tcls").val();
		var syopt = jquery("#syopt").val();
		
		if(tclsidx == "" || document.getElementById("syopt").checked == false){
			jquery(".controls-error").html("Please choose all options before you continue");
		} else {
			jquery(".page-content-container").load("grading/promotion_tabledata.php", {"cursy":cursy,"fclsidx":fcls,"tclsidx":tcls,"syopt":syopt});
		}
	});
	
</script>