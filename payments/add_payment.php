<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<div class="page-title-container">
	<h2>Add Payment Details</h2>
</div>

<div class="page-container">
	<a href="#!/payments/default">Back</a>
	<div class="add-payments-form">
	<div id="response"></div>
		<form id="addPaymentForm">
			<div class="form-section"><fieldset id="first">
				<select id="classopt" name="classopt">
					<option value="">Choose Class</option>
					<?php
					if (mysqli_num_rows($class_selectsqlresult) > 0) {
						while ($classrow = mysqli_fetch_assoc($class_selectsqlresult)){
							echo 
								"<option value='".$classrow['ID']."'>".$classrow['Class_Name']."</option>";
						}
					}
					?>
				</select><span class="required-mark">*</span>
				
				<select id="sectopt" name="sectopt">
					<option value="">Choose Section</option>
					<?php
					if (mysqli_num_rows($section_selectsqlresult) > 0) {
						while ($sectrow = mysqli_fetch_assoc($section_selectsqlresult)){
							echo 
								"<option value='".$sectrow['ID']."'>".$sectrow['Description']."</option>";
						}
					}
					?>
				</select><span class="required-mark">*</span>
				<!--<button type="button" class="nxt">Next</button>--></fieldset>
			</div>
			
			<div class="form-section"><fieldset>
				<div id="stdinsert">
				<select id='stdopt' name='stdopt'><option value=''>Choose Student</option><option value='Buggs'>Buggs</option>
				</select>
				</div>
				<!--<input type="text" placeholder="Enter Student Name"/>-->
				
				<p>OR</p>
				
				<table border="1">
					<caption>Select From Class List</caption>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Section</th>
						<th></th>
					</tr>
					
					<tr>
						<td>1</td>
						<td>Lovely Doe</td>
						<td>Boarding</td>
						<td>Select</td>
					</tr>
				</table><!--<button type="button" class="prev">Previous</button><button type="button" class="nxt">Next</button>--></fieldset>
			</div>
			
			<div class="form-section"><fieldset>
				<label>Select Item Paid For:</label>
				<select id="paidfor" name="paidfor">
					<option value="">Select Item</option>
					<option value="Fees">Fees</option>
					<?php
					if (mysqli_num_rows($requirements_selectsqlresult) > 0) {
						while ($reqrow = mysqli_fetch_assoc($requirements_selectsqlresult)){
							echo 
								"<option value='".$reqrow['ID']."'>".$reqrow['Description']."</option>";
						}
					}
					?>
				</select><span class="required-mark">*</span></fieldset>
			</div>
			
			<div class="form-section"><fieldset>
				<div class="editrow">
					<label>Being Paid For:</label>
					<input id="paidfortxt" type="text" />
				</div>
				
				<div class="editrow">
					<label>Student:</label>
					<input id="stdtxt" type="text" />
				</div>
				
				<div class="editrow">
					<label>Payment Date:</label>
					<input type="text" name="paiddate" placeholder="dd/mm/yyyy"/><span class="required-mark">*</span></br>
					<span class="input-error"></span>
				</div>
				
				<div class="editrow">
					<label>Recieved Date:</label>
					<input type="text" name="recdate" placeholder="dd/mm/yyyy"/><span class="required-mark">*</span></br>
					<span class="input-error"></span>
				</div>
				
				<div class="editrow">
					<label>Amount Paid:</label>
					<input type="text" name="amount"/><span class="required-mark">*</span></br>
					<span class="input-error"></span>
				</div>
				
				<div class="editrow">
					<label>Payment Type:</label>
					<select name="ptype">
						<option value="">Choose Type</option>
						<option value="Cash">Cash</option>
						<option value="Bank">Bank</option>
						<option value="MTN Mobile Money">MTN Mobile Money</option>
						<option value="Airtel Money">Airtel Money</option>
					</select><span class="required-mark">*</span>
				</div></fieldset>
			</div>
			
			<div class="btn-row">
				<button type="button" id="prev" onclick="navigate(-1)">Previous</button>
				<button type="button" id="nxt" onclick="navigate(1)">Next</button>
			</div>
		</form>
	</div>
</div>

<script>
	function back() {
		jquery("#page-view-container").load("payments/default");
	}
	
	var currentSection = 0; //Current section is the first one

showSection(currentSection); //Displays the current Section

//Display specified section
function showSection(x) {
	var y = document.getElementsByClassName("form-section");
	y[x].style.display = "block";
	
	//Display buttons accordingly
	if (x == 0) {
		document.getElementById("prev").style.display = "none";
	} else {
		document.getElementById("prev").style.display = "inline";
	}
	
	if (x == y.length - 1) {
		document.getElementById("nxt").innerHTML = "Submit";
	} else {
		document.getElementById("nxt").innerHTML = "Next";
	}
}

//Function to navigate sections
function navigate(x) {
	var y = document.getElementsByClassName("form-section");
	//var z = document.getElementsByClassName("btn-row");
	if (x == 0 /*&& !validateForm()*/) return false; //Exists if fields are invalid
	
	y[currentSection].style.display = "none"; //Hides the current section
	
	currentSection = currentSection + x; //Increase or Decrease the current section by 1
	
	//Submit the form if at the end
	if (currentSection >= y.length) {
		AddPayment();
		//document.getElementById("addPaymentForm").submit();
		//return false;
	}
	
	showSection(currentSection); //if not, display the current Section
	
}

jquery("#classopt").change(function(){
	var classopt = jquery("#classopt").val();
	if (classopt != "") {
		jquery.ajax({type:"POST",
					url: "crudscripts/payments/payments_student_selection.php",
					data: {"classopt":classopt}
		}).done(function(msg){
			alert(msg);
			//jquery("#stdinsert").html(msg);
			//jquery(msg).insertAfter(jquery("#firstopt"));
		});
	}
});

jquery("#stdopt").change(function(){
	if(jquery("#stdopt").val() != ""){
		//alert("ok");
		jquery("#stdtxt").val((jquery("#stdopt option:selected").text()));
	} else {
		jquery("#stdtxt").val("");
	}
});

jquery("#paidfor").change(function(){
	if(jquery("#paidfor").val() != ""){
		jquery("#paidfortxt").val(jquery("#paidfor option:selected").text());
	} else {
		jquery("#paidfortxt").val("");
	}
});

function AddPayment(){
	//alert("Submit");
	jquery.ajax({type:"POST",
				url: "crudscripts/payments/addpayment.php",
				data: jquery("#addPaymentForm").serialize()
	}).done(function(msg){
		jquery("#response").html(msg);
	});
}
/*var currentstep, nextstep;
jquery(".nxt").click(function(){
	currentstep = jquery(this).parent();
	nextstep = jquery(this).parent();
	//nextstep.css({'border':'solid 2px'});
	nextstep.hide();
	alert("ok");
	//currentstep.hide();
});

jquery(".prev").click(function(){
	/*currentstep = jquery(this).parent();
	nextstep = jquery(this).parent().prev();
	nextstep.css({'display':'block'});
	alert("ok");
	currentstep.hide();jquery("#try").css({'display':'block'});
});

function fine(){
	if(jquery("#nxt").html() == "Submit"){
		alert("Submit");
	}
}*/

</script>