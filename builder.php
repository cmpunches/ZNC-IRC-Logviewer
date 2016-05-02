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
		if ( isset( $_GET["user"] ) ) 
		{
			$user = $_GET["user"];
			$networks = getNetworksForUser( $user );
			foreach ( $networks as $network )
			{
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
		if ( ( isset( $_GET["user"] ) && isset( $_GET["network"] ) ) )
		{
			$user = $_GET["user"];
			$network = $_GET["network"];
			$channels = getChannelsForNetworkForUser( $user, $network );
			echo implode(",", $channels);
		}
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
	$unfilteredNetworkList 	= scandir( $GLOBALS['log_root'] . '/' . $user );
	$unsortedNetworkList 	= array_diff( $unfilteredNetworkList , array( '..', '.' ) );
	$networkList 			= array_values( $unsortedNetworkList );
	return $networkList;
}

function getChannelsForNetworkForUser( $user, $network )
{
	$unfilteredChannelList 	= scandir( $GLOBALS['log_root'] . '/' . $user . '/' . $network );
	$unsortedChannelList 	= array_diff( $unfilteredChannelList, array( '..', ',' ) );
	$channelList 			= array_values( $unsortedChannelList );
	return $channelList;
}

# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates

?>
