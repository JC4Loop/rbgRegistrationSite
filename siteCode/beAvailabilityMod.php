<?php
	require_once("User.class");
	require_once("DatabaseCxn.class");
	session_start();
	if (!isset($_SESSION['logged']) || !$_SESSION['logged'] == true){
		header("location:Login.php");
	}
	if(isset($_GET['data'])){
		$arrayStringified = $_GET['data'];
		//echo $arrayStringified;
		$array = json_decode($arrayStringified,true);
		$counter = 0;
		foreach ($array as $value) {
		 	$counter++;
		}
		echo "<br />".$array['Mon']['12pm']."<br />";
		echo 'is set'. "<br />";
		//var_dump($array);

		$userObj = $_SESSION['user'];
		$uID = $userObj->getID();
		if($userObj->updateAvailability($array)){
			echo "success";
		} else {
			echo "problem";
		}
		
		
	} else {
		echo 'GET data is not set';
	}
?>