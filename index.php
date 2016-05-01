<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# $users/$networks/$channels/$logs

$root_logpath = '../IRC';

function getUsers( $ZNCLogRoot )
{
	return array_values( 
		array_diff( 
			scandir( $ZNCLogRoot ), 
			array( '..', '.' )
		) 
	);	
}

function getNetworksForUser( $user, $ZNCLogRoot )
{
	return array_values(
		array_diff(
			scandir( $ZNCLogRoot . '/' . $user ),
			array( '..', '.' )
		)
	);
}



print_r( getNetworksForUser( 'phanes', $root_logpath ) );


$smarty->display('index.tpl');


?>
