<?php
	require_once("header.php");
	require_once("database.php");
	if (!isset($_POST['password1']) || 
		!isset($_POST['email']) ||
		!isset($_POST['fname']) ||
		!isset($_POST['school']) ||
		!isset($_POST['grade']) ||
		!isset($_POST['major'])) {
		displayError("Insufficient post parameters supplied.");
	}
	echo json_encode($_POST);
	$name = $_POST['fname'];
	$password1 = $_POST['password1'];
	if (count($password1) <= 0) displayError("Password must be a non-zero number of characters");
	$salt = (string)rand();
	$hash = crypt($password1, $salt);
	$email = $_POST['email'];
	$college = $_POST['school'];
	$grade = $_POST['grade'];
	$grade = 2016;
	$major = $_POST['major'][0];


	$db = new Database();
	$query = "SELECT * FROM Users WHERE email='" . $email  . "'";
	$db->query($query);
	$result = $db->get_row();
	if ($result) displayError("The email address is already in use");

	
	$query = "INSERT INTO Users (name, email, passwordhash, passwordsalt, college, grad_year, major) " .
					"VALUES ('$name', '$email', '$hash', '$salt', '$college', '$grade', '$major')";
	echo $query;
	$result = $db->query($query);
	echo json_encode($result);
	displaySuccess();


	require_once("footer.php");

	function displayError($errorMsg) {
		echo $errorMsg;
		//header("Location: /signup.php");
		exit();
	}

	function displaySuccess() {
		global $name;
		global $email;
		$_SESSION['user'] = $name;
		$_SESSION['email'] = $email;
		echo "Welcome, " . $name . "<br>Your account has been created!  Now go find some study buddies";
		header("Location: /find.php");
		exit();
	}
?>