<div class="page-title-container">
	<h2>Fees Structure</h2>
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
		<button id="add">Add Fees</button>
	</div>
	
	<div class="page-content-container">
		<div class="table-container">
			<?php
				//connect to database
				require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
				
				$feessql = mysqli_query($conn, "SELECT * FROM Fees_Structure");
				if($feessql){
					$counter = 1;
					echo "<table border='1'>
							<caption>Fees Structure<span>Search Table</span></caption>
							<tr>
								<th>No.</th>
								<th>Amount</th>
								<th>Class</th>
								<th>Section</th>
								<th></th>
							</tr>";
					while($feesrow = mysqli_fetch_assoc($feessql)){
						echo "<tr>
								<td hidden>".$feesrow['ID']."</td>
								<td>$counter</td>
								<td>".number_format($feesrow['Amount'])."</td>
								<td>".$feesrow['Class_Name']."</td>
								<td>".$feesrow['Description']."</td>
								<td><button class='edits'>Edit</button></td>
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
	
	jquery("#add").click( function() {
		jquery('.modal-body').load('admin/fees/add', function() {
			jquery("#editModal").modal({show:true});
		});
	});
	
	jquery(".edits").click( function() {
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var feesID = jquery(col[0]).text();
		
		jquery('.modal-body').load('admin/fees/edit', {"feesID":feesID}, function() {
			jquery("#editModal").modal({show:true})
		});
	});
</script>
	