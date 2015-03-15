<?php

/*
 * 
 * CLASE PROSPECTCONTROLLER 
 * 
 * ESTA CLASE SE UTILIZA PARA CONTROLAR TODO ACERCA DE SALES EN PROSPECTOS 
 * CADA FUNCION ESTA PREDETERMINADA  Y POR LO CUAL NO NECESITA UN MODELO A SEGUIR
 * 
 * ULTIMA VERSION 0.1 :
 * 
 * 
 * VERSIONES ANTERIORES :
 * 
 * 
 * MEJORAS:
 * 
 * 
 */



class ProspectController extends MysqlConection {
    
    /**
     * VARIABLE QUERY PROTEGIDA
     */
    protected  $QUERY = null;
            
    /**
     * CONSTRUCTOR HERENCIA PADRE MYSQLCONECTION
     */
    function __construct() {
        parent::__construct();
    }

    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo Funcion de busqueda un prospecto por nombre 
     *@param String $prospect_name nombre del prospecto 
     *@return int devuelve la cantidad de prospectos encontrados.
     */
    public function Find_Prospect($prospect_name)
    {
        $this->QUERY = "SELECT count(*) as contador FROM sales_prospect WHERE nombre LIKE '$prospect_name%'";
        $result = parent::RawQuery($this->QUERY);
        if($result)
        {
            return $result;
        }
    }
    
     /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo Funcion agregar un nuevo prospecto
     *@param array $params arreglo de campos a add prospectos 
      *<code>
      * 
      * $params= array("campo1"=>valor , "campo2"=>valor);
      * 
      * </code> 
      *
     *@return boolean true si se guardo correctamente
     */
    public function Add_Prospect($params )
    {
        if(is_array($params))
        {
            return $this->Insert("sales_prospect" , $params);
        }
    }
    
   
    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo Obtiene todos los prospectos y devuelve un arreglo de ellos
     *@param int optional , $activate : 1=solo prospectos activos , 2=todos los prospectos , 0=prospectos inactivos
     *@return int devuelve la cantidad de prospectos encontrados.
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
    
   /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo ontiene un prospecto por su ID 
     *@param int/string $id 
     *@return array , devuelve un arreglo
     */
    public function Get_Prospect_ById($id)
    {
        $R = parent::RawQuery("SELECT * FROM sales_prospect WHERE id_prospect LIKE $id");
        return $R[0];
    }
    
    
    
    public function Get_ContactProspect($id)
    {
        
    }
    
    
    public function Get_Country($id_coutry){
        $this->QUERY = "SELECT PAI_NOMBRE as pais from pais WHERE PAI_PK like $id_coutry";
        $r = parent::RawQuery($this->QUERY);
        return $r[0]['pais'];
    }
    
    
    public function Set_MetaStatus($new_status , $id_prospect)
    {
        return parent::Update("sales_prospect", array("meta_estado"=>$new_status ) , "id_prospect LIKE $id_prospect");
    }
    
    
    public function Set_Estatus($new_status , $id_prospect)
    {
         return parent::Update("sales_prospect", array("estado"=>$new_status ) , "id_prospect LIKE $id_prospect");
    }
    
    
    
    
    
}
