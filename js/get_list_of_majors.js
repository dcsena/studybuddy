
var mjr_str = "";
function get_majors(x) { // creates a list of all the majors from http://admissions.umich.edu/academics-majors/majors-degrees
	if (x.nodeName == 'A') {
		mjr_str += (x.firstChild.nodeValue + "!");
	} else {
		for (var i = 0; i < x.childNodes.length; i++) {
			get_majors(x.childNodes[i]);
		}
	}
}