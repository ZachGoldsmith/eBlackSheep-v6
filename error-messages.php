<?php
if (isset($_GET['denied']) AND !empty($_GET['denied']))
{
echo 'ACCESS DENIED';
}
elseif (isset($_GET['error']) AND !empty($_GET['error']))
{
echo 'YOU HAVE ALREADY REQUESTED TODAY';
}
elseif (isset($_GET['recieved']) AND !empty($_GET['recieved']))
{
echo 'SUPPLY REQUEST HAS BEEN RECIEVED';
}
elseif (isset($_GET['supplied-error']) AND !empty($_GET['supplied-error']))
{
    echo 'ERROR. PLEASE TRY AGAIN!';
}
elseif (isset($_GET['supplied']) AND !empty($_GET['supplied']))
{
	$soldier = strtoupper($_GET['supplied']);
    echo $soldier.' HAS BEEN SUPPLIED';
}

// Admin Panel Errors
elseif (isset($_GET['addherd']) AND !empty($_GET['addherd']))
{
    echo 'HERD HAS BEEN ADDED';
}
elseif (isset($_GET['addherd-error']) AND !empty($_GET['addherd-error']))
{
    echo 'THERE WAS AN ERROR ADDING HERD';
}

elseif (isset($_GET['aop']) AND !empty($_GET['aop']))
{
    echo 'NEW SUPPLY OPTION HAS BEEN ADDED';
}
elseif (isset($_GET['aop-error']) AND !empty($_GET['aop-error']))
{
    echo 'THERE WAS AN ERROR ADDING NEW SUPPLY OPTION';
}

elseif (isset($_GET['addsoldier']) AND !empty($_GET['addsoldier']))
{
    echo 'NEW SOLDIER HAS BEEN ADDED';
}
elseif (isset($_GET['addsoldier-error']) AND !empty($_GET['addsoldier-error']))
{
    echo 'THERE WAS AN ERROR ADDING NEW SOLDIER';
}

elseif (isset($_GET['changeoption']) AND !empty($_GET['changeoption']))
{
    echo 'SUPPLY OPTION HAS BEEN CHANGED';
}
elseif (isset($_GET['changeoption-error']) AND !empty($_GET['changeoption-error']))
{
    echo 'THERE WAS AN ERROR CHANGING THE SUPPLY OPTION';
}

elseif (isset($_GET['changesoldierpw']) AND !empty($_GET['changesoldierpw']))
{
    echo 'SOLDIERS PASSWORD HAS BEEN CHANGED';
}
elseif (isset($_GET['changesoldierpw-error']) AND !empty($_GET['changesoldierpw-error']))
{
    echo 'THERE WAS AN ERROR CHANGING THE SOLDIERS PASSWORD';
}

elseif (isset($_GET['removeherd']) AND !empty($_GET['removeherd']))
{
    echo 'HERD HAS BEEN REMOVED';
}
elseif (isset($_GET['removeherd-error']) AND !empty($_GET['removeherd-error']))
{
    echo 'THERE WAS AN ERROR REMOVING THE HERD';
}

elseif (isset($_GET['removeoption']) AND !empty($_GET['removeoption']))
{
    echo 'SUPPLY OPTION HAS BEEN REMOVED';
}
elseif (isset($_GET['removeoption-error']) AND !empty($_GET['removeoption-error']))
{
    echo 'THERE WAS AN ERROR REMOVING THE SUPPLY OPTION';
}

elseif (isset($_GET['removesoldier']) AND !empty($_GET['removesoldier']))
{
    echo 'SOLDIER HAS BEEN REMOVED';
}
elseif (isset($_GET['removesoldier-error']) AND !empty($_GET['removesoldier-error']))
{
    echo 'THERE WAS AN ERROR DISCHARGING SOLDIER';
}

elseif (isset($_GET['newleader']) AND !empty($_GET['newleader']))
{
    echo 'NEW LEADER FOR HERD HAS BEEN SET';
}
elseif (isset($_GET['newleader-error']) AND !empty($_GET['newleader-error']))
{
    echo 'THERE WAS AN ERROR SETTING NEW LEADER';
}

// COMMUNE MANAGEMENT MESSAGES
elseif (isset($_GET['csaved']) AND !empty($_GET['csaved']))
{
    echo 'COMMUNE STATUS UPDATED';
}

// NEWS MESSAGES
elseif (isset($_GET['addnews']) AND !empty($_GET['addnews']))
{
    echo 'SUCCESSFULLY CREATED NEW VMA-214 NEWS ARTICLE '.$_GET['newsname'];
}
elseif (isset($_GET['addnews-error']) AND !empty($_GET['addnews-error']))
{
    echo 'THERE WAS AN ERROR CREATING NEWS. PLEASE TRY AGAIN.';
}
elseif (isset($_GET['delnews']) AND !empty($_GET['delnews']))
{
    echo 'SUCCESSFULLY DELETED VMA-214 NEWS ARTICLE '.$_GET['newsname'];
}
elseif (isset($_GET['delnews-error']) AND !empty($_GET['delnews-error']))
{
    echo 'THERE WAS AN ERROR DELETING NEWS. PLEASE TRY AGAIN.';
}

// TEAM LIST MESSAGES
elseif (isset($_GET['moved']) AND !empty($_GET['moved']))
{
    echo strtoupper($_GET['name']).' HAS BEEN MOVED TO '.$_GET['team'];
}
elseif (isset($_GET['returned']) AND !empty($_GET['returned']))
{
    echo strtoupper($_GET['name']).' HAS BEEN RETURNED TO '.$_GET['team'];
}

// EDIT SOLDIER MESSAGES
elseif (isset($_GET['saved']) AND !empty($_GET['saved']))
{
    echo strtoupper($vmaname).' INFORMATION SAVED!';
}
elseif (isset($_GET['srequested']) AND !empty($_GET['srequested']))
{
    echo 'YOU HAVE REQUESTED FOR '.strtoupper($vmaname);
}
elseif (isset($_GET['serror']) AND !empty($_GET['serror']))
{
    echo strtoupper($vmaname).' HAS ALREADY REQUESTED TODAY!';
}

// SOLDIER PANEL MESSAGES
elseif (isset($_GET['supply']) AND !empty($_GET['supply']))
{
    echo 'SUCESSFULLY CHANGED SUPPLY OPTION TO: OPTION '.$_GET['supply'];
}
elseif (isset($_GET['pass']) AND !empty($_GET['pass']))
{
    echo 'YOU HAVE SUCCESSFULLY CHANGED YOUR PASSWORD';
}
elseif (isset($_GET['error-pass']) AND !empty($_GET['error-pass']))
{
    echo 'THERE HAS BEEN A PROBLEM SETTING YOUR NEW PASSWORD. PLEASE TRY AGIAN.';
}
elseif (isset($_GET['discord']) AND !empty($_GET['discord']))
{
    echo 'YOUR DISCORD NICKNAME HAS BEEN SET TO: '.$_GET['discord'];
}

// APPLICATION MESSAGES
elseif (isset($_GET['processed']) AND !empty($_GET['processed']))
{
    echo 'SOLDIER HAS BEEN PROCESSED SUCESSFULLY!';
}
elseif (isset($_GET['removed']) AND !empty($_GET['removed']))
{
    echo 'SOLDIERS APPLICATION HAVE BEEN REMOVED';
}
?>