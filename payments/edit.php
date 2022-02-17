<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if (!empty($_POST['pymtID'])){
		$pymtrow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM StudentPayments WHERE ID=".$_POST['pymtID']));
		$paidfor = $pymtrow['PaidFor'];
		$datepaid = date("d/m/Y", strtotime($pymtrow['Payment_Date']));
		$datercvd = date("d/m/Y", strtotime($pymtrow['Recieved_Date']));
		$ptype = $pymtrow['Payment_Type'];
		$amount = number_format($pymtrow['Amount_Paid']);
		$pymtID = $pymtrow['ID'];
	}
?>
<div class="form-container">
	<div class="form-heading-container">
		<h2>Edit Payment</h2>
		<div id="response"></div>
	</div>
	
	<div class="form-content">
		<form id="payment-form">
			<div class="editrow">
				<input type="text" id="pymtID" name="pymtID" value="<?php echo $pymtID ?>" hidden /><br/>
				<label for="paidfor">Paid For:</label>
				<input type="text" id="paidfor" name="paidfor" value="<?php echo $paidfor ?>" readonly /><span class="required-mark">*</span><br/>
				<span id="paidfor-error" class="input-error"></span>
			</div>

			<div class="editrow">
				<label for="datepaid">Payment Date:</label>
				<input type="text" id="datepaid" name="datepaid" value="<?php echo $datepaid ?>" /><span class="required-mark">*</span><br/>
				<span id="datepaid-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<label for="datercvd">Recieved Date:</label>
				<input type="text" id="datercvd" name="datercvd" value="<?php echo $datercvd ?>" /><span class="required-mark">*</span><br/>
				<span id="datercvd-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<label for="type">Payment Type:</label>
				<select id="ptype" name="ptype">
					<option value="">Choose Type</option>
					<option value="Cash" <?php if($ptype == "Cash"){echo "selected ";}?>>Cash</option>
					<option value="Bank" <?php if($ptype == "Bank"){echo "selected ";}?>>Bank</option>
					<option value="MTN Mobile Money" <?php if($ptype == "MTN Mobile Money"){echo "selected ";}?>>MTN Mobile Money</option>
					<option value="Airtel Money" <?php if($ptype == "Airtel Money"){echo "selected ";}?>>Airtel Money</option>
				</select><span class="required-mark">*</span><br/>
				<span id="ptype-error" class="input-error"></span>
			</div>
			
			<div class="editrow">
				<label for="amount">Amount Paid:</label>
				<input type="text" id="amount" name="amount" value="<?php echo $amount ?>" /><span class="required-mark">*</span><br/>
				<span id="amount-error" class="input-error"></span>
			</div>
			<span class="required-mark">(*) Required Fields</span>
			
			<div class="editrow btn-row">
				<input type="button" id="edit" value="Confirm Changes"/>
				<button type="button" id="cancel">Cancel</button>
			</div>
		</form>
	</div>
</div>

<script>
	var paidfor = jquery("#paidfor");
	var datepaid = jquery("#datepaid");
	var datercvd = jquery("#datercvd");
	var ptype = jquery("#ptype");
	var amount = jquery("#amount");
	var pfe = jquery("#paidfor-error");
	var dpe = jquery("#datepaid-error");
	var dre = jquery("#datercvd-error");
	var pte = jquery("#ptype-error");
	var ame = jquery("#amount-error");
	var isFormGood = true;
	
	function checkForm(){
		if(paidfor.val() == ""){
			isFormGood = false;
			pfe.html("Please enter Paid For");
		}else{
			isFormGood = true;
			pfe.html("");
		}
		
		if(datepaid.val() == ""){
			isFormGood = false;
			dpe.html("Please enter Payment Date");
		}else{
			isFormGood = true;
			dpe.html("");
		}
		
		if(datercvd.val() == ""){
			isFormGood = false;
			dre.html("Please enter Date Recieved");
		}else{
			isFormGood = true;
			dre.html("");
		}
		
		if(amount.val() == ""){
			isFormGood = false;
			ame.html("Please enter Amount");
		}else{
			isFormGood = true;
			ame.html("");
		}
		
		if(ptype.val() == ""){
			isFormGood = false;
			pte.html("Please choose Payment Type");
		}else{
			isFormGood = true;
			pte.html("");
		}
		
		return isFormGood;
	}
	
	jquery("#edit").click(function(){
		if(checkForm()){
			jquery.ajax({type: "POST",
						url: "crudscripts/payments/edit.php",
						data: jquery("#payment-form").serialize()
			}).done(function(msg){
				jquery("#response").html(msg);
			});
		}
	});
	
	jquery("#cancel").click(function(){
		jquery("#editModal").modal('hide');
	});
</script>