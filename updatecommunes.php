<?php
include('connection.php');
include('functions.php');

$sql = "SELECT * FROM bs_accounts WHERE Commune = '1'";
$result = mysqli_query($mysqli, $sql) or die("Query failed ($sql) - " . mysqli_error($mysqli));
$numrows = mysqli_num_rows($result);

for($i = 0; $i < $numrows; $i++) 
{ 
$row = mysqli_fetch_array($result);
$id = $row['CitizenID'];
$originalherd = $row['Team'];

$sql2 = "UPDATE bs_accounts SET Commune='N/A' WHERE CitizenID = ".$id."";
$result2 = mysqli_query($mysqli, $sql2);

echo $id.' has been updated<br />';

}
mysqli_close($mysqli);
?>