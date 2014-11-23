<?php


include_once('php-mailjet.class-mailjet-0.1.php');
 
// Create a new Object
$mj = new Mailjet();
 
// Get some of your account informations
$me = $mj->userInfos();
 
// Display your firstname
echo $me->infos->firstname;



?>