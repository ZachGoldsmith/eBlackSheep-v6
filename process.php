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

include("navigations.php");

if ($vmaclearance < 4) {
header("Location: home.php?denied=1");	
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Process Soldier | eRepublik</title>

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
input, select {
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;		
}
</style>
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script>
$(function() {
  $("#accordion, #accordion2, #accordion3, #accordion4, #accordion5").accordion({
	collapsible: true,
    active: false,
    heightStyle: "content",
	icons: null
  }); 
    $( "#process-button, #back-button" ).button()
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

<div id="messages">
<?php
include('error-messages.php');
?>
</div>

<div id="content">
<?php
$appid = $_GET['id'];
$appcitizen = $_GET['citizen'];

$appsql = 'SELECT * FROM bs_applications WHERE CitizenID ='.$appid.'';
$appresult = mysqli_query($mysqli, $appsql);
$approw = mysqli_fetch_array($appresult);

$discord = $approw['DiscordNick'];
$referrer = $approw['Referrer'];
$team = $approw['Team'];

$teamsql = "SELECT * FROM bs_herds WHERE HerdName = '".$team."'";
$teamresult = mysqli_query($mysqli, $teamsql);
$teamrow = mysqli_fetch_array($teamresult);
$teamabr = $teamrow['HerdAbbr'];

$supplysql = 'SELECT * FROM bs_supplyoptions';
$supplyresult = mysqli_query($mysqli, $supplysql);
$supplyrow = mysqli_fetch_array($supplyresult);
?>
<form action="" method="post" target="_self">

Citizen ID:<br />
<input style="color:#999999" name="citizenid" type="text" value="<?=$appid?>" readonly="readonly" />
<br />
<br />
Citizen Name:<br />
<input style="color:#999999" name="citizenname" type="text" value="<?=$appcitizen?>" readonly="readonly" />
<br />
<br />
Discord Nickname:<br />
<input name="discordnick" type="text" value="<?=$discord?>" />
<br />
<br />
Clearance:<br />
<select name="clearance">
<option>1 - Soldier</option>
<option>2 - Herd Leader</option>
<option>3 - Honor Guard</option>
<option>4 - Admin</option>
<option>5 - Super Admin</option>
</select>
<br />
<br />
Team:<br />
<select name="team">
<option selected="selected"><?=$team?></option>
<?php
$tsql = "SELECT * FROM bs_herds WHERE HerdName != '".$team."' AND HerdName != 'Lost Herd' AND HerdName !='Honor Guard'";  
$tres = mysqli_query($mysqli, $tsql) or die("Query failed ($tsql) - " . mysqli_error($mysqli)); 
$tnum = mysqli_num_rows($tres);

for($i = 0; $i < $tnum ; $i++) 
{ 
$trow = mysqli_fetch_array($tres);
$tname = $trow['HerdName'];
echo '<option>'.$tname.'</option>';
}
?>
</select>
<br />
<br />
Insignia:<br />
<input name="insignia" type="text" value="E1" />
<br />
<br />
Commune:<br />
<input name="commune" type="text" value="N/A" />
<br />
<br />
Referrer:<br />
<input style="color:#999999" name="referrer" type="text" value="<?=$referrer?>" readonly="readonly" />
<br />
<br />
<table width="20%" border="0" align="center" style="margin:0 auto;">
  <tr>
    <td align="right"><input onclick="location.href='applications.php'" id="back-button" type="button" value="Back to Applications" /></a></td>
    <td align="left" style="padding-right:3px;"><input id="process-button" type="submit" value="Process Soldier" /></td>
  </tr>
</table>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

$citizenid = $_POST['citizenid'];
$citizenname = $_POST['citizenname'];
$citizendiscord = $_POST['discord'];
$citizenclearance = $_POST['clearance'][0];
$citizenteam = $_POST['team'];
$citizeninsignia = $_POST['insignia'];
$citizencommune = $_POST['commune'];
$citizenreferrer = $_POST['referrer'];

$teamsql = "SELECT * FROM bs_herds WHERE HerdName='".$citizenteam."'";
$teamres = mysqli_query($mysqli, $teamsql);
$teamrow = mysqli_fetch_array($teamres);
$citizenteam = $teamrow['HerdAbbr'];


$lookup = "SELECT * FROM bs_applications WHERE CitizenID = '".$citizenid."'";
$return = mysqli_query($mysqli, $lookup);
$info = mysqli_fetch_array($return);
$citizenso = $info['Option'];
$citizenpw = $info['Password'];
$citizenjoin = $info['ApplyDate'];
$onlinestatus = "images/user-offline.png";

$date = date("Y-m-d");
$time = date("h:i:sa T");

$addsoldiersql = "INSERT INTO bs_accounts (CitizenID, CitizenName, DiscordNick, Clearance, Insignia, Team, OriginalTeam, Commune, SupplyOption, Password, OnlineStatus, `Join`, Referrer) VALUES ('$citizenid','$citizenname','$citizendiscord','$citizenclearance','$citizeninsignia','$citizenteam','$citizenteam','$citizencommune','$citizenso','$citizenpw','$onlinestatus','$citizenjoin','$citizenreferrer')";  
$soldierresult = mysqli_query($mysqli, $addsoldiersql) or die("Query failed ($addsoldiersql) - " . mysqli_error($mysqli));

$delappsql = "DELETE FROM bs_applications WHERE CitizenID='$citizenid'";  
$delappres = mysqli_query($mysqli, $delappsql) or die("Query failed ($delappsql) - " . mysqli_error($mysqli));

$processed = $vmaname." has added ".$citizenname." to the roster.";
$applog="INSERT INTO bs_logs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$vmaname', '$processed')";
$applogres=mysqli_query($mysqli, $applog);  

header("Location: applications.php?processed=1&name=".$citizenname."");

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
<? ob_flush(); mysqli_close($mysqli);?>