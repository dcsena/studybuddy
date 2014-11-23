<?php
	require_once("header.php");
	require_once("database.php");
	if (!isset($_SESSION['email'])) {
		echo "you need to login first";
		header("Location: /login.php");
		exit();
	}
	$email = $_SESSION['email'];
	if (!isset($_POST['class1']) || 
		!isset($_POST['date']) ||
		!isset($_POST['time'])){
		displayError("Insufficient post parameters supplied.");
	}
	echo json_encode($_POST);
	$class1 = $_POST['class1'];
	$date = $_POST['date'];
	$time = $_POST['time'];

	$db = new Database();
	$query = "SELECT * FROM ClassList WHERE email='" . $email  . "'";
	$db->query($query);
	$result = $db->get_row();
	$location = "UGLI";
	function getLocation($date, $time){

		$ch = curl_init();
		$url = "http://umich.resourcescheduler.net/rsrequest/User.asp";
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,true);
		$name = $_SESSION['user'];
		$password = "wildhacks1234";
		$phone = "5514273069";
		$data = array(
			fName => $name,
			lName => "Bob",
			Email => $email,
			Phone => $phone,
			Pwd => $password,
			Pwd2 => $password
		);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);

		$url2 = "http://umich.resourcescheduler.net/rsrequest/Wizard.asp?ID=1";
		$data2 = array(
			Desc => "For class $class1",
			SelLoc => 7,
			SelType => "",
			Capacity => 2,
			SelSchedType => "One Time"
		);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url2);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data2);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		$url3 = "http://umich.resourcescheduler.net/rsrequest/Wizard1.asp";
		function convertToTime($time,$num){
			echo($time);
			$timelist = explode(":",$time);
			$hr = $timelist[0];
			$timelist2 = explode(" ",$time);
			$day = $timelist2[1];
			if ($hr > 10){
				$hr = (($hr+$num)%12);
				if ($day == 'AM')
					$day = 'PM';
				else
					$day = 'AM';
			}
			return "$hr $day";
			$ch = curl_init();
		}

		$inputStartTime = convertToTime($time,0);
		$duration = 2;
		$inputEndTime = convertToTime($time,$duration);
		$date3 = array(
			CDate => $date,
			first_avail_date => 0,
			StartHr => $inputStartTime,
			StartMin => "00",
			EndHr => $inputEndTime,
			EndMin => "00",
			chkFirst => 0
		);
		curl_setopt($ch,CURLOPT_URL,$url3);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data3);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);

		$url4 = "http://umich.resourcescheduler.net/rsrequest/Wizard3.asp";
		curl_setopt($ch,CURLOPT_URL,$url4);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,true);
		$date4 = array(
			Notes => ""
		);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data4);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);


		$url5 = "http://umich.resourcescheduler.net/rsrequest/WizardFinish.asp";
		curl_setopt($ch,CURLOPT_URL,$url5);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_POST,true);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		$location = "Hatcher and Shapiro Libraries";
		return $location;
	}
	
	$query = "INSERT INTO ClassList (email, class1, dates, time, location) " .
					"VALUES ('$email', '$class1', '$date', '$time','$location')";
	echo $query;
	$result = $db->query($query);
	echo json_encode($result);
	displaySuccess();


	require_once("footer.php");

	function displayError($errorMsg) {
		echo $errorMsg;
	}

	function displaySuccess() {
		echo "Class successfully entered.<br/>";
	}

	 
	// // Create a new Object
	// $mj = new Mailjet();
	 
	// // Get some of your account informations
	// $me = $mj->userInfos();
	 
	// // Display your firstname
	// echo $me->infos->firstname;
	$query = "SELECT * FROM ClassList
		WHERE class1 = '". $class1 . "'";
	$db->query($query);
	$match = $db->get_row();
	if ($match == false){
		echo "0 matches";
	}
	else{
		echo "$match[0]";
		while ($match = $db->get_row()){
			echo "$match[0]";
		}
	}
	include("php-mailjet-v3-simple.class.php");
	function sendEmail() {
	    $mj = new Mailjet();
	    $user2 = "Matt Leibold";
	    $msg = "You will be meeting with $user2 for $class1 at: $time on $date at $location.";
	    $params = array(
	        "method" => "POST",
	        "from" => "studybuddy@buddy.com",
	        "to" => $email,
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
?>