<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
session_start(); 
?>

<head>
	<title>Logged Out</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
</head>

<body>	

	<?php	
	include 'menuTemplate.php';
		unset($_SESSION['logged']);
		unset($_SESSION['uName']);
	?>
	<div class="centerDiv">You are now Logged out</div>
	
</body>
</html>