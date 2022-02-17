<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="roles-top-control">
<div><button id="back"> <!--onclick="window.history.back()"-->Back</button></div>
	<button id="addrole">New Role</button>	<button id="assignrole">Assign Role</button>
</div>
<?php 
	if(mysqli_num_rows($teacher_roles_selectsqlresult) > 0){
		echo "<table border='1'>
				<caption>Teacher Roles</caption>
				<tr>
					<th>No</th>
					<th>Description</th>
					<th>Teachers Assigned</th>
				</tr>";		
		$counter = 1;
		while($teacher_rolerow = mysqli_fetch_assoc($teacher_roles_selectsqlresult)){
			echo "<tr>";
			echo 	"<td hidden>".$teacher_rolerow['ID']."</td>";
			echo 	"<td>$counter</td>";
			echo	"<th>".$teacher_rolerow['Description']."</td>";
			echo	"<td>".$teacher_rolerow['TeachersAssigned']."</td>";
			echo	"<td><button class='edit'>Edit</button>";
			echo "</tr>";
			
			$counter++;
		}
		echo "</table>";
	}
?>

<script>
	jquery("#back").click(function(){
		jquery(".table-container").load("teacher/teacher_tabledata.php");
	});
	

	jquery("#addrole").click(function(){
		jquery(".modal-body").load("teacher/edit_role.php", function(){
			jquery("#editModal").modal({show:true});
		});
		//alert("ok");
	});
	
	jquery("#assignrole").click(function(){
		jquery(".modal-body").load("teacher/assignroles.php", function(){
			jquery("#editModal").modal({show:true});
		});
	});
	
	var _row = null;
	jquery(".edit").click(function(){
		_row = jquery(this).parents("tr");
		var col = _row.children("td");
		var roleID = jquery(col[0]).text();
		
		jquery(".modal-body").load("teacher/edit_role.php", {"roleID":roleID}, function(){
			jquery("#editModal").modal({show:true});
		});
	});
</script>