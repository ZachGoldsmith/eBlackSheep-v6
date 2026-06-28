<div id="accordion" style="width:100%; margin-top:10px;" align="center">
<?php
$query100 = "SELECT * FROM bs_herds";  
$result100 = mysqli_query($mysqli, $query100) or die("Query failed ($query100) - " . mysqli_error($mysqli)); 
$numrows100 = mysqli_num_rows($result100);

if ($numrows100 == 0) {
echo "";	
}

else{ 

for($i100 = 0; $i100 < $numrows100 ; $i100++) 
{ 
$row100 = mysqli_fetch_array($result100);
//set table variables
$herdname = $row100['HerdName'];
$abbrev = $row100['HerdAbbr'];

echo '<h3>'.$herdname.'</h3><div><p>';

$query110 = "SELECT * FROM bs_accounts WHERE Team = '$abbrev' ORDER BY Insignia DESC";  
$result110 = mysqli_query($mysqli, $query110) or die("Query failed ($query110) - " . mysqli_error($mysqli)); 
$numrows110 = mysqli_num_rows($result110);

if ($numrows110 == 0) {
echo "<br /><div align='center' style='font-size:xx-small; padding-bottom:20px;'><strong>No Soldiers in ".$herdname."</strong></div>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th align='center'>&nbsp;</th>
<th align='center'>&nbsp;</th>
<th align='center'>&nbsp;</th>
<th align='left' style='padding-left:5px; padding-right:5px;'>Citizen Name</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>Insignia</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>Strength</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>Military Rank</th>
<th align='center' style='padding-left:5px; padding-right:5px;' width='75px'>National Rank</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>Top Damage</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>Commune</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>&nbsp;</th>
<th align='center' style='padding-left:5px; padding-right:5px;'>&nbsp;</th>
</tr>";

for($i = 0; $i < $numrows110 ; $i++) 
{ 
$row110 = mysqli_fetch_array($result110);
//set table variables
$db_citname = $row110['CitizenName'];
$db_citid = $row110['CitizenID'];
$db_insignia = $row110['Insignia'];
$db_onlinestatus = $row110['OnlineStatus'];
$db_citizenstatus = $row110['CitizenStatus'];
if($db_citizenstatus == "0"){
$db_citname = '<span style="color:#B20000">'.$db_citname.'</span>';
}
else{
$db_citname;	
}

$db_strength = number_format($row110['Strength']);
$db_militaryrank = $row110['Rank'];
$db_militarylevel = $row110['RankLevel'];
$db_topdamage = number_format($row110['TopDamage']);
$db_topdamagedate = $row110['TopDamageDate'];
$db_nationalrank = $row110['NationalRank'];
$db_commune = $row110['Commune'];


$infoaction = "soldierinfo.php?id=".$db_citid."";

$profilebutton = '<a href="http://www.erepublik.com/en/citizen/profile/'.$db_citid.'" target="_blank"><img src="images/usericon.png" width="12" height="12" alt="profile" /></a>';



if($herdname == "Lost Herd"){
$lastherd = $row110['OriginalTeam'];
$movesoldier = "movesoldier.php?id=".$db_citid."&herd=".$lastherd."";
$moveicon = '<img src="images/backtoherd.png" width="16" height="16" />';
$movetitle = 'Move Soldier Back to Original Herd';
}
else {
$lostherd = "1LH";
$movesoldier = "movesoldier.php?id=".$db_citid."&herd=".$lostherd."";	
$moveicon = '<img src="images/movelostherd.png" width="16" height="16" />';
$movetitle = 'Move Soldier to Lost Herd';
}
		

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
  
       echo "<td align='center' width='16px'>";
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
	     echo "<td align='center'><a href='".$movesoldier."' target='_self' style='color:#000000;' title='".$movetitle."'>".$moveicon."</a></td>";
		  echo "</tr>";		  

}
  echo "</table>";
  
}

echo '</p></div>';

}
}
    ?>    
</div>