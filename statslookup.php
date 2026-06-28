<?php
$sql9 = "SELECT * FROM bs_accounts ORDER BY TopDamage DESC";
$result9 = mysqli_query($mysqli, $sql9);
$row9 = mysqli_fetch_array($result9);

$tfavatar = $row9['Avatar'];
$tfname = $row9['CitizenName'];
$tfdamage = number_format($row9['TopDamage']);
$tfdmgdate = $row9['TopDamageDate'];

$sql10 = "SELECT * FROM bs_accounts ORDER BY Strength DESC";
$result10 = mysqli_query($mysqli, $sql10);
$row10 = mysqli_fetch_array($result10);

$hstravatar = $row10['Avatar'];
$highstrname = $row10['CitizenName'];
$highstr = number_format($row10['Strength']);

$sql11 = "SELECT * FROM bs_accounts WHERE Strength >1 ORDER BY Strength ASC";
$result11 = mysqli_query($mysqli, $sql11);
$row11 = mysqli_fetch_array($result11);

$lstravatar = $row11['Avatar'];
$lowstrname = $row11['CitizenName'];
$lowstr = number_format($row11['Strength']);

$sql12 = "SELECT * FROM bs_accounts ORDER BY RankLevel DESC";
$result12 = mysqli_query($mysqli, $sql12);
$row12 = mysqli_fetch_array($result12);

$hrankavatar = $row12['Avatar'];
$highrankname = $row12['CitizenName'];
$highrank = $row12['Rank'];

$sql13 = "SELECT * FROM bs_accounts WHERE RankLevel >1 ORDER BY RankLevel ASC";
$result13 = mysqli_query($mysqli, $sql13);
$row13 = mysqli_fetch_array($result13);

$lrankavatar = $row13['Avatar'];
$lowrankname = $row13['CitizenName'];
$lowrank = $row13['Rank'];

?>