<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check password input
		require_once("database.php");
		$email = $_POST['email'];
		$password = $_POST['password'];
		$db = new Database();
		$query = "SELECT * FROM Users WHERE email='" . $email . "'";
		$db->query($query);
		$result = $db->get_row();
		if (!$result) {
			$login_error = "We can't find that email address";
		} else {
			$hash = crypt($password, $result['passwordsalt']);
			if ($hash == $result['passwordhash']) {
				if (!isset($_SESSION)) session_start();
				$_SESSION['email'] = $email;
				$_SESSION['user'] = $result['name'];
				if (isset($_COOKIE['prev_url'])) header('Location: http://' . $_SERVER['HTTP_HOST'] . $_COOKIE['prev_url']);
				else header("Location: /find.php");
				exit;
			} else {
				$login_error = "Incorrrect password.  This incident has been reported.";
			}
		}
	}
	$no_prev_url = true;
	include("header.php");
?>
<h1> Meet friends in your classes. </h1>
<br/>
<?php
	if (isset($login_error)) {
		echo "<div class='main_image' style='color: red;'>" . $login_error . "</div>";
	}
?>
<div id='logincontainer' style="max-width: 300px; display: block; margin: 0 auto; text-align: center">
<form role="form" class="form" name="login" autocomplete="off" action="login.php" method="post" onSubmit = "return validateLogin(this)">
	<label class="control-label">Log in to Study Buddy</label>
	<input class="paddedinput form-control" type="email" name="email" placeholder="email"><br>
	<input class="paddedinput form-control" type="password" name="password" placeholder="password"><br>
	<button id="action_button" class="form_buttons btn btn-primary" type="submit">Submit</button>
	<button class="form_buttons btn btn-default" type="reset" onclick="resetForm();">Reset</button>
	<br>
	<a href="/signup.php" style="color: #CCCCCC;">I don't have an account!</a>
</form>
</div>

<br/>
<script>
	$('#login').hide(); // hide the login and signup buttons since we are on the login page
</script>

<?php
	include("footer.php");
?>