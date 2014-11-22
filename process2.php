<?php
	function generateBuyerCSV($fileName,$input){
		$exists = (file_exists($fileName));
		$stringToAdd = "";
		if (!$exists){
			$handle = fopen($fileName, 'a');
			foreach($input as $name => $value) {
				if ($name == "sellType")
					break;
				$stringToAdd.="$name,";
			}
			$stringToAdd.="\n";
			fwrite($handle, $stringToAdd);
		}
	}
	function generateSellerCSV($fileName,$input){
		$exists = (file_exists($fileName));
		$stringToAdd = "";
		if (!$exists){
			$handle = fopen($fileName, 'a');
			foreach($input as $name => $value) {
				if ($name == "serious" || $name == "price" || $name == "bio" || $name == "kids" || $name == "opets")
					continue;
				$stringToAdd.="$name,";
			}
			$stringToAdd.="\n";
			fwrite($handle, $stringToAdd);
		}
	}
	function traverseBuyerInfo($input,&$msg,&$stringToAdd){
		foreach($input as $name => $value) {
			if ($name == "opets"){
				print "Other Pets:<br>";
				$msg .= "Other Pets\n";
				foreach($input['opets'] as $a){
					print "$a<br>";
					$msg .="$a\n";
					$stringToAdd.="$a " . " ";
				}
				$stringToAdd .= ",";
				continue;
			}
			if ($name == "sellType"){
				break;
			}
			print "$name : $value<br>";
			$msg .="$name : $value\n";
			$stringToAdd.="$value,";
		}
	}
	function traverseSellerInfo($input,&$msg,&$stringToAdd,$sentinel){
		foreach($input as $name => $value) {
			if ($sentinel && ($name == "email" || $name == "username" || $name == "password1" || $name == "password2" || $name == "fname" || $name == "zip_code" || $name == "custType")){
				$stringToAdd.="$value,";
				continue;
			}
			if ($name == "serious" || $name == "price" || $name == "bio" || $name == "kids" || $name == "opets"){
				continue;
			}
			if ($name == "dogType"){
				print "Dog Type:<br>";
				$msg .= "Dog Type\n";
				foreach($input['dogType'] as $a){
					print "$a<br>";
					$msg .="$a\n";
					$stringToAdd.="$a " . " ";
				}
				$stringToAdd .= ",";
				continue;
			}
			print "$name : $value<br>";
			$msg .="$name : $value\n";
			$stringToAdd.="$value,";
		}
	}
	$custType = $_POST['custType'];
	$fileNameBuy = "pinderBuyer.csv";
	$fileNameSell = "pinderSeller.csv";
	if ($custType == "both"){
		generateBuyerCSV($fileNameBuy,$_POST);
		generateSellerCSV($fileNameSell,$_POST);
		$msg = "Thank you for signing up for Pinder\n";//Email message
		$stringToAdd="";	//File into
		traverseBuyerInfo($_POST,$msg,$stringToAdd);
		$stringToAdd.="\n";
		$handle = fopen($fileNameBuy, 'a');
		fwrite($handle, $stringToAdd);
		fclose($handle);
		$stringToAdd = "";
		traverseSellerInfo($_POST,$msg,$stringToAdd,true);
		$stringToAdd.="\n";
		$handle = fopen($fileNameSell, 'a');
		fwrite($handle, $stringToAdd);
		fclose($handle); 
		$to = $_POST["email"];
		$headers = "From: Pinder@pinder.com"."<".$_POST["email"]. ">\r\n";
		mail($to, 'Pinder Signup', $msg,$headers);
		echo "Email sent";

	}
	elseif ($custType == "buyer"){
		generateBuyerCSV($fileNameBuy,$_POST);
		$msg = "Thank you for signing up for Pinder\n";//Email message
		$stringToAdd="";	//File into
		traverseBuyerInfo($_POST,$msg,$stringToAdd);
		$stringToAdd.="\n";
		$handle = fopen($fileNameBuy, 'a');
		fwrite($handle, $stringToAdd);
		fclose($handle); 
		$to = $_POST["email"];
		$headers = "From: Pinder@pinder.com"."<".$_POST["email"]. ">\r\n";
		mail($to, 'Pinder Signup', $msg,$headers);
		echo "Email sent";
	}
	elseif ($custType == "seller"){
		generateSellerCSV($fileNameSell,$_POST);
		$msg = "Thank you for signing up for Pinder\n";//Email message
		$stringToAdd="";	//File into
		traverseSellerInfo($_POST,$msg,$stringToAdd,false);
		$stringToAdd.="\n";
		$handle = fopen($fileNameSell, 'a');
		fwrite($handle, $stringToAdd);
		fclose($handle); 
		$to = $_POST["email"];
		$headers = "From: Pinder@pinder.com"."<".$_POST["email"]. ">\r\n";
		mail($to, 'Pinder Signup', $msg,$headers);
		echo "Email sent";
	}
?>