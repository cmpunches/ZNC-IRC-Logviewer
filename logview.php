<?php
# builds the lists required for the znc log viewer
# assuming a $user/$network/$channel/$date spec.

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once( "inc/apifuncs.php" );

$log_root = '../IRC';

#echo("<pre>");
if ( isset( $_GET["user"] ) && isset( $_GET["network"] ) && isset( $_GET["channel"] ) && isset( $_GET["log"] ) )
{
	$user = $_GET["user"];
	$network = $_GET["network"];
	$channel = $_GET["channel"];
	$log = $_GET["log"];
	echo("<link rel=\"stylesheet\" href=\"css/irclogs.css\" />");
	getPrettyLog( $user, $network, $channel, $log );
} else {
	echo( "Invalid request.  Either user, network, channel, or date.log was invalid or unspecified." );
}
#echo("</pre>");
?>
