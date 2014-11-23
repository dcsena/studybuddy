<?php
	include("database.php");
	$email = $_POST['email'];
	$password = $_POST['password'];
	$db = new Database();
	$query = "SELECT * FROM Users WHERE email='" . $email . "'";
	$db->query($query);
	$result = $db->get_row();
	if (!$result) {
		echo "your email address is not in our system";
	} else {
		echo json_encode($result);
		$hash = crypt($result['passwordsalt'] . $password);
		if ($hash == $result['passwordhash']) {
			echo "congrats, you've logged in";
		} else {
			echo "incorrrect password.  this incident has been reported";
		}
	}

?>
