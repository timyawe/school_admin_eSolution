<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/schooltermvar.inc";

	if ($_POST['classopt']!= "") {
		$classID = trim($_POST["classopt"]);
	}
	
	if ($_POST['sectopt']!= "") {
		$sectID = trim($_POST["sectopt"]);
	}
	
	if ($_POST['stdopt']!= "") {
		$stdID = trim($_POST["stdopt"]);
	}
	
	if ($_POST['paidfor']!= "") {
		if ($_POST['paidfor'] != "Fees") {
			$paidfor_req = trim($_POST["paidfor"]);
			$paidfor_fees = "NULL";
		} else {
			$feessqlresult = mysqli_query($conn, "SELECT FeesID FROM SchoolFeesIDs WHERE ClassID = $classID AND SectionID = $sectID");
			if($feessqlresult){
				if(mysqli_num_rows($feessqlresult)>0){
					while($feesrow = mysqli_fetch_assoc($feessqlresult)){
						$paidfor_fees = $feesrow['FeesID'];
						$paidfor_req = "NULL";
					}
				}
			}
		}
	}
	
	if ($_POST['paiddate'] != "") {
		//Change date format for mysql date compatibility
		$paiddate = date("Y-m-d", strtotime(trim($_POST['paiddate'])));
	}
	
	if ($_POST['recdate'] != "") {
		//Change date format for mysql date compatibility
		$recdate = date("Y-m-d", strtotime(trim($_POST['recdate'])));
	}
		
	if ($_POST['amount']!= "") {
		$amount = trim($_POST["amount"]);
	}
	
	if ($_POST['ptype']!= "") {
		$ptype = trim($_POST["ptype"]);
	}
	//echo $amount.$paiddate.$recdate.$ptype.$classID.$stdID.$paidfor_fees.$paidfor_req.$schtermID;
	if(mysqli_query($conn, "INSERT INTO PaymentsIn_Information (Amount_Paid,Payment_Date,Recieved_Date,Payment_Type,ClassID,StudentID,SchoolFeesID,
							RequirementsID,SchoolTermID) VALUES ($amount,'$paiddate','$recdate','$ptype',$classID,$stdID,$paidfor_fees,$paidfor_req,
							$schtermID)")){
		echo "<span class='alert-response-success'>Payment was added successfully</span>";
							} else {
								echo "<span class='alert-response-error'>Error: ".mysqli_error($conn)."</span>";
							}
?>