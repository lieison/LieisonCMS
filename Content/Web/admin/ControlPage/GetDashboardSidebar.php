<?php

include   '../../../Conf/Include.php';

ob_start();
$dashboard = new Dashboard();
echo $dashboard->get_dashboard_sidebar_menu($_REQUEST['rol'], $_REQUEST['page']);
unset($dashboard);
ob_end_flush();


