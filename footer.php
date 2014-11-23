<footer>Made by Matt Leibold and Dylan Sena at Wildhacks
<?php
	$fileName = 'footer.php';
	$fileName = $_SERVER["REQUEST_URI"];
	$url_pieces = explode("/",$fileName);
	$len = count($url_pieces);
	$fileName = $url_pieces[$len-1];
	if ($fileName == "")
		$fileName = "index.php";
	$timestamp = date('l jS \of F Y h:i:s A',filemtime($fileName));
	echo $timestamp;
?>
</footer>
</body>
</html>