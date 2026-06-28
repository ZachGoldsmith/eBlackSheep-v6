<?php
ob_start();

$query99 = "SELECT * FROM bs_applications";  
$result99 = mysqli_query($mysqli, $query99) or die("Query failed ($query99) - " . mysqli_error($mysqli));
$count = " ".mysqli_num_rows($result99)." ";

if($vmaclearance == '1') {
// All Pages EXCEPT Admin Panel and Soldiers Panel (Top Nav)
$nav1 = "
<a href='home.php'>Home</a> 
| <a href='teamlist.php'>Team List</a> 
| <a href='chainofcommand.php'>Chain of Command</a> 
| <a href='statistics.php'>Statistics</a> 
| <a href='avatarcreator.php'>Avatar Creator</a> 
| <a href='../forums' target='_blank'>Forums</a> 
| <a href='reqsupplies.php'>Request Supplies</a>
| <a href='https://discord.gg/VKDDkTT9UW' target='_blank'>Join Discord Server</a>  
";

// If in Soldiers Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('spanel.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";	
}
// If not, set these (Bottom Nav)
else{
$nav2 = "
<a href='spanel.php'>Soldiers Panel</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";
}
// Soldiers Panel Nav
$nav5 = "
<a href='spanel.php'>Soldiers Panel</a>
";	
}

if($vmaclearance == '2') {
// All Pages EXCEPT Admin Panel and Soldiers Panel (Top Nav)
$nav1 = "
<a href='home.php'>Home</a> 
| <a href='teamlist.php'>Team List</a> 
| <a href='chainofcommand.php'>Chain of Command</a> 
| <a href='statistics.php'>Statistics</a> 
| <a href='avatarcreator.php'>Avatar Creator</a> 
| <a href='../forums' target='_blank'>Forums</a> 
| <a href='reqsupplies.php'>Request Supplies</a>
| <a href='https://discord.gg/VKDDkTT9UW' target='_blank'>Join Discord Server</a>  
";

// If in Soldiers Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('spanel.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";	
}
// If not, Set these (Bottom Nav)
else{
$nav2 = "
<a href='spanel.php'>Soldiers Panel</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";
}	
// Soldiers Panel Nav (Top Nav)
$nav5 = "
<a href='spanel.php'>Soldiers Panel</a>
";	
}

if($vmaclearance == '3') {
// All Pages EXCEPT Admin Panel and Soldiers Panel (Top Nav)
$nav1 = "
<a href='home.php'>Home</a> 
| <a href='teamlist.php'>Team List</a> 
| <a href='qm.php'>QM</a> 
| <a href='chainofcommand.php'>Chain of Command</a> 
| <a href='statistics.php'>Statistics</a> 
| <a href='avatarcreator.php'>Avatar Creator</a> 
| <a href='../forums' target='_blank'>Forums</a> 
| <a href='reqsupplies.php'>Request Supplies</a>
| <a href='https://discord.gg/VKDDkTT9UW' target='_blank'>Join Discord Server</a>  
";

// If on Soldiers Panel, Set these Links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('spanel.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";	
}
// If not, Set these links (Bottom Nav)
else{
$nav2 = "
<a href='spanel.php'>Soldiers Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";
}
// Soldiers Panel links (Top Nav)
$nav5 = "
<a href='spanel.php'>Soldiers Panel</a>
";		
}

if($vmaclearance == '4') {
// All pages EXCEPT Admin Panel and Soldiers Panel (Top Nav)
$nav1 = "
<a href='home.php'>Home</a> 
| <a href='teamlist.php'>Team List</a> 
| <a href='qm.php'>QM</a> 
| <a href='chainofcommand.php'>Chain of Command</a> 
| <a href='statistics.php'>Statistics</a> 
| <a href='avatarcreator.php'>Avatar Creator</a> 
| <a href='www.eblacksheep.net/forums' target='_blank'>Forums</a> 
| <a href='reqsupplies.php'>Request Supplies</a>
| <a href='https://discord.gg/VKDDkTT9UW' target='_blank'>Join Discord Server</a>  
";

// If in Admin Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('news.php', 'apanel.php', 'cmanagement.php', 'recruiter.php', 'updater.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='spanel.php'>Soldiers Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";		
}
// If Not, Set these (Bottom Nav)
else{
$nav2 = "
<a href='apanel.php'>Admin Panel</a> 
| <a href='spanel.php'>Soldiers Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";
}
// If in Soldiers Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('spanel.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='apanel.php'>Admin Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";	
// Soldiers Panel Links (Top Nav)
$nav5 = "
<a href='spanel.php'>Soldiers Panel</a>
";	
}
// If not in Soldiers Panel, Set these links (Bottom Nav)
$nav3 = "
<a href='apanel.php'>Admin Panel</a> 
| <a href='news.php'>News</a> 
| <a href='cmanagement.php'>Commune Management</a> 
| <a href='recruiter.php'>Recruiter</a> 
| <a href='updater.php'>Manual MU API Updater</a> 
";
}

if($vmaclearance == '5') {
// All pages EXCEPT for Admin Panel and Soldier Panel
$nav1 = "
<a href='home.php'>Home</a> 
| <a href='teamlist.php'>Team List</a> 
| <a href='qm.php'>QM</a> 
| <a href='chainofcommand.php'>Chain of Command</a> 
| <a href='statistics.php'>Statistics</a> 
| <a href='avatarcreator.php'>Avatar Creator</a> 
| <a href='../forums' target='_blank'>Forums</a> 
| <a href='reqsupplies.php'>Request Supplies</a>
| <a href='https://discord.gg/VKDDkTT9UW' target='_blank'>Join Discord Server</a>  
";

// If in Admin Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('news.php', 'apanel.php', 'cmanagement.php', 'recruiter.php', 'updater.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='spanel.php'>Soldiers Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";		
}
// If not in Admin Panel, set these (Bottom Nav)
else{
$nav2 = "
<a href='apanel.php'>Admin Panel</a> 
| <a href='spanel.php'>Soldiers Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";
}

// If in Soldiers Panel, Set these links (Bottom Nav)
if (in_array(basename($_SERVER['PHP_SELF']), array('spanel.php')))
{
$nav2 = "
<a href='home.php'>Back to Home</a> 
| <a href='apanel.php'>Admin Panel</a> 
| <a href='applications.php'>New Applications (".$count.")</a> 
| <a href='donations.php'>Donate Supplies to MU</a>
";	
// Soldiers Panel Links (Top Nav)
$nav5 = "
<a href='spanel.php'>Soldiers Panel</a>
";	
}
// Admin Panel links (Top Nav) 
$nav3 = "
<a href='apanel.php'>Admin Panel</a> 
| <a href='news.php'>News</a> 
| <a href='cmanagement.php'>Commune Management</a> 
| <a href='recruiter.php'>Recruiter</a> 
| <a href='updater.php'>Manual MU API Updater</a> 
";
}
ob_flush();
?>