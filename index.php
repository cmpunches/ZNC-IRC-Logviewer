<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# $users/$networks/$channels/$logs

# build a multidimensional key/value set using:
# @users
#	@networks
#		@channels
#			@dates

# it's coming
$smarty->display('index.tpl');

?>
