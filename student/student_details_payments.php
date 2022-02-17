<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	
	if($_POST['stdID'] != ""){
		$paymentsclass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ClassID FROM PaymentsIn_Information WHERE StudentID=".$_POST['stdID']));
		$currentclassrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SYClassID FROM Student_Information WHERE ID_No=".$_POST['stdID']));
		$feestobepaid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Amount FROM FeesToBePaid WHERE ID_No=".$_POST['stdID']. " AND ClassID=".
			$currentclassrow['SYClassID']));
		$feespaid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Amount_Paid FROM FeesPaid WHERE ID_No=".$_POST['stdID']. " AND ClassID=".
			$currentclassrow['SYClassID']));
		$feesbal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Feesbalance FROM FeesBalance WHERE ID_No=".$_POST['stdID']. " AND ClassID=".
			$currentclassrow['SYClassID']));
	}
	
?>
<div class="payments-topbar">
	<div class="payments-topbar-labels">
		<label>Fees To Be Paid:</label>
		<label><?php if($feestobepaid){echo $feestobepaid['Amount'];} ?></label>
		<label>Total Fees Paid:</label>
		<label><?php if($feespaid){echo $feespaid['Amount_Paid'];} ?></label>
		<label>Fees Balance:</label>
		<label><?php if($feesbal){echo $feesbal['FeesBalance'];} ?></label>
	</div>
	
	<div class="payments-topbar-buttons">
		<a href="#!payments/add">Add Payment</a>
		<div class="topbar-buttons-error"></div>
		<select id="classopt">
			<option value="">Select Class</option>
			<?php 
				if (mysqli_num_rows(mysqli_query($conn, "SELECT ClassID FROM PaymentsIn_Information WHERE StudentID=".$_POST['stdID'])) > 0) {
					while($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
						$classID = $paymentsclass['ClassID'];
						if($classID == $classrow['ID']){
							echo "<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
						}
					}						
				} else {
					echo "<option value=''>No Payments Added</option>";
				}
			?>
		</select>
		
		<select id="termopt">
			<option value="">Select Term</option>
			<option value="Term I">Term I</option>
			<option value="Term II">Term II</option>
			<option value="Term III">Term III</option>
		</select>
		
		<button onclick="injectFeesDetails()">View Fees Payment</button>
		<button onclick="injectAllPayments()">View All Payment</button>
	</div>
	
	<div class="payments-details-content">
		<div class="payments-details-default">
			Extra Ameneties Paid For
		</div>
	</div>
</div>

<script>
	function injectFeesDetails() {
		var classID = jquery("#classopt").val();
		var term = jquery("#termopt").val();
		var stdID = jquery("#stdID").val();
		if( classID != "" && term != ""){
			jquery(".topbar-buttons-error").html("");
			jquery(".payments-details-content").load("student/schoolfees_payments", {"classID":classID,"term":term,"stdID":stdID});
		} else {
			jquery(".topbar-buttons-error").html("Please choose both options to continue");
		}
	}
	
	function injectAllPayments() {
		var classID = jquery("#classopt").val();
		var term = jquery("#termopt").val();
		var stdID = jquery("#stdID").val();
		if( classID != "" && term != ""){
			jquery(".topbar-buttons-error").html("");
			jquery(".payments-details-content").load("student/all_payments_tabledata", {"classID":classID,"term":term,"stdID":stdID});
		} else {
			jquery(".topbar-buttons-error").html("Please choose both options to continue");
		}
	}
	
</script>