<?php
	session_start();
	if (isset($_SESSION['email'])) unset($_SESSION['email']);
	if (isset($_SESSION['user'])) unset($_SESSION['user']);
	if (isset($_COOKIE['prev_url'])) header('Location: http://' . $_SERVER['HTTP_HOST'] . $_COOKIE['prev_url']);
	else header('Location: http://' . $_SERVER['HTTP_HOST'] . 'index.php');
	exit;
?>
