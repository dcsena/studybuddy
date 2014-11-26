<html>
<head>
	<title>Fuck HEROKU</title>
	<meta name="description" content="A semi visual client for postgresql on heroku because heroku is a piece of shit that doesn't let you do this with existing tools">
</head>
<body>
<form action="postgrescli.php" method="post">
<label for="query">Query: </label><input type="text" name="query" style="width: 50%;" id="query_input">
<input type="submit">
</form>
<form action="postgrescli.php" method="post">
	<input type="hidden" name="showTables" value="true">
	<input type='submit' value="Show Tables">
</form>
<div style="width: 100%;">
<?php
	require "database.php";
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$db = new Database();
		if (isset($_POST['showTables'])) {
			$db->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public';");
			outputQuery($db);
			exit;
		}
		if (isset($_SESSION['previous_inputs'])) {
			array_push($_SESSION['previous_inputs'], $_POST['query']);
		} else {
			$_SESSION['previous_inputs'] = array();
			array_push($_SESSION['previous_inputs'], $_POST['query']);
		}
		$query = $_POST['query'];
		$db->query($query);
		outputQuery($db);
	}

	function outputQuery($db) {
		$result = Array();
		echo "<table style='padding: 5px;'>";
		$count = 0;
		while ($result = $db->get_row()) {
			if ($count == 0) {
				echo "<tr>";
				foreach ($result as $key => $value) {
					echo "<th style='padding: 2px 5px 2px 5px;'>" . $key . "</th>";
				}
				echo "</tr>";
			}
			echo "<tr>";
			foreach ($result as $key => $value) {
				echo "<td style='padding: 2px 5px 2px 5px;'>" . $value . "</td>";
			}
			echo "</tr>";
			$count++;
		}
		echo "</table>";
		echo "<b>" . $count . " results found</b>";
	}
?>
</div>
<script>
	var previous_inputs = [];
	previous_inputs.push("");
	<?php
		if (isset($_SESSION) && isset($_SESSION['previous_inputs'])) {
			for ($i = count($_SESSION['previous_inputs']) - 1; $i >= 0; $i--) {
				echo "previous_inputs.push('" . $_SESSION['previous_inputs'][$i] . "');\n";
			}
		}
	?>
	var previous_input_counter = 0;
	var qi = document.getElementById("query_input");
	qi.onkeydown = function(e) {
		if (e.keyCode == 38) { // up
			if (previous_input_counter == 0) {
				previous_inputs[0] = qi.value;
			}
			if (previous_input_counter < previous_inputs.length - 1) {
				previous_input_counter++;
				qi.value = previous_inputs[previous_input_counter];
			}
		} else if (e.keyCode == 40) { // down
			if (previous_input_counter == 0) {
				previous_inputs[0] = qi.value;
			}
			if (previous_input_counter > 0) {
				previous_input_counter--;
				qi.value = previous_inputs[previous_input_counter];
			}
		}
	};
</script>
</body>
</html>