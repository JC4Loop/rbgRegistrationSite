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
	$genderMale = "";
	$genderFemale = "";
	if ($userObj->gender == "M"){
		$genderMale = "checked";
	} else {
		$genderFemale = "checked";
	}
	$houseS = "";
	$babyS = "";
	$plantS = "";
	$catS = "";
	$dogW = "";
	$carer = "";
	switch ($userObj->sitterType) {
		case '1':
			$houseS = 'selected = "selected"'; 
			break;
		case '2':
			$babyS = 'selected = "selected"';
			break;
		case '3':
			$plantS = 'selected = "selected"';
			break;
		case '4':
			$catS = 'selected = "selected"';
			break;
		case '5':
			$dogW = 'selected = "selected"';
			break;
		case '6':
			$carer = 'selected = "selected"';
			break;
		default:
			# code...
			break;
	}
	
?>
<head>
	<title>UpdateDetails</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}
		
	</style>

	<script>
		function validateForm(){
			var errorMessage;
			var errorFound = false;
			var phoneInput = document.forms["theForm"]["phone"].value;
			if (phoneInput.length <= 11){
				for (var i = 0; i  < phoneInput.length; i++){
					if(isNaN(phoneInput[i])){
						phoneError(phoneInput[i] + " is not numeric");
						//errorFound = true;
					}
					// user will be able to leave phoneNumber blank so no 1 not 0
					if (phoneInput.length >= 1 && phoneInput.length < 11){
						//errorFound = true;
						phoneError("Phone Number is too short - 11 characters expected");
					}
				}
			} else {
				phoneError("Phone Number is too long");
				//errorFound = true;
			}
			var pc1Input = document.forms["theForm"]["postcode1"].value;
			if (pc1Input.length <= 4){

			} else {
				postCodeError("Invalid Input - First part of Postcode is too long");
				errorFound = true;
			}
			var pc2Input = document.forms["theForm"]["postcode2"].value;
			if (pc2Input.length == 3){
				var pattern = /^[0-9][A-Za-z]{2}/; // first char numeric followed by two letters
				var result = pc2Input.match(pattern);
				if(!result){
					//errorFound = true;
					postCodeError("Second part of postcode is invalid");
				}
				
			} else {
				errorFound = true;
				postCodeError("Second part of postcode has invalid length");
			}

			var summaryInput = document.forms["theForm"]["summary"].value;
			if (summaryInput.length > 0){
				var pattern = /[\'^£$%&*}{@#~?><>,|;:\/<>=_+¬-]/;
				// if matches pattern - error
				var result = summaryInput.match(pattern);
				if (result){
					//errorFound = true;
					summaryError("Summary has forbidden characters");
				}
			}
			
			var avgInput = document.forms["theForm"]["avgpph"].value;
			var pattern = /^[-+]?[0-9]*\.?[0-9]+$/;
			// avgInput must match
			var result = avgInput.match(pattern);
			if (!result){
				errorFound = true;
				avgError("non num in avg");
			}

			if (errorFound){
				return false;
			} else {
				return true;
			}

			function phoneError(msg){
				errorFoundFunc("phoneError",msg);
			}
			function postCodeError(msg){
				errorFoundFunc("postcodeError",msg);
			}
			function summaryError(msg){
				errorFoundFunc("sumError",msg);
			}
			function avgError(msg){
				errorFoundFunc("avgError",msg);
			}
			function errorFoundFunc(id,msg){
				document.getElementById(id).style.display = "inline-block";
				document.getElementById(id).innerHTML = msg;
			}

		}

		function focusOut(id){
			var x = document.getElementById(id);
			x.innerHTML = "";
			x.style.display = "none";
		}
	</script>

</head>

<body>
	<?php 
	include 'AuthMenuTemplate.php';
		
	?>
	<div class="leftBox">
		<a class="leftLinks" href="UpdateManageImages.php"><div class="leftLinks">Upload / Remove Images</div></a> <br />
		<a class="leftLinks" href="ChangeAvailability.php"><div class="leftLinks">View / Change Availability</div></a>
		<a class="leftLinks" href="ChangeRates.php"><div class="leftLinks">VIew / Change Rates</div></a>
	</div>
	<div class="centerBox">
		<br />
		<h3 style="text-align: center; background-color: white">Update Details</h3>
		<p>Update your details using the form below</p>
		<form id="updateForm" name="theForm" action="serverUpdate.php " onsubmit="return validateForm()" method="post">
			<fieldset>
				<div class="formLine">
	 				<label class="updatelabel" for="fname">Firstname</label>
	 				<input type="text" name="fname" value="<?php echo "$userObj->firstname" ?>"/>
	 			</div>
	 			<div class="formLine">
	 				<label class="updatelabel" for="sname">Surname</label>
	 				<input type="text" name="sname" value="<?php echo $userObj->surname ?>"/>
	 			</div>
	 			<div class="formLine">
	 				<input type="radio" name="gender" value="M" <?php echo $genderMale ?>> Male<br />
 					<input type="radio" name="gender" value="F" <?php echo $genderFemale ?>> Female<br />
	 			</div>
	 			<div class="formLine">
	 				<label class="updatelabel" for="phone">Phone Number</label>
	 				<input type="text" onfocusout="focusOut('phoneError')" name="phone" value="<?php echo $userObj->phoneNumber ?>" />
	 				<div class="errorDiv" id="phoneError" style="display:none; color:red"></div>
	 			</div>
	 			<div class="formLine">
	 				<label class="updatelabel" for="postcode1">PostCode</label>
	 				<input type="text" onfocusout="focusOut('postcodeError')" name="postcode1" value="<?php echo $userObj->postCode1 ?>" />
	 				<input type="text" onfocusout="focusOut('postcodeError')" name="postcode2" value="<?php echo $userObj->postCode2 ?>" />
	 				<div class="errorDiv" id="postcodeError" style="display:none; color:red"></div>
	 			</div>
	 			<div class="formLine">
	 				<label class="updatelabel" for="sittertype">Sitter Type</label>
	 				<select name="sittertype">
    					<option value="1" <?php echo $houseS ?> >House Sitter</option>
    					<option value="2" <?php echo $babyS ?>  >Baby Sitter</option>
    					<option value="3" <?php echo $plantS ?> >Plant Sitter</option>
    					<option value="4" <?php echo $catS ?>   >Cat Sitter</option>
    					<option value="5" <?php echo $dogW ?>   >Dog Walker</option>
    					<option value="6" <?php echo $carer ?>  >Carer</option>
  					</select>
	 			</div>
	 			<div class="formLine">
	 				<textarea style="resize: none" onfocusout="focusOut('sumError')" rows="10" cols="50" name="summary"><?php echo $userObj->summary ?></textarea>
	 				<div class="errorDiv" id="sumError" style="display:none; color:red"></div>
	 			</div>
	 			<div class="formLine">
	 				<label class="updatelabel" for="avgpph" onfocusout="focusOut('avgError')" style="float:left">Average Price per hour £</label>
	 				<input type="text" name="avgpph" style="margin-left: 10px; float:left" value="<?php echo $userObj->avgpricePerHour ?>" />
	 				<div style="margin-left: 5px; float:left">
	 					Whilst you may post and change rates in the Rates and Availability page,<br /> this is to give an idea of your charges.
	 				</div> <br /> <br />
	 				<div class="errorDiv" id="avgError" style="display:none; color:red"></div>
	 			</div>
	 			<br />
	 			<div class="formLine">
	 				<input type="submit" value="Update Info" style="float:none"/>
	 			</div>
			</fieldset>
			
		</form>
	</div>
		
</body>
</html>