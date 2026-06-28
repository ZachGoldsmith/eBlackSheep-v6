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
$vmaherd = $row2['HerdName'];

include("navigations.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Statistics | eRepublik</title>

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
#topfighter, #strength, #rank, #otherherds {
	padding-top:5px;
	width:300px;
	height:20px;
	background-color:#333333;
	color:#CCCCCC;
	font-family:Impact;
	margin:0 auto;
}
#tfcontent, #strcontent, #rankcontent, #herdcontent {
	width:270px;
	height:auto;
	margin:0 auto;
	margin-top:5px;
	margin-bottom:5px;	
}
#strname, #rankname, #herdname {
	font-size:14px;
	font-family:"Berlin Sans FB", BerlinSans;	
}
#tfname {
	font-size:20px;
	font-family:"Berlin Sans FB", BerlinSans;
}
#tfname #tfdamage, #strname #str, #rankname #ra {
	font-size:12px;
	font-family:"Berlin Sans FB", BerlinSans;
	margin-right:5px;
	margin-top:-3px;
}
#footer {
	font-size:10px;
	font-family:"Berlin Sans FB", BerlinSans;
	color:#666666;
	margin:0 auto;
	height:25px;
	margin-top:10px;
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

<div id="topfighter">TOP FIGHTER</div>
<div id="tfcontent" align="center">
<?php include('statslookup.php'); ?>
<table width="80%" border="0">
  <tr>
    <td align="center"><img src="<?=$tfavatar?>" width="50" height="50" style="border:#000000 1px solid" /></td>
    <td align="right" id="tfname">
	<?=$tfname?>
    <br />
    <div id="tfdamage"><?=$tfdamage?><br />
	<span style="font-size:10px;">(Achieved on: <?=$tfdmgdate?>)</span></div>
    </td>
  </tr> 
</table>
</div>

<div id="strength">STRENGTH</div>
<div id="strcontent" align="center">
<table width="100%" border="0">
  <tr>
    <td style="font-family:Impact;">HIGHEST</td>
    <td width="86">&nbsp;</td>
    <td style="font-family:Impact;">LOWEST</td>
  </tr>
  <tr>
  <td width="41"><img src="<?=$hstravatar?>" width="20" height="20" style="border:#000000 1px solid; margin-top:2px;" /></td>
    <td align="left" id="strname">
	<?=$highstrname?>
    <br />
    <div align="left" id="str"><?=$highstr?></div>    
    </td>
    <td width="39"><img src="<?=$lstravatar?>" width="20" height="20" style="border:#000000 1px solid; margin-top:2px;" /></td>
    <td width="86" align="left" id="strname">
	<?=$lowstrname?>
    <br />
    <div align="left" id="str"><?=$lowstr?></div>
    </td>
  </tr>
</table>
</div>

<div id="rank">RANK</div>
<div id="rankcontent" align="center">
<table width="100%" border="0">
  <tr>
    <td style="font-family:Impact;">HIGHEST</td>
    <td width="86">&nbsp;</td>
    <td style="font-family:Impact;">LOWEST</td>
  </tr>
  <tr>
  <td width="41"><img src="<?=$hrankavatar?>" width="20" height="20" style="border:#000000 1px solid; margin-top:2px;" /></td>
    <td align="left" id="rankname">
	<?=$highrankname?>
    <br />
    <div align="left" id="ra"><?=$highrank?></div>    
    </td>
    <td width="39"><img src="<?=$lrankavatar?>" width="20" height="20" style="border:#000000 1px solid; margin-top:2px;" /></td>
    <td width="86" align="left" id="rankname">
	<?=$lowrankname?>
    <br />
    <div align="left" id="ra"><?=$lowrank?></div>
    </td>
  </tr>
</table>
</div>

<div id="otherherds">INDIVIDUAL HERD STATISTICS</div>
<div id="herdcontent" align="center">
    
    *Under Construction*
    
<?php


/* Individual Herd Statistics

$sql5 = "SELECT * FROM bs_herds";
$result5 = mysqli_query($mysqli, $sql5);

$numrows5 = mysqli_num_rows($result5);

echo '<table width="75%" border="0" align="center">';
echo '<tr>';

$col = 2;
for($i = 0; $i < $numrows5 ; $i++) 
{ 
$row5 = mysqli_fetch_array($result5);

$herdname = $row5['HerdName'];
$herdlink = 'herdstats.php?herd='.$herdname;

if($i % $col == 0) {
echo '</tr><tr>';	
}
echo '<td align="center"><a href="'.$herdlink.'" target="_blank">'.$herdname.'</a></td>';  
}
echo '</tr>'; 
echo '</table>';

*/


?>
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