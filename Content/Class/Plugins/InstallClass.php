<?php namespace Plugin\Install;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstallClass
 *
 * @author rolandoantonio
 */
abstract class InstallClass extends \MysqlConection {
    
    protected function InstallDBPlugin(){
        $database = "";
        return $database;
    }

    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }

    public abstract function InsertTable($table);
    
    public abstract function InsertDb($insert);
    
    public function Execute($plugin_name , $plugin_status , $plugin_dir){
        $plugin_db = parent::RawQuery("show tables like 'sivar_plugins'");
    }
 
}
