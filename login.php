<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StudyBuddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
</head>
<body>	
	<header>
	<?php
		include("header.php");
	?>
	<h1> Meet friends in your classes. </h1>
	</header>
	<br/>


<!-- 	email -> email
	password -> password -->

	<form role="form" class="form" name="login" autocomplete="off" action="process_login.php" method="post" onSubmit = "return validateLogin(this)">
		<label> Enter your email: <br/>
			<input type="email" name = "email">
		</label>
		<label>
			Enter your password: <br/>
			<input type= "password" name = "password">
		</label>
		<button id="action_button" class="form_buttons btn btn-primary" type="submit">Submit</button>
		<button class="form_buttons btn btn-default" type="reset" onclick="resetForm();">Reset</button>
	</form>

	<br/>

	<!-- <a href="http://fathomless-dusk-5464.herokuapp.com/signup.php">I don't have an account!</a> -->
	<a href="/signup.php">I don't have an account!</a>
	<?php
		include("footer.php");
	?>
	
</body>
</html>