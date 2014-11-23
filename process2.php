<?php
	require_once("header.php");
	echo "penis";
	if (!isset($_POST['password1']) || 
		!isset($_POST['email']) ||
		!isset($_POST['fname']) ||
		!isset($_POST['school[]']) ||
		!isset($_POST['grade']) ||
		!isset($_POST['major']) ||
		!isset($_POST['classes[]'])) {
		displayError("Insufficient post parameters supplied.");
	}
	echo json_encode($_POST);
	$password1 = $_POST['password1'];
	if (count($password1) <= 0) displayError("Password must be a non-zero number of characters");
	$salt = openssl_random_pseudo_bytes(20);
	$hash = crypt($salt . $password1);
	$email = $_POST['email'];
	$college = $_POST['school[]'];
	$grade = $_POST['grade'];
	$major = $_POST['major'];


	//$db = new Database();
	//$query = "SELECT * FROM Users WHERE email='" . $email  . "'";
	//$db->query($query);
	//$result = $db->get_row();
	if ($result) displayError("The email address is already in use");

	/*
	$query = 	"INSERT INTO Users (name, email, passwordhash, passwordsalt, college, grad_year, major) " .
					"VALUES ('$name', '$email', '$passwordhash', '$passwordsalt', '$college', $grad_year, '$major')";
	$result = pg_query($query) or displayError(pg_last_error());

	*/

	require_once("footer.php");

	function displayError($errorMsg) {
		echo $errorMsg;
	}

	function displaySuccess() {

	}
?>