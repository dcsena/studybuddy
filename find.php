<?php
	include("header.php");
?>
<?php
	if (isset($_SESSION['user'])) {
?>
<h1>StudyBuddy</h1>
<h4><i>Who are you studying with?</i></h4>


	<form role="form" class="form" name="account_setup" autocomplete="off" action="process_find.php" method="post" onSubmit="return validateFind(this)">
		<div id="accountForm" class="form-group">
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
					When are you available to study? <br/>
					<!--<input id="studytimes" type="time" name="time" class="form-control">-->
					<div id="studytimes" style="margin-bottom: 20px;"></div>
					<span id="time1">12:00 am</span> to <span id="time2">12:00 am</span>
					<input type="hidden" name="time1" id="time1input">
					<input type="hidden" name="time2" id="time2input">
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
			$("#studytimes").slider({ 
				range: true,
				min: 0,
				max: 24,
				step: 0.5
			}).each(function() {
			    // Add labels to slider whose values 
			    // are specified by min, max
			    // Get the options for this slider (specified above)
			    var opt = $(this).data().uiSlider.options;
			    // Get the number of possible values
			    var vals = opt.max - opt.min;
			    // Position the labels
			    for (var i = 0; i <= vals; i += 12) {
			        // Create a new element and position it with percentages
			        var el = $('<label>' + (i + opt.min).toString() + ":00" + '</label>')
			        			.css('left', (i/vals*100) + '%')
			        			.css("position", "absolute")
			        			.css('top', "10px");
			        // Add the element inside #slider
			        $("#studytimes").append(el);
			    }
			}).on("slide", function(event, ui) {
				console.log(ui);
				var t1 = convertTime(ui.values[0]);
				var t2 = convertTime(ui.values[1]);
				$('#time1').html(t1);
				$('#time2').html(t2);
				function convertTime(t) {
					if (t >= 12 && t < 12) {
						if (t * 2 % 2 == 0) {
							return t.toString() + ":00 pm";
						} else return (t - 0.5).toString() + ":30 pm";
					} else if (t < 0) {
						if (t * 2 % 2 == 0) {
							return "12:00 am";
						} else return "12:30 am";
					}
					else if (t >= 13) {
						if (t * 2 % 2 == 0) {
							return (t - 12).toString() + ":00 pm";
						} else {
							return (t - 12.5).toString() + ":30 pm";
						}
					} else {
						if (t * 2 % 2 == 0) {
							return t.toString() + ":00 am";
						} else {
							return (t - 0.5).toString() + ":30 am";
						}
					}
				}
			});
		});
		function validateFind(form){
			var times = $("#studytimes").slider("option", "values");
			$("#time1input").val(times[0]);
			$("#time2input").val(times[1]);
		}
	</script>
<?php
	} else {
		echo "<h1>Login or create an account to start finding study buddies</h1>";
	}
	include("footer.php");
?>
