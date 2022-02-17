function openTab(evnt, tab) {
	
	var i, tabcontent, tablinks;
	
	tabcontent = document.getElementsByClassName("tab-content");
	
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	
	tablinks = document.getElementsByClassName("tab-links");
	
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace("active", "");
	}
	
	document.getElementById(tab).style.display = "block";
	
	evnt.currentTarget.className += " active";
	
}


/*var jquery = $.noConflict();*/

function insertPageContent(container, url, key, value) {
	jquery(container).load(url,{key:value});	
}

function insertPageContent_demographic() {
	jquery('#demographic-content').load('student/student_details_demographic');
}

function insertPageContent_guardian() {
	jquery('#guardian-content').load('student/student_details_guardian');
}

function insertPageContent_grading() {
	jquery('#grading-content').load('student/student_details_grading');
}

function insertPageContent_payments() {
	jquery('#payments-content').load('student/student_details_payments');
}

function insertPageContent_comments() {
	jquery('#comments-content').load('student/student_details_comments');
}