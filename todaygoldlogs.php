<?php
date_default_timezone_set('America/Los_Angeles');
$suptoday = date("Y-m-d");
$no = 'No';

$query9 = "SELECT * FROM bs_goldlogs WHERE DateSupplied = '$suptoday' ORDER BY Timestamp DESC";  
$result9 = mysqli_query($mysqli, $query9) or die("Query failed ($query9) - " . mysqli_error($mysqli)); 
$numrows9 = mysqli_num_rows($result9);

if ($numrows9 == 0) {
echo "<br />No Gold Logs Found";	
}

else{ 
echo "<table border='0' align='center'>
<tr>
<th><div align='left' style='padding-left:5px; font-size:x-small;'>DATE SUPPLIED</div></th>
<th><div align='left' style='padding-left:5px; font-size:x-small;'>TIME SUPPLIED</div></th>
<th><div align='left' style='padding-left:5px; font-size:x-small;'>CITIZEN NAME</div></th>
<th style='font-size:x-small;'>GOLD</th>
<th style='font-size:x-small;'>SUPPLIER</th>
</tr>";

for($i = 0; $i < $numrows9 ; $i++) 
{ 
$row9 = mysqli_fetch_array($result9);
//set table variables
$reqcitizen = $row9['ReqCitizen'];
$reqgold = $row9['ReqGold'];
$datesup = $row9['DateSupplied'];
$timesup = $row9['TimeSupplied'];
$supplier = $row9['Supplier'];

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
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $datesup . "</td>";
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $timesup . "</td>";  
  echo "<td align='left' style='padding-left:5px; padding-right:50px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $reqcitizen . "</td>";
  echo "<td align='center' style='padding-left:20px; padding-right:20px; font-weight:normal; padding-top:4px; padding-bottom:5px; color:#0000B2;'>" . $reqgold . "</td>";
  echo "<td align='center' style='padding-left:10px; padding-right:10px; font-weight:normal; padding-top:4px; padding-bottom:5px;'>" . $supplier . "</td>";  
  echo "</tr>";
  
}
echo "</table>";
}
?> 