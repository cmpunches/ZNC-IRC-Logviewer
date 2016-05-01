<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# $host/$users/$networks/$channels/$logs
$host = $_SERVER['HTTP_HOST'];

function getUsers( $ZNCLogRoot )
{
	return array_values( 
		array_diff( 
			scandir( $ZNCLogRoot ), 
			array( '..', '.' )
		) 
	);	
}

$root_logpath = '../IRC';



print_r( getUsers( $root_logpath ) );


$smarty->display('index.tpl');


?>
