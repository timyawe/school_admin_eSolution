<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['stdID'] != "") {
		$stdID = $_POST['stdID'];
		$stdkinsqlresult = mysqli_query($conn, "SELECT * FROM StudentKin_Information WHERE StudentID=". $_POST['stdID']);
	} else {
		echo "Not Set";
	}
?>
<div class="tab-form-container">
	<button id="add">Add Guardian</button>
		<div class="guardian-content-container">
			<div class="table-container">
				<table border="1">
					<caption>Table Heading<span>Search Table</span></caption>
						<tr>
								<th>No</th>
								<th>Name</th>
								<th>Relationship</th>
								<th>Contact</th>
								<th></th>
							</tr>
							<?php 
								while($stdkinrow = mysqli_fetch_assoc($stdkinsqlresult)) {
									
									echo "<tr>";
									echo "<td hidden>".$stdkinrow['ID']."</td>";
									echo "<td>Add Counter</td>";
									echo "<td>".$stdkinrow['SurName']." ".$stdkinrow['FirstName']."</td>";
									echo "<td>".$stdkinrow['Student_Relationship']."</td>";
									echo "<td>".$stdkinrow['Primary_Contact']."</td>";
									echo "<td><button class='edit' onclick='edit(this)'>Edit</button> | <button class='more' onclick='more(this)'>More</button></td>";
									echo "</tr>";
								}
							?>
				</table>
			</div>
		</div>
</div>

<script>
jquery("#add").click(function() {
		var stdID = jquery("#stdID").val();
		jquery('.modal-body').load('student/guardian', {"stdID":stdID}, function() {
		jquery('#editModal').modal({show:true});
	});
	});
	
var _row = null;

function edit(btn){
	_row = jquery(btn).parents("tr");
	var col = _row.children("td");
	var grdnID = jquery(col[0]).text();
	
	jquery(".modal-body").load("student/guardian.php", {"grdnID":grdnID}, function(){
		jquery("#editModal").modal({show:true});
	});
	
}

function more(btn){
	_row = jquery(btn).parents("tr");
	var col = _row.children("td");
	var grdnID = jquery(col[0]).text();
	
	jquery(".guardian-content-container").load("student/guardian_details", {"grdnID":grdnID});
}
</script>