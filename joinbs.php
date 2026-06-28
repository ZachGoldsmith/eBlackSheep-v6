<?php
ob_start();

include('connection.php');
include('functions.php');	

$sql3 = "SELECT * FROM bs_global";
$result3 = mysqli_query($mysqli, $sql3);
$row3 = mysqli_fetch_array($result3);
$version = $row3['Version'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Submit Application | eRepublik</title>
<style type="text/css">
@font-face {
    font-family: BerlinSans;
    src: url(fonts/BRLNSR.ttf) format("truetype");
}
@font-face {
    font-family: Impact;
    src: url(fonts/impact.ttf) format("truetype");
}
body {
	margin-top: 0 0 0 0;
}
a {
	border: none;
	color:#666666;	
}
.login {
	width:800px;
	height:100%;
	margin: 0 auto;	
}
#eday {
	color:#999999;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;
}
#line {
	width:110px;
	height:1px;
	background-color:#B25900;
	margin: 0 auto;
}
#logo {
	width:241px;
	height:144px;
	margin:0 auto;	
	padding-top:15px;
}
#application {
	width:245px;
	height:auto;
	margin: 0 auto;
	font-size:14px;
	font-family: Impact;
	margin-top:20px;	
}
#input {
	width:225px;
	height:25px;
	background-color:#EEEEEE;
	border-color:#DDDDDD;
	border-style:solid;
	border-width:1px;
	padding-left:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:14px;
	color:#B25900;
}
#input2 {
	width:235px;
	height:30px;
	background-color:#EEEEEE;
	border-color:#DDDDDD;
	border-style:solid;
	border-width:1px;
	padding-left:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:14px;
	color:#B25900;
}
#footer {
	font-size:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	color:#666666;
	margin:0 auto;
	position:fixed;
	bottom:0;
	left:0;
	right:0;
	height:20px;
}
</style>
</head>

<body>
<div class="login">

<!-- Current eDay -->
<div id="eday" align="center">
Current eDay: <?=$eday?>
</div>
<div id="line"></div>
<!-- ------------ -->

<!-- Logo -->
<div id="logo">
<img src="images/logos/logo2.png" width="241" height="144" />
</div>
<!-- ---- -->

<!-- Login Area -->
<div id="application" align="center">
<form method="post">
<div style="color:#666666;padding-left:7px;text-align:left;">CITIZEN ID: <img src="/images/help_black.png" height="12px" width="12px" title="Your citizen ID is at the end of your profile link. Ex: http://www.erepublik.com/en/citizen/profile/12345678, where 12345678 is the citizen ID."/></div> 
<input id="input" name="citizenid" type="text" />
<br />
<div style="color:#666666;padding-left:7px;text-align:left;">CITIZEN NAME:</div>
<input id="input" name="citizenname" type="text" />
<br />
<div style="color:#666666;padding-left:7px;text-align:left;">PASSWORD:</div>
<input id="input" name="citizenpass" type="password" />
<br />
<div style="color:#666666;padding-left:7px;text-align:left;">TEAM CHOICE: <img src="images/help_black.png" height="12px" width="12px" title="Pick whichever team you want to be on. The color you pick will determine your avatar stripe on your eRepublik profile."/></div> 
<select id="input2" name="team">
<option selected="selected" disabled="disabled">&nbsp;</option>
<?php
$query3 = "SELECT * FROM bs_herds WHERE HerdName != 'Honor Guard' AND HerdName != 'Lost Herd'";  
$result3 = mysqli_query($mysqli, $query3) or die("Query failed ($query3) - " . mysqli_error($mysqli)); 
$numrows3 = mysqli_num_rows($result3);

for($i = 0; $i < $numrows3 ; $i++) 
{ 
$row3 = mysqli_fetch_array($result3);
$herd = $row3['HerdName'];

echo '<option>'.$herd.'</option>';

}
?>
</select>
<br />
<div style="color:#666666;padding-left:7px;text-align:left;">REFERRER: <img src="images/help_black.png" height="12px" width="12px" title="If anyone told you about VMA-214 The Black Sheep, you can put their name here."/></div> 
<input id="input" name="referrer" type="text" />
<br />
<table width="100%" border="0" align="center" style="margin-top:3px;">
  <tr>
    <td align="left"><a href="index.php" target="_self"><img src="images/buttons/backtohome.png" width="112" height="27" /></a></td>
    <td align="right" style="padding-right:3px;"><input name="apply" type="image" src="images/buttons/submit.png" /></td>
  </tr>
</table>
</form>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	include('connection.php');
	$citid = $_POST['citizenid'];
	$citname = $_POST['citizenname'];
	$referrer = $_POST['referrer'];
	$date = date("Y-m-d");
    $password = sha1($_POST['citizenpass']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $team = $_POST['team'];
	$commune = 'N/A';
	if(empty($referrer)){ $referrer = 'N/A'; }
	
    if (!preg_match('/^[0-9]+?$/', $citid) || $citid <= 0) {
        echo '<div style="font-size:x-small; color:red; margin-top:40px;">Invalid citizen ID; your citizen ID is the set of numbers in your profile link!</div>';
    }
	else {
    	$sql1="SELECT * FROM bs_accounts WHERE CitizenID='".$citid."'";
    	$result1=mysqli_query($mysqli, $sql1);
    	$numrows1=mysqli_num_rows($result1);
		
    	$sql3="SELECT * FROM bs_applications WHERE CitizenID='".$citid."'";
    	$result3=mysqli_query($mysqli, $sql3);
    	$numrows3=mysqli_num_rows($result3);		
    	
		if($numrows3 > 1) { 
		echo '<div style="margin-top:40px;" id="eday">APPLICATION HAS ALREADY BEEN SUBMITTED</div>';
		}
		
		else {
		
    	if($numrows1 < 1) {
        	$sql2="INSERT INTO bs_applications (CitizenID, CitizenName, ApplyDate, Referrer, Password, IP, Team, Commune) VALUES ('$citid','$citname','$date','$referrer','$password','$ip','$team','$commune')";
        	$result2=mysqli_query($mysqli, $sql2);
        	echo '<div style="margin-top:40px;" id="eday">
            APPLICATION SUBMITTED<br />
			WE WILL CONTACT YOU SHORTLY<br /><br />
            To get set up quickly, <a href="http://eblacksheep.net/forums/index.php?action=chat">visit us on IRC</a>.
            <br />If you\'re employed, please quit your job<br />
(if you can\'t do it today, send a message to your employer asking him/her to fire you).
            </div>';
        }
    	elseif($numrows1 <= 1) {
    	    echo '<div style="margin-top:40px;" id="eday">YOU\'RE ALREADY IN THE ROSTER SYSTEM</div>';	
    	}
		}
    }
} 
?>
</div>
<!-- ---------- -->

<!-- Footer -->
<div id="footer" align="center" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">
Version: <?=$version?> | Created and Managed by: Zach Goldsmith
</div>
<!-- ------ -->

</div>
</body>
</html>
<?php ob_flush(); mysqli_close($mysqli); ?>