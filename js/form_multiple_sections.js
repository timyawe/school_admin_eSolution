var currentSection = 0; //Current section is the first one

showSection(currentSection); //Displays the current Section

//Display specified section
function showSection(x) {
	var y = document.getElementById("ok");
	y[x].style.display = "block";
	
	//Display buttons accordingly
	if (x == 0) {
		document.getElementById("prev").style.display = "none";
	} else {
		document.getElementById("prev").style.display = "inline";
	}
	
	if (x == (x.length - 1)) {
		document.getElementById("nxt").innerHTML = "Submit";
	} else {
		document.getElementById("nxt").innerHTML = "Next";
	}
}

//Function to navigate sections
function navigate(x) {
	var y = document.getElementsByClassName("form-section");
	
	if (x == 0 && !validateForm()) return false; //Exists if fields are invalid
	
	y[currentSection].style.display = "none"; //Hides the current section
	
	currentSection = currentSection + x; //Increase or Decrease the current section by 1
	
	//Submit the form if at the end
	if (currentSection >= y.length) {
		document.getElementById("addPaymentForm").submit();
		return false;
	}
	
	showSection(currentSection); //if not, display the current Section
}