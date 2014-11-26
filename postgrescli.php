<html>
<head>
	<title>Postgresql CLI</title>
	<meta name="description" content="A semi visual client for postgresql on heroku because heroku is a piece of shit that doesn't let you do this with existing tools">
	<style>
	.result_cell {
		border: 1px solid black;
		padding: 2px 5px 2px 5px;
	}
	</style>
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
	require_once "database.php";
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$db = new Database();
		if (isset($_POST['showTables'])) {
			$db->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public';");
			outputQuery($db, "tables");
		} else {
			if (isset($_SESSION['previous_inputs'])) {
				array_push($_SESSION['previous_inputs'], $_POST['query']);
			} else {
				$_SESSION['previous_inputs'] = array();
				array_push($_SESSION['previous_inputs'], $_POST['query']);
			}
			$query = $_POST['query'];
			$db->query($query);
			outputQuery($db, "normal");
		}
	}

	function outputQuery($db, $type) {
		if ($type == "tables") {
			$count = 0;
			$tables = array();
			$table_schemas = array();
			while ($result = $db->get_row()) {
				array_push($tables, $result['table_name']);
				$count++;
			}
			foreach($tables as $t) {
				$db->query("select column_name, data_type from INFORMATION_SCHEMA.COLUMNS where table_name = '$t'");
				$row = array();
				while ($row = $db->get_row()) {
					if (!isset($table_schemas[$t])) {
						$table_schemas[$t] = array();
					}
					array_push($table_schemas[$t], $row);
				}
			}
			echo "<table style='padding: 5px;'>";
			foreach($table_schemas as $name => $schema) {
				echo "<tr><th style='text-align: left; color: blue;'>" . $name . "</th></tr>\n";
				echo "<tr><td><table style='border-collapse: collapse;'>";
				$row1 = "<tr><th class='result_cell'>column name:</th>";
				$row2 = "<tr><th class='result_cell'>data type:</th>";
				foreach ($schema as $s) {
					$row1 .= "<td class='result_cell'>" . $s['column_name'] . "</td>";
					$row2 .= "<td class='result_cell'>" . $s['data_type'] . "</td>";
				}
				$row1 .= "</tr>";
				$row2 .= "</tr>";
				echo $row1;
				echo $row2;
				echo "</table></td></tr>";
			}
			echo "</table>";
			echo "<b>" . $count . " results found</b>";
		} else {
			$result = Array();
			echo "<table style='padding: 5px; border-collapse: collapse;'>";
			$count = 0;
			while ($result = $db->get_row()) {
				if ($count == 0) {
					echo "<tr>";
					foreach ($result as $key => $value) {
						echo "<th class='result_cell'>" . $key . "</th>";
					}
					echo "</tr>";
				}
				echo "<tr>";
				foreach ($result as $key => $value) {
					echo "<td class='result_cell'>" . $value . "</td>";
				}
				echo "</tr>";
				$count++;
			}
			echo "</table>";
			echo "<b>" . $count . " results found</b>";
		}
	}
?>
</div>
<script>
	var previous_inputs = [];
	previous_inputs.push("");
	<?php
		if (isset($_SESSION) && isset($_SESSION['previous_inputs'])) {
			for ($i = count($_SESSION['previous_inputs']) - 1; $i >= 0; $i--) {
				echo "previous_inputs.push(\"" . $_SESSION['previous_inputs'][$i] . "\");\n";
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