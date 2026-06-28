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
<title>VMA-214 | BlackSheep Military Unit | Admin Panel | eRepublik</title>

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
  $("#accordion, #accordion2, #accordion3, #accordion4, #accordion5").accordion({
	collapsible: true,
    active: false,
    heightStyle: "content",
	icons: null
  }); 
    $( "#addsoldier-button, #removesoldier-button, #changesoldierpw-button, #search-button, #add-option-button, #remove-option-button, #change-option-button, #create-herd-button, #remove-herd-button, #change-herd-lead-button, #rename-herd-button" ).button()
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
<div id="navigation"><?=$nav3?></div>
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
<h3>Soldier Options</h3>
<div>
<p>

<div id="accordion2">
<!-- Add Soldier -->
<h3>Add Soldier</h3>
<div>
<p align="center">
<span style="color:#B20000;">Note: Citizen Password is set to 'vma214' automatically. Don't forget to tell the soldier!</span>
<form action="addsoldier.php" method="post">
            <table width="65%" border="0" align="center">
              <tr>
                <td width="65%">Citizen ID:<br />
                  <input name="citid" type="number" autofocus="autofocus" /></td>
                <td width="35%">Citizen Name:<br />
                  <input name="citname" type="text" /></td>
              </tr>
              <tr>
                <td>Herd:<br />
                  <select name="herd">
                    <option selected="selected" disabled="disabled">&nbsp;</option>
                    <?php
$query3 = "SELECT * FROM bs_herds";  
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
                  </td>
                <td>Discord Nickname:<br />
                  <input name="discord" type="text" /></td>
              </tr>
              <tr>
                <td>Clearance:<br />
                  <select name="clearance">
                    <option selected="selected">1 - Soldier</option>
                    <option>2 - Herd Leader</option>
                    <option>3 - Honor Guard</option>
                    <option>4 - Admin</option>
                    <option>5 - Super Admin</option>
                  </select></td>
                <td>Commune:<br />
                  <input name="commune" type="text" /></td>
              </tr>
              <tr>
                <td>Supply Option:<br />
                  <input name="supplyoption" type="number" /></td>
                <td>Insignia:<br />
                  <select name="insignia">
                    <option selected="selected">E1 - Soldier</option>
                    <option>O1 - Officer Rank 1</option>
                    <option>02 - Officer Rank 2</option>
                    <option>03 - Officer Rank 3</option>
                  </select></td>
              </tr>
            </table>
            <table width="65%" border="0" align="center">
              <tr>
                <td width="65%">
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

echo 'Supply Option '.$number.': [<span style="color:#1A6600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span>] | <span style="color:#0000B2">G: '.$gold_option.'</span>]';
echo '<br />';


}
?></td>
                <td width="35%"><input type="submit" value="Add Soldier" id="addsoldier-button" /></td>
              </tr>
            </table>
          </form>
</p>
</div>

<!-- Discharge Soldier -->
<h3>Discharge Soldier</h3>
<div>
<p>
<form action="removesoldier.php" method="post">
    Citizen ID:<br />
<input name="citid" type="number" autofocus="autofocus" />
	<br />
    <br />
    Citizen Name:<br />
<input name="citname" type="text">
    <br />
	<br />
	<input type="submit" id="removesoldier-button" value="Remove Soldier" />
    </form>
</p>
</div>

<!-- Change Soldier PW -->
<h3>Change Soldier Credentials</h3>
<div>
<p>
<form action="changesoldierpw.php" method="post">
    Citizen ID:<br />
<input name="citid" type="number" autocomplete="off" autofocus="autofocus" />
	<br />
    <br />
    New Password:<br />
<input name="citpw" type="password" autocomplete="off">
    <br />
	<br />
	<input type="submit" id="changesoldierpw-button" value="Change Soldier's Password" />
    </form>
</p>
</div>

<!-- Search for Soldier -->
<h3>Soldier Search</h3>
<div>
<p>
<form action="" method="post">
    Citizen Name / ID:<br />
<input name="citsearch" type="text" autocomplete="off" autofocus="autofocus" />
	<br />
	<br />
	<input type="submit" id="search-button" value="Search Soldier" />
    </form>
    <br />
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$search = mysqli_real_escape_string($mysqli, $_POST['citsearch']);

$sql2 = "SELECT * FROM bs_accounts WHERE CitizenName LIKE '%$search%' || CitizenID LIKE '%$search%'";
$result2 = mysqli_query($mysqli, $sql2);
$numrows2 = mysqli_num_rows($result2);

