<div class="page-title-container">
	<h2>Teacher Details</h2>
</div>

<div class="page-container">
	<div class="backbtn">Back</div> <input id="tchID" type="text" value="{{tchID}}"/>
	<div class="page-content-container">
		<div class="page-tabs-container">
			<button id="pBtn" class="tab-links">Personal Details</button>
			<button class="tab-links" onclick="openTab(event, 'classes-content');
				insertPageContent('#classes-content', 'teacher/teacher_details_classes.php')">Classes</button>
			<button class="tab-links" onclick="openTab(event, 'subjects-content');
				insertPageContent('#subjects-content', 'teacher/teacher_details_subjects.php')">Subjects</button>
			<button class="tab-links" onclick="openTab(event, 'roles-content');
				insertPageContent('#roles-content', 'teacher/teacher_details_roles.php')">Roles</button>
			<button class="tab-links" onclick="openTab(event, 'comments-content');
			insertPageContent('#comments-content', 'teacher/teacher_details_comments.php')">General Comments</button>
		</div>
		
		<div class="tab-content-container">
			<div id="personal-content" class="tab-content"></div>
			
			<div id="classes-content" class="tab-content"></div>
			
			<div id="subjects-content" class="tab-content"></div>
			
			<div id="roles-content" class="tab-content"></div>
			
			<div id="comments-content" class="tab-content"></div>
		</div>
	</div>
</div>

<script>
	document.getElementById("pBtn").click();
	
	jquery(document).ready(function(){
//function start(){
	jquery("#pBtn").click(function(){
		openTab(event, 'personal-content'); 
		var tchID = jquery("#tchID").val();
		jquery('#personal-content').load('teacher/teacher_details_personal.php', {"tchID":tchID})
	});
//}
	});
</script>