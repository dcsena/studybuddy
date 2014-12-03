<?php
	include("header.php");
	if (isset($_SESSION['user'])) {
?>
	<h1> Study Buddy </h1>
	<br/>
<?php } ?>

<?php
	require_once("database.php");
	check_matches();
	$db = new Database();
	$email = $_SESSION['email'];
	$db->query("SELECT * FROM Pairings WHERE email1='$email' OR email2='$email'");
	$row = $db->get_row();
	echo "<div class='main_image'>";
	if ($row) {
		echo "<p style='font-size: 150%;'>Below are your current pairings:</p>";
		$partnerEmail = $row['email1'];
		if ($row['email1'] == $email) $partnerEmail = $row['email2'];
		echo "<table class='pairing_table'><tr><th>Class</th><th>Partner Email</th></tr>";
		echo "<tr><td>" . $row['class'] . "</td><td>" . $partnerEmail . "</td></tr>";
		while ($row = $db->get_row()) {
			$partnerEmail = $row['email1'];
			if ($row['email1'] == $email) $partnerEmail = $row['email2'];
			echo "<tr><td>" . $row['class'] . "</td><td>" . $partnerEmail . "</td></tr>";
		}
		echo "</table>";
	} else {
		echo "<p>You have no matches yet</p>";
	}
	echo "</div>";
	function check_matches() {
		if (!isset($_SESSION)) session_start();
		$email = $_SESSION['email'];
		$db = new Database();
		$db->query("SELECT * FROM PartnerRequests WHERE email='$email' AND paired=false");
		$unpaired_classes = array();
		$row = array();
		while ($row = $db->get_row()) {
			array_push($unpaired_classes, $row);
		}
		$pairs_found = array();
		foreach ($unpaired_classes as $class) {
			$c = $class['class'];
			$t1 = $class['time1'];
			$t2 = $class['time2'];
			$db->query("SELECT * FROM PartnerRequests WHERE email!='$email' AND paired=false AND class='$c' AND time1<=$t2 AND time2>=$t1");
			$id = $class['id'];
			$row = $db->get_row();
			if ($row) {
				array_push($pairs_found, $row);
				$r_id = $row['id'];
				$r_email = $row['email'];
				$db->query("UPDATE PartnerRequests SET paired=true WHERE id=$r_id OR id=$id");
				$db->query("INSERT INTO Pairings (id1, id2, email1, email2, class) VALUES ($id, $r_id, '$email', '$r_email', '$c')");
			}
		}
	}
?>
	
	<br/>
<?php
	if (!isset($_SESSION['user'])) {
		echo "<h1>Login or create an account to check your study times</h1>";
	}
	include("footer.php");
?>