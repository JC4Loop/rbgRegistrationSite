<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php session_start(); ?>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />

	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <style type="text/css">
        #divCaptcha
        {
            background-image: url('checklines.png');
            width: 15%; /* for IE 6 */
            height: 100px;
            display: table;
            border-style: solid;
            border-width: 1px;
            margin: 10px auto;
        }
        #spnstring
        {
            font-size: xx-large;
            font-family: Cooper Std Black;
            font-style: italic;
            color: #480000;
            letter-spacing: 4px;
            height: 100px;
            opacity: 0.4;
            filter: alpha(opacity=40);
            vertical-align: middle;
            display: table-cell;
            text-align: center;
        }

        div.errorDiv{
            margin: auto;
            text-align: center;
            padding: 15px 10px 5px 10px;
            width : 60%;
        }
    </style>
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
    	
    	window.onload = function() { disableBtn(); randomString(); emptyErrorDivInvisible();}
    	
    	function disableBtn() {
            var sb = document.getElementById('submitBtn');
   		    sb.disabled = true;
        }


    var randomstring= "";
        function randomString() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = Math.floor((Math.random() * 5) + 1);
            randomstring = '';
            for (var i = 0; i < string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum, rnum + 1);
            }
            $('#spnstring').html(randomstring);
        }

        function checkCaptch(){
            var lbl = document.getElementById('corInCorLbl');
            var sInput = document.getElementById("captchIn").value;
            var n = sInput.localeCompare(randomstring); 
            if (n == 0){
                lbl.innerHTML = "Thankyou";
                document.getElementById('submitBtn').disabled = false;
            } else {
                //alert('wrong Captcha');
                document.getElementById('captchIn').value = "";
                lbl.innerHTML = "Incorrect";
                randomString();
            }
        }

        function focusOut(id){
            var x = document.getElementById(id);
            x.innerHTML = "";
            x.style.display = "none";
        }

        function validateForm(){
            var errorFound = false;
            var uNInput = document.forms["theForm"]["uName"].value;
            if (uNInput == ""){
                errorFound = true;
                errorFoundFunc("unError","No username entered");
            } else if (hasSpecialChars(uNInput)){
                errorFound = true;
                errorFoundFunc("unError","Special Characters not allowed");
            } else if (uNInput.length > 10){
                errorFound = true;
                errorFoundFunc("unError","Max length of Username is 10 characters");
            }

            var pwInput = document.forms["theForm"]["password"].value;
            if (pwInput == ""){
                errorFound = true;
                errorFoundFunc("pwError","Please Enter a Password");
            } else if (hasSpecialChars(pwInput)){
                errorFound = true;
                errorFoundFunc("pwError","Password cannot contain special characters");
            } else if (pwInput.length > 8){
                errorFound = true;
                errorFoundFunc("pwError","Max length for password is 8");
            }



            var emInput = document.forms["theForm"]["email"].value;
            if (emInput == ""){
                errorFound = true;
                errorFoundFunc("emError","Email is required");
            } else if (emInput.match(/[\'^£$%&*}{#~?><>,|;:\/<>=_+¬-]/)){ // don't check for @ symbol
                errorFound = true;
                errorFoundFunc("emError","Email cannot contain special characters");
            } else {
                // this will only check for occurence of @ in valid position
                // server validation will be relied on
                if (!(emInput.match(/^[^@]*@[^@]*$/))){
                    errorFound = true;
                    errorFoundFunc("emError","You have input an invalid email");
                }
            }

            if (errorFound){
                return false;
            } else {
                return true;
            }
        }

        function hasSpecialChars(s){
            var pattern = /[\'^£$%&*}{@#~?><>,|;:\/<>=_+¬-]/;
            return s.match(pattern);
        }

        function errorFoundFunc(id,msg){
            document.getElementById(id).style.display = "block";
            document.getElementById(id).innerHTML = msg;
        }

        function emptyErrorDivInvisible(){
            var errorDivs = document.getElementsByClassName("errorDiv");
            for (var i = 0; i < errorDivs.length; i++){
                if (errorDivs[i].value == null){
                    errorDivs[i].style.display = "none";
                }
            }
        }


    </script>
</head>

<body>
	<?php 
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true){
            include 'AuthMenuTemplate.php';
            echo '<div class="centerDiv">To register as a new user you must first log out</div>';
            exit();
        } else {
            include 'menuTemplate.php';
        }

        $errorMsgs;
        if (isset($_SESSION['errorMsgs'])){
            $errorMsgs = $_SESSION['errorMsgs'];
        }
    ?>
	<div>
		<form method="post" action="Emailinfo.php" onsubmit="return validateForm()" name="theForm">
			<fieldset style= "width: 500px; margin: 20px auto;">
				<legend>Registration Form</legend>
				<div class="formline">
					<label for="name">Username:</label>
					<input type="text" id="name" name="uName" onfocusout="focusOut('unError')" />
				</div>
                <div class="errorDiv" id="unError" style="color:red">
                        <?php
                            if (isset($errorMsgs) and $errorMsgs['uName'] != null){
                                echo $errorMsgs['uName'];
                            }
                        ?>
                    </div>

				<div class="formline">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" onfocusout="focusOut('pwError')" />
				</div>
                <div class="errorDiv" id="pwError" style="color:red">
                <?php
                    if (isset($errorMsgs) and $errorMsgs['password'] != null){
                        echo $errorMsgs['password'];
                    }
                ?>
                </div>

				<div class="formline">
					<label for="email">E-Mail:</label>
					<input type="text" id="email" name="email" onfocusout="focusOut('emError')" />
				</div>
                <div class="errorDiv" id="emError" style="color:red">
                <?php
                    if (isset($errorMsgs) and $errorMsgs['email'] != null){
                        echo $errorMsgs['email'];
                    }
                ?>
                </div>
				<div style="margin-top:15px; margin-left: 25px; color:blue;">
				Input correct captcha to unlock submit button, case sensitive
				</div>
				    <div id="divCaptcha">
       			 <span id="spnstring"></span>
    				</div>
   				 <a onclick="randomString();" style="cursor: pointer; color: Red; position: inherit;">
        			(Reload image)</a>
    			<input type="text" id="captchIn" name="captch" />
    			<button type="button" onclick="checkCaptch()" id="checkBtn"> Check </button>

    			<div class="formline">
                    <label id="corInCorLbl"></label>
					<input id="submitBtn" type="submit" name="submit" value="Submit Form" />
				</div>
			</fieldset>
		</form>
</body>

</html>