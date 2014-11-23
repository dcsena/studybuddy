<?php
	include("php-mailjet-v3-simple.class.php");
	function sendEmail($class1,$to,$otherUsers,$meetTime,$meetDate,$meetLocation) {
	    $mj = new Mailjet();
	    $msg = "You will be meeting with $otherUsers for $class1 at: $meetTime on $meetDate at $meetLocation.";
	    $params = array(
	        "method" => "POST",
	        "from" => "studybuddy@buddy.com",
	        "to" => $to,
	        "subject" => "Study Buddy Meetup",
	        "text" => $msg
	    );

	    $result = $mj->sendEmail($params);

	    if ($mj->_response_code == 200)
	       echo "success - email sent";
	    else
	       echo "error - ".$mj->_response_code;
    	return $result;
	}
	echo sendEmail("a","leiboldm@umich.edu","fasdf", "23", "34", "23");
?>