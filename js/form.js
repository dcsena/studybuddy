/* Hide both buyerForm and sellerForm on load */
// function hideBoth() {
// 	$("#buyerForm").removeClass("hidden");
// 	$("#buyerForm").hide();
// 	$("#sellerForm").removeClass("hidden");
// 	$("#sellerForm").hide();
// }
function showDate(){
	var date = document.getElementById("datepicker");
	
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

function validatePasswords(p1, p2) {
	if (p1 == "" || p2 == "") return "No Password was entered.\n"
	else if (p1.length < 6 || p2.length < 6)
		return "Passwords must be at least 6 characters.\n"
	else if (!/[a-z]/.test(p1) ||
		!/[A-Z]/.test(p1) ||
		!/[0-9]/.test(p1) ||
		!/[a-z]/.test(p2) ||
		!/[A-Z]/.test(p2) ||
		!/[0-9]/.test(p2))
		return "Passwords require one each of a-z, A-Z and 0-9.\n"
	if (p1 != p2) return "Passwords do not match.\n"
	return ""
}

function validateFname(field) {
	if (field == "") return "No Forename was entered.\n"
	return ""
}

function validateZipCode(field) {
	if (field == "") return "No Zip Code was entered.\n"
	else if (!/(^\d{5}$)|(^\d{5}-\d{4}$)/.test(field))
		return "The Zip Code is invalid.\n"
	return ""
}

function validateCustType(field){
	if (field == "") return "No Customer Type was entered.\n";
	return "";
}

/* TODO: Continue validating buyerForm and sellerForm */

function validate(form) {
	fail = validateEmail(form.email.value);
	fail += validateUsername(form.username.value);
	fail += validatePasswords(form.password1.value, form.password2.value);
	fail += validateFname(form.fname.value);
	fail += validateZipCode(form.zip_code.value);
	fail += validateCustType(form.custType.value);
	if (fail == "") {
		/*$("#submittedAlert").fadeIn();*/
		return true;
	} else {
		alert(fail);
		return false;
	}
}

/* Hide both buyerForm and sellerForm slowly */
// function resetForm() {
// 	$("#buyerForm").slideUp("slow");
// 	$("#sellerForm").slideUp("slow");
// 	$("body").css("background-image", "url(img/both.jpg)");
// }

/* Show/hide buyerForm or sellerForm */
// function showHide(e) {
// 	if (e.name == "custType") {
// 		switch (e.value) {
// 			case 'buyer':
// 				$("#sellerForm").slideUp("slow");
// 				$("#buyerForm").slideDown("slow");
// 				$("body").css("background-image", "url(img/buyer.jpg)");
// 				break;
// 			case 'seller':
// 				$("#buyerForm").slideUp("slow");
// 				$("#sellerForm").slideDown("slow");
// 				$("body").css("background-image", "url(img/seller.jpg)");
// 				break;
// 			case 'both':
// 				$("#buyerForm").slideDown("slow");
// 				$("#sellerForm").slideDown("slow");
// 				$("body").css("background-image", "url(img/both.jpg)");
// 				break;
// 			default:
// 				$("#buyerForm").hide();
// 				$("#sellerForm").hide();
// 				$("body").css("background-image", "url(img/both.jpg)");
// 				break;
// 		}
// 	}
// }

function setMajor() {
	//var dogTypes = ["Affenpinscher", "Afghan Hound", "Airedale Terrier", "Akita", "Alaskan Malamute", "American English Coonhound", "American Eskimo Dog", "American Foxhound", "American Hairless Terrier", "American Leopard Hound", "American Staffordshire Terrier", "American Water Spaniel", "Anatolian Shepherd Dog", "Appenzeller Sennenhunde", "Australian Cattle Dog", "Australian Shepherd", "Australian Terrier", "Azawakh", "Barbet", "Basenji", "Basset Hound", "Beagle", "Bearded Collie", "Beauceron", "Bedlington Terrier", "Belgian Laekenois", "Belgian Malinois", "Belgian Sheepdog", "Belgian Tervuren", "Bergamasco", "Berger Picard", "Bernese Mountain Dog", "Bichon Frise", "Biewer Terrier", "Black and Tan Coonhound", "Black Russian Terrier", "Bloodhound", "Bluetick Coonhound", "Boerboel", "Bolognese", "Border Collie", "Border Terrier", "Borzoi", "Boston Terrier", "Bouvier des Flandres", "Boxer", "Boykin Spaniel", "Bracco Italiano", "Braque du Bourbonnais", "Briard", "Brittany", "Broholmer", "Brussels Griffon", "Bull Terrier", "Bulldog", "Bullmastiff", "Cairn Terrier", "Canaan Dog", "Cane Corso", "Cardigan Welsh Corgi", "Catahoula Leopard Dog", "Caucasian Ovcharka", "Cavalier King Charles Spaniel", "Central Asian Shepherd Dog", "Cesky Terrier", "Chesapeake Bay Retriever", "Chihuahua", "Chinese Crested", "Chinese Shar-Pei", "Chinook", "Chow Chow", "Cirneco dell'Etna", "Clumber Spaniel", "Cocker Spaniel", "Collie", "Coton de Tulear", "Curly-Coated Retriever", "Czechoslovakian Vlcak", "Dachshund", "Dalmatian", "Dandie Dinmont Terrier", "Danish-Swedish Farmdog", "Deutscher Wachtelhund", "Doberman Pinscher", "Dogo Argentino", "Dogue de Bordeaux", "Drentsche Patrijshond", "Dutch Shepherd", "English Cocker Spaniel", "English Foxhound", "English Setter", "English Springer Spaniel", "English Toy Spaniel", "Entlebucher Mountain Dog", "Estrela Mountain Dog", "Eurasier", "Field Spaniel", "Finnish Lapphund", "Finnish Spitz", "Flat-Coated Retriever", "French Bulldog", "French Spaniel", "German Longhaired Pointer", "German Pinscher", "German Shepherd Dog", "German Shorthaired Pointer", "German Spitz", "German Wirehaired Pointer", "Giant Schnauzer", "Glen of Imaal Terrier", "Golden Retriever", "Gordon Setter", "Grand Basset Griffon Vendeen", "Great Dane", "Great Pyrenees", "Greater Swiss Mountain Dog", "Greyhound", "Hamiltonstovare", "Harrier", "Havanese", "Hovawart", "Ibizan Hound", "Icelandic Sheepdog", "Irish Red and White Setter", "Irish Setter", "Irish Terrier", "Irish Water Spaniel", "Irish Wolfhound", "Italian Greyhound", "Jagdterrier", "Japanese Chin", "Jindo", "Kai Ken", "Karelian Bear Dog", "Keeshond", "Kerry Blue Terrier", "Kishu Ken", "Komondor", "Kooikerhondje", "Kromfohrlander", "Kuvasz", "Labrador Retriever", "Lagotto Romagnolo", "Lakeland Terrier", "Lancashire Heeler", "Leonberger", "Lhasa Apso", "Lowchen", "Maltese", "Manchester Terrier", "Mastiff", "Miniature American Shepherd", "Miniature Bull Terrier", "Miniature Pinscher", "Miniature Schnauzer", "Mudi", "Neapolitan Mastiff", "Newfoundland", "Norfolk Terrier", "Norrbottenspets", "Norwegian Buhund", "Norwegian Elkhound", "Norwegian Lundehund", "Norwich Terrier", "Nova Scotia Duck Tolling Retriever", "Old English Sheepdog", "Otterhound", "Papillon", "Parson Russell Terrier", "Pekingese", "Pembroke Welsh Corgi", "Perro de Presa Canario", "Peruvian Inca Orchid", "Petit Basset Griffon Vendeen", "Pharaoh Hound", "Plott", "Pointer", "Polish Lowland Sheepdog", "Pomeranian", "Poodle", "Portuguese Podengo", "Portuguese Podengo Pequeno", "Portuguese Pointer", "Portuguese Sheepdog", "Portuguese Water Dog", "Pug", "Puli", "Pumi", "Pyrenean Mastiff", "Pyrenean Shepherd", "Rafeiro do Alentejo", "Rat Terrier", "Redbone Coonhound", "Rhodesian Ridgeback", "Rottweiler", "Russell Terrier", "Russian Toy", "Saluki", "Samoyed", "Schapendoes", "Schipperke", "Scottish Deerhound", "Scottish Terrier", "Sealyham Terrier", "Shetland Sheepdog", "Shiba Inu", "Shih Tzu", "Siberian Husky", "Silky Terrier", "Skye Terrier", "Sloughi", "Slovensky Cuvac", "Small Munsterlander Pointer", "Smooth Fox Terrier", "Soft Coated Wheaten Terrier", "Spanish Mastiff", "Spanish Water Dog", "Spinone Italiano", "St. Bernard", "Stabyhoun", "Staffordshire Bull Terrier", "Standard Schnauzer", "Sussex Spaniel", "Swedish Lapphund", "Swedish Vallhund", "Thai Ridgeback", "Tibetan Mastiff", "Tibetan Spaniel", "Tibetan Terrier", "Tornjak", "Tosa", "Toy Fox Terrier", "Treeing Tennessee Brindle", "Treeing Walker Coonhound", "Vizsla", "Weimaraner", "Welsh Springer Spaniel", "Welsh Terrier", "West Highland White Terrier", "Whippet", "Wire Fox Terrier", "Wirehaired Pointing Griffon", "Wirehaired Vizsla", "Working Kelpie", "Xoloitzcuintli", "Yorkshire Terrier"];
	var majorTypes = [];

	var dropdown = document.getElementById("major");
	for (var i = 0; i < majorTypes.length; ++i) {
		var opt = document.createElement('option');
		opt.innerHTML = majorTypes[i];
		opt.value = majorTypes[i];
		dropdown.appendChild(opt);
	}
	$('#major').multiselect();
}
