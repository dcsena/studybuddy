<?php
	include("header.php");
	if (isset($_SESSION['user'])) {
?>
	<h1> Study Buddy </h1>
	<br/>
<?php } ?>

<?php
	require_once("database.php");
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
?>
	
	<br/>
<?php
	if (!isset($_SESSION['user'])) {
		echo "<h1>Login or create an account to check your study times</h1>";
	}
	include("footer.php");
?>