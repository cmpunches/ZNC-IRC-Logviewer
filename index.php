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

function getChannelsForNetworkForUser( $user, $network, $ZNCLogRoot )
{
	return array_values(
		array_diff(
			scandir( $ZNCLogRoot . '/' . $user . '/' . $network ),
			array( '..', '.' )
		)
	);
}

# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates



print_r( getChannelsForNetworkForUser( 'phanes', 'freenode', $root_logpath ) );

# it's coming
$smarty->display('index.tpl');


?>
