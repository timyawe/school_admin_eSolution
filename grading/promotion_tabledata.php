<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['cursy']!= "") {
		$cursy = trim($_POST['cursy']);
	}
	
	if ($_POST['fclsidx']!= "") {
		$fclsrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM Class_Information WHERE Class_Index =".$_POST['fclsidx']));
		$fcls = $fclsrow['ID'];
	}
	
	if ($_POST['tclsidx']!= "") {
		$tclsrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM Class_Information WHERE Class_Index =".$_POST['tclsidx']));
		$tcls = $tclsrow['ID'];
	}
	
	if ($_POST['syopt']!= "") {
		$syopt = trim($_POST['syopt']);
	}
	
	$syID = mysqli_query($conn, "SELECT ID FROM SchoolYearClass_Information WHERE SchoolYearID = $cursy AND ClassID = $fcls");
	//if($syID && mysqli_num_rows($syID)>0){
		$syIDrow = mysqli_fetch_assoc($syID);
		$stds = mysqli_query($conn, "SELECT * FROM PromotionData WHERE ClassID = $fcls AND SYClassID =".$syIDrow['ID']);
	//}
	
?>
<div class="table-container">
	<div id="response"></div>
	<form id="promotionForm">
		<input type="text" name="tcls" value="<?php echo $tcls ?>" />
		<input type="text" name="syopt" value="<?php echo $syopt ?>" />
		<?php
			if($stds){
				echo "<table border='1'>
					<tr>
						<th>Select</th>
						<th>Position</th>
						<th>Name</th>
						<th>Total Points</th>
					</tr>";
		
				while($stdsrow = mysqli_fetch_assoc($stds)){
					echo "<tr>";
					echo "<td><input type='checkbox' name='stdprmtdIDs[]' value='".$stdsrow['ID_No']."' /></td>";
					echo "<td>1st</td>";
					echo "<td>".$stdsrow['FullName']."</td>";
					echo "<td>".$stdsrow['TotalMarks']."</td>";
					
					echo "</tr>";
				}
				echo "</table>";
				//echo "</div><button type='button' id='done'>Done</button></div>";
			} else {
				echo "None";
			}
		?>
	</form>
</div>

<script>
	/*jquery(document).ready(function(){
		var SYClassID = <?php echo $SYClassID ?>;
		if(SYClassID != "NULL"){
			jquery("#response").html("The students to the class selected have already been promoted");
		}
	});*/
	
	jquery("#done").click(function(){
			
		//var tcls = <?php echo $tcls ?>;
	
		jquery.ajax({type:"POST",
					url: "crudscripts/grading/promotion.php",
					data: jquery("#promotionForm").serialize()
		}).done(function(msg){
			jquery("#response").html(msg);
		});
	});

</script>