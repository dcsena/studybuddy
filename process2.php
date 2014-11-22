<?php
	require_once("header.php");
	$dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com dbname=d9ekpsg66labji user=awmugmpdenzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ")
		or die('Could not connect: ' . pg_last_error());

	$query = 'SELECT * FROM authors';
	$result = pg_query($query) or die("Query failed: " . pg_last_error());
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
		foreach ($line as $col_value) {
			echo $col_value;
		}
	}

	pg_free_result($result);

	pg_close($dbconn);
	echo "You're signed up";
	require_once("footer.php");
?>