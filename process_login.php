<?php
	include("database.php");
	include("header.php");
	$email = $_POST['email'];
	$password = $_POST['password'];
	$db = new Database();
	$query = "SELECT * FROM Users WHERE email='" . $email . "'";
	$db->query($query);
	$result = $db->get_row();
	if (!$result) {
		echo "your email address is not in our system";
		echo "redirecting to login!";
		// header("Location: http://fathomless-dusk-5464.herokuapp.com/login.php");
		header("Location: /login.php");
		exit;
	} else {
		echo json_encode($result);
		$hash = crypt($password, $result['passwordsalt']);
		if ($hash == $result['passwordhash']) {
			$_SESSION['email'] = $email;
			$_SESSION['user'] = $result['name'];
			echo "congrats, you've logged in";
			header("Location: /find.php");
			exit;
		} else {
			echo "incorrrect password.  this incident has been reported";
		}
	}

?>
