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

// Javascript code to display image in larger size has been taken from https://www.w3schools.com/howto/howto_js_lightbox.asp
// This however needs work to better appearence such as image size.
	
?>
<head>
	<title>ImageManage</title>
	<link rel="stylesheet" type="text/css"
	href="RBGreenwich.css" />
	<style>
		p {
			text-align: center;
		}
		* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: blue;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

		
	</style>
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
		<h3 style="text-align: center; background-color: white">Update / Manage Images</h3>
		<p>Upload / Delete Images using the form below</p>
		<p><?php 
			$images = $userObj->receiveImages();
			if ($images[0] == false) {
				echo 'You have not uploaded an image';
			}
			if (count($images) >= 1 && !$images[0] == false) {
				$count = count($images);
				echo "You have uploaded $count image(s).";
			}
		?></p>
		Select image to upload:
		<form id="frmImageUpload" action="imageUpload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="imageToUpload" id="imageToUpload" />
			<input type="submit" value="Upload Image" name="submit" />
		</form>
		<div>
		<?php 
		$count = count($images);
			if ($count > 0 && $images[0] !== false) { // if there are images to display show them
				$c = 0;
				$cTwo = 0;
				foreach ($images as $i) {
					$dir = "../rbgSitterSite/uImageUploads/";
					if (($c % 4) == 0){ 
						echo '<div class="row">' . "\n";
					}
					$cTwo++;
					displayImage($dir,$i,$c);
				
					if (((($c % 4) == 0) && ($cTwo == 4)) || $cTwo == $count) { // if we are modulo to 4 and 4 rows have been added 
						echo '</div>' . "\n \n";	// close row div						//  or we've output all images
						$cTwo = 0;
					}
						
					$c++;
				}

				echo "\n".'<div id="myModal" class="modal">' . "\n";
				echo "\t".'<span class="close cursor" onclick="closeModal()">&times;</span>' ."\n";
				echo "\t".'<div class="modal-content">'."\n";
				$c = 1;
				foreach ($images as $i) {
					echo "\t\t" .'<div class="mySlides">'."\n";
					echo "\t\t\t".'<div class="numbertext">'.$c.' / '.$count.'</div>' . "\n";
					echo "\t\t\t".'<img src="'.$dir.$i.'" style="max-height:600px; max-width:600px" />' . "\n";
					echo "\t\t".'</div>' . "<!-- end mySlides -->\n";

					//<img src='".$dir.$i."' style='max-width:150px; max-height:150px; margin-left:20px'"
					$c++;
				}
			}
			

    	$c = 1;
    	if ($images[0] !== false){
			echo "\t\t".'<a class="prev" onclick="plusSlides(-1)">&#10094;</a>'."\n";
    		echo "\t\t".'<a class="next" onclick="plusSlides(1)">&#10095;</a>'."\n";

    		echo "\t\t".'<div class="caption-container">'."\n";
     		echo "\t\t".' <p id="caption"></p>'."\n";
    		echo "\t\t".'</div>'."<!-- close caption-container -->\n";

			foreach ($images as $i) {
				echo "\t\t".'<div class="column">'."\n";
				echo "\t\t\t".'<img class="demo cursor" src="'.$dir.$i.'" style="max-height:150px; max-width:150px" onclick="currentSlide('.$c.')" />' . "\n";
				echo "\t\t".'</div>' . "<!-- end column div -->\n"; //
				$c++;
			}
		}
    ?>
    	</div> <!-- end of model content-->
	</div> <!-- end modal -->
   
			
		<?php
			function displayImage($dir,$i,$count){ // display the image on the default page not javascript
				$c = $count + 1;
				echo '<div class="column">';
				//echo "<a href='".$dir.$i."'> <img src='".$dir.$i."' style='max-width:150px; max-height:150px; margin-left:20px'"
				//	.'onclick="openModal();currentSlide('.$c.')"'. 'class="hover-shadow cursor" /></a>'."\n";
				echo "<img src='".$dir.$i."'style='max-width:150px; max-height:150px'"
					.'onclick="openModal();currentSlide('.$c.')"'. 'class="hover-shadow cursor" />'."\n";
				echo '</div>'."\n";
			}
		?>
		
	
	<script>
		// Open the Modal
	function openModal() {
  		document.getElementById('myModal').style.display = "block";
	}

	// Close the Modal
	function closeModal() {
  		document.getElementById('myModal').style.display = "none";
	}

	var slideIndex = 1;
	showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
  		showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
  		showSlides(slideIndex = n);
	}

	function showSlides(n) {
  		var i;
  		var slides = document.getElementsByClassName("mySlides");
  		var dots = document.getElementsByClassName("demo");
  		var captionText = document.getElementById("caption");

  		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {slideIndex = slides.length}
  		for (i = 0; i < slides.length; i++) {
    		slides[i].style.display = "none";
  		}
  		for (i = 0; i < dots.length; i++) {
    		dots[i].className = dots[i].className.replace(" active", "");
  		}
  		slides[slideIndex-1].style.display = "block";
  		dots[slideIndex-1].className += "active";
  		captionText.innerHTML = dots[slideIndex-1].alt;
	}

		</script>
	</body>
</html>
