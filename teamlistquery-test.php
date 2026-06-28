<div id="accordion" style="width:100%; margin-top:10px;" align="center">
<?
include('connection.php');
include('functions.php');
include('lookup.php');

$query3 = "SELECT * FROM bs_herds WHERE HerdName='Honor Guard'";  
$result3 = mysqli_query($mysqli, $query3) or die("Query failed ($query3) - " . mysqli_error($mysqli)); 
$numrows3 = mysqli_num_rows($result3);



if ($numrows3 == 0) {
echo "<br /><div align='center' style='font-size:xx-small; padding-bottom:20px;'><strong>No Soldiers in Honor Guard</strong></div>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
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
</tr>";

for($i = 0; $i < $numrows3 ; $i++) 
{ 
$row3 = mysqli_fetch_array($result3);
//set table variables
$db_citname = $row3['CitizenName'];
$db_citid = $row3['CitizenID'];
$db_insignia = $row3['Insignia'];
$db_onlinestatus = $row3['OnlineStatus'];
$db_citizenstatus = $row3['CitizenStatus'];
if($db_citizenstatus == "0"){
$db_citizenstatus = "  <img src='images/user-dead.png' width='13' height='13' />";
}
else{
$db_citizenstatus = "";	
}
$db_strength = number_format($row3['Strength']);
$db_militaryrank = $row3['Rank'];
$db_militarylevel = $row3['RankLevel'];
$db_topdamage = number_format($row3['TopDamage']);
$db_topdamagedate = $row3['TopDamageDate'];
$db_nationalrank = $row3['NationalRank'];
$db_commune = $row3['Commune'];

$infoaction = "soldierinfo.php?id=".$db_citid."";
		

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
  echo "<td align='center'><a href='http://www.erepublik.com/en/main/messages-compose/".$db_citid."' target='_blank' style='color:#000000;'><img src='images/inbox-upload.png' width='16' height='16' /></a></td>";
  
  echo "<td align='center'><a href='http://www.erepublik.com/en/economy/donate-items/".$db_citid."' target='_blank' style='color:#000000;'><img src='images/money-coin.png' width='16' height='16' /></a></td>"; 
     
  echo "<td align='left'><a href='http://www.erepublik.com/en/citizen/profile/".$db_citid."' target='_blank' style='color:#000000;'><img src='".$db_onlinestatus."' width='8' height='8' />" . $db_citname . "</a>".$db_citizenstatus."</td>";
  
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

<a style="cursor:pointer;" onclick="popup('<?=$infoaction?>')"><img src="images/information-button.png" width="16" height="16" /></a>
          <? 
		  echo "</td>"; 
		  echo "</tr>";		  

}
  echo "</table>";
  
}
?>
    </p>
  </div>