<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php session_start();

?>
<head>
	<title>LogIn</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<script type = "text/javascript">
		
		//var x = document.forms["lgForm"]["uname"].value;
		document.addEventListener("DOMContentLoaded", function() {
			var elements = document.getElementsByTagName("INPUT");
    		for (var i = 0; i < elements.length; i++) {
        		elements[i].oninvalid = function(e) {
            		e.target.setCustomValidity("");
            		if (!e.target.validity.valid) {
                		e.target.setCustomValidity("ThIs fieLd cannOt be leFt blaNk");
           	 		}
        		};
        		elements[i].oninput = function(e) {
            	e.target.setCustomValidity("");
        		};
    		}
		});

		function changeUserInputVal(username){
			var uinput = document.getElementById('name');
			uinput.value = username;
		}
		
	</script>
	
</head>

<body>

	<?php 
	if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){
		//include 'AuthMenuTemplate.php';
		setMasterPage(true);
		$uName = $_SESSION['uName'];
		echo "\n\n".'<div class="centerDiv">';
		echo "You are already logged in as $uName";
		echo '</div>';
		exit();
	} else {
		//include 'menuTemplate.php';//
		setMasterPage(false);
		
	}

	function setMasterPage($bool){
		if ($bool == true) {
			include 'AuthMenuTemplate.php';
		} else {
			include 'menuTemplate.php';
		}
	}
	?>
	<h3 style="text-align: center;">Log In</h3>
		<div id="errorDiv" style="color:red; margin-left:40%;margin-right:30%"></div>
		<form name="lgForm" method="post" action="CheckLogIn.php">
			<fieldset style= "width: 500px; margin: 20px auto;">
				<legend>Log In details</legend>
				<div class="formline">
					<label for="uName">Username:</label>
					<input type="text" id="name" name="uName" required/>
					<label for="publicCheck">Check if using public computer</label>
					<input type="checkbox" name="publicCheck" value ="Y" />
				</div>

				<div class="formline">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" required/>
				</div>
				<div class="formline">
					<input id="logInBtn" type="submit" name="submit" value="Log In" style="text-align: center;" />
				</div>
				</fieldset>
		</form>
		<?php
		//echo $_COOKIE["username"];
		if(isset($_COOKIE["username"])){
			foreach($_COOKIE as  $key => $val){
				if ($key == "username"){
					//echo "\n\ncookie name = ".$key.", and value = ".$val;
					echo "\n<script>changeUserInputVal('$val')</script>\n";
				}	
    		}
		}
		?>
		<script>
			var err ="";
			<?php 
				if(isset($_SESSION['loginfailMsg']) && isset($_GET['er']))
				{
					echo 'err = "'. $_SESSION['loginfailMsg'] . '";';
					// this is to set javascript var with value from php
				} 
				//decided not to use this - $_SERVER['HTTP_REFERER'] 
			?> 
			document.getElementById('errorDiv').innerHTML = err;
		</script>
</body>


</html>
