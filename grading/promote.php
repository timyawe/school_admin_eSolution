<div class="page-title-container">
	<h2>Promotion Details</h2>
</div>

<div class="page-container">
<div><button id="back">Back</button></div>
	<div class="top-controls-container">
		<select id="grdsopt">
			<option value="">Select Option</option>
			<option value="promoted">Promoted</option>
			<option value="remainers">Remainers</option>
		</select>
	</div>
	<div class="page-content-container">
		
	</div>
</div>

<script>
	jquery("#back").click(function(){
		window.history.back();
	});
	
	jquery("#grdsopt").change(function(){
		if(jquery("#grdsopt").val() == "promoted"){
			jquery(".page-content-container").load("grading/promoted.php");
		}
		
		if(jquery("#grdsopt").val() == "remainers"){
			jquery(".page-content-container").load("grading/remainers.php");
		}
	});
	
</script>