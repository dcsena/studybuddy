<?php
	session_start();
	session_destroy();
	if (isset($_COOKIE['prev_url'])) header('Location: http://' . $_SERVER['HTTP_HOST'] . $_COOKIE['prev_url']);
	else header('Location: http://' . $_SERVER['HTTP_HOST'] . 'index.php');
	exit;
?>
