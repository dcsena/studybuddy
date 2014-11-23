<?php
	include("header.php");
?>
<?php
	if (isset($_SESSION['user'])) {
?>
<h1>StudyBuddy</h1>
<h4>Who are you studying with?</h4>


	<form role="form" class="form" name="account_setup" autocomplete="off" action="process_find.php" method="post" onSubmit="return validateFind(this)">
		<div id="accountForm" class="form-group" style="width: 100%; margin: 0 auto; display: block; text-align: center; padding-bottom: 10px;">
			<fieldset>
				<label> What class do you need help in? <br/>
					<input type="text" name="class1" required class="form-control" placeholder="math101">
					</br>			
				</label>
				<br/>
				<label> What day are you available to study? <br/>
					<input type="text" name="date" id="datepicker" class="form-control">
				</label>
				<br/><br/>
				<label>
					What time are you available to study? <br/>
					<input type="time" name="time" class="form-control">
				</label>
			</fieldset>
			<div id="buttons">
				<button id="action_button" class="form_buttons btn btn-primary" type="submit">Submit</button>
				<button class="form_buttons btn btn-default" type="reset" onclick="resetForm();">Reset</button>
			</div>
		</div>
		<br/>
		<!-- Submit/Reset Buttons -->
	</form>
	<script src="js/form.js"></script>
	<script>
		$(document).ready(function() {
			showDate();
		});
	</script>
<?php
	} else {
		echo "<h1>Login or create an account to start finding study buddies</h1>";
	}
	include("footer.php");
?>
