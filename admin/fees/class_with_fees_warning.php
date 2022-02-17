<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	$clsnames = array();
	$cls_checked = array();
	if(isset($_POST['clsfeesIDs'])){
		foreach($_POST['clsfeesIDs'] as $chkd){
			array_push($cls_checked, $chkd);
		}
	}
	if(isset($_POST['no_feescls'])){
		foreach($_POST['no_feescls'] as $chkd){
			array_push($cls_checked, $chkd);
		}
	}
	print_r($cls_checked);
	if(count($_POST['clsfeesIDs']) > 1){
		$clsNames_sql = mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=". implode(" OR ID=", $_POST['clsfeesIDs']));
		while($clsNames_sqlrow = mysqli_fetch_assoc($clsNames_sql)){
			array_push($clsnames, $clsNames_sqlrow['Class_Name']);
		}
	}else{
		$clsNames_sql = mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=". implode($_POST['clsfeesIDs']));
		while($clsNames_sqlrow = mysqli_fetch_assoc($clsNames_sql)){
			array_push($clsnames, $clsNames_sqlrow['Class_Name']);
		}
	}
?>

<p><strong>Warning</strong>: You have chosen the following <?php if(count($clsnames) >1){echo "classes";}else{echo "class";} ?>; <strong><?php echo implode(", ",$clsnames); ?></strong> whose fees is already added.</br>
If you continue, the current fees amount for the <?php if(count($clsnames) >1){echo "those classes";}else{echo "that class";} ?> will be replaced!</p>
<button id="canc">Back</button>
<button id="cont">Continue</button>


<script>
	jquery("#cont").click(function(){
		var no_feescls = <?php if(isset($_POST['no_feescls'])){echo json_encode($_POST['no_feescls']);}else{echo 0;} ?>;//prevents javascript from reading an empty variable no_feescls
		var clsfeesIDs = <?php echo json_encode($_POST['clsfeesIDs']); ?>;
		var checked = <?php echo json_encode($cls_checked); ?>;
		var warning = true;
		
		jquery("#editModal").modal('hide');
			
		jquery("#editModal").on('hidden.bs.modal', function(e){
			jquery('.modal-body').load('admin/try.php', {"checkedbox":checked, "warning":warning}, function() {
				jquery("#editModal").modal({show:true});
				
			});
			//alert("Good");
		});
		
	});
</script>