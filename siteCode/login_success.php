<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	require_once("User.class"); 
	session_start();
	
	if (!isset($_SESSION['logged']) || !$_SESSION['logged'] == true){
		header("location:Login.php");
	}
?>
<head>
	<title>LogInSuccess</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	
</head>

<body>
	<?php 
	include 'AuthMenuTemplate.php';
	$user = $_SESSION['user'];
	$uName = $user->getUserName();

	?>
	<div class="centerDiv">Welcome Back, <?php echo $uName ?> You are now logged in.</div>
	
		
</body>

	

 

</html>
