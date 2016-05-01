<?php
# Displays index with pulldown menu items for user, network, and channel.

require_once('inc/smarty-3.1.29/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'views';

$smarty->compile_dir = 'tmp';

$smarty->display('index.tpl');
$smarty->display('index.tpl');


?>
