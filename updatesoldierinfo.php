<script>
function Scrollit(){ window.scrollBy(0,1); }
setInterval("Scrollit()",0.1);
</script>
<?php
date_default_timezone_set('America/Los_Angeles');

require __DIR__.'/vendor/autoload.php';

use Erpk\Harvester\Client\Client;

use Erpk\Harvester\Client\ClientBuilder;

$builder = new ClientBuilder();
$builder->setEmail('zgold92@yahoo.com');
$builder->setPassword('September61992');

$client = $builder->getClient();


use Erpk\Harvester\Module\Citizen\CitizenModule;
// assumes you have your Client object already set up
$module = new CitizenModule($client);

$con=mysqli_connect("localhost","goldsmithzach","eblacksheep92","bsroster");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if( !ini_get('safe_mode') ){ 
    set_time_limit(0); //this won't work if safe_mode is enabled.
}

// Perform queries
$query = mysqli_query($con,"SELECT * FROM bs_accounts WHERE CitizenID = '$newcitid'");
$numrows = mysqli_num_rows($query);

if ($numrows == 0) {
exit;	
}

else{
for($i = 0; $i < $numrows ; $i++) 
{ 
$row1 = mysqli_fetch_array($query);
$citid = $row1['CitizenID'];
$citizen = $module->getProfile($citid);
$birthday = $citizen['birth']; //Birthday
$level = $citizen['level']; //Level
$xp = $citizen['experience']; //Experience
$avatar = $citizen['avatar']; //Avatar
$strength = $citizen['military']['strength']; //Strength
$militaryrank = $citizen['military']['rank']->getName(); //Military Rank
$militarylevel = $citizen['military']['rank']->getLevel(); //Military Level
$rankpoints = $citizen['military']['rank']->getPoints(); //Rank Points
$militaryunit = $citizen['military']['unit']['name']; //Military Unit
$citizenship = $citizen['citizenship']->getName(); //Citizenship
$state = $citizen['residence']['region']->getName(); //State
$country = $citizen['residence']['country']->getName(); //Country
$topdamage = $citizen['top_damage']['damage']; //Top Damage
$topdamagedate = $citizen['top_damage']['date']; //Top Damage Date
$nationalrank = $citizen['national_rank']; //National Ranking
$onlinestatus = $citizen['online']; //Online Status
$citizenstatus = $citizen['alive']; //Citizen Status
$medal1 = $citizen['medals']['freedom_fighter']; //Medal 1
$medal2 = $citizen['medals']['hard_worker']; //Medal 2
$medal3 = $citizen['medals']['congress_member']; //Medal 3
$medal4 = $citizen['medals']['country_president']; //Medal 4
$medal5 = $citizen['medals']['media_mogul']; //Medal 5
$medal6 = $citizen['medals']['battle_hero']; //Medal 6
$medal7 = $citizen['medals']['campaign_hero']; //Medal 7
$medal8 = $citizen['medals']['resistance_hero']; //Medal 8
$medal9 = $citizen['medals']['super_soldier']; //Medal 9
$medal10 = $citizen['medals']['society_builder']; //Medal 10
$medal11 = $citizen['medals']['mercenary']; //Medal 11
$medal12 = $citizen['medals']['top_fighter']; //Medal 12
$medal13 = $citizen['medals']['true_patriot']; //Medal 13
$division = $citizen['division']; //Division
if($onlinestatus == 1) {
$onlinestatus = "images/user-online.png";	
}
else {
$onlinestatus = "images/user-offline.png";	
}
if($citizenstatus == 1) {
$citizenstatus = "1";	
}
else {
$citizenstatus = "0";	
}

$query2 = mysqli_query($con,"UPDATE bs_accounts SET Birthday='$birthday', Level='$level', XP='$xp', Strength='$strength', Rank='$militaryrank', RankLevel='$militarylevel', RankPoints='$rankpoints', Citizenship='$citizenship', State='$state', Country='$country', MUMember='$militaryunit', OnlineStatus='$onlinestatus', Avatar='$avatar', TopDamage='$topdamage', TopDamageDate='$topdamagedate', NationalRank='$nationalrank', CitizenStatus='$citizenstatus', FreedomFighter='$medal1', HardWorker='$medal2', Congressman='$medal3', President='$medal4', MediaMogul='$medal5', BattleHero='$medal6', CampaignHero='$medal7', ResistanceHero='$medal8', SuperSoldier='$medal9', SocietyBuilder='$medal10', Mercenary='$medal11', TopFighter='$medal12', TruePatriot='$medal13', Division='$division' WHERE CitizenID='$citid'");

}
}
?>
<? mysqli_close($mysqli); ?>