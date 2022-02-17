<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if(!empty($_POST['classID']) && !empty($_POST['term']) && !empty($_POST['stdID'])){
		$classID = $_POST['classID'];
		$term = $_POST['term'];
		$stdID = $_POST['stdID'];
		$stdpymts = mysqli_query($conn, "SELECT * FROM StudentPayments WHERE ClassID=$classID AND Term='$term' AND StudentID=$stdID");
	} else {
		//die("Not");
	}
?>
<table border="1">
	<caption>Heading Matching Class &amp; Term</caption>
	
	<?php
				if(mysqli_num_rows($stdpymts)>0){
					echo "<tr>
							<th>Payment Date</th>
							<th>Paid For</th>
							<th>Amount</th>
							<th>Payment Type</th>
							<th>Date Recieved</th>
							<th></th>
						</tr>";
					while($stdpymtsrow = mysqli_fetch_assoc($stdpymts)){
						echo "<tr>";
						echo 	"<td hidden>".$stdpymtsrow['ID']."</td>";
						echo 	"<td>".$stdpymtsrow['Payment_Date']."</td>";
						echo 	"<td>".$stdpymtsrow['PaidFor']."</td>";
						echo 	"<td>".$stdpymtsrow['Amount_Paid']."</td>";
						echo 	"<td>".$stdpymtsrow['Payment_Type']."</td>";
						echo 	"<td>".$stdpymtsrow['Recieved_Date']."</td>";
						echo 	"<td><button class='edit'>Edit</button></td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><th>No Payments</th></tr>";
					echo "<tr><td>This student has not made any payments for the selected options</td></tr>";
					//echo "Error". mysqli_error($conn);
				}
			?>
<table>

<script>
var _row = null;
jquery(".edit").click(function() {
		_row = jquery(this).parents("tr");
		var col = _row.children("td");
		var pymtID = jquery(col[0]).text();
		
		jquery('.modal-body').load('payments/edit', {"pymtID":pymtID}, function() {
		jquery('#editModal').modal({show:true});
	});
	});
</script>