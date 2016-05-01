<?php
# Displays index with pulldown menu items for user, network, and channel.
require_once('inc/smarty.php');

# domain/$users/$networks/$channels/$logs
$host = $_SERVER['HTTP_HOST'];

echo($host);
$smarty->display('index.tpl');


?>
