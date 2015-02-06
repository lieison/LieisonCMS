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
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_dashboard_pages()
    {
        return FunctionsController::get_directory_tree("admin" ,  array("name"=>"dashboard" , "extend"=> "php"));
    }
    
    public function set_dashboard_page($page , $directory)
    {
        
    }
    
    public function delete_dashboard_page($page_name , $directory)
    {
        
    }
   
}
