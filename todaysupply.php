<?php
date_default_timezone_set('America/Los_Angeles');	
$suptoday = date("Y-m-d");
$no = 'No';
$yes = 'Yes';
$query09 = "SELECT SUM(ReqFood) AS ReqFood FROM bs_supplylogs WHERE DateSupplied='$suptoday'";  
$result09 = mysqli_query($mysqli, $query09) or die("Query failed ($query09) - " . mysqli_error($mysqli));
$row09 = mysqli_fetch_array($result09); 
$sum09 = $row09['ReqFood'];

$query010 = "SELECT SUM(ReqWeapons) AS ReqWeapons FROM bs_supplylogs WHERE DateSupplied='$suptoday'";  
$result010 = mysqli_query($mysqli, $query010) or die("Query failed ($query010) - " . mysqli_error($mysqli));
$row010 = mysqli_fetch_array($result010); 
$sum010 = $row010['ReqWeapons'];

if($sum09 == ''){
$sum09 = 0;	
}

if($sum010 == ''){
$sum010 = 0;	
}

echo $sum09." FOOD SUPPLIED AND ".$sum010." WEAPONS SUPPLIED TODAY";
	?>
    <br />

<?php
$query9 = "SELECT * FROM bs_supplies WHERE RequestDate='$suptoday' AND Supplied='$no' ORDER BY Timestamp DESC";  
$result9 = mysqli_query($mysqli, $query9) or die("Query failed ($query9) - " . mysqli_error($mysqli)); 
$numrows9 = mysqli_num_rows($result9);

if ($numrows9 == 0) {
echo "<div style='padding-bottom:5px;'>No Supply Requests Found</div>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'></div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>DONATE</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>CITIZEN NAME</div></th>
<th style='font-size:x-small;'>FOOD</th>
<th style='font-size:x-small;'>TANKS</th>
<th style='font-size:x-small;'>COMMUNE</th>
<th style='font-size:x-small;'>SUPPLIED</th>
</tr>";

for($i = 0; $i < $numrows9 ; $i++) 
{ 
$row9 = mysqli_fetch_array($result9);
//set table variables
$sup_citname = $row9['CitizenName'];
$sup_citid = $row9['CitizenID'];
$sup_food = $row9['ReqFood'];
$sup_tanks = $row9['ReqWeapons'];
$sup_date = $row9['RequestDate'];

$sql = "SELECT * FROM bs_accounts WHERE CitizenID = '".$sup_citid."'";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);
$comstatus = ($row['CommuneStatus'] == 'work') ? '<img src="images/thumb-up.png" height="15px" width="15px" />' : '<img src="images/thumb.png" height="15px" width="15px" />';
$supplybutton = '<a href="supplied.php?id='.$sup_citid.'&req=supplies&date='.$sup_date.'" target="_self"><img src="images/check.png" width="15" height="15" alt="supplied" /></a>';
$deletebutton = '<a href="delete-request.php?id='.$sup_citid.'&req=supplies&date='.$sup_date.'" target="_self"><img src="images/cross.png" width="15" height="15" alt="supplied" /></a>';
$donatebutton = '<a href="http://www.erepublik.com/en/economy/donate-items/'.$sup_citid.'" target="_blank"><img src="images/money-coin.png" width="15" height="15" alt="donate" /></a>';

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
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $deletebutton . "</td>";
  
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $donatebutton . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:100px; font-weight:normal; padding-top:4px; padding-bottom:5px;' name='citname'>" . $sup_citname . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px; color:#006600;'>" . $sup_food . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px; color:#B20000;'>" . $sup_tanks . "</td>";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $comstatus . "</td>";  
  
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $supplybutton . "</td>";  
  echo "</tr>";
}
echo "</table>";
}
?>