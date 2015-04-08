<?php


class DashboardModel extends MysqlConection {
    
    function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
}
