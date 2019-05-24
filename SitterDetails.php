<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	require_once("User.class");
	require_once("DatabaseCxn.class");
	session_start();
	if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){
		include 'AuthMenuTemplate.php';
	} else {
		include 'menuTemplate.php';	
	}


?>
	<head>
	<title>Sitter Details</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}

		th,td {
			padding-left: 20px;
			padding-right:20px;
		}
		td {
			margin-left:0px;
			margin-right:0px;
		
		}
		table#sittersTbl{
			padding-bottom: 60px;
		}
		
	</style>
	</head>

<body onload="updateSDataTable()">
	<?php
		if (isset($_GET['var'])){
			$uID = $_GET['var'];
			$sitter = DatabaseCxn::getSitterData($uID);
		} else {
			echo "You have not selected a Sitter";

		}
	?>

	<div class="centerBox">
		<div>
			<br />
			<h3 style="text-align: center; background-color: white">Details For Selected Sitter</h3>
		
			<table id="sittersTbl" style="text-align: center; margin:auto">
				<tr>
					<th>Name</th>
					<td><?php echo $sitter['firstName'] ." ". $sitter['surName'] ?></td>
				</tr>
				<tr>
					<th>Sitter Type</th>
					<td><?php echo $sitter['sitterType'] ?> </td>
				</tr>
				<tr>
					<th>Gender</th>
					<td><?php 
						if($sitter['gender'] == "M"){
							echo "Male";
						} else {
							echo "Female";
						} ?> </td>
				</tr>
				<tr>
					<th>Summary</th>
					<td><?php echo $sitter['summary'] ?> </td>
				</tr>

				</table>
			</div>
			<section>
				<h4 style="text-align: center; background-color: white">Sitter Images</h4>
				<?php
					$sitterObj = new User($uID,"null");
					$images = $sitterObj->receiveImages();
					if ($images[0] == false) {
						echo 'User has not uploaded an image';
					}
					if (count($images) >= 1 && !$images[0] == false) {
						$count = count($images);
						echo "User has uploaded $count image(s).";
					}
					foreach($images as $i){
						
					}
				?>
			</section>
			<section>
				<h4 style="text-align: center; background-color: white">Rates</h4>
				<?php
				?>
			</section>
			</body>
	
	<script>

	</script>
</html>
