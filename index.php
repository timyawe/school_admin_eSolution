<?php session_start(); /*if (!isset($_SESSION['loggedin'])){header("Location: login.php");}*/ ?>
<!DOCTYPE html>
<html lang="en">
<?php require "head_content.inc"; ?>

	<body>
	<div id="app-container" data-ng-app="ThisApp">
		<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body"></div>
				</div>
			</div>
		</div>
		<!--<div id="page-view-title">
			<h2>{{page-view-title}}</h2>
		</div>-->
		
		<div id="side-bar">
			<ul>
				<li><a href="#!dashboard">Dashboard</a></li>
				<li><a href="#!class/default">Class Information</a></li>
				<li><a href="#!student/default">Student Information</a></li>
				<li><a href="#!grading/default">Grading Information</a></li>
				<li><a href="#!teacher/default">Teacher Information</a></li>
				<li><a href="#!payments/default">Payments Information</a></li>
				<?php
				if($_SESSION['usertype'] == "Admin"){echo "<li><a href='#!admin/default'>Admin</a></li>";}
				?>
			</ul>		
		</div>
		
		<div id="app-container-heading">
			<h1>School Administration E-Solution</h1>
		</div>
		
		<div id="page-view-container" data-ng-view></div>
	
	</div>
	
	<script>
		var app = angular.module("ThisApp", ["ngRoute"]);
		/*app.constant("baseUrl", "http//:localhost:63342/schooleadmin/index.php");*/
		app.config(function($routeProvider/*, $locationProvider*/) {
			$routeProvider
			.when("/dashboard", {templateUrl : "dashboard.php"})
			.when("/class/default", {templateUrl : "class/default.php", controller : "classTitle"})
			.when("/student/default", {templateUrl : "student/default.php"/*, css : "css/page_layout.css"*/})
			.when("/grading/default", {templateUrl : "grading/default.php"})
			.when("/teacher/default", {templateUrl : "teacher/default.php"})
			.when("/payments/default", {templateUrl : "payments/default.php"})
			.when("/admin/default", {templateUrl : "admin/default.php"})
			/*.when("/student/edit", {templateUrl : "student/edit.php"})*/
			.when("/student/details/:stdID", {templateUrl : "student/details.php", controller: "studentDetails"})
			.when("/student/details/guardian", {templateUrl : "student/details.php", controller : "selectGuardian"})
			.when("/grading/add", {templateUrl : "grading/add.php"})
			.when("/grading/promote", {templateUrl : "grading/promote.php"})
			.when("/teacher/details/:tchID", {templateUrl : "teacher/details.php", controller: "teacherDetails"})
			.when("/payments/add", {templateUrl : "payments/add_payment.php"})
			.when("/admin/fees_structure", {templateUrl : "admin/fees/fees_structure.php"})
			.when("/admin/requirements", {templateUrl : "admin/requirements/requirements.php"})
			/*$locationProvider.html5Mode(true)*/;
			
		});
		
		app.controller("classTitle", function($scope) {
			$scope.nice = "Manage Class Details";
		});
		
		app.controller("selectGuardian", function() {
			document.getElementById("grdn").click();
		});
		
		app.controller("studentDetails", function($scope, $http, $routeParams){
			/*$http({method:"POST",
					url: "student/details.php",
					params: {stID: $routeParams.stdID}
			}).then(function(msg){
				$scope.id=msg.data
			});*/
			$scope.stdID = $routeParams.stdID;
		});
		
		app.controller("teacherDetails", function($scope, $routeParams){
			$scope.tchID = $routeParams.tchID;
			/*document.getElementById("pBtn").click(function(){
		openTab(event, 'personal-content'); 
		var tchID = jquery("#tchID").val();
		jquery('#personal-content').load('teacher/teacher_details_personal.php', {"tchID":$routeParams.tchID});
		});*/
		});
	</script>
	
	
	<!--<script type="text/javascript">
		var jquery = $.noConflict();
	</script>-->
	
<!--	<script>
	var jquery = $.noConflict();
		
		/*jquery('.page-container').on('load', function() {
			jquery('.page-container').load('student/student_default_content.php');
		});*/
		
		jquery('.edit').on('click', function() {
			jquery('.trial').load('student/edit', function() {
			alert("This sucks");});
		
		});
		/*jquery('.page-containers').on('click', function() {
			alert("This sucks more");
			jquery('.page-container').load('student/student_default_content');
		});*/
		
	</script>
	
<!--	<script>
	function openTab(evnt, tab) {
	var i, tabcontent, tablinks;
	
	tabcontent = document.getElementsByClassName("tabcontent");
	
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	
	tablinks = document.getElementsByClassName("tablinks");
	
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace("active", "");
	}
	
	document.getElementById(tab).style.display = "block";
	
	evnt.currentTarget.className += " active";
}
	</script>-->
	</body>
	
</html>