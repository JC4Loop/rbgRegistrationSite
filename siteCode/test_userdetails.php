<?php
	require_once("User.class");
	require_once("DatabaseCxn.class");

	$user = new User(1,"ab123");
	$user->getDetails();
	echo 'set details should have worked<br />';
	echo $user->gender;
	echo '<br />'.$user->summary;

?>