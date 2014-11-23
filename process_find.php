<?php
	require_once("header.php");
	require_once("database.php");
	if (!isset($_SESSION['email'])) {
		echo "you need to login first";
		header("Location: /login.php");
		exit();
	}
	$email = $_SESSION['email'];
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
	$query = "SELECT * FROM ClassList WHERE email='" . $email  . "'";
	$db->query($query);
	$result = $db->get_row();
	$location = "UGLI";
	
	$query = "INSERT INTO ClassList (email, class1, dates, time, location) " .
					"VALUES ('$email', '$class1', '$date', '$time','$location')";
	echo $query;
	$result = $db->query($query);
	echo json_encode($result);
	displaySuccess();


	require_once("footer.php");

	function displayError($errorMsg) {
		echo $errorMsg;
	}

	function displaySuccess() {
		echo "Class successfully entered.<br/>";
	}

	// include_once('php-mailjet.class-mailjet-0.1.php');
	 
	// // Create a new Object
	// $mj = new Mailjet();
	 
	// // Get some of your account informations
	// $me = $mj->userInfos();
	 
	// // Display your firstname
	// echo $me->infos->firstname;
	$query = "SELECT * FROM ClassList
		WHERE class1 = '". $class1 . "'";
	$db->query($query);
	$match = $db->get_row();
	if ($match == null){
		echo "0 matches";
	}
	else{
		echo "$match[0]";
		while ($match = $db->get_row()){
			echo "$match[0]";
		}
	}
	$user2 = "Matt Leibold";
	$msg = "You will be meeting with $user2 for $class1 at: $time on $date at $location.";
	$headers = "From: studybuddy@sb.com"."<".$email. ">\r\n";
	mail($email, 'Study Buddy Signup', $msg,$headers);
	echo "Email sent";
?>