<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.
ini_set('display_errors', '1');
error_reporting(E_ALL);

require("inc/apifuncs.php");

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
			$user		= $_GET["user"];
			$networks	= getNetworksForUser( $user );
			echo implode(",", $networks);
		} else {
			echo( "Invalid request.  No user specified." );
		}
		break;

	case "channels":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) )
		{
			$user		= $_GET["user"];
			$network	= $_GET["network"];
			$channels	= getChannelsForNetworkForUser( $user, $network );
			echo implode(",", $channels);
		} else {
			echo("Need to provide both a valid user and network uri variable.  Either one or both was either invalid or not provided.");
		}
		break;

	case "dates":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) )
		{
			$user		= $_GET["user"];
			$network	= $_GET["network"];
			$channel	= htmlspecialchars( $_GET["channel"] );
			$logs		= getLogs( $user, $network, $channel );
			echo implode(",", $logs );
		} else {
			echo("Need to provide both a valid user, network, and channel uri variable.  At least one was either invalid or not provided.");			
		}
		break;
		
	case "onelog":
		if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) && isset( $_GET["log"] ) )
		{
			$user		= $_GET["user"];
			$network	= $_GET["network"];
			$channel	= htmlspecialchars( $_GET["channel"] );
			$log		= $_GET["log"];
			getRawLog( $user, $network, $channel, $log );
		} else {
			echo("Need to provide both a valid user, network, channel, and log uri variable.  At least one was either invalid or not provided.");
		}
		break;
	
	default: 
		echo( "Invalid request.  No payload specified, or invalid payload specified." );
}


?>
