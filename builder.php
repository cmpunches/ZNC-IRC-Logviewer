<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.
ini_set('display_errors', '1');
error_reporting(-1);

$log_root = '../IRC';

$payload = htmlspecialchars( $_GET["payload"] );

switch( trim( $payload ) ) 
{
	case "users":
		$users = getUsers();
		foreach ( $users as $user )
		{
			echo( "$user" );
			if ( count( $users ) > 1 ) 
			{
				echo ",";
			}
		}
		break;
	case "networks":
		echo("line 25<br>" );
		if ( isset( $_GET["user"] ) ) 
		{
			$user = $_GET["user"];
			var_dump($user);
			echo("line 27<br>" );
			$networks = getNetworksForUser( $user );
			foreach ( $networks as $network )
			{
				echo("line 31<br>" );
				echo( "$network" );
				if ( count( $networks ) > 1 )
				{
					echo ",";
				}
			}
		} else {
			echo( "Invalid request.  No user specified." );
		}

		break;
		
	case "channels":
		break;
		
	case "dates":
		break;
		
	default: 
		echo( "Invalid request.  No payload specified, or invalid payload specified." );

}

function getUsers()
{
	$unfilteredUserList 	= scandir( $GLOBALS['log_root'] );
	$unsortedUserList 		= array_diff( $unfilteredUserList, array( '..', '.' ) );
	$userList 				= array_values( $unsortedUserList );
	return $userList;
}

function getNetworksForUser( $user )
{
	echo("line 64<br>" );

	var_dump($user);
	$unfilteredNetworkList = scandir( $GLOBALS['log_root'] . '/' . $user );
	$unsortedNetworkList = array_diff( $unfilteredNetworkList , array( '..', '.' ) );
	$networkList = array_values( $unsortedNetworkList );
	var_dump($networkList);
	return $networkList;
}

//function getChannelsForNetworkForUser( $user, $network )
//{
	//return array_values(
		//array_diff(
			//scandir( $GLOBALS['log_root'] . '/' . $user . '/' . $network ),
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
