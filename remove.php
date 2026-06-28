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
}
?>
<?php
$citid = mysqli_real_escape_string($mysqli, $_GET['id']);

$query3 = "DELETE FROM bs_applications WHERE CitizenID='$citid'";  
$result3 = mysqli_query($mysqli, $query3) or die("Query failed ($query3) - " . mysqli_error($mysqli));
if ($result3 == 'TRUE') {
header("Location: applications.php?removedapp=1"); 
}
?>
<?php mysqli_close($mysqli); ob_flush(); ?>