if ($numrows2 == 0) {
echo "<div style='padding-bottom:5px;'><strong>No Soldiers Found!</strong></div>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:xx-small;'>ID</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:xx-small;'>Name</div></th>
<th style='font-size:xx-small;'>Herd</th>
</tr>";

for($i = 0; $i < $numrows2 ; $i++) 
{ 
$row2 = mysqli_fetch_array($result2);
//set table variables
$citname = $row2['CitizenName'];
$citid = $row2['CitizenID'];
$herd = $row2['Team'];

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
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $citid . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:100px; font-weight:normal; padding-top:4px; padding-bottom:5px;' name='citname'><a href='soldierinfo.php?id=".$citid."' target='_blank'>" . $citname . "</a></td>";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $herd . "</td>";  
  echo "</tr>";
}
echo "</table>";
}
}
?>	
</p>
</div>
</div>

</p>
</div>

<!-- Supply Options -->
<h3>Supply Options</h3>
<div>
<p>

<div id="accordion2">
<!-- Add Supply Option -->
<h3>Add Supply Option</h3>
<div>
<p>
<form action="addoption.php" method="post">
Food Amount<br />
<input name="food_option" type="number" />
    <br />
	<br />
Weapon Amount<br />
<input name="weapon_option" type="number" />
    <br />
	<br /> 
Gold Amount<br />
<input name="gold_option" type="number" step="any" />
    <br />
	<br />           
	<input type="submit" id="add-option-button" value="Add Supply Option" />
    </form>
        <br />
	Current Options:<br />
<?php
$query8 = "SELECT * FROM bs_supplyoptions";  
$result8 = mysqli_query($mysqli, $query8) or die("Query failed ($query8) - " . mysqli_error($mysqli)); 
$numrows8 = mysqli_num_rows($result8);

for($i = 0; $i < $numrows8 ; $i++) 
{ 
$row8 = mysqli_fetch_array($result8);
$number = $row8['OptionNumber'];
$food_option = $row8['Food'];
$weapon_option = $row8['Weapons'];
$gold_option = $row8['Gold'];

echo 'Option '.$number.': [<span style="color:#1A6600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span>] | <span style="color:#0000B2">G: '.$gold_option.'</span>]';
echo '<br />';


}
?>
</p>
</div>

<!-- Remove Supply Option -->
<h3>Remove Supply Option</h3>
<div>
<p>
<form action="removeoption.php" method="post">
Option Number<br />
<input name="option" type="number" />
    <br />
	<br />    
	<input type="submit" id="remove-option-button" value="Remove Supply Option" />
    </form>
        <br />
	Current Options:<br />
<?php
$query8 = "SELECT * FROM bs_supplyoptions";  
$result8 = mysqli_query($mysqli, $query8) or die("Query failed ($query8) - " . mysqli_error($mysqli)); 
$numrows8 = mysqli_num_rows($result8);

for($i = 0; $i < $numrows8 ; $i++) 
{ 
$row8 = mysqli_fetch_array($result8);
$number = $row8['OptionNumber'];
$food_option = $row8['Food'];
$weapon_option = $row8['Weapons'];
$gold_option = $row8['Gold'];

echo 'Option '.$number.': [<span style="color:#1A6600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span>] | <span style="color:#0000B2">G: '.$gold_option.'</span>]';
echo '<br />';


}
?>
</p>
</div>

<!-- Change Supply Option -->
<h3>Change Supply Option</h3>
<div>
<p>
<form action="changeoption.php" method="post">
Option Number<br />
<input name="option" type="number" />
    <br />
	<br />   
New Food Amount<br />
<input name="new_food" type="number" />
    <br />
	<br />  
New Weapon Amount<br />
<input name="new_weapon" type="number" />
    <br />
	<br />   
New Gold Amount<br />
<input name="new_gold" type="number" step="any" />
    <br />
	<br />             
	<input type="submit" id="change-option-button" value="Change Supply Option" />
    </form>
        <br />
	Current Options:<br />
<?php
$query8 = "SELECT * FROM bs_supplyoptions";  
$result8 = mysqli_query($mysqli, $query8) or die("Query failed ($query8) - " . mysqli_error($mysqli)); 
$numrows8 = mysqli_num_rows($result8);

for($i = 0; $i < $numrows8 ; $i++) 
{ 
$row8 = mysqli_fetch_array($result8);
$number = $row8['OptionNumber'];
$food_option = $row8['Food'];
$weapon_option = $row8['Weapons'];
$gold_option = $row8['Gold'];

echo 'Option '.$number.': [<span style="color:#1A6600">F: '.$food_option.'</span> | <span style="color:#B20000">T: '.$weapon_option.'</span>] | <span style="color:#0000B2">G: '.$gold_option.'</span>]';
echo '<br />';


}
?>
</p>
</div>
</div>

