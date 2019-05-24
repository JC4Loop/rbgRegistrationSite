<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Verification</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
</head>

<body>	
	<?php include 'menuTemplate.php'; 
	session_start(); 
	
	$secret = "35onoi2=-7#%g03kl";
	if (md5($_GET['email'].$secret) == $_GET['hash']) {
		$userN = $_GET['User'];
		if(CheckUser($userN)){
			$_SESSION["UNsesh"] = $userN;
			echo'<div style="text-align:center; margin:20px;">Please input Your 5 digit code provided in the email</div>';
    		echo '<form action="VerifyUser.php" method="post" style="text-align:center;">';
			echo '<input type="text" id="vCode" name="vCode" />';
			echo '<input type="submit" value="Verify Account" />';
			echo '</form>';
		} else {
			echo '<div style="text-align:center;"></div>';
		}
	
    } else {
    	echo "You do not have permission to access this page";
    }

	function CheckUser($userN){
		$hostname = "localhost";
		$databaseName = "rbgsite";      
		$username = "siu";              
		$password = "appletree";
		//$cxn = mysqli_connect($hostname, $username, $password) or die ("message");
		$cxn = mysqli_connect($hostname, $username, $password,$databaseName) or die ('could not connect to database');
		$sql = "SELECT UserName, Verified FROM Users WHERE UserName = '$userN'";
		$result = mysqli_query($cxn, $sql);
		$found = false;
		while ($row = mysqli_fetch_array($result)){
			if($row['UserName']== $userN){
				echo "Found user". $userN;
				$found = true;
				if($row['Verified'] == 0){
					return true;
				} else {
					echo "User is already verified";
					return false;
				}
			} //end outer if
		} // end while
		if($found == false){
			echo "User not found";
			return false;
		}

	}


		function VerifyUser(){
			$hostname = "localhost";
			$databaseName = "rbgsite";      
			$username = "siu";              
			$password = "appletree";

			//$cxn = mysql_connect($hostname, $username, $password) or die ("message");
			$cxn = mysqli_connect($hostname, $username, $password,$databaseName) or die ('could not connect to database');
			$sql = "UPDATE  Users SET Verified = 1 WHERE UserName = '$username'";

			if (mysqli_query($cxn, $sql)) {
				//verification update
				$msg = "You have completed your registration. You will now be redirected";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($cxn);
				$msg = "There has been a problem - Verification failed";
			}
			echo '<div style="font-size: 25px">'. $msg . '</div>';

			mysqli_close($cxn);
		}


	?>

</body>

</html>
