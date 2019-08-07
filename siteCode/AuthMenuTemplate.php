<?php 
if(isset($_SESSION['uName']) && isset($_SESSION['logged'])){
	if($_SESSION['logged'] == true){
		$uName = $_SESSION['uName'];
		echo '<div id="topMenu">';
		echo '	<div id="topMenuSub1">';
		echo '		<h1>Royal Borough of Greenwich</h1>';
		echo ' 	</div>';
		echo '	<div id="topMenuSub2">';
		echo '  <div id="showUserName">Hello '.$uName.', you are logged in';
		echo '								<a href="loggedout.php">LogOut</a></div>';
		echo '			<ul>';
		echo ' 				<a href="LogIn.php"><li>LogIn</li></a>';
		echo '				<a href="UpdateDetails.php"><li>Update Details</li></a>';
		echo ' 				<a href="SitterSearch.php"><li>Sitter Search</li></a>';
		echo '			</ul>';
		echo '	</div>';
		echo '</div>';
	} else {
		echo 'Something has gone wrong. Second if statement has returned false';
	}
} else {
	echo 'Something has gone wrong first if statement has returned false '.$_SESSION['uName'];
}



?>