<?php


class TaskController extends TaskModel {
    
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
    
    
    
}
