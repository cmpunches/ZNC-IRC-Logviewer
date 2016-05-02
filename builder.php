<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.
ini_set('display_errors', '1');
error_reporting(E_ALL);

$log_root = '../IRC';

$payload = htmlspecialchars( $_GET["payload"] );

switch( trim( $payload ) ) 
{
	case "users":
		$users = getUsers();
		echo implode(",", $users);
		break;
	case "networks":
		if ( isset( $_GET["user"] ) ) 
		{
			$user = $_GET["user"];
			$networks = getNetworksForUser( $user );
			echo implode(",", $networks);
		} else {
			echo( "Invalid request.  No user specified." );
		}
		break;
	case "channels":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) )
		{
			$user = $_GET["user"];
			$network = $_GET["network"];
			$channels = getChannelsForNetworkForUser( $user, $network );
			echo implode(",", $channels);
		} else {
			echo("Need to provide both a valid user and network uri variable.  Either one or both was either invalid or not provided.");
		}
		break;
	case "dates":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) )
		{
			$user = $_GET["user"];
			$network = $_GET["network"];
			$channel = htmlspecialchars( $_GET["channel"] );
			$logs = getLogs( $user, $network, $channel );
			echo implode(",", $logs );
		} else {
			echo("Need to provide both a valid user, network, and channel uri variable.  At least one was either invalid or not provided.");			
		}
		break;
	case "onelog":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) && isset( $_GET["log"] ) )
		{
			$user = $_GET["user"];
			$network = $_GET["network"];
			$channel = htmlspecialchars( $_GET["channel"] );
			$log = htmlspecialchars( $_GET["log"] );
			getRawLog( $user, $network, $channel, $log );
		} else {
			echo("Need to provide both a valid user, network, channel, and log uri variable.  At least one was either invalid or not provided.");
		}
		break;
	
	default: 
		echo( "Invalid request.  No payload specified, or invalid payload specified." );
}

function getUsers()
{
	$unfilteredUserList		= scandir( $GLOBALS['log_root'] );
	$unsortedUserList		= array_diff( $unfilteredUserList, array( '..', '.' ) );
	$userList				= array_values( $unsortedUserList );
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
	$unsortedChannelList 	= array_diff( $unfilteredChannelList, array( '..', '.' ) );
	$channelList 			= array_values( $unsortedChannelList );
	return $channelList;
}

function getLogs( $user, $network, $channel )
{
	$unfilteredLogList 		= scandir( $GLOBALS['log_root'] . '/' . $user . '/' . $network . '/' . $channel );
	$unsortedLogList 		= array_diff( $unfilteredLogList, array( '..', '.' ) );
	$logList				= array_values( $unsortedLogList );
	return $logList;
}

function getRawLog( $user, $network, $channel, $log )
{
	$logfilepath = $GLOBALS['log_root'] . '/' . $user . '/' . $network . '/' . $channel . '/' . $log;
	if ( file_exists($logfilepath) && is_file( $logfilepath )  )
	{
		readfile($logfilepath);
	} else {
		echo("Log either doesn't exist or isn't a file:  $logfilepath");
	}
}


# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates

?>
