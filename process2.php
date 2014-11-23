<?php
	require_once("header.php");
	$dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com dbname=d9ekpsg66labji user=awmugmpdenzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ")
		or die('Could not connect: ' . pg_last_error());

	if (!isset($_POST['password1']) || 
		!isset($_POST['email']) ||
		!isset($_POST['name']) ||
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


	//$query = "SELECT * FROM Users WHERE email='" . $email  . "'";
	//$result = pg_query($query) or die("Query failed: " . pg_last_error());
	//$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	if ($line) displayError("The email address is already in use");

	//pg_free_result($result);

	pg_close($dbconn);
	require_once("footer.php");

	function displayError(errorMsg) {
		echo errorMsg;
	}

	function displaySuccess() {

	}
?>