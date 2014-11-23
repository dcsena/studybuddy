<?php	
	$dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com dbname=d9ekpsg66labji user=awmugmpdenzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ")
		or die('Could not connect: ' . pg_last_error());

	$query = 'CREATE TABLE Users (
		name varchar(50) NOT NULL,
		email varchar(255) PRIMARY KEY,
		passwordhash varchar(255),
		passwordsalt varchar(255),
		college varchar(255),
		grad_year integer,
		major varchar(255)
	);';
	$result = pg_query($query) or die("Query failed: " . pg_last_error());
	pg_free_result($result);

	pg_close($dbconn);
?>