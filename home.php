<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$vmadiscord = $row1['DiscordNick'];
$vmaclearance = $row1['Clearance'];
$vmainsignia = $row1['Insignia'];	
$vmapic = $row1['Avatar'];
$vmaherd = $row2['HerdName'];
$vmafood = $row3['Food'];
$vmaweapons = $row3['Weapons'];
$vmagold = $row3['Gold'];
$vmadivision = $row1['Division'];
$vmastrength = number_format($row1['Strength']);
$vmamilrank = $row1['Rank'];
$vmaranklevel = $row1['RankLevel'];
$vmarankpoints = $row1['RankPoints'];
$vmatopdmg = $row1['TopDamage'];
$vmatopdmgdate = $row1['TopDamageDate'];
$vmacitizen = $row1['Citizenship'];
$vmastate = $row1['State'];
$vmacountry = $row1['Country'];
$vmabirthday = $row1['Birthday'];
$vmalevel = $row1['Level'];
$vmaxp = $row1['XP'];
$vmanatrank = $row1['NationalRank'];

$vma1 = $row1['FreedomFighter'];
$vma2 = $row1['HardWorker'];
$vma3 = $row1['Congressman'];
$vma4 = $row1['President'];
$vma5 = $row1['MediaMogul'];
$vma6 = $row1['BattleHero'];
$vma7 = $row1['CampaignHero'];
$vma8 = $row1['ResistanceHero'];
$vma9 = $row1['SuperSoldier'];
$vma10 = $row1['SocietyBuilder'];
$vma11 = $row1['Mercenary'];
$vma12 = $row1['TopFighter'];
$vma13 = $row1['TruePatriot'];

include("navigations.php");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Soldier Homepage | eRepublik</title>

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
#cdo-title {
	padding-top:5px;	
	width:370px;
	height:20px;
	font-family:Impact;
	font-size:12px;
	background-color:#333333;	
	margin: 0 auto;
	text-align:center;
	color:#EDEDED;
	margin-top:10px;
}
#cdo {
	width:368px;
	height:auto;
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px;
	background-color:#EDEDED;	
	margin: 0 auto;
	text-align:center;
	color:#333333;
	border:#DDDDDD 1px solid;
	padding-top:5px;
	padding-bottom:5px;		
}
#cdo-content {
	color:#333333;
}
#citinfo {
	margin: 0 auto;
	font-family:"Berlin Sans FB", BerlinSans;
	font-size:12px; 	
	color:#333333;
	margin-top:10px;
}
#footer {
	font-size:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	color:#666666;
	margin:0 auto;
	height:25px;
	margin-top:10px;
}
#accordion {
	margin-top:10px;	
}
#impactfont {
	font-family:Impact;
	font-size:12px	
}
a.current {
 text-decoration:underline;
 color:#666666;	
}
#messages {
	text-align:center;
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;	
	margin-top:10px;
}
#news {
	float:none;	
	clear:both;
	position:absolute;
}
#news-handle
{
	font-family:Impact;
	border:#000000 1px solid;
	background-color:#333333;	
	color:#EDEDED;
	cursor:move;
	font-size:12px;	
}
</style>
<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>
<script>
$(function() {
  $("#accordion").accordion({
	collapsible: true,
    active: false,
    heightStyle: "content",
	icons: null
  });
$( "#news" ).draggable({ handle: "#news-handle" });  
});

/* $(function(){
  $('a').each(function() {
    if ($(this).prop('href') == window.location.href) {
      $(this).addClass('current');
    }
  });
}); */

</script>
</head>

<body>
<div id="news" align="center">
<div id="news-handle">
BLACK SHEEP NEWS
</div>
<div id="news-content">

<iframe id="NewsWindow" seamless src="news_win.php" height="204" marginwidth="0" marginheight="0" frameborder="0" scrolling="no" style="display: block; margin: 0 auto; padding: 0; border: #000000 1px solid;"></iframe>

</div>
</div>

<div class="main">

<!-- Top Bar -->
<div>
<table width="800" border="0">
  <tr>
    <td align="left"><img src="images/logos/sidelogo-NEW.png" width="159" height="61" /></td>
    <td align="right" id="topinfo">
    Current eDay: <?=$eday?>
    <br />
	Welcome, <?=SoldierInfo($mysqli, $vmaid)[1]?>!
    <br />
	You are in <?=SoldierInfo($mysqli, $vmaid)[2]?>
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

<!-- Current Daily Order -->
<div id="messages">
<?php
include('error-messages.php');
?>
</div>

<div id="cdo-title">CURRENT DAILY ORDER</div>
<div id="cdo">
<?php
$sql5 = "SELECT * FROM bs_dailyorder";
$result5 = mysqli_query($mysqli, $sql5);
mysqli_data_seek($result5, mysqli_num_rows($result5) - 1);
$row5 = mysqli_fetch_array($result5);

