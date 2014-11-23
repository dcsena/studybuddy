<?php	
	$dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com dbname=d9ekpsg66labji user=awmugmpdenzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ")
		or die('Could not connect: ' . pg_last_error());

	$query = 'CREATE TABLE Users (
		name varchar(50),
		email varchar(50),
		passwordhash varchar(255),
		passwordsalt varchar(255),
		college varchar(20),
		grad_year integer,
		major varchar(50),
		classes varchar(50),
		PRIMARY KEY(email)
	);';
	$result = pg_query($query) or die("Query failed: " . pg_last_error());
	pg_free_result($result);

	pg_close($dbconn);
?>