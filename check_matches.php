<?php
	// api to be called by ajax to check if their are any new matches for this user
	require_once("database.php");
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
?>