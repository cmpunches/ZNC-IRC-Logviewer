<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once( "inc/apifuncs.php" );

$log_root = '../IRC';

if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) && isset( $_GET["date"] ) )
{
	$user = $_GET["user"];
	$network = $_GET["network"];
	$channel = $_GET["channel"];
	$date = $_GET["date"];
	getRawLog( $user, $network, $channel, $log );
} else {
	echo( "Invalid request.  Either user, network, channel, or date.log was invalid or unspecified." );
}

?>
