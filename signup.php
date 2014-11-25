<?php require("header.php"); ?>
<!-- NEEDS TO BE IMPLEMENTED:
SET MAJOR -->
<div id='maincontent' style="width: 100%; background-color: inherit; text-align: center;">
	<form role="form" class="form" name="account_setup" autocomplete="off" action="process2.php" method="post" onSubmit="return validate(this)">
		<div id="accountForm" class="form-group" style="background-color: #DDDDDD;">
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
				<label> What major/majors are you? </br>
					<select name = "major[]" id="major" class = "form-control" multiple = "multiple">
						<option>Select Major Here</option>
					</select>
				</label>
				<br/>
			</fieldset>
		</div>
		<br/>

		<!-- Submit/Reset Buttons -->
		<div id="buttons">
			<button id="action_button" class="form_buttons btn btn-primary" type="submit">Submit</button>
			<button class="form_buttons btn btn-default" type="reset" onclick="resetForm();">Reset</button>
		</div>
	</form>
</div>

	<script src="js/form.js"></script>
	<script>
	<?php // get all the majors and put them in a javascript array called majors
		$major = "";
		$major_array = array();
		$char = '';
		$major_file = fopen("majors.txt", "r");
		while (false !== ($char = fgetc($major_file))) {
			if ($char !== "!") {
				$major .= $char;
			} else {
				array_push($major_array, $major);
				$major = "";
			}
		}
		array_unique($major_array);
		echo "var majors = [";
		for ($i = 0; $i < count($major_array); $i++) {
			echo "\"" . $major_array[$i] . "\"";
			if ($i != count($major_array) - 1) echo ",";
		}
		echo "];";
	?>
	majors.sort()
	function setMajor() {
		var dropdown = document.getElementById("major");
		dropdown.remove(0);
		for (var i = 0; i < majors.length; ++i) {
			var opt = document.createElement('option');
			opt.innerHTML = majors[i];
			opt.value = majors[i];
			dropdown.appendChild(opt);
		}
		$('#major').multiselect();
	}
	$(document).ready(function(){
		setMajor();
		setSchool();
	});
	$('#login').hide();
	</script>
	<?php
		include("footer.php");
	?>
</body>
</html>