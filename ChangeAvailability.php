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
	$array = $userObj->availability;


?>
<head>
	<title>View / Change Availability</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}
		th.tLeftH {
			width: 10%;
		}
		table {
			border-collapse: collapse;
		}

		table, th, td {
    		border: 1px solid black;
		}

		.availElement, .availMon, .availTue, .availWed, .availThu, .availFri, .availSat, .availSun {
			width: 30px;
			display: block;
			margin:auto;
			background-color: red;
		}
		input[type=button] {
			border: none;
    		padding: 10px 30px 10px 23px;
    		/*text-align: center;*/
    		text-decoration: none;
    		cursor: pointer;
		}
		input[type=submit] {
			background-color: green;

		}
		
		tr:nth-child(even) {
			background-color: #00ffbf;
		}
	</style>
	<script>
<?php 		// change the values of the buttons (table)
	echo '	function modBtnTable() {';
	foreach($array as $key =>$week) {
		echo 'var x = document.getElementsByClassName("avail'.$key.'");' ."\n";
		foreach($week as $sKey => $day) {
			if ($day !== "X"){
			echo 'changeValues(x,"'.$sKey.'", "'.$day.'");'."\n";
			}
		}
	}
	echo '		'."\n";
	echo '	}'."\n";
?>
</script>
</head>

<body onload="modBtnTable()">
	<?php 
	include 'AuthMenuTemplate.php';
		
	?>
	<div class="leftBox">
		<a class="leftLinks" href="UpdateManageImages.php"><div class="leftLinks">Upload / Remove Images</div></a> <br />
		<a class="leftLinks" href="ChangeAvailability.php"><div class="leftLinks">VIew / Change Availability</div></a>
		<a class="leftLinks" href="ChangeRates.php"><div class="leftLinks">VIew / Change Rates</div></a>
	</div>
	<div class="centerBox">
		<br />
		<h3 style="text-align: center; background-color: white">Update / Manage Rates & Availability</h3>
		<p></p>
		<div id="availTableContain">
			<table>
				<tr>
					<td style="width:100px"></td>
					<th scope="col">Monday</th>
					<th scope="col">Tuesday</th>
					<th scope="col">Wednesday</th>
					<th scope="col">Thursday</th>
					<th scope="col">Friday</th>
					<th scope="col">Saturday</th>
					<th scope="col">Sunday</th>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">4 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="4am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">5 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="5am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">6 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="6am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">7 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="7am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">8 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="8am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">9 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="9am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">10 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="10am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">11 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="11am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">12 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="12pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">1 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="1pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">2 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="2pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">3 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="3pm" /></td>
				</tr><tr>
					<th class="tLeftH" scope="row">4 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="4pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">5 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="5pm" /></td>
				<tr>
					<th class="tLeftH" scope="row">6 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="6pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">7 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="7pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">8 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="8pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">9 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="9pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">10 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="10pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">11 PM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="11pm" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">12 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="12am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">1 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="1am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">2 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="2am" /></td>
				</tr>
				<tr>
					<th class="tLeftH" scope="row">3 AM</th>
					<td><input class="availMon" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availTue" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availWed" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availThu" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availFri" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availSat" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
					<td><input class="availSun" type="button" value="X" onclick="doFunction(this)" name="3am" /></td>
				</tr>
			</table>
			<input id="savebtn" type="button" onclick="updateAvail()" value="Save / Update Availability"/>
			<p id="response"></p>
		</div>
		
	</div>
	
		<script>
			function updateAvail(){
				var monday = document.getElementsByClassName("availMon");
				var updatedMonday = {};
				updatedMonday = loopArray(monday);
				var tuesday = document.getElementsByClassName("availTue");
				var updatedTuesday = {};
				updatedTuesday = loopArray(tuesday);
				var wednesday = document.getElementsByClassName("availWed");
				var updatedWednesday = {};
				updatedWednesday = loopArray(wednesday);
				var thursday = document.getElementsByClassName("availThu");
				var updatedThursday = {};
				updatedThursday = loopArray(thursday);
				var friday = document.getElementsByClassName("availFri");
				var updatedFriday = {};
				updatedFriday = loopArray(friday);
				var saturday = document.getElementsByClassName("availSat");
				var updatedSaturday = {};
				updatedSaturday = loopArray(saturday);
				var sunday = document.getElementsByClassName("availSun");
				var updatedSunday = {};
				updatedSunday = loopArray(sunday);
				var availability = {};
				availability["Mon"] = updatedMonday;
				availability["Tue"] = updatedTuesday;
				availability["Wed"] = updatedWednesday;
				availability["Thu"] = updatedThursday;
				availability["Fri"] = updatedFriday;
				availability["Sat"] = updatedSaturday;
				availability["Sun"] = updatedSunday;
				sendToServer(availability);
			}

			function sendToServer(myVar){
				var xmlhttp = new XMLHttpRequest();
				var PageToSendTo = "beAvailabilityMod.php?";
 				var VariablePlaceholder = "data=";
 				var varJson = JSON.stringify(myVar);
 				var UrlToSend = PageToSendTo + VariablePlaceholder + varJson;
				xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
                		document.getElementById("response").innerHTML = this.responseText;
            		}
        		};
        		xmlhttp.open("GET", UrlToSend, true);
        		xmlhttp.send();
			}

			function changeValues(x,i, dValue) {
				//for (var i = 0; i < 24; i++){
					if (dValue != "X" ){
						x[i].value = "-";
						x[i].style.background = "blue";
					}
				//}
				//alert('end');
			}
			/*var ar = document.getElementsByClassName("availMon");
				for (var i = 0; i < 24; i++){
					ar[i].value = "-";
					ar[i].style.background = "blue";
				}*/

			function loopArray(classElements){
				var count = classElements.length; // should allways be 24
				var updatedArray = {};
				for (var i = 0; i < count; i++){
					var name = classElements[i].name;
					updatedArray[name] = classElements[i].value;
				}
				return updatedArray;
			}

			function doFunction($a){
				if ($a.value == "X"){
					$a.style.background = "blue";
					$a.value = "-";
				} else {
					$a.style.background = "red";
					$a.value = "X";
				}
			}
		</script>
</body>

	

 

</html>