<?php
date_default_timezone_set('America/Los_Angeles');	
$suptoday = date("Y-m-d");
$no = 'No';
$yes = 'Yes';
$query09 = "SELECT SUM(ReqGold) AS ReqGold FROM bs_goldlogs WHERE DateSupplied='$suptoday'";  
$result09 = mysqli_query($mysqli, $query09) or die("Query failed ($query09) - " . mysqli_error($mysqli));
$row09 = mysqli_fetch_array($result09); 
$sum09 = $row09['ReqGold'];

if($sum09 == ''){
$sum09 = 0;	
}

echo $sum09." GOLD SUPPLIED TODAY";
	?>
    <br />

<?php
$plus7 = strtotime("-7 day");
$last7days = date("Y-m-d", $plus7);

$query10 = "SELECT * FROM bs_gold WHERE Supplied='No' ORDER BY Timestamp DESC"; // BETWEEN '$suptoday' AND '$last7days'
$result10 = mysqli_query($mysqli, $query10) or die("Query failed ($query10) - " . mysqli_error($mysqli)); 
$numrows10 = mysqli_num_rows($result10);

if ($numrows10 == 0) {
echo "<div style='padding-bottom:5px;'>No Gold Requests Found</div>";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'></div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>DONATE</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>DATE REQUESTED</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>TIME REQUESTED</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>CITIZEN NAME</div></th>
<th style='font-size:x-small;'>GOLD</th>
<th style='font-size:x-small;'>COMMUNE</th>
<th style='font-size:x-small;'>SUPPLIED</th>
</tr>";

for($i = 0; $i < $numrows10 ; $i++) 
{ 
$row10 = mysqli_fetch_array($result10);
//set table variables
$sup_citname = $row10['CitizenName'];
$sup_citid = $row10['CitizenID'];
$sup_gold = $row10['ReqGold'];
$reqdate = $row10['RequestDate'];
$reqtime = $row10['RequestTime'];
$comstatus = ($row10['CommuneStatus'] == 'work') ? '<img src="images/thumb-up.png" height="15px" width="15px" />' : '<img src="images/thumb.png" height="15px" width="15px" />';
$supplybutton = '<a href="supplied.php?id='.$sup_citid.'&req=gold&date='.$reqdate.'" target="_self"><img src="images/check.png" width="15" height="15" alt="supplied" /></a>';
$deletebutton = '<a href="delete-request.php?id='.$sup_citid.'&req=gold&date='.$sup_date.'" target="_self"><img src="images/cross.png" width="15" height="15" alt="supplied" /></a>';
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
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $reqdate . "</td>"; 
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $reqtime . "</td>";     
  echo "<td align='left' style='padding-left:5px; padding-right:100px; font-weight:normal; padding-top:4px; padding-bottom:5px;' name='citname'>" . $sup_citname . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px; color:#0000B2;'>" . $sup_gold . "</td>";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $comstatus . "</td>";  
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $supplybutton . "</td>";  
  echo "</tr>";
}
echo "</table>";
}
?>