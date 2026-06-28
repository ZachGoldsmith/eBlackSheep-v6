<?php
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
$vmaherd = mysqli_real_escape_string($mysqli, $row2['HerdName']);
$vmafood = $row3['Food'];
$vmaweapons = $row3['Weapons'];
$vmagold = $row3['Gold'];
$vmadivision = $row['Division'];
$vmastrength = number_format($row['Strength']);
$vmamilrank = $row['Rank'];
$vmaranklevel = $row['RankLevel'];
$vmarankpoints = number_format($row['RankPoints']);
$vmatopdmg = number_format($row['TopDamage']);
$vmatopdmgdate = $row['TopDamageDate'];
$vmacitizen = $row['Citizenship'];
$vmastate = $row['State'];
$vmacountry = $row['Country'];
$vmabirthday = $row['Birthday'];
$vmalevel = $row['Level'];
$vmaxp = number_format($row['XP']);
$vmanatrank = $row['NationalRank'];
$vmacommune = $row['Commune'];
$doubled = ($row['DoubleSupplies'] == "doubled" ? "checked" : "");

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
header("Location: soldierinfo.php?id=".$soldierid);
$edit_nav = $vmaname.'\'s Soldier Information';	
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VMA-214 | BlackSheep Military Unit | Edit Soldier | eRepublik</title>

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
<div align="center" style="font-size:12px;">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$updated_clearance = mysqli_real_escape_string($mysqli, $_POST['clearance']);
	
	if($updated_clearance == '') {
		$updated_clearance = $vmaclearance;
	}	
	elseif($updated_clearance == '1 - Soldier') {
		$updated_clearance = '1';
	}
	elseif($updated_clearance == '2 - Herd Leader') {
		$updated_clearance = '2';
	}
	elseif($updated_clearance == '3 - Honor Guard') {
		$updated_clearance = '3';
	}
	elseif($updated_clearance == '4 - Admin') {
		$updated_clearance = '4';
	}
	elseif($updated_clearance == '5 - Super Admin') {
		$updated_clearance = '5';
	}				
	$updated_team = mysqli_real_escape_string($mysqli, $_POST['herd']);
	
	$getherd = 'SELECT * FROM bs_herds WHERE HerdName="'.$updated_team.'"';
	$getherdresult = mysqli_query($mysqli, $getherd);
	$herdrow = mysqli_fetch_array($getherdresult);
	$updated_team = $herdrow['HerdAbbr'];
										
	$updated_insignia = mysqli_real_escape_string($mysqli, $_POST['insignia']);
	$updated_supplyoptions = mysqli_real_escape_string($mysqli, $_POST['supplyoption']);
    if(isset($_POST['doubled']) && 
       $_POST['doubled'] == 'doubled') 
    {
        $doubled = mysqli_real_escape_string($mysqli, $_POST['doubled']);
    }
    else
    {
        $doubled = "No";
    }     

	$commune = mysqli_real_escape_string($mysqli, $_POST['commune']);	
	$discord = mysqli_real_escape_string($mysqli, $_POST['discordnick']);	
	$citname = mysqli_real_escape_string($mysqli, $_POST['citname']);				
	
	$sql3="UPDATE bs_accounts SET Clearance='$updated_clearance', Team='$updated_team', Commune='$commune', Insignia='$updated_insignia', SupplyOption='$updated_supplyoptions', DoubleSupplies='$doubled', DiscordNick='$discord', CitizenName='$citname' WHERE CitizenID='$soldierid'";
    $result3=mysqli_query($mysqli, $sql3);
	header("Location: editsoldier.php?id=".$soldierid."&saved=1");		
}
?>
<br />
<form action="" method="post" target="_self">
<table width="50%" border="0">
              <tr>
                <td width="65%">Citizen ID:<br />
                  <input style="color:#999999" name="citid" type="number" readonly="readonly" value="<?=$_GET['id'];?>"/></td>
                <td width="35%">Citizen Name:<br />
                  <input name="citname" type="text" value="<?=$vmaname?>" /></td>
              </tr>
              <tr>
                <td>Herd:<br />
                  <select name="herd">
                    <option selected="selected">
                    <?=$vmaherd?>
                    </option>
                    <?php
$query30 = "SELECT * FROM bs_herds WHERE HerdName != '".$vmaherd."' AND HerdName != 'Lost Herd'";  
$result30 = mysqli_query($mysqli, $query30) or die("Query failed ($query30) - " . mysqli_error($mysqli)); 
$numrows30 = mysqli_num_rows($result30);

for($i30 = 0; $i30 < $numrows30 ; $i30++) 
{ 
$row30 = mysqli_fetch_array($result30);
$herd = $row30['HerdName'];

echo '<option>'.$herd.'</option>';

}
?>
                  </select>
                  </td>
                <td>Discord Nickname:<br />
                  <input name="discordnick" type="text" value="<?=$vmadiscord?>" /></td>
              </tr>
              <tr>
                <td>Clearance:<br />
                  <select name="clearance">
                    <option selected="selected" disabled="disabled"><?=$vmaclearance?></option>
                    <option>1 - Soldier</option>
                    <option>2 - Herd Leader</option>
                    <option>3 - Honor Guard</option>
                    <option>4 - Admin</option>
                    <option>5 - Super Admin</option>
                  </select></td>
                <td>Commune:<br />
                  <input name="commune" type="text" value="<?=$vmacommune?>" /></td>
              </tr>
              <tr>
                <td>Supply Option:<br />
                  <input name="supplyoption" type="number" value="<?=$vmasupply?>" /></td>
                <td>Insignia:<br />
                  <input name="insignia" type="text"  value="<?=$vmainsignia?>"/></td>
                <td>Double supplies: <input name="doubled" type="checkbox" value="doubled" <?=$doubled?> /></td>                  
              </tr>
              <table border="0">
              <tr>
                <td><?php
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

echo 'Supply Option '.$number.': [<span style="color:#1A6600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span> | <span style="color:#00008D">G: '.$gold_option.'</span>]';
echo '<br />';


}
?></td>
              </tr>
            </table>
            </table>
            <br />
<input type="submit" value="Save" id="save-button" />
</form>
</div>
  
<!-- Footer -->
<div id="footer" align="center">
<div id="line2"></div>
<table width="800px" border="0" style="margin: 0 auto;" align="center">
  <tr>
    <td align="left" style="color:#000000;font-family:BerlinSans,'Berlin Sans FB';font-size:12px;"></td>
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