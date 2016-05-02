<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.

$log_root = '../IRC';

$payload = htmlspecialchars( $_GET["payload"] );

switch( $payload ) 
{
	case "users":
		foreach ( getUsers() as $user)
		{
			echo("$user\n<br>");
		}
		break;
	case "networks":
		break;
	case "channels":
		break;
	case "dates":
		break;
	default: 
		print "Invalid request.  No payload specified.";
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

//function getNetworksForUser( $user )
//{
	//return array_values(
		//array_diff(
			//scandir( $log_root . '/' . $user ),
			//array( '..', '.' )
		//)
	//);
//}

//function getChannelsForNetworkForUser( $user, $network )
//{
	//return array_values(
		//array_diff(
			//scandir( $log_root . '/' . $user . '/' . $network ),
			//array( '..', '.' )
		//)
	//);
//}

# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates

?>
