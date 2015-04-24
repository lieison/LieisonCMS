<?php


class TaskModel extends MysqlConection {
    
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
   
}
