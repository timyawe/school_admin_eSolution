<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	//require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	$class_selectsqlresult = mysqli_query($conn, "SELECT * FROM ClassDetailsList");
?>
<div class="page-title-container">
	<h2>{{nice}}</h2>
</div>
	<!--<div id="editModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"></div>
			</div>
		</div>
	</div>-->
<div class="page-container">
	<div class="top-controls-container">
		<button id="add">Add Class</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			<table border="1">
				<caption>Class Details List<span>Search Table</span></caption>
				<tr>
					<th>ID</th>
					<th>Description</th>
					<th>Class Teacher</th>
					<th>Students</th>
					<!--<th>Subjects</th>-->
					<th></th>
				</tr>
				
				<?php
				if (mysqli_num_rows($class_selectsqlresult) > 0) {
					while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
						echo "<tr class='rows'>";
						echo "<td class='id'>".$classrow['ID']."</td>";
						echo "<td>".$classrow['Class_Name']."</td>";
						echo "<td>".$classrow['ClassTeacher']."</td>";
						echo "<td>".$classrow['StudentsNo']."</td>";
						echo "<td><button class='edits' onclick='sick(this)'>Edit</button></td>";
						echo "</tr>";
					}
				}
				?>
				
				<!--	<td>1</td>
					<td>Baby Class</td>
					<td>Mr Right</td>
					<td>10</td>
					<td>3</td>
					<td><button class="edits">Edit</button></td>
				</tr>-->
			</table>
		</div>
	</div>	
</div>

<script>
var _row = null;
	jquery("#add").click(function() {
		jquery(".modal-body").load("class/edit", function() {
			jquery("#editModal").modal({show:true})
		});
	});
	
	function sick(fuck){
		_row = jquery(fuck).parents("tr");
		var col = _row.children("td");
		//alert(jquery(col[0]).text());
		var classID = jquery(col[0]).text();
		jquery(".modal-body").load("class/edit",{"classID":classID}, function() {
			jquery("#editModal").modal({show:true})
		});
	}
		
	/*jquery(".edits").click(function(){
		var tr = jquery(".edits").parents("tr");
		var cols = tr.children("td");
		alert(jquery(cols[0]).text());
		
	});*/
	
</script>