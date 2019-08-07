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
	<title>Sitter Search</title>
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
		.clickableTblRow{
			padding-left: 30px;
			padding-right: 30px
		}
		.clickableTblRow:hover { 
			background: #80a8ff;
			cursor: pointer;
		}
		
	</style>
	</head>

<body onload="updateSDataTable()">
	

	<div class="centerBox">
		<div>
			<br />
			<h3 style="text-align: center; background-color: white">Sitter Search</h3>
			<p>View & Search Greenwich Sitters</p>
			<table id="sittersTbl" style="text-align: center; margin:auto">
				<tr>
					<th>Sitter Type</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Gender</th>
					<th>PostCode</th>
					<th>Avg PPH</th>
				</tr>
			<?php
				$allSitters = DatabaseCxn::getAllVerifiedUsers();
				foreach($allSitters as $x){
					echo '<tr onclick="rowClicked(';
					echo $x->getID();
					echo ')" class="clickableTblRow">';
					echo "<td>$x->sitterType</td>";
					echo "<td>$x->surname</td>";
					echo "<td>$x->firstname</td>";
					echo "<td>$x->gender</td>";
					echo "<td>$x->postCode1 $x->postCode2</td>";
					echo "<td>$x->avgpricePerHour</td>";
					echo "</tr>";
				}
			?>
				</table>
			</div>
			</body>
	
	<script>
		function rowClicked(id){
			var goTo = "SitterDetails.php?var=" + id;
			window.location.assign(goTo);
		}

		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
           		if (this.readyState == 4 && this.status == 200) {
               		document.getElementById("sittersTbl").innerHTML += this.responseText;
           		}
        	};
        	xmlhttp.open("GET", "be_SittersTable.php", true);
        	xmlhttp.send();
	</script>
</html>