$do_region = $row5['Region'];
$do_country = $row5['Country'];
$do_id = $row5['ID'];

echo "<a href='http://www.erepublik.com/en/military/battlefield/" . $do_id . "' target='_blank' id='cdo-content'>Fight for: ".$do_country." | Region: ".$do_region."</a>";
?>
</div>
<!-- ------------------- -->

<!-- Citizen Information -->
<table width="100%" border="0" id="citinfo">
  <tr>
    <td width="178" height="122" align="center"><img src="<?=$vmapic?>" width="120" height="120" style="border:#000000 1px solid" /></td>
    <td width="206">
	Citizen Name: <?=SoldierInfo($mysqli, $vmaid)[1]?>
    <br />
    Discord Nickname: <?=SoldierInfo($mysqli, $vmaid)[3]?>
    <br />
    Clearance: <?=$vmaclearance?>
    <br />
    Insignia: <?=$vmainsignia?>
    <br />
    <br />
    Supply Option: <?=$vmasupply?>
    <br />
	[<span style="color:#006600">Food: <?=$vmafood?></span> | <span style="color:#B20000">Tanks:  <?=$vmaweapons?></span> | <span style="color:#0000B2">Gold: <?=$vmagold?></span>] 
    </td>
    <td width="212">
    Division: <?=$vmadivision?>
    <br />
	Strength: <?=$vmastrength?>
    <br />
	Military Rank: <?=$vmamilrank?> (<?=$vmaranklevel?>)
    <br />
	Rank Points: <?=$vmarankpoints?>
    <br />
	National Rank: <?=$vmanatrank?>
    <br />
	Top Damage: <?=$vmatopdmg?>
    <br />
	(Achieved on: <?=$vmatopdmgdate?> )
    </td>
    <td width="186">
    Birthday: <?=$vmabirthday?>
    <br />
	Level: <?=$vmalevel?>
    <br />
	Experience: <?=$vmaxp?>
	<br />
	Citizenship: <?=$vmacitizen?>
    <br />
	Current Location: <?=$vmastate?>, <?=$vmacountry?>
    </td>
  </tr>
</table>
<!-- ------------------- -->

<div id="accordion">
  <h3 align="center" id="impactfont">MY MEDALS</h3>
  <div align="center">
    <p>
    <table width="80%" border="0" cellspacing="0">
  <tr>
    <td><img src="images/medals/freedom_fighter.png" width="51" height="71" alt="freedom_fighter" title="Freedom Fighter"/></td>
    <td><img src="images/medals/hard_worker.png" width="51" height="71" alt="hard_worker" title="Hard Worker"/></td>
    <td><img src="images/medals/congressman.png" width="51" height="71" alt="congressman" title="Congressman" /></td>
    <td><img src="images/medals/president.png" width="51" height="71" alt="president" title="President" /></td>
    <td><img src="images/medals/media_mogul.png" width="51" height="71" alt="media_mogul" title="Media Mogul" /></td>
    <td><img src="images/medals/battle_hero.png" width="51" height="71" alt="battle_hero" title="Battle Hero" /></td>
    <td><img src="images/medals/campaign_hero.png" width="51" height="71" alt="campaign_hero" title="Campaign Hero" /></td>
    <td><img src="images/medals/resistance_hero.png" width="51" height="71" alt="resistance_hero" title="Resistance Hero" /></td>
    <td><img src="images/medals/super_soldier.png" width="51" height="71" alt="super_soldier" title="Super Soldier" /></td>
    <td><img src="images/medals/society_builder.png" width="51" height="71" alt="society_builder" title="Society Builder" /></td>
    <td><img src="images/medals/mercenary.png" width="51" height="71" alt="mercenary" title="Mercenary" /></td>
    <td><img src="images/medals/top_fighter.png" width="51" height="71" alt="top_fighter" title="Top Fighter" /></td>
    <td><img src="images/medals/true_patriot.png" width="51" height="71" alt="true_patriot" title="True Patriot" /></td>
  </tr>
  <tr>
    <td align="center"><?=$vma1?></td>
    <td align="center"><?=$vma2?></td>
    <td align="center"><?=$vma3?></td>
    <td align="center"><?=$vma4?></td>
    <td align="center"><?=$vma5?></td>
    <td align="center"><?=$vma6?></td>
    <td align="center"><?=$vma7?></td>
    <td align="center"><?=$vma8?></td>
    <td align="center"><?=$vma9?></td>
    <td align="center"><?=$vma10?></td>
    <td align="center"><?=$vma11?></td>
    <td align="center"><?=$vma12?></td>
    <td align="center"><?=$vma13?></td>
  </tr>
</table>
    </p>
  </div>
  
  <h3 align="center" id="impactfont">MY HERD</h3>
  <div>
    <p>
	<?php include('myherd.php'); ?>
    </p>
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