<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	
	<title>{{title}}</title>
	
	<script src="js/assets/jquery/jquery-3.6.0.min.js"></script>
	<script src="js/assets/angular/angular.min.js"></script>
	<script src="js/assets/angular/angular-route.js"></script>
	<script src="js/assets/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/assets/bootstrap/bootstrap.min.css">
	<script src="js/pagetabs.js"></script>
	<script src="js/edit_form_injection.js"></script>
	<!--<script src="js/form_multiple_sections.js"></script>-->
	<link rel="stylesheet" href="css/page_layout.css">
	
	<style>
	.tab-content {display: none}
	.form-section {display: none}
	//fieldset:not(#first) {display: none}
	caption {caption-side: top}
	
	</style>
	
	<script>
	jquery("#back").click(function() {
		window.history.back();
	});
	</script>
	
</head>