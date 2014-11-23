function showDate(){
	$( "#datepicker" ).datepicker({
		showButtonPanel: true
	});
}
function setSchool(){
	var schoolList = ["University of Michigan"];

	var dropdown = document.getElementById("school");
	dropdown.remove(0);
	for (var i = 0; i < schoolList.length; ++i) {
		var opt = document.createElement('option');
		opt.innerHTML = schoolList[i];
		opt.value = schoolList[i];
		dropdown.appendChild(opt);
	}
}



/* Input validation */
function validateEmail(field) {
	if (field == "") return "No Email was entered.\n"
	else if (!((field.indexOf(".") > 0) &&
			(field.indexOf("@") > 0)) ||
		/[^a-zA-Z0-9.@_-]/.test(field))
		return "The Email address is invalid.\n"
	return ""
}

function validateUsername(field) {
	if (field == "") return "No Username was entered.\n"
	else if (field.length < 5)
		return "Usernames must be at least 5 characters.\n"
	else if (/[^a-zA-Z0-9_-]/.test(field))
		return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
	return ""
}

function validatePassword(p1) {
	if (p1 == "") return "No Password was entered.\n"
	else if (p1.length < 6)
		return "Passwords must be at least 6 characters.\n"
	else if (!/[a-z]/.test(p1) ||
		!/[A-Z]/.test(p1) ||
		!/[0-9]/.test(p1))
		return "Passwords require one each of a-z, A-Z and 0-9.\n"
	return ""
}

function validateFname(field) {
	if (field == "") return "No Forename was entered.\n"
	return ""
}


function validate(form) {
	fail = validateEmail(form.email.value);
	fail += validateUsername(form.username.value);
	fail += validatePassword(form.password.value);
	fail += validateFname(form.fname.value);
	if (fail == "") {
		/*$("#submittedAlert").fadeIn();*/
		return true;
	} else {
		alert(fail);
		return false;
	}
}

function setMajor() {
	var majorTypes = ["Math","Physics","Computer Science"];

	var dropdown = document.getElementById("major");
	dropdown.remove(0);
	for (var i = 0; i < majorTypes.length; ++i) {
		var opt = document.createElement('option');
		opt.innerHTML = majorTypes[i];
		opt.value = majorTypes[i];
		dropdown.appendChild(opt);
	}
	$('#major').multiselect();
}

function validateLogin(form){

}
