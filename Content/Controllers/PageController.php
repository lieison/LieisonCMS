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
          $admin = new AdminController();
          $privs = $admin->Get_MasterPrivilegios();
          for ($i=0; $i< count($result); $i++){
              $a = explode(",", $result[$i]['priv_nombre']);
              $strings = array();
              foreach ($a as $a_values){
                  foreach ($privs as $p_values){
                      if((int)$a_values == (int)$p_values['nivel']){
                          array_push($strings, $p_values['nombre']);
                      }
                  }
              }
              $result[$i]['priv_nombre'] = implode(",", $strings);
          }
          
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
    
    
    public function Set_UpdateDashboard($id , array $params){
        return parent::Update("dashboard" , $params , " id_dashboard LIKE $id");
    }

        
    public function set_dashboard_page($page , $directory)
    {
        
    }
    
    public function delete_dashboard_page($page_name , $directory)
    {
        
    }
   
}
