<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$studentsqlresult = mysqli_query($conn, "SELECT ID_No, SurName,FirstName FROM Student_Information WHERE ClassID=".$_POST['classID']);
	
	if($_POST['subjCode'] != "" || $_POST['markfor'] != "" || $_POST['classID'] != "") {
		$subjCode = $_POST['subjCode'];
		$markfor = $_POST['markfor'];
		$classID = $_POST['classID'];
	}
/*	if(mysqli_num_rows($studentsqlresult) >0) {
		while($stdrow = mysqli_fetch_assoc($studentsqlresult)){
			$stdID = $stdrow['ID_No'];
			$name = $stdrow['SurName']. " ". $stdrow['FirstName'];
		}
	}
	echo $stdID. "". $name; */
?>
<h2><?php echo "Enter $markfor Marks" ?> </h2>
<div id="response"></div>
<form id="gradesform">
	<input name="classID" type="text" value="<?php echo $classID ?>" />
	<input name="subjCode" type="text" value="<?php echo $subjCode ?>" />
	<input name="markfor" type="text" value="<?php echo $markfor ?>" />
	<table border="1">
		<tr>
			<th>Name</th>
			<th>Mark</th>
		</tr>
		<?php
			if(mysqli_num_rows($studentsqlresult) >0) {
				while($stdrow = mysqli_fetch_assoc($studentsqlresult)){
					echo "<tr>";
					echo "<td hidden><input name='id[]' type='text' value='".$stdrow['ID_No']."' /></td>";
					echo "<td><label>".$stdrow['SurName']. " ". $stdrow['FirstName']."</label></td>";
					echo "<td><input name='mark[]' type='text'/></td>";
					echo "</tr>";
					//$stdID = $stdrow['ID_No'];
					//$name = $stdrow['SurName']. " ". $stdrow['FirstName'];
				}
			}
		?>
	</table>
	<input type="button" id="addmarks" value="Add Marks">
</form>

<script>
	jquery("#addmarks").click(function(){
		jquery.ajax({type: "POST",
					url: "crudscripts/grading/addgrades.php",
					data: jquery("#gradesform").serialize()
		}).done(function(msg){
			jquery("#response").html(msg);
		});
	});
</script>
