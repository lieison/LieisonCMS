<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProspectController
 *
 * @author rolandoantonio
 */
class ProspectController extends MysqlConection {
    
    protected  $QUERY = null;
            
    function __construct() {
        parent::__construct();
    }

    public function Find_Prospect($prospect_name)
    {
        $this->QUERY = "SELECT count(*) as contador FROM sales_prospect WHERE nombre LIKE '$prospect_name'";
        $result = parent::RawQuery($this->QUERY);
        if($result)
        {
            return $result;
        }
    }
    
    public function Add_Prospect($params )
    {
        if(is_array($params))
        {
            return $this->Insert("sales_prospect" , $params);
        }
    }
    
    /**
     * $activate (0,1,2)
     */
    public function Get_All_Prospect($activate = 1)
    {
        if($activate == 2){
            $this->QUERY = "SELECT * FROM sales_prospect";
        }else{
             $this->QUERY = "SELECT * FROM sales_prospect WHERE estado LIKE $activate";
        }
        return parent::RawQuery($this->QUERY);
    }
    
    
    
}
