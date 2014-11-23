<?php
	include("header.php");
	if (isset($_SESSION['user'])) {
?>
	<h1> Meet friends in your classes. </h1>
	<br/>

	<p>
		Below are your upcoming appointments:
	</p>
	
	<br/>
<?php
	} else {
		echo "<h1>Login or create an account to check your study times</h1>";
	}
	include("footer.php");
?>