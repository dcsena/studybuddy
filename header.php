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
		$_SESSION['user'] = "unknown user";
		echo "Not signed in.";
		echo "<div id = \"status\">\n";
		echo "<a href=\"signup.php\">Signup</a>\n";
		echo "<a href=\"login.php\">Login</a>\n";
		echo "</div>\n";
	}
	else{
		echo "Welcome, " . $_SESSION['user'];
	}
?>