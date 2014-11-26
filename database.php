<?php
	class Database {
		var $conn;
		var $dbh;
		function Database() {
			$this->conn = pg_connect("host=ec2-54-243-245-159.compute-1.amazonaws.com port=5432 dbname=d9ekpsg66labji user=awmugmpdemzddy password=ps-jTmFdmIIU8VMWs2A8nX_3eQ connect_timeout=5");
		}
		function query($q) {
			$this->dbh = pg_query($this->conn, $q);
			if ($this->dbh === False) echo('Could not execute query: ' . pg_last_error());
		}
		function get_row() {
			return pg_fetch_array($this->dbh, null, PGSQL_ASSOC);
		}
		function __destruct() {
			pg_close($this->conn);
		}
	}
?>