<?php 
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="page-title-container">
	<h2>Manage Teachers' Details</h2>
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
		<button id="addteacher">Add Teacher</button> <button id="roles">Manage Roles</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			
		</div>
	</div>
</div>

<script>
	jquery(document).ready(function(){
		jquery(".table-container").load("teacher/teacher_tabledata.php");
	});
	
	jquery("#addteacher").click(function() {
		jquery(".modal-body").load("teacher/edit", function() {
			jquery("#editModal").modal({show:true})
		});
	});
	
	var _row = null;
	
	function edit(btn) {
		_row = jquery(btn).parents("tr");
		var col = _row.children("td");
		
		var tchID = jquery(col[0]).text();
		jquery(".modal-body").load("teacher/edit", {"tchID":tchID}, function(){
			jquery("#editModal").modal({show:true})
		});
	}
	
	jquery("#roles").click(function(){
		jquery(".table-container").load("teacher/roles.php");
	});
</script>