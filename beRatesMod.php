<?php
	require_once("User.class");
	require_once("DatabaseCxn.class");
	session_start();
	if (!isset($_SESSION['logged']) || !$_SESSION['logged'] == true){
		header("location:Login.php");
	}

	if(isset($_GET['data']) && isset($_GET['opr'])){
		$arrayStringified = $_GET['data'];
		$array = json_decode($arrayStringified,true);
		$userObj = $_SESSION['user'];
		$uID = $userObj->getID();

		if ($_GET['opr'] == "insert"){

			if($userObj->addRate($array)){
				echo "success";
			} else {
				echo "problem";
			}

		} else  if ($_GET['opr'] == "update") {

			if($userObj->updateRate($array)){
				echo "success";
			} else {
				echo "problem";
			}
		
		} else if ($_GET['opr'] == "delete"){
			//$rateID = $array["rateID"];
			if($userObj->deleteRate($array)){
				echo "success";
			} else {
				echo "problem";
			}
		}
		
		
		
	} else { // if data & Opr NOT set
		echo 'is not set';
	}
?>