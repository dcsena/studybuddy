<?php
	class Database {
		var $conn;
		var $dbh;
		function Database() {
			$this->dbconn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com port=5432 dbname=d9ekpsg66labji user=awmugmpdemzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ connect_timeout=5")
				or die('Could not connect: ' . pg_last_error());
		}
		function query($q) {
			$this->dbh = pg_query($this->conn, $q) or die('Could no execute query: ' . pg_last_error());
		}
		function get_row() {
			return pg_fetch_array($this->dbh, null, PGSQL_ASSOC);
		}
		function __destruct() {
			pg_free_result($this->dbh);
			pg_close($conn);
		}
	}
?>