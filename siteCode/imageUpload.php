<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	require_once("User.class");
	require_once("DatabaseCxn.class");
	session_start(); 
	if (!isset($_SESSION['logged']) || !$_SESSION['logged'] == true){
		header("location:Login.php");
	}
	$userObj = $_SESSION['user'];
	$userObj->getDetails();


	
?>
<head>
	<title>ImageManage</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}
		
	</style>
</head>

<body>
	<?php 
	include 'AuthMenuTemplate.php';
		
	?>
	<div class="leftBox">
		<a class="leftLinks" href="UpdateManageImages.php"><div class="leftLinks">Upload / Remove Images</div></a> <br />
		<a class="leftLinks" href="UpdateRatesAvail.php"><div class="leftLinks">Rates & Availability</div></a>
	</div>
	<div class="centerBox">
		<br />
		<h3 style="text-align: center; background-color: white">Update / Manage Images</h3>
		<p></p>
		
	</div>
	
		
</body>

	

 

</html>
<?php
	$imagePN = basename( $_FILES["imageToUpload"]["name"]); // image path and name
	$target_dir = "uImageUploads/";
	$target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image of fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
		if($check !== false){ // if file is an image
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check file size
	if ($_FILES["imageToUpload"]["size"] > 500000) {
    	echo "Sorry, your file is too large.";
    	$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["imageToUpload"]["name"]). " has been successfully uploaded.";
        	if($userObj->addImagetoDb($imagePN,$imageFileType)){
        		echo 'Data was added to database';
        	} else {
        		echo 'Whilst file was uploaded there was a problem with the database';
        	}


    	} else {
        	echo "There was an error uploading your file.";
    	}
	}
?>