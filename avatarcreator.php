<?php
session_start();
$vmaid = $_SESSION['vmabsmu'];

if(!isset($vmaid)) {
header("Location: index.php");
exit;
}

elseif(isset($vmaid)) {
include('connection.php');
include('functions.php');
include('lookup.php');

$version = $row6['Version'];
$vmaname = $row1['CitizenName'];
$vmaclearance = $row1['Clearance'];	
$vmapic = $row1['Avatar'];
$vmaherd = $row2['HerdName'];

include("navigations.php");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Avatar Creator | eRepublik</title>

<style type="text/css">
@font-face {
    font-family: BerlinSan;
    src: url(fonts/BRLNSR.ttf) format("truetype");
}
@font-face {
    font-family: Impact;
    src: url(fonts/impact.ttf) format("truetype");
}
body {
	margin-top: 0 0 0 0;
}
#topinfo a:link {
	color: #999999;
	text-decoration: none;
}
#topinfo a:visited {
	text-decoration: none;
	color: #999999;
}
#topinfo a:hover {
	text-decoration: underline;
	color: #666666;
}
#topinfo a:active {
	text-decoration: none;
	color: #999999;
}
a:link, a:visited, a:hover, a:active {
	color:#000000;
	text-decoration:none;	
}
#topinfo {
	color:#999999;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;
}
.main {
	width:800px;
	height:auto;
	margin: 0 auto;	
}
#line1 {
	width:800px;
	height:2px;
	background-color:#000000;
	margin: 0 auto;
}
#line2 {
	width:800px;
	height:2px;
	background-color:#B25900;
	margin: 0 auto;
}
#navigation {
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px;
	padding-left:3px;
	margin-top:2px;
	margin-bottom:2px;
}

#content {
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px;
	margin-top:10px;
	text-align:center;	
}
a.current {
 text-decoration:underline;
 color:#666666;	
}
#footer {
	font-size:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	color:#666666;
	margin:0 auto;
	height:25px;
	margin-top:10px;
}
#upload-button {
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px;
	text-align:center;	
	background-color:#333333;
	color:#999999;
}
</style>
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
  $("#generate-button").button();
  $("#radio").buttonset();
});
</script>
</head>

<body>
<div class="main">

<!-- Top Bar -->
<div>
<table width="800" border="0">
  <tr>
    <td align="left"><img src="images/logos/sidelogo-NEW.png" width="159" height="61" /></td>
    <td align="right" id="topinfo">
    Current eDay: <?=$eday?>
    <br />
	Welcome, <?=$vmaname?>!
    <br />
	You are in <?=$vmaherd?>
    <br />
    <a href="logout.php">Logout</a>
    </td>
  </tr>
</table>
</div>
<!-- ------ -->
<div id="line1"></div>

<!-- Navigation -->
<div id="navigation"><?=$nav1?></div>
<!-- ---------- -->

<div id="line2"></div>

<div id="content">

<form enctype="multipart/form-data" action="avatarcreator.php" method="POST">
			<p>Select your herd from the choices below:</p>
			<p>
            <div id="radio">
<?php
if($vmaherd == 'Honor Guard') {
$sql5 = "SELECT * FROM bs_herds WHERE HerdName != 'Lost Herd' AND HerdName != 'White Herd'";
$result5 = mysqli_query($mysqli, $sql5);
$numrows5 = mysqli_num_rows($result5);	
}
else{
$sql5 = "SELECT * FROM bs_herds WHERE HerdName != 'Honor Guard' AND HerdName != 'Lost Herd' AND HerdName != 'White Herd'";
$result5 = mysqli_query($mysqli, $sql5);
$numrows5 = mysqli_num_rows($result5);
}

for($i = 0; $i < $numrows5 ; $i++) 
{ 
$row5 = mysqli_fetch_array($result5);
$herdname = $row5['HerdName'];
$shortherd = strtolower($herdname);
$shortherd = explode(' ',trim($shortherd));
$number = $i+1;

?>
<script>
$(function() {
  $("#radio<?=$i+1?>").button();
});
</script>
<?php

echo '<input id="radio'.$number.'" type="radio" name="herd" checked="checked" value="'.$shortherd[0].'"><label for="radio'.$number.'">'.$herdname.'</label>';
}

?>
                <br />
                </div>
			</p>
			<p>
				<input name="uploaded" type="file" id="upload-button">
                <br />
                <br />
				<input id="generate-button" type="submit" value="Generate">
			</p>
		</form>
		<?php
			if (!empty($_FILES['uploaded'])) {
				// Upload code
				$target = "upload/"; 
				$target = $target . basename( $_FILES['uploaded']['name']) ; 	
				$ok = true;
				
				if ($_FILES['uploaded']['name'] == NULL) {
					echo '<p>There was a problem uploading your file.</p>';
				} else {
					// Provied a user message if the uploaded file is not in a useable format
					$filetypes = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png');
					if (!in_array($_FILES['uploaded']['type'], $filetypes)) {
						echo '<p>Your file type is not an image, your file was '.$_FILES['uploaded']['type'].'.</p>';
						$ok = false;
					}
					// Don't allow silly users to use large file sizes. Limits the CPU used while processing.
					if ($_FILES['uploaded']['size'] > 600000) { 
						echo '<p>Your file is too large. The maximum size allowed is 600k.<br />'; 
						echo 'Your file size is: '.$_FILES['uploaded']['size'].'</p>';
						$ok = false; 
					} 
					// If everything is ok, then we can go ahead and use the uploaded graphic
					if (!$ok) { 
						Echo "<p>Sorry your file was not uploaded.</p>"; 
					} else {
						if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) {
							$_SESSION['filename'] = $target;
							$_SESSION['filetype'] = $_FILES['uploaded']['type'];
							$_SESSION['herd'] = $_POST['herd'];
							//echo '<p><img src="'.$target.'" max-width="200px" max-height="200px" />';
							echo '<img src="createAvatar.php" width="200px" height="200px" /></p>';
						} else { 
							echo "<p>Sorry, there was a problem uploading your file.</p>"; 
						}
					}
				}
			}
		?>

</div>

<!-- Footer -->
<div id="footer" align="center">
<div id="line2"></div>
<table width="800px" border="0" style="margin: 0 auto;" align="center">
  <tr>
    <td align="left" style="color:#000000;font-family:BerlinSans,'Berlin Sans FB';font-size:12px;"><?=$nav2?></td>
    <td align="right" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Version: <?=$version?> | <a href="mailto:zachgoldsmith@outlook.com" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Contact Webmaster</a> | <?APILastUpdate()?></td>
  </tr>
</table>
<div id="line1"></div>
</div>
<!-- ------ -->

</div>
</body>
</html>