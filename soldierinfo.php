<?php
error_reporting(0);
session_start();
$vmaid = $_SESSION['vmabsmu'];
$soldierid = $_GET['id'];

if(!isset($vmaid)) {
header("Location: index.php");
exit;
}

elseif(isset($vmaid)) {
include('connection.php');
include('functions.php');

if(isset($soldierid)) {
include('slookup.php');	
}

$userclearance = $row10['Clearance'];

$version = $row6['Version'];
$vmaname = $row['CitizenName'];
$vmadiscord = $row['DiscordNick'];
$vmaclearance = $row['Clearance'];
$vmainsignia = $row['Insignia'];	
$vmapic = $row['Avatar'];
$vmaherd = $row2['HerdName'];
$vmafood = $row3['Food'];
$vmaweapons = $row3['Weapons'];
$vmagold = $row3['Gold'];
$vmadivision = $row['Division'];
$vmastrength = $row['Strength'];
$vmamilrank = $row['Rank'];
$vmaranklevel = $row['RankLevel'];
$vmarankpoints = $row['RankPoints'];
$vmatopdmg = $row['TopDamage'];
$vmatopdmgdate = $row['TopDamageDate'];
$vmacitizen = $row['Citizenship'];
$vmastate = $row['State'];
$vmacountry = $row['Country'];
$vmabirthday = $row['Birthday'];
$vmalevel = $row['Level'];
$vmaxp = $row['XP'];
$vmanatrank = $row['NationalRank'];

$vma1 = $row['FreedomFighter'];
$vma2 = $row['HardWorker'];
$vma3 = $row['Congressman'];
$vma4 = $row['President'];
$vma5 = $row['MediaMogul'];
$vma6 = $row['BattleHero'];
$vma7 = $row['CampaignHero'];
$vma8 = $row['ResistanceHero'];
$vma9 = $row['SuperSoldier'];
$vma10 = $row['SocietyBuilder'];
$vma11 = $row['Mercenary'];
$vma12 = $row['TopFighter'];
$vma13 = $row['TruePatriot'];

include("navigations.php");

if ($userclearance >= 3) {
$edit_nav = '<a href="soldierinfo.php?id='.$soldierid.'">Soldier Information</a>  |  <a href="editsoldier.php?id='.$soldierid.'" target="_self">Edit Soldier</a> |  <a href="srequest.php?id='.$soldierid.'" target="_self">Request Supplies for Soldier</a>';
}
else {
$edit_nav = $vmaname.'\'s Soldier Information';	
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Soldier Information Panel | eRepublik</title>

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
	font-family:"Berlin Sans FB", BerlinSans;
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
#impactfont {
	font-family:Impact;
	font-size:12px	
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
	Currently Viewing: <?=$vmaname?>
    <br />
	<?=$vmaname?> is in <?=$vmaherd?>
    <br />
    <a href="javascript:window.close();">Close Window</a>
    </td>
  </tr>
</table>
</div>
<!-- ------ -->
<div id="line1"></div>

<!-- Navigation -->
<div id="navigation"><?=$edit_nav?></div>
<!-- ---------- -->

<div id="line2"></div>

<!-- Current Daily Order -->
<div id="messages">
<?php
include('error-messages.php');
?>
</div>

<!-- Citizen Information -->
<table width="100%" border="0" id="citinfo">
  <tr>
    <td width="178" height="122" align="center"><img src="<?=$vmapic?>" width="120" height="120" style="border:#000000 1px solid" /></td>
    <td width="206">
	Citizen Name: <?=$vmaname?>
    <br />
    Discord Nickname: <?=$vmadiscord?>
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

  <h3 align="center" id="impactfont"><?=strtoupper($vmaname)?>'S MEDALS</h3>
  <div align="center" style="font-size:12px;">
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
  
<!-- Footer -->
<div id="footer" align="center">
<div id="line2"></div>
<table width="800px" border="0" style="margin: 0 auto;" align="center">
  <tr>
    <td align="left" style="color:#B20000;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;"><a href="#" style="color:#B20000;">DISCHARGE SOLDIER [UNDER CONSTRUCTION]</a></td>
    <td align="right" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Version: <?=$version?> | <a href="mailto:zachgoldsmith@outlook.com" style="color:#666666;font-family:BerlinSans,'Berlin Sans FB';font-size:10px;">Contact Webmaster</a> | <?APILastUpdate()?></td>
  </tr>
</table>
<div id="line1"></div>
</div>
<!-- ------ -->

</div>
</body>
</html>
<?php mysqli_close($mysqli); ?>