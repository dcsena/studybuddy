<?php


include_once('php-mailjet.class-mailjet-0.1.php');
 
// Create a new Object
$mj = new Mailjet();
 
// Get some of your account informations
$me = $mj->userInfos();
 
// Display your firstname
echo $me->infos->firstname;

$umichurl = "http://umich.resourcescheduler.net/rsrequest/login.asp";
$email = "";
$password = "";

$umichrequest = "http://umich.resourcescheduler.net/rsrequest/Wizard.asp?ID=1";
$requestDescription = "";
$capacity = "";
$date = "";

$umichrequest2 = "http://umich.resourcescheduler.net/rsrequest/Wizard1.asp";
$umichrequest3 = "http://umich.resourcescheduler.net/rsrequest/Wizard3.asp";
$umichrequest4 = "http://umich.resourcescheduler.net/rsrequest/WizardFinish.asp";

?>