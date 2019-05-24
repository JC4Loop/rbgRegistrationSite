<?php
	require_once("User.class");
	require_once("DatabaseCxn.class");
	$user = new User(1,"ab123");
	$user->getDetails();
	echo 'set details should have worked<br />';
	$array = $user->availability;
	var_dump($array);
	//echo "<br />".$array["monday"]["3am"];
	//echo $array["sunday"]["1pm"];
	echo "<br /><br />";

	echo $value["1am"];
	foreach ($array as $value) {
		
		foreach($value as $v){
			echo $v;
		}
		echo "<br />";
	}

	echo '<br />'.$user->summary;
?>