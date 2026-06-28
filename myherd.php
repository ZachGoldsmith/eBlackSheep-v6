<style type="text/css">
@font-face {
    font-family: BerlinSans;
    src: url(fonts/BRLNSR.ttf) format("truetype");
}
#title {
font-size:10px;
font-family: 'Berlin Sans FB', BerlinSans;
font-weight:normal;
}
</style>
<?php

$query4 = "SELECT * FROM bs_accounts WHERE Team = '$vmateam' AND CitizenName != '$vmaname' ORDER BY Insignia DESC";  
$result4 = mysqli_query($mysqli, $query4) or die("Query failed ($query4) - " . mysqli_error($mysqli)); 
$numrows4 = mysqli_num_rows($result4);

if ($numrows4 == 0) {
echo "<br /><div align='center' style='font-size:xx-small; padding-bottom:20px;'><strong>No Soldiers in ".$vmaherd."</strong></div>";	
}

else{ 
echo "<table border='0' align='center' width='100%'>
<tr id='title'>
<th align='center'>&nbsp;</th>
<th align='center'>&nbsp;</th>
<th align='center'>&nbsp;</th>
<th align='left' style='padding-left:5px; padding-right:5px;'>CITIZEN NAME</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>INSIGNIA</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>STRENGTH</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>MILITARY RANK</th>
<th align='center' style='padding-left:5px; padding-right:5px;' width='75px'>NATIONAL RANK</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>TOP DAMAGE</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>COMMUNE</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>&nbsp;</th>
</tr>";

for($i = 0; $i < $numrows4 ; $i++) 
{ 
$row4 = mysqli_fetch_array($result4);
//set table variables
$db_citname = $row4['CitizenName'];
$db_citid = $row4['CitizenID'];
$db_insignia = $row4['Insignia'];
$db_team = $row4['Team'];
$db_supplyoption = $row4['SupplyOption'];
$db_onlinestatus = $row4['OnlineStatus'];
$db_citizenstatus = $row4['CitizenStatus'];
if($db_citizenstatus == "0"){
$db_citname = '<span style="color:#B20000">'.$db_citname.'</span>';
}
else{
$db_citname;	
}

$db_strength = number_format($row4['Strength']);
$db_militaryrank = $row4['Rank'];
$db_militarylevel = $row4['RankLevel'];
$db_topdamage = number_format($row4['TopDamage']);
$db_topdamagedate = $row4['TopDamageDate'];
$db_nationalrank = $row4['NationalRank'];
$db_commune = $row4['Commune'];

$infoaction = "soldierinfo.php?id=".$db_citid."";

$profilebutton = '<a href="http://www.erepublik.com/en/citizen/profile/'.$db_citid.'" target="_blank"><img src="images/usericon.png" width="12" height="12" alt="profile" /></a>';

$firsteday = "2007-11-20";	


//start alternate color patern on rows
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
  
  echo "<td align='center'><a href='http://www.erepublik.com/en/main/messages-compose/".$db_citid."' target='_blank' style='color:#000000;'><img src='images/inbox-upload.png' width='16' height='16' /></a></td>";
  
  echo "<td align='center'><a href='http://www.erepublik.com/en/economy/donate-items/".$db_citid."' target='_blank' style='color:#000000;'><img src='images/money-coin.png' width='16' height='16' /></a></td>";    
  
  echo "<td align='left'><img src='".$db_onlinestatus."' width='8' height='8' /> " . $db_citname . "</td>";
  
  echo "<td align='center' width='30px'>" . $db_insignia . "</td>";
  
  echo "<td align='center'>" . $db_strength . "</td>";
  
  echo "<td align='center' title='(".$db_militarylevel.")'>" . $db_militaryrank . "</td>";
  
  echo "<td align='center' width='45px'>" . $db_nationalrank . "</td>";
    
  echo "<td align='center' title='Achieved on ".$db_topdamagedate."'>" . $db_topdamage . "</td>"; 
  
  echo "<td align='center'>" . $db_commune . "</td>";     
  
  echo "<td align='center'>";
?>

<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 820;
 var height = 425;
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

<a style="cursor:pointer;" onclick="popup('<?=$infoaction?>')"><img src="images/information-button.png" width="16" height="16" /></a>
          <?php
	echo "</td>";
}
  echo "</table>";

}
?>
