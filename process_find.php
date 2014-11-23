<?php
	require_once("header.php");
	require_once("database.php");
	if (!isset($_POST['class1']) || 
		!isset($_POST['date']) ||
		!isset($_POST['time'])){
		displayError("Insufficient post parameters supplied.");
	}
	echo json_encode($_POST);
	$class1 = $_POST['class1'];
	$date = $_POST['date'];
	$time = $_POST['time'];

	$db = new Database();
	$query = "SELECT * FROM ClassList WHERE class='" . $class1  . "'";
	$db->query($query);
	$result = $db->get_row();

	
	$query = "INSERT INTO ClassList (class, dates, time, location) " .
					"VALUES ('$class1', '$date', '$time')";
	echo $query;
	$result = $db->query($query);
	echo json_encode($result);
	displaySuccess();


	require_once("footer.php");

	function displayError($errorMsg) {
		echo $errorMsg;
	}

	function displaySuccess() {
		echo "Welcome, " . $name . "<br>Your account has been created!  Now go find some study buddies";
	}

	// include_once('php-mailjet.class-mailjet-0.1.php');
	 
	// // Create a new Object
	// $mj = new Mailjet();
	 
	// // Get some of your account informations
	// $me = $mj->userInfos();
	 
	// // Display your firstname
	// echo $me->infos->firstname;



?>