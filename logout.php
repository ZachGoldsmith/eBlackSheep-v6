<?php
session_destroy();
session_start();
$_SESSION = array();
header("Location: index.php");
?>