<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	session_start(); 
	require_once("DatabaseCxn.class");
?>
<head>
	<title>LogIn Fail</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<script>
		function myFunction() {
    		window.open("dudrecievemail.php");
		}
	</script>
</head>

<body>
	<?php include 'menuTemplate.php'; ?>
	<h3 style="text-align: center;">Log In Fail</h3>

	<div></div>
	<?php
		if((isset($_GET['fr']) && $_GET['fr'] == "na") && isset($_SESSION['uName']))
		{
			echo "You have yet to register your account\n<br />\nFollow the link for directions on how to authenticate.";

			$uName = $_SESSION['uName'];
			$email ="";
			$vCode = "";

			$sql = "SELECT UserName, email, VCode, Verified FROM Users WHERE UserName ='" . $uName ."'";
			$result = DatabaseCxn::getCustomSingle($sql);


				while ($row=mysqli_fetch_array($result))
				{
					if($row['UserName'] == $uName && $row['Verified'] == 0){
						$email = $row['email'];
						$vCode = $row['VCode'];
					} else if (!$row['UserName']== $uName) {
						echo 'Something has gone wrong, your username does not match, this should not happen';
					} else if($row['UserName'] == $uName && $row['Verified'] == 1){
						echo 'Something has gone wrong, it now appears you are verified, this should not happen';
					} else {
						echo "Something has gone wrong and we don't know why, this should not happen";
					}
				}

				$secret = "35onoi2=-7#%g03kl";
				$email2 = urlencode($email);
				$hash = MD5($email.$secret);
				$link = '<a href ="http://localhost/myWeb/wsSitters/rbgSitterSite/UserVerification.php?email='.$email2.'&hash='.$hash.'&User='.$uName.'">Verify My Account</a>';
				$msg = "Thankyou for registering with the Royal Borough of Greenwich\n
						to continue registration please follow the link below and input your activation code provided\n
						 $vCode \n
					 	$link";
				
				$msg = wordwrap($msg,70);
				$_SESSION['msg'] = $msg;
				echo '<input type="button" onclick="myFunction()" value="view mail" />';
				//header("location:dudrecievemail.php");
				echo '<br /><div>The email with your verification code has been resent to your email</div>';
		}
	?>
</body>
</html>