<div class="page-title-container">
	<h2>Requirements</h2>
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
		<div id="back">Back</div>
		<button id="add">Add Requirements</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			<?php
				//connect to database
				require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
				$class_no = mysqli_num_rows(mysqli_query($conn, "SELECT Class_Name FROM Class_Information"));
				$clsreqsql = mysqli_query($conn, "SELECT Class_Name,Section FROM Requirements_Structure");
				$reqclasses = array();
				$reqsection = array();
				while($reqclassesrow = mysqli_fetch_assoc($clsreqsql)){
					array_push($reqclasses, $reqclassesrow['Class_Name']);
					array_push($reqsection, $reqclassesrow['Section']);
				}
				
				$reqssql = mysqli_query($conn, "SELECT * FROM Requirements_Information");
				if($reqssql){
					$counter = 1;
					echo "<table border='1'>
							<caption>Requirements<span>Search Table</span></caption>
							<tr>
								<th>No.</th>
								<th>Description</th>
								<th>Amount</th>
								<th style='text-align:center'>Class</th>
								<th>Section</th>
								<th></th>
							</tr>";
						while($reqsrow = mysqli_fetch_assoc($reqssql)){
							echo "<tr>
									<td hidden>".$reqsrow['ID']."</td>
									<td>$counter</td>
									<td>".$reqsrow['Description']."</td>
									<td>".number_format($reqsrow['Amount'])."</td>";
									if(count($reqclasses) == $class_no){
												echo "<td>All</td>";
											}else{
												echo "<td>".implode(", ",$reqclasses)."</td>";
											}
									echo "<td>".implode(", ",$reqsection)."</td>";
									echo "<td><button class='edits'>Edit</button></td>
								</tr>";
							$counter++;
						}
					echo "</table>";
				}
				?>
		</div>
	</div>	
</div>

<script>
	jquery("#back").click(function() {
		window.history.back();
	});
	
	jquery("#add, .edits").click(function() {
		jquery('.modal-body').load('admin/requirements/edit', function() {
			jquery("#editModal").modal({show:true})
		});
	});
</script>
	