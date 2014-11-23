<?php
	include("header.php");
?>
<h1> Meet friends in your classes. </h1>
<br/>


<!-- 	email -> email
	password -> password -->
<div id='logincontainer' style="max-width: 300px; display: block; margin: 0 auto; text-align: center">
<form role="form" class="form" name="login" autocomplete="off" action="process_login.php" method="post" onSubmit = "return validateLogin(this)">
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
	$('#login').hide();
</script>
<!-- <a href="http://fathomless-dusk-5464.herokuapp.com/signup.php">I don't have an account!</a> -->
<?php
	include("footer.php");
?>