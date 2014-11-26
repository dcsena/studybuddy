<?php
	error_reporting(E_ALL);
	$dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com port=5432 dbname=d9ekpsg66labji user=awmugmpdemzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ connect_timeout=5")
		or die('Could not connect: ' . pg_last_error());

	$query = 'CREATE TABLE PartnerRequests (
		id SERIAL PRIMARY KEY,
		email varchar(255) NOT NULL,
		class varchar(50) NOT NULL,
		submitted timestamp default current_timestamp,
		time1 timestamp NOT NULL,
		time2 timestamp NOT NULL,
		paired boolean NOT NULL
	);';
	$result = pg_query($dbconn, $query) or die("Query failed: " . pg_last_error());
	pg_free_result($result);

	pg_close($dbconn);
?>