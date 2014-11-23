<?php require("header.php"); ?>
<!-- NEEDS TO BE IMPLEMENTED:
SET MAJOR -->
	<script>
	$(document).ready(function(){
		setMajor();
		setSchool();
	});
	</script>
	<form role="form" class="form" name="account_setup" autocomplete="off" action="process2.php" method="post" onSubmit="return validate(this)">

		<!-- Account Information Fieldset
		Input items here:
		name/id  -> type
		fname -> text
		email  -> email input
		password  -> password input
		school[] -> select option
		grade -> select option
		major[] -> multiselect option
		class1,2,3,4 -> text
		date -> text
		time -> time
		 -->

		<div id="accountForm" class="form-group">
			<fieldset>
				<legend>Account Information:</legend>
				<label>First Name: *
					<input type="text" name="fname" required placeholder="Dylan" class="form-control">
				</label>
				</br>
				<label>Email: *
					<input type="email" name="email" required placeholder="example@study.com" class="form-control" autofocus>
				</label>
				<br/>
				<label>Password: *
					<input type="password" required name="password1" class="form-control">
				</label>
				<br/>
				<label>
					What school are you in?
					<select name="school" id="school" class = "form-control">
						<option>Select school here</option>
					</select>
				</label>
				<br/>

				<label>Grade *
					<select name = "grade" id = "grade" class = "form-control">
						<option value="Freshman">Freshman</option>
						<option value="Sophomore">Sophomore</option>
						<option value="Junior">Junior</option>
						<option value="Senior">Senior</option>
						<option value="Other">Other</option>
					</select>
				</label>
				<br/>
				<label> What major are you? </br>
					<select name = "major[]" id="major" class = "form-control" multiple = "multiple">
						<option>Select Major Here</option>
					</select>
				</label>
				<br/>
				<!-- <label> List the classes you need help in: </br>
					Class 1:
					<input type="text" name = "class1">
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
				<label> What day are you available to study?
					<input type="text" name = "date" id = "datepicker">
				</label>
				<br/>
				<label>
					What time are you available to study?
					<input type="time" name = "time">
				</label> -->

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
</body>
</html>