<?php

    
 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.5
 *  EN LA VERSION 1.5 SE MODIFICARON VARIAS FUNCIONES PARA SU CORRECTA EJECUCION EN CUALQUIER AMBITO 
 *@todo Lieison S.A de C.V 
 */


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
    
    public function Set_NewSeccion( $title  ,$icon , $start , $privs ){
        return parent::Insert("seccion_dashboard", array(
            "numero" => $start,
            "icono" => $icon,
            "titulo" =>$title,
            "privilegios" =>$privs
        ));
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

}
