<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Find Buddies</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-multiselect.css"> -->
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
</head>
<body>
<!-- NEEDS TO BE IMPLEMENTED:
SET MAJOR -->
<body onload="setMajor(); setSchool();">
	<header>
		<h1>StudyBuddy</h1>
		<h4>Who are you studying with?</h4>
	</header>


	<form role="form" class="form" name="account_setup" autocomplete="off" action="process_find.php" method="post" onSubmit="return validateFind(this)">

		<div id="accountForm" class="form-group">
			<fieldset>
				<label> List the classes you need help in: </br>
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
				<label> What day are you available to study? <br/>
					<input class="date" id="inputDate" value="01/01/2015" />
					<label id="closeOnSelect"><input type="checkbox" /> Close on selection</label>
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
	
	<?php
		include("footer.php");
	?>

<!--  	<script type="text/javascript" src="js/jquery.js"></script>
   	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-multiselect.js"></script> -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/datepicker.js"></script>
	<script src="js/form.js"></script>
</body>
</html>


