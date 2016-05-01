<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# $host/$users/$networks/$channels/$logs
$host = $_SERVER['HTTP_HOST'];

$root_logpath = '../IRC';

$users = array_values( 
	array_diff( 
		scandir( $root_logpath ), 
		array( '..', '.' )
	) 
);

print_r($users);


$smarty->display('index.tpl');


?>
