<?php
	include("header.php");
?>
<h1>StudyBuddy</h1>
<h4>Who are you studying with?</h4>


	<form role="form" class="form" name="account_setup" autocomplete="off" action="process_find.php" method="post" onSubmit="return validateFind(this)">

		<div id="accountForm" class="form-group">
			<fieldset>
				<label> List the classes you need help in: </br>
					Class 1: *
					<input type="text" name = "class1" required>
					</br>
					Class 2:
					<input type="text" name = "class2">
					</br>
					Class 3:
					<input type="text" name = "class3">
					</br>
					Class 4:
					<input type="text" name = "class4">	
					</br>				
				</label>
				<br/>
				<label> What day are you available to study? <br/>
					<input type="text" name = "date" id = "datepicker">
				</label>
				<br/>
				<label>
					What time are you available to study? <br/>
					<input type="time" name = "time">
				</label>
			</fieldset>
		</div>
		<br/>

		<!-- Submit/Reset Buttons -->
		<div id="buttons">
			<button id="action_button" class="form_buttons btn btn-primary" type="submit">Submit</button>
			<button class="form_buttons btn btn-default" type="reset" onclick="resetForm();">Reset</button>
		</div>
	</form>
	<script src="js/form.js"></script>
<?php
	include("footer.php");
?>