</p>
</div>

<!-- Herd Options -->
<h3>Herd Options</h3>
<div>
<p>

<div id="accordion2">
<!-- Create New Herd -->
<h3>Create New Herd</h3>
<div>
<p>
<form action="addherd.php" method="post">
Abbreviation<br />
<input name="abbrev" type="text" />
    <br />
   <div style="font-weight:normal; font-size:xx-small">(Ex: 1BH, 1RH, 1YH)</div><br />
    <br />
Herd Name<br />
<input name="herdname" type="text" />
    <br />
	<br />
	<input type="submit" id="create-herd-button" value="Create Herd" />
    </form>
</p>
</div>

<!-- Remove Existing Herd -->
<h3>Remove Existing Herd</h3>
<div>
<p>
<form action="removeherd.php" method="post">
Herd Name<br />
<input name="herdname" type="text" />
    <br />
	<br />
	<input type="submit" id="remove-herd-button" value="Remove Herd" />
    </form>
</p>
</div>

<!-- Change Herd Leader -->
<h3>Change Herd Leader</h3>
<div>
<p>
<form action="changelead.php" method="post">
Herd To Change<br />
 <select name="herd">
                    <option selected="selected" disabled="disabled">&nbsp;</option>
                    <?php
$query3 = "SELECT * FROM bs_herds";  
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
	<br />
New Herd Leader (Citizen ID)<br />
<input name="new_herdlead" type="number" />
    <br />
	<br />    
	<input type="submit" id="change-herd-lead-button" value="Change Herd Leader"  />
    </form>
</p>
</div>

<!-- Rename Herd -->
<h3>Rename Herd</h3>
<div>
<p>
<form action="renameherd.php" method="post">
Old Herd Name<br />
<input name="old_herdname" type="text" />
    <br />
	<br />
New Herd Name<br />
<input name="new_herdname" type="text" />
    <br />
	<br />
New Abbreviation<br />
<input name="herd_abbrev" type="text" />
    <br />
	<br />    
	<input type="submit" id="rename-herd-button" value="Rename Herd" />
    </form>
</p>
</div>
</div>

</p>
</div>

<!-- Logs -->
<h3>Logs</h3>
<div>
<p>

<div id="accordion2">
<!-- Soldier Logs -->
<h3>Soldier Logs</h3>
<div>
<p>
<?php
$query9 = "SELECT * FROM bs_slogs ORDER BY Date DESC, Timestamp DESC LIMIT 75 ";  
$result9 = mysqli_query($mysqli, $query9) or die("Query failed ($query9) - " . mysqli_error($mysqli)); 
$numrows9 = mysqli_num_rows($result9);

if ($numrows9 == 0) {
echo "<br /><strong>No Soldier Logs Found</strong>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>DATE</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>TIME</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>CITIZEN NAME</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>ACTION</div></th>
</tr>";

for($i = 0; $i < $numrows9 ; $i++) 
{ 
$row9 = mysqli_fetch_array($result9);
//set table variables
$log_date = $row9['Date'];
$log_time = $row9['Time'];
$log_citname = $row9['CitizenName'];
$log_action = $row9['Action'];

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
  echo "<td>" . $log_date . "</td>";
  echo "<td>" . $log_time . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $log_citname . "</td>";
  echo "<td>" . $log_action . "</td>";    
  echo "</tr>";
  
}
echo "</table>";
}
?> 
</p>
</div>

<!-- Admin Logs -->
<h3>Admin Logs</h3>
<div>
<p>
 <?php
$query9 = "SELECT * FROM bs_logs ORDER BY Date DESC, Timestamp DESC LIMIT 75 ";  
$result9 = mysqli_query($mysqli, $query9) or die("Query failed ($query9) - " . mysqli_error($mysqli)); 
$numrows9 = mysqli_num_rows($result9);

if ($numrows9 == 0) {
echo "<br /><strong>No Admin Logs Found</strong>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>DATE</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>TIME</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>CITIZEN NAME</div></th>
<th><div align='left' style='padding-left:5px; font-size:xx-small;'>ACTION</div></th>
</tr>";

for($i = 0; $i < $numrows9 ; $i++) 
{ 
$row9 = mysqli_fetch_array($result9);
//set table variables
$log_date = $row9['Date'];
$log_time = $row9['Time'];
$log_citname = $row9['CitizenName'];
$log_action = $row9['Action'];

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
  echo "<td>" . $log_date . "</td>";
  echo "<td>" . $log_time . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $log_citname . "</td>";
  echo "<td>" . $log_action . "</td>";    
  echo "</tr>";
  
}
echo "</table>";
}
?> 
</p>
</div>
</div>

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