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



	if ($rates !== null){
		foreach($rates as $r){
			//echo '<tr onclick="rowClicked('.$r->getRateID().')"> <td> '.$r->getHours() . "</td> <td>".$r->getPrice() . "</td></tr>";
			$string1 = '<tr onclick="tblRowClicked(';
			$string2 = $r->getRateID();
			$string3 = ',this)" class="clickableTblRow"';
			echo $string1.$string2.$string3.'><td>'.$r->getHours() . "</td> <td>".$r->getPrice() . "</td></tr>\n";
		}

	}					
?>