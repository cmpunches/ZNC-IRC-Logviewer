<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# $host/$users/$networks/$channels/$logs
$host = $_SERVER['HTTP_HOST'];

$root_logpath = '../IRC';

$users = scandir($root_logpath);

print_r($users);


$smarty->display('index.tpl');


?>
