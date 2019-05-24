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
?>

<head>
	<title>UpdateInfo</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
</head>

<body>	

	<?php	
	include 'AuthMenuTemplate.php';
		$fName = test_input($_POST['fname']);
		$sName = test_input($_POST['sname']);
		$gender = test_input($_POST['gender']);
		$phone = test_input($_POST['phone']);
		$postcode1 = test_input($_POST['postcode1']);
		$postcode2 = test_input($_POST['postcode2']);
		$sitterType = test_input($_POST['sittertype']);
		$summary = test_input($_POST['summary']);
		$avgpph = test_input($_POST['avgpph']);

		$errors['phone'] = false;
		$errors['pc2'] = false;
		$errors['summary'] = false;
		$errors['avgpph'] = false;
		$errorCount = 0;

		if (hasSpecialChars($fName)){
			$errorCount++;
			echo "Forbidden chars in first name";
		}

		if (hasSpecialChars($sName)){
			$errorCount++;
			echo "Forbidden chars in surname";
		}

		if (strlen($phone) != 0 and strlen($phone) != 11){
			$errorCount++;
			echo 'lengh is not 0 or 11 '.strlen($phone);
			$errors['phone'] = true;
		}
		if (strlen($phone) == 11){
			if(!ctype_digit($phone)){
				echo "non digit found in phone";
				$errorCount++;
				$errors['phone'] = true;
			}
			
		}

		// if does not match - error
		if(!preg_match('/^[0-9][A-Za-z]{2}/',$postcode2) || hasSpecialChars($postcode2)){ 
			echo "PC2 invalid <br />";
			$errorCount++;
			$errors['pc2'] = true;
		}
		// if does match (contains any forbidden chars) - error
		if (hasSpecialChars($summary)){
			echo "\n <br /> Forbidden characters in sum";
			$errorCount++;
			$errors['summary'] = true;
		} else {
			echo "\n<br /> no f chars in summary";
		}


		if (count($errors) > 0){
			echo "\n<br />".$errorCount." errors found";
			foreach($errors as $key => $erBool){
				if ($erBool == 1){
					echo "\n<br />". $key . " = ". $erBool . "#";
				}
				
			}
		}

		
    // one or more of the 'special characters' found in $string
		function hasSpecialChars($var){
			if (preg_match('/[\'^£$%&*}{@#~?><>,|;:\/<>=_+¬-]/', $var)){
				return true;
			} else {
				return false;
			}
		}


		
		//$uID = $_SESSION['uID'];
		$uID = $userObj->getID();

		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	<div class="centerDiv">
		<?php
			echo $fName ."<br/>";
			echo $sName ."<br />";
			echo $gender ."<br />";
			echo $phone ."<br />";
			echo $postcode1.$postcode2 ."<br />";
			echo $sitterType ."<br />";
			echo $summary. "<br />";
			echo $avgpph ."<br />";


		?>
	</div>
	<?php
		if ($errorCount == 0){
			if (DatabaseCxn::updateUserDetails($uID,$fName,$sName,$gender,$phone,$postcode1,$postcode2,$sitterType,$summary,$avgpph)){
				echo "Record Updated Successfully";
			}
		} else {
			echo "Errors Found, will not save to database";
		}
		
	?>
</body>
</html>