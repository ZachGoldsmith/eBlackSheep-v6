<?php
require __DIR__.'/vendor/autoload.php';

use Erpk\Harvester\Client\ClientBuilder;

$builder = new ClientBuilder();
$builder->setEmail('lanbo@aa.agaaa.org');
$builder->setPassword('ekZZ1kl');

$client = $builder->getClient();

use Erpk\Harvester\Module\Military\MilitaryModule;
$module = new MilitaryModule($client);

$con=mysqli_connect("p3plcpnl1206.prod.phx3.secureserver.net","bsroster","September6!99@","bsroster");

$doStatus = $module->getDailyOrderStatus();
$id = $doStatus['do_battle_id'];
$region = $doStatus['do_region_name'];
$country = $doStatus['do_for_country'];

$query = mysqli_query($con,"INSERT INTO bs_dailyorder (ID, Region, Country) VALUES ('$id','$region','$country')");

mysqli_close($con);

?>