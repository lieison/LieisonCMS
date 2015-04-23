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
              $result[$i]['priv_nombre'] = $this->ConvertPrivToString($result[$i]['priv_nombre']);
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
    
    
    public function get_seccion_dashboard($status = 1){
        
        if($status == 1){
            $this->QUERY = "SELECT * FROM seccion_dashboard WHERE status LIKE 1";
        }else if($status == 0){
            $this->QUERY = "SELECT * FROM seccion_dashboard WHERE status LIKE 0";
        }
        else{
            $this->QUERY = "SELECT * FROM seccion_dashboard";
        }
        
        $value = parent::RawQuery($this->QUERY);
        return $value;
    }
    
    
    public function Set_UpdateDashboard($id , array $params){
        return parent::Update("dashboard" , $params , " id_dashboard LIKE $id");
    }
    
    
    public function ConvertPrivToString($numeric_privs){
         $admin = new AdminController();
         $privs = $admin->Get_MasterPrivilegios();
         $privs_array = array();
         $numeric_array = explode(",", $numeric_privs);
         for($i=0; $i< count($numeric_array); $i++){
             foreach ($privs as $v){
                 if($numeric_array[$i] == $v['nivel']){
                     array_push($privs_array, $v['nombre']);
                     break;
                 }
             }
         }
         $glue = implode(",", $privs_array);
         if(SivarApi\Tools\Validation::Is_Empty_OrNull($glue)){
             return "all privileges";
         }
         return $glue;
    }
    
    public function Set_NewSeccion( $title  ,$icon , $start , $privs ){
        return parent::Insert("seccion_dashboard", array(
            "numero" => $start,
            "icono" => $icon,
            "titulo" =>$title,
            "privilegios" =>$privs
        ));
    }
   

     
   
}
