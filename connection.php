<?php

// Set Database Credentials
$db = "localhost";
$dbuser = "goldsmithzach";
$dbpass = "eblacksheep92";
$dbsel = "bsroster";

// Connect to Database
$mysqli = new mysqli($db,$dbuser,$dbpass,$dbsel);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>