<?php

// Generate eDay
function dateDiff($today, $firsteDay)
{
    return round(abs(strtotime($today) - strtotime($firsteDay)) / 86400);

}

date_default_timezone_set('America/Los_Angeles');
$today = date("Y-m-d");
$firsteday = "2007-11-20";

$eday = dateDiff($today, $firsteday);

// Get Website Version

function GetVersion($mysqli)
{
    $sql = "SELECT * FROM bs_global";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
    return $row['Version'];
}

$version = GetVersion($mysqli);

// API Info
function APILastUpdate() {
    $API = "API IS CURRENTLY DOWN";
    echo $API;
}

// Authorize User

function UserAuth($mysqli) {
    // Save Username and Password
    $vmaid = mysqli_real_escape_string($mysqli, $_POST['vmaid']);
    $vmapswd = mysqli_real_escape_string($mysqli, sha1($_POST['vmapswd']));
    // Set Date and Time
    $date = date("Y-m-d");
    $time = date("h:i:sa T");

    // Find Soldier
    $sql = "SELECT * FROM bs_accounts WHERE CitizenID = '$vmaid' AND Password = '$vmapswd'";
    $result = mysqli_query($mysqli, $sql);
    $numrows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $vmaname = $row['CitizenName'];
    $loggedin = "Logged in";

    // Soldier Not Found
    if ($numrows < 1) {
        echo "<span style='font-size:12px;'>SOLDIER ACCOUNT NOT FOUND!</span>";
    }
    // Soldier Found
    elseif ($numrows == 1) {
        echo "<span style='font-size:12px;'>USER AUTHENTICATED. PLEASE WAIT...</span>";
        session_start();

        // Set Cookie, Record Login, Send user to home.php
        $_SESSION['vmabsmu'] = $vmaid;
        $sql2 = "INSERT INTO bs_slogs (Date, Time, CitizenName, Action) VALUES ('$date', '$time', '$vmaname', '$loggedin')";
        $result2 = mysqli_query($mysqli, $sql2);
        ?>
        <script>
            setTimeout(function () {
                window.location.href = 'home.php'
            }, 1500);
        </script>
        <?php
    }

}

function SoldierInfo($mysqli, $vmaid) {

    // Gather Soldier Information
    $soldier_sql = "SELECT * FROM bs_accounts WHERE CitizenID = '$vmaid'";
    $soldier_result = mysqli_query($mysqli, $soldier_sql);
    //$soldier_numrows = mysqli_num_rows($soldier_result);
    $soldier_row = mysqli_fetch_array($soldier_result);

    $soldierID = $soldier_row['CitizenID'];
    $soldierName = $soldier_row['CitizenName'];
    $soldierTeam = $soldier_row['Team'];
    $soldierDiscord = $soldier_row['DiscordNick'];
    $soldierClearance = $soldier_row['Clearance'];
    $soldierBirth = $soldier_row['Birthday'];
    $soldierLevel = $soldier_row['Level'];
    $soldierXP = $soldier_row['XP'];
    $soldierStr = $soldier_row['Strength'];
    $soldierRank = $soldier_row['Rank'];
    $soldierRLevel = $soldier_row['RankLevel'];
    $soldierRPoints = $soldier_row['RankPoints'];
    $soldierCS = $soldier_row['Citizenship'];
    $soldierState = $soldier_row['State'];
    $soldierCountry = $soldier_row['Country'];
    $soldierMU = $soldier_row['MUMember'];
    $soldierOnline = $soldier_row['OnlineStatus'];
    $soldierTopDam = $soldier_row['TopDamage'];
    $soldierTopDamDate = $soldier_row['TopDamageDate'];
    $soldierAvatar = $soldier_row['Avatar'];
    $soldierJoinDate = $soldier_row['Join'];
    $soldierNRank = $soldier_row['NationalRank'];
    $soldierAlive = $soldier_row['CitizenStatus'];
    $soldierFF = $soldier_row['FreedomFighter'];
    $soldierHW = $soldier_row['HardWorker'];
    $soldierCM = $soldier_row['Congressman'];
    $soldierPres = $soldier_row['President'];
    $soldierMedia = $soldier_row['MediaMogul'];
    $soldierBH = $soldier_row['BattleHero'];
    $soldierCH = $soldier_row['CampaignHero'];
    $soldierRH = $soldier_row['ResistanceHero'];
    $soldierSS = $soldier_row['SuperSoldier'];
    $soldierSB = $soldier_row['SocietyBuilder'];
    $soldierMerc = $soldier_row['Mercenary'];
    $soldierTF = $soldier_row['TopFighter'];
    $soldierTP = $soldier_row['TruePatriot'];
    $soldierDiv = $soldier_row['Division'];
    $soldierComStatus = $soldier_row['CommuneStatus'];
    $soldierReferredBy = $soldier_row['Referrer'];

    // Gather Herd Information
    $team_sql = "SELECT * FROM bs_herds WHERE HerdAbbr = '$soldierTeam'";
    $team_result = mysqli_query($mysqli, $team_sql);
    //$team_numrows = mysqli_num_rows($team_result);
    $team_row = mysqli_fetch_array($team_result);
    $soldierHerd = $team_row['HerdName'];
    
    return [
    
    /* 0 - ID */ $soldierID, 
    /* 1 - Name */ $soldierName, 
    /* 2 - Herd */ $soldierHerd, 
    /* 3 - Discord Name */ $soldierDiscord, 
    /* 4 - Clearance */ $soldierClearance,
    /* 5 - Birthday */ $soldierBirth,
    /* 6 - Level */ $soldierLevel,
    /* 7 - XP */ $soldierXP,
    /* 8 - Strength */ $soldierStr,
    /* 9 - Rank */ $soldierRank,
    /* 10 - Rank Level */ $soldierRLevel,
    /* 11 - Rank Points */ $soldierRPoints,
    /* 12 - Citizenship */ $soldierCS,
    /* 13 - State */ $soldierState,
    /* 14 - Country */ $soldierCountry,
    /* 15 - Military Unit */ $soldierMU,
    /* 16 - Online Status */ $soldierOnline,
    /* 17 - Top Damage */ $soldierTopDam,
    /* 18 - Top Damage Date */ $soldierTopDamDate,
    /* 19 - Avatar */ $soldierAvatar,
    /* 20 - MU Join Date */ $soldierJoinDate,
    /* 21 - National Rank */ $soldierNRank,
    /* 22 - Alive or Dead? */ $soldierAlive,
    /* 23 - Freedom Fighter */ $soldierFF,
    /* 24 - Hard Worker */ $soldierHW,
    /* 25 - Congressman */ $soldierCM,
    /* 26 - President */ $soldierPres,
    /* 27 - Media Mogul */ $soldierMedia,
    /* 28 - Battle Hero */ $soldierBH,
    /* 29 - Campaign Hero */ $soldierCH,
    /* 30 - Resistance Hero */ $soldierRH,
    /* 31 - Super Soldier */ $soldierSS,
    /* 32 - Society Builder */ $soldierSB,
    /* 33 - Mercenary */ $soldierMerc,
    /* 34 - Top Fighter */ $soldierTF,
    /* 35 - True Patriot */ $soldierTP,
    /* 36 - Division */ $soldierDiv,
    /* 37 - Commune Status */ $soldierComStatus,
    /* 38 - Referrer */ $soldierReferredBy

];
    
}

    
?>