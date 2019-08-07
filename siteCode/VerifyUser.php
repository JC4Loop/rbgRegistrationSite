<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
session_start(); 
require_once("User.class");
?>

<head>
	<title>Verification2</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
</head>

<body>	

	<?php

	include 'menuTemplate.php'; 
	$vCode = $_POST['vCode'];
	$userN = $_SESSION['UNsesh'];
	$hostname = "localhost";
	$databaseName = "rbgsite";      
	$username = "siu";              
	$password = "appletree";
	$cxn = mysqli_connect($hostname, $username, $password,$databaseName) or die ("message");
	checkCode($cxn,$userN,$vCode);
	$uID;
		function checkCode($cxn, $un, $vc){
			echo "<br />";
			$sql1 = "SELECT VCode,uID FROM Users WHERE UserName ='".$un."'";
			if($result = mysqli_query($cxn, $sql1)){
				while ($row = mysqli_fetch_array($result)){
					$uID = $row['uID'];
					if($row['VCode']== $vc){
						VerifyUser($cxn, $un,$uID);
						$_SESSION['uID'] = $row['uID'];
						$_SESSION['uName'] = $un;
						$_SESSION['user'] = new User($row['uID'],$un);
					} else {
						echo 'Verification code incorrect';
					}
				}
			} else {
				echo 'something has gone wrong';
			}
		}


		function VerifyUser($cxn, $un,$uID){
			
			$sql = "UPDATE Users SET Verified = 1 WHERE UserName = '" .$un."'";
			if (mysqli_query($cxn, $sql)) {
				$_SESSION['logged'] = true;
				$msg = 'Verification complete you are now logged in';
				//header( "refresh:5;url=.php" );
	
			} else {
				$msg = "Error: " . $sql . "<br>" . mysql_error($cxn);
			}
			echo '<div style="font-size: 25px">'. $msg . '</div>';
			InsertRowInDetails($cxn,$uID);
			mysqli_close($cxn);
		} 

		function InsertRowInDetails($cxn,$uID){
			//global $cxn; // if i wanted global var
			$sql = "INSERT INTO userdetails (uID) VALUES (".$uID.")";
			if ($cxn->query($sql) === TRUE) {
				echo "You are ready to update your details";
			} else {
    			echo "Error: " . $sql . "<br>" . $cxn->error;
    			echo "There was an error preparing your details Admin has been informed and will email you";
			}
		}

		?>
</body>
</html>