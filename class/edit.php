<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['classID'] != "") {
		$classIDsqlresult = mysqli_query($conn, "SELECT ID, Class_Name, Class_Index FROM Class_Information WHERE ID=".$_POST['classID']);
		while ($classIDrow = mysqli_fetch_assoc($classIDsqlresult)) {
			$classID = $classIDrow['ID'];
			$classname = $classIDrow['Class_Name'];
			$classindex = $classIDrow['Class_Index'];
		}
	} else {
		$classID = "";
		$classname = "";
		$classindex = "";
	}
	
?>
<div class="form-container">
	<div class="form-heading-container">
	<?php 
		if ($classID != ""){
			echo "<h2>Edit Class</h2>";
		} else {
			echo "<h2>Add Class</h2>";
		}
		?>
		
		<div id="response"></div>
	</div>
	
<div class="form-content">
	<form id="classForm" method="POST" action="">			
		<div class="editrow">
			<input id="cid" type="text" name="classID" value="<?php echo $classID ?>" hidden />
			<div><label for="clsName">Class Name</label></div>
			<input id="cn" type="text" name="clsName" value="<?php echo $classname ?>" placeholder="Enter Class Name">
			<span class="required-mark">*</span></br>
			<span id="cn-error" class="input-error"></span>
		</div>
		
		<div class="editrow">
			<div><label for="clsindex">Class Order Number</label></div>
			<input id="con" type="text" name="clsindex" value="<?php echo $classindex ?>" placeholder="Enter Class Order No. (e.g 1)">
			<span class="required-mark">*</span></br>
			<span id="con-error" class="input-error"></span>
		</div>
		
		<div class="editrow btn-row">
			<input id="add" type="button" value="Add" <?php if ($classID != ""){echo "disabled ";} ?> />
			<input type="button" id="edit" value="Edit" <?php if ($classID == ""){echo "disabled ";} ?> />
			<button type="button" id="close">Cancel</button>
		</div>
	</form>
</div>

<script>
	var cn = jquery("#cn")/*.val()*/;
	var con = jquery("#con")/*.val()*/;
	var formIsGood = true;
	
	function checkedForm(){
		if(cn.val() == ""){
			formIsGood = false;
			jquery("#cn-error").html("Please Enter Class Name");
		} else {
			jquery("#cn-error").html("");
		}
		
		if(con.val() == ""){
			formIsGood = false;
			jquery("#con-error").html("Please Enter Class Order Number");
		} else {
			jquery("#con-error").html("");
		}
		
		return formIsGood;
	}
	
	jquery("#add").click(function(){ 
		/*jquery("#classForm").submit(function(){*/ 
		if(checkedForm()){
			jquery.ajax({type: "POST",
						url: "includes/input/addclass.php",
						data: jquery("#classForm").serialize(),
						success: function(msg){
							jquery("#response").html(msg);
							//jquery("#cn").val("");
							//jquery("#con").val("");
							cn.val("");
							con.val("");
							//jquery("#add").attr("disabled","disabled");
							
						},
						error: function(msg){
							jquery(".form-heading-container").html("An Error has occured");
						}
			});
		/*});*/
		}
	});
	
	jquery("#edit").click(function(){
		if(checkedForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/class/edit.php",
						data: jquery("#classForm").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
				//cn.val("");
				//con.val("");
			});
		}
	});
	
	jquery("#close").click(function(){
		jquery("#editModal").modal('hide');
	});
	
	jquery("#editModal").on('hidden.bs.modal', function(e){
		//alert("done");
		location.reload();
	});
</script>