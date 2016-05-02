<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.

$log_root = '../IRC';

$payload = htmlspecialchars( $_GET["load"] );

switch( $payload ) 
{
	case "users":
		$users = getUsers();
		foreach ($users as $user)
		{
			print "$user\n<br>";
		}
		break;
	case "networks":
		break;
	case "channels":
		break;
	case "dates":
		break;
	default: 
		print "Access denied.";
}

function getUsers()
{
	return array_values( 
		array_diff( 
			scandir( $log_root ), 
			array( '..', '.' )
		) 
	);	
}

function getNetworksForUser( $user )
{
	return array_values(
		array_diff(
			scandir( $log_root . '/' . $user ),
			array( '..', '.' )
		)
	);
}

function getChannelsForNetworkForUser( $user, $network )
{
	return array_values(
		array_diff(
			scandir( $log_root . '/' . $user . '/' . $network ),
			array( '..', '.' )
		)
	);
}

# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates

?>
