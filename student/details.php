
<div class="page-title-container">
	<h2>Student Details</h2>
</div>
<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body"></div>
				</div>
			</div>
		</div>

<div class="page-container">
	<div class="backbtn">Back</div> <input id="stdID" type="text" value="{{stdID}}"/>
	<div class="page-content-container">
		<div class="page-tabs-container">
			<button id="dem" class="tab-links">Demographic Info</button>
			<button id="grdn" class="tab-links">Guardian Info</button>
			<button id="grad" class="tab-links">Grading Info</button>
			<button id="pymts" class="tab-links">Payments Info</button>
			<button class="tab-links" onclick="openTab(event, 'comments-content');insertPageContent_comments()">General Comments</button>
		</div>
		
		<div class="tab-content-container">
			<div id="demographic-content" class="tab-content"></div>
			
			<div id="guardian-content" class="tab-content"></div>
			
			<div id="grading-content" class="tab-content"></div>
			
			<div id="payments-content" class="tab-content"></div>
			
			<div id="comments-content" class="tab-content"></div>
		</div>
	</div>
</div>

<script>
document.getElementById("dem").click();

jquery(".backbtn").click(function() {
		window.history.back();
	});

jquery("#dem").click(function(){
	openTab(event, "demographic-content");
	var stdID = jquery("#stdID").val();
	if(stdID != " "){
		jquery('#demographic-content').load('student/student_details_demographic',{"stdID":stdID});
		//insertPageContent("#demographic-content",'student/student_details_demographic',"stdID",stdID);
		//alert(stdID);
	}
});

jquery("#grdn").click(function(){
	openTab(event, "guardian-content");
	var stdID = jquery("#stdID").val();
	if(stdID != " "){//alert(stdID);
		jquery('#guardian-content').load('student/student_details_guardian',{"stdID":stdID});
		//insertPageContent("#demographic-content",'student/student_details_demographic',"stdID",stdID);
		//alert(stdID);
	}
});

jquery("#grad").click(function(){
	openTab(event, 'grading-content');
	var stdID = jquery("#stdID").val();
	if(stdID != " "){
		jquery("#grading-content").load('student/student_details_grading',{"stdID":stdID});
	}
});

jquery("#pymts").click(function(){
	openTab(event, 'payments-content');
	var stdID = jquery("#stdID").val();
	if(stdID != " "){//alert(stdID);
		jquery("#payments-content").load('student/student_details_payments',{"stdID":stdID});
	} 
});
</script>