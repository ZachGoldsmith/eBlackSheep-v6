<?php
ob_start();
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
$vmaherd = $row2['HerdName'];
$vmadiscord = $row1['DiscordNick'];

include("navigations.php");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Soldiers Panel | eRepublik</title>

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
#messages {
	text-align:center;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;	
	margin-top:10px;
}
</style>
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script>
$(function() {
  $("#accordion, #accordion2, #accordion3").accordion({
	collapsible: true,
    active: false,
    heightStyle: "content",
	icons: null
  }); 
    $( "#soption-button, #spass-button, #update-discord-button" ).button()
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
<div id="navigation"><?=$nav5?></div>
<!-- ---------- -->

<div id="line2"></div>

<div id="messages">
<?php
include('error-messages.php');
?>
</div>

<div id="content">

<div id="accordion">
<!-- Soldier Options -->
<h3>Change Supply Option</h3>
<div>
<p>
<form action="updateinfo.php?so=1" method="post">
<input name="supplyoption" type="text" value="<?=$vmasupply?>" />
<br />
<br />
<input type="submit" value="Save Supply Option" id="soption-button" />
</form>
<br />
<?php
$query4 = "SELECT * FROM bs_supplyoptions";  
$result4 = mysqli_query($mysqli, $query4) or die("Query failed ($query4) - " . mysqli_error($mysqli)); 
$numrows4 = mysqli_num_rows($result4);

for($i = 0; $i < $numrows4 ; $i++) 
{ 
$row4 = mysqli_fetch_array($result4);
$number = $row4['OptionNumber'];
$food_option = $row4['Food'];
$weapon_option = $row4['Weapons'];
$gold_option = $row4['Gold'];

echo 'Option '.$number.': [<span style="color:#006600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span>] | <span style="color:#0000B2">T: '.$gold_option.'</span>]';
echo '<br />';


}
?>
</p>
</div>
</div>

<div id="accordion2">
<!-- Soldier Options -->
<h3>Change Password</h3>
<div>
<p>
<form action="updateinfo.php?pass=1" method="post">
<input name="old_password" type="password" placeholder="Current Password" />
<br />
<br />
<input name="new_password" type="password" placeholder="New Password" />
<br />
<br />
<input name="repeat_new_password" type="password" placeholder="Repeat Password" />
<br />
<br />
<input type="submit" value="Save Password" id="spass-button" />
</form>
</p>
</div>
</div>

<div id="accordion3">
<!-- Soldier Options -->
<h3>Change Discord Nickname</h3>
<div>
<p>
<form action="updateinfo.php?discord=1" method="post">
<input name="discordnick" type="text" value="<?=$vmadiscord?>" />
<br />
<br />
<input type="submit" value="Update Discord Nickname" id="update-discord-button" />
</form>
</p>
</div>
</div>

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
<?php ob_flush(); mysqli_close($mysqli);?>