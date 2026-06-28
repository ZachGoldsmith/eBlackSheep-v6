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
<title>VMA-214 | BlackSheep Military Unit | Applications | eRepublik</title>

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

<div id="messages">
<?
include('error-messages.php');
?>
</div>

<?php
$query9 = "SELECT * FROM bs_applications ORDER BY ApplyDate ASC";  
$result9 = mysqli_query($mysqli, $query9) or die("Query failed ($query9) - " . mysqli_error($mysqli)); 
$numrows9 = mysqli_num_rows($result9);

if ($numrows9 == 0) {
echo "<br /><div align='center'>No New Applications Found</div>"; 
}

else{ 
echo "<font face='Verdana' size='1'>";
echo "<table border='0' align='center'>
<tr>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:xx-small;'>PROFILE</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:xx-small;'>CITIZEN NAME</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:xx-small;'>DISCORD NAME</div></th>
<th><span class='pagehead3' style='font-size:xx-small;'>TEAM</span></th>
<th><span class='pagehead3' style='font-size:xx-small;'>CITIZEN ID</span></th>
<th><span class='pagehead3' style='font-size:xx-small;'>DATE</span></th>
<th><span class='pagehead3' style='font-size:xx-small;'>IP</span></th>
<th><span class='pagehead3' style='font-size:xx-small;'>PROCESS</span></th>
<th><span class='pagehead3' style='font-size:xx-small;'>REMOVE</span></th>
</tr>";

for($i = 0; $i < $numrows9 ; $i++) 
{ 
$row9 = mysqli_fetch_array($result9);
//set table variables
$app_citizen = $row9['CitizenName'];
$app_id = $row9['CitizenID'];
$discord = $row9['DiscordNick'];
$app_referrer = $row9['Referrer'];
$app_team = $row9['Team'];
$app_date = $row9['ApplyDate'];
$app_IP = $row9['IP'];

if (empty($app_IP)) {
    $app_IP = 'Not Stored';
}
if (empty($app_team)) {
    $app_team = 'Not Stored';
}



$profilebutton = '<a href="http://www.erepublik.com/en/citizen/profile/'.$app_id.'" target="_blank"><img src="images/usericon.png" width="15" height="15" alt="profile" /></a>';
$processaction = 'process.php?id='.$app_id.'&citizen='.$app_citizen.'';
$removeaction = 'remove.php?id='.$app_id.'';

if($i % 2)
{
$RowColor="bgcolor=''";
}
else
{
$RowColor="bgcolor='#DDDDDD'";
}

//inserts the data in rows, creating one row for every record found
  echo "<tr ".$RowColor.">";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $profilebutton . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:100px; font-weight:normal; padding-top:4px; padding-bottom:5px;' name='citname'>" . $app_citizen . "</td>";
  echo "<td align='left' style='padding-left:5px; padding-right:100px; font-weight:normal; padding-top:4px; padding-bottom:5px;' name='citname'>" . $discord . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $app_team . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $app_id . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $app_date . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $app_IP . "</td>";
echo "<td span class='pagehead2' align='center'>";
?>
<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 820;
 var height = 525;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'Edit Soldier', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>

<a href="<?=$processaction?>" target="_self" style="cursor:pointer;"><img src="images/notebook--pencil.png" width="16" height="16" /></a>
          <?php
echo "</td>";
echo "<td span class='pagehead2' align='center'>";
?>

<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 820;
 var height = 525;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'Edit Soldier', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>

<a href="<?=$removeaction?>" target="_self" style="cursor:pointer;"><img src="images/notebook--minus.png" width="16" height="16" /></a>
<?php  
echo "</td>";           
}
echo "</table>";
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