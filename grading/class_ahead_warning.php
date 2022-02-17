<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['fclsidx']!= "") {
		$fclsrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE Class_Index =".$_POST['fclsidx']));
		$fcls = $fclsrow['Class_Name'];
	}
	
	if ($_POST['tclsidx']!= "") {
		$tclsrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE Class_Index =".$_POST['tclsidx']));
		$tcls = $tclsrow['Class_Name'];
	}
?>
<p><strong>Warning</strong>: You have selected to promote student(s) from <strong><?php echo $fcls ?></strong> to <strong><?php echo $tcls ?></strong>. 
This means the selected student(s) will have skipped a class.
If you confirm the selection, click Continue, else click Cancel to change the selection.</p>
<button id="cont">Continue</button>
<button id="canc">Cancel</button>

<script>
	jquery("#cont").click(function(){
		var cursy = <?php echo $_POST['cursy'] ?>;
		var fclsidx = <?php echo $_POST['fclsidx'] ?>;
		var tclsidx = <?php echo $_POST['tclsidx'] ?>;
		var syopt = <?php echo $_POST['syopt'] ?>;
		
		jquery("#editModal").modal('hide');
		
		jquery("#editModal").on('hidden.bs.modal', function(e){
			jquery(".page-content-container").load("grading/promotion_tabledata.php", {"cursy":cursy,"fclsidx":fclsidx,"tclsidx":tclsidx,"syopt":syopt});
		});
		
	});
	
	jquery("#canc").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>