<?php

include   '../../../Conf/Include.php';

ob_start();
$dashboard = new DashboardController();
echo $dashboard->get_dashboard_sidebar_menu($_REQUEST['rol'], $_REQUEST['page']);
ob_end_flush();


