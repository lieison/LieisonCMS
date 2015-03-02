<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PageController
 *
 * @author rolandoantonio
 */
class PageController extends MysqlConection {
    
    var $QUERY = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_dashboard_pages()
    {
        return FunctionsController::get_directory_tree("admin" ,  array("name"=>"dashboard" , "extend"=> "php"));
    }
    
    public function get_dashboard_database()
    {
        $this->QUERY = "SELECT dashboard.id_dashboard as id, "
                . " dashboard.titulo as dash_titulo , seccion_dashboard.titulo as sec_titulo"
                . ", dashboard.link , dashboard.icono  "
                . ", privilegios.nombre as 'priv_nombre'  FROM dashboard"
                . " INNER JOIN seccion_dashboard ON dashboard.id_seccion=seccion_dashboard.id_seccion"
                . " INNER JOIN privilegios ON dashboard.privilegios=privilegios.nivel "
                . "WHERE dashboard.link LIKE '%dashboard%'";
        
        $result = parent::RawQuery($this->QUERY);
        return $result;
    }
    
    
    public function get_numbers_seccion()
    {
        $numeros = array();
        $this->QUERY = "SELECT numero FROM seccion_dashboard";
        $result = $this->RawQuery($this->QUERY);
        foreach ($result as $k=>$v)
        {
            $numeros[] = $v['numero'];
        }
        return $numeros;
    }
    
    public function set_dashboard_page($page , $directory)
    {
        
    }
    
    public function delete_dashboard_page($page_name , $directory)
    {
        
    }
   
}
