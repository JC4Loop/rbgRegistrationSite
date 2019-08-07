<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php 
		session_start(); 
		require_once("User.class");
		require_once("DatabaseCxn.class");
?>

	<?php
		unset($_SESSION['loginfailMsg']);

		$uName = test_input($_POST['uName']);
		$pass = test_input($_POST['password']);
		$cPass = md5($pass);

		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//$errors = array("uName"=>false, "password"=>false);
		$errorCount = 0;

		if ($uName == null) {
			$errors["uName"] = true;
			$_SESSION['loginfailMsg'] = "You have entered a null user name";
			$errorCount++;
		} else if (preg_match('/[\'^£$%&*}{@#~?><>,|;:\/<>=_+¬-]/', $uName)){
			$_SESSION['loginfailMsg'] = "Forbidden Characters in user name";
			$errors['uName'] = true;
			$errorCount++;
		}

		if ($cPass == null){
			$_SESSION['loginfailMsg'] = "You have entered a null password";
			$errorCount++;
		} else if (preg_match('/[\'^£$%&*}{@#~?><>,|;:\/<>=_+¬-]/', $cPass)) {
			$_SESSION['loginfailMsg'] = "Forbidden Characters in password";
			$errorCount++;
		}

		if ($errorCount == 0){
			sendToDatabase($uName,$cPass);
		} else {
			directBack();
		}
		//sendToDatabase();
		function sendToDatabase(){
			global $uName,$cPass;
			$result =  DatabaseCxn::userLogin($uName,$cPass);
			switch($result){
				case 0: 
					break;
				case 1:
					$_SESSION['loginfailMsg'] = "Username not found";
					directBack();
					break;
				case 2:
					if (!isset($_POST["publicCheck"]) || $_POST["publicCheck"] !== "Y"){
						$cookie_name = "username";
						$cookie_value = $uName;
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
					} else {
						setcookie("username","",time() - 1,"/"); //delete cookie
					}
					$_SESSION['logged'] = true;
					setUserSession();
					header("location:login_success.php");
					break;
				case 3:
					// not yet verified.
					$_SESSION['uName'] = $uName;
					setUserSession();
					header('location:login_fail.php?fr=na');
					break;
				case 4:
					$_SESSION['loginfailMsg'] = "Incorrect Password";
					directBack();
					break;
			}
		}

		

		function setUserSession(){
			//$_SESSION['uID'] = $row['uID'];
			$uName2 = test_input($_POST['uName']);
			$_SESSION['uName'] = $uName2;
			
			$uID = DatabaseCxn::getUserIDFromUName($uName2);
			
			$_SESSION['user'] = new User($uID,$uName2);
		}

		function directBack(){
			header("location:Login.php?er=01");
		}
		
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CheckLogIn</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
</head>

<body>
</body>
</html>