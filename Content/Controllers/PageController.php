<?php


class PageController extends PageModel{
    
    var $QUERY = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_dashboard_pages()
    {
        return FunctionsController::get_directory_tree(
                    "admin" ,  
                    array("name"=>"dashboard" , "extend"=> "php")
                );
    }
    
    public function get_dashboard_database($id = null)
    {
      
        if($id== null){
              /**
         * SENTENCIA SQL ES UN VIEW
         */
            $result = parent::RawQuery("SELECT * FROM VIEW_DASHBOARD_DB");
        }else{
              /**
         * SENTENCIA SQL PROCEDIMIENTO ALMACENADO
         */
             $result = parent::RawQuery("CALL ProcGetDashboardPagebyId($id)");
             $result = $result[0];
        }
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
    
    
    public function get_seccion_dashboard(){
        
        $this->QUERY = "SELECT * FROM seccion_dashboard WHERE status LIKE 1";
        $value = parent::RawQuery($this->QUERY);
        return $value;
    }


    
    public function set_dashboard_page($page , $directory)
    {
        
    }
    
    public function delete_dashboard_page($page_name , $directory)
    {
        
    }
   
}
