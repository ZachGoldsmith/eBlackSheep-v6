<?php
date_default_timezone_set('America/Los_Angeles');
$query92 = "SELECT * FROM bs_goldlogs WHERE DateSupplied != '$suptoday' ORDER BY Timestamp DESC, DateSupplied DESC LIMIT 50";  
$result92 = mysqli_query($mysqli, $query92) or die("Query failed ($query92) - " . mysqli_error($mysqli)); 
$numrows92 = mysqli_num_rows($result92);

$query192 = "SELECT SUM(ReqGold) AS TotalGold FROM bs_gold WHERE Supplied = 'Yes'";  
$result192 = mysqli_query($mysqli, $query192) or die("Query failed ($query192) - " . mysqli_error($mysqli)); 
$row192 = mysqli_fetch_array($result192);
$totalgold = $row192['TotalGold'];
if($totalgold == ''){
$totalgold = '0';	
}

if ($numrows92 == 0) {
echo "Total Gold sent: ".$totalgold;
echo "<br />";	
echo "<br />No Gold Logs Found";	
}

else{ 
echo "Total Gold sent: ".$totalgold;
echo "<br />";	
echo "<table border='0' align='center'>
<tr>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>DATE SUPPLIED</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>TIME SUPPLIED</div></th>
<th><div class='pagehead3' align='left' style='padding-left:5px; font-size:x-small;'>CITIZEN NAME</div></th>
<th><span class='pagehead3' style='font-size:x-small;'>GOLD</span></th>
<th><span class='pagehead3' style='font-size:x-small;'>SUPPLIER</span></th>
</tr>";

for($i2 = 0; $i2 < $numrows92 ; $i2++) 
{ 
$row92 = mysqli_fetch_array($result92);
//set table variables
$reqcitizen2 = $row92['ReqCitizen'];
$reqgold2 = $row92['ReqGold'];
$datesup2 = $row92['DateSupplied'];

if($datesup2 == $suptoday) {
	$datesup2 = "<strong>".$datesup2."</strong>";
}

$timesup2 = $row92['TimeSupplied'];
$supplier2 = $row92['Supplier'];

if($i2 % 2)
{
$RowColor2="bgcolor=''";
}
else
{
$RowColor2="bgcolor='#DDDDDD'";
}

//inserts the data in rows, creating one row for every record found
  echo "<tr ".$RowColor2.">";
  echo "<td align='left' style='padding-left:5px; padding-right:40px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $datesup2 . "</td>";
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $timesup2 . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $reqcitizen2 . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px; color:#0000B2;'>" . $reqgold2 . "</td>";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $supplier2 . "</td>";  
  echo "</tr>";
}
echo "</table>";
}

?> 