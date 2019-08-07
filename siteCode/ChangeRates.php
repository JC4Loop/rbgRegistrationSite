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
	$rates = $userObj->rates;
	
?>
<head>
	<title>RatesUpdate</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}
		.urateline {
			text-align: center;
			padding-bottom: 20px;
		}
		th,td {
			padding-left: 20px;
			padding-right:20px;
		}
		td {
			margin-left:0px;
			margin-right:0px;
		
		}
		.clickableTblRow{
			padding-left: 30px;
			padding-right: 30px
		}
		.clickableTblRow:hover { 
			background: #80a8ff;
			cursor: pointer;
		}
		
	</style>
	<script>
		var previousSelectedRow = null; // declare a global var to hold current row selected
		var bColor = null;
		var rateIdOfSelected;
		
	</script>
</head>

<body onload="updateTable()">
	<?php 
	include 'AuthMenuTemplate.php';	
	?>

	<div class="leftBox">
		<a class="leftLinks" href="UpdateManageImages.php"><div class="leftLinks">Upload / Remove Images</div></a> <br />
		<a class="leftLinks" href="ChangeAvailability.php"><div class="leftLinks">View / Change Availability</div></a>
		<a class="leftLinks" href="ChangeRates.php"><div class="leftLinks">VIew / Change Rates</div></a>
	</div>
	<div class="centerBox">
		<div>
			<br />
			<h3 style="text-align: center; background-color: white">View / Update Rates</h3>
			<p>Upload Rates using the form below</p>
			<p><?php 
				if ($rates == null){
					echo "<b>You have not set any rates</b>";
				}
				?>
			</p>
			<table id="ratesTbl" style="text-align: center; margin:auto">
				<tr>
					<th>Hour(s)</th>
					<th>Price</th>
				</tr>
				<?php /*
					if ($rates !== null){
						foreach($rates as $r){
							//echo '<tr onclick="rowClicked('.$r->getRateID().')"> <td> '.$r->getHours() . "</td> <td>".$r->getPrice() . "</td></tr>";
							$string1 = '<tr onclick="tblRowClicked(';
							$string2 = $r->getRateID();
							$string3 = ',this)" class="clickableTblRow"';
							echo $string1.$string2.$string3.'><td>'.$r->getHours() . "</td> <td>".$r->getPrice() . "</td></tr>\n";
						}
					} */
					
				?>
	
			</table>
			</div>
			<div style="margin-top: 100px">
				<form>
					<fieldset>
						<div class="urateline">
							<label for="hours">Hour(s):</label>
							<input type="text" id="hours" name="hours" disabled="disable"/>
							<label for="price">Price:</label>
							<input type="text" id="price" name="price" disabled="disable"/>
							<input id="deletebtn" type="button" onclick="deleteRate()" value= "Delete Rate"
								disabled="disabled" style="visibility:hidden"/>
						</div>
						<div class="urateline">
						<input id="modbtn" type="button" onclick="modRates()" value="Add / Update Rate"/>

						</div>
						<p id="response"></p>
					</fieldset>
				</form>
			</div>
		</div>

	<script>

		function createNewRate(){
			document.getElementById('deletebtn').disabled = true;
			document.getElementById('deletebtn').style.visibility = "hidden";
			var hourInput = document.getElementById("hours");
			hourInput.disabled = false;
			hourInput.value = "";
			var priceInput = document.getElementById("price");
			priceInput.disabled = false;
			priceInput.value = "";
			document.getElementById("modbtn").value = "Add Rate";
		}

		function tblRowClicked(rID,row){
			rateIdOfSelected = rID;
			if (previousSelectedRow != null){ // set color of previously selected row to default
				previousSelectedRow.style.backgroundColor = bColor;
				previousSelectedRow.style.color = "black";
			}
			previousSelectedRow = row;
			var hoursTxt = row.childNodes[0].innerHTML;
			var priceTxt = row.childNodes[2].innerHTML;
			
			var hourInput = document.getElementById("hours");
			var priceInput = document.getElementById("price");
			hourInput.disabled = true;
			priceInput.disabled = false;
			hourInput.value = hoursTxt;
			priceInput.value = priceTxt;
			row.style.backgroundColor = "blue";
			row.style.color = "white";
			document.getElementById("modbtn").value = "Update Rate";
			document.getElementById('deletebtn').style.visibility = "visible";
			document.getElementById('deletebtn').disabled = false;
			
		}
		
		function modRates(){
			var hour = document.getElementById('hours').value;
			var price = document.getElementById('price').value;
			if (isNaN(hour) || isNaN(price) || hour == "" || price == ""){
				alert('null or not number');
			} else {
				var rateID = rateIdOfSelected;
				var rate = {rateID,hour,price};
				if (document.getElementById("modbtn").value == "Add Rate"){
					sendToServer(rate,"insert");
				} else if (document.getElementById("modbtn").value == "Update Rate"){
					sendToServer(rate,"update");
				} else {
					alert('something has gone wrong \n code has fault');
				}
			}
		}

		function deleteRate(){
			var row = previousSelectedRow;
			var rateID = rateIdOfSelected;
			var hoursTxt = row.childNodes[0].innerHTML;
			var priceTxt = row.childNodes[2].innerHTML;
			var rate = {rateID,hoursTxt,priceTxt};
			if (confirm("CONFIRM: You wish to delete rate of " + hoursTxt + " hour(s) & " + priceTxt + " price?")) {
				sendToServer(rate,"delete");
    		} else {
        		
    		}
		}

		function sendToServer(myVar,operation){
			var xmlhttp = new XMLHttpRequest();
			var PageToSendTo = "beRatesMod.php?";
 			var VariablePlaceholder1 = "data=";
 			var varJson1 = JSON.stringify(myVar);
 			var varPlaceHolder2 = "&opr=";
 			var UrlToSend = PageToSendTo + VariablePlaceholder1 + varJson1 + varPlaceHolder2 + operation;
 	
			xmlhttp.onreadystatechange = function() {
           		if (this.readyState == 4 && this.status == 200) {
               		document.getElementById("response").innerHTML = this.responseText;
               		if (document.getElementById("response").innerHTML == "success"){
               			updateTable();
               		}
           		}
        	};
        	xmlhttp.open("GET", UrlToSend, true);
        	xmlhttp.send();
		}

		function updateTable(){						  //clickableTblRow
			var elementsToRemove = document.getElementsByClassName("clickableTblRow");
			//alert(removeFrom);
			var etrLength = elementsToRemove.length;
			//alert(etrLength);
			var parentElement;
			var currentElement;
			for (var i = etrLength - 1; i >= 0; i--){	
				currentElement = elementsToRemove[i];
				parentElement = currentElement.parentNode;
				parentElement.removeChild(currentElement);
			}
			var addRowElem = document.getElementById("rowAddNew");
			if (addRowElem != null){
				var parARE = addRowElem.parentNode;
				parARE.removeChild(addRowElem);
			}
			
			//alert('removed table rows');
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
           		if (this.readyState == 4 && this.status == 200) {
           			var ratesTable = document.getElementById("ratesTbl");
               		ratesTable.innerHTML += this.responseText; // add returned rows to table

               		var newRow = document.createElement("tr");
               		var textNode = document.createTextNode("Add New Rate");
            		var col = document.createElement("td");
            		col.colSpan = "2";
            		col.appendChild(textNode);
            		newRow.appendChild(col);
            		newRow.id = "rowAddNew";
            		newRow.onclick = function() {createNewRate()};
            		newRow.style.cursor = "pointer";
            		//document.getElementById("myP").style.cursor = "pointer"; 
            		ratesTable.appendChild(newRow);
           		}
        	};
        	xmlhttp.open("GET", "be_UpdateRatesTable.php", true);
        	xmlhttp.send();
		}

		//bColor = row.style.backgroundColor
	</script>
	</body>
</html>
