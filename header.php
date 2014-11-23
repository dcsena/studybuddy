<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>StudyBuddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
</head>
<body style="background-color: #228022;">
	<header>
<?php
	$menu = array(
		'home'  => array('text'=>'Home',  'url'=>'index.php'),
		'interests'  => array('text'=>'Find Buddies',  'url'=>'find.php'),
		'appSuggestions' => array('text'=>'Study Time', 'url'=>'study.php')
	);
	function generatureMenu($items){
		$html = "<nav>\n<ul>\n";
		$fileName = $_SERVER["REQUEST_URI"];
		$url_pieces = explode("/",$fileName);
		$len = count($url_pieces);
		foreach($items as $item){
			$selected = "";
			if (($url_pieces[$len-1] == "") && ($item['url'] == 'index.php')){
				$selected = "current";
			}
			if ($url_pieces[$len-1] == $item['url']){
				$selected = "current";
			}
			$html .= "<li><a href = '{$item['url']}' class = \"{$selected}\">{$item['text']}</a></li>\n";
		}
		$html .= "</ul>\n</nav>\n";
		return $html;
	}
	echo generatureMenu($menu);
	session_start();
	if (!isset($_SESSION['user'])) {
		echo "<div id='welcome'>Not signed in.</div><br>";
		echo "<div id = \"login\">\n";
		echo "<a href=\"signup.php\" class='btn btn-default btn-lg'>Signup</a>\n";
		echo "<a href=\"login.php\" class='btn btn-default btn-lg'>Login</a>\n";
		echo "</div>";
	}
	else{
		echo "<div id='welcome'>Welcome, " . $_SESSION['user'] . "</div>";
	}
?>
</header>