<?php

/*
 * 
 * CLASE PROSPECTCONTROLLER 
 * 
 * ESTA CLASE SE UTILIZA PARA CONTROLAR TODO ACERCA DE SALES EN PROSPECTOS 
 * CADA FUNCION ESTA PREDETERMINADA  Y POR LO CUAL NO NECESITA UN MODELO A SEGUIR
 * 
 * ULTIMA VERSION 0.1 :
 *  VERSION ESTABLE
 * 
 * VERSIONES ANTERIORES :
 *  SIN VERSION ANTERIOR
 * 
 * MEJORAS:
 *  SIN MEJORAS
 * 
 */

class ProspectController extends MysqlConection {
    
    /**
     * VARIABLE QUERY PROTEGIDA
     */
    protected  $QUERY = null;
    protected $CONTACT_COUNT = 0;
            
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
        $this->QUERY = "SELECT count(*) as contador FROM sales_prospect WHERE nombre LIKE '%$prospect_name%'";
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
    
    

    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo obtiene el pais por medio del ID en la base de datos
     *@param string $id_coutry
     *@return array , devuelve el pais (Nombre)
     */
    public function Get_Country($id_coutry){
        $this->QUERY = "SELECT PAI_NOMBRE as pais from pais WHERE PAI_PK like $id_coutry";
        $r = parent::RawQuery($this->QUERY);
        return $r[0]['pais'];
    }
    
    
    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo establece un nuevo meta estado 
     *      Los Meta estados Sirven para verificar si un prospecto esta:
     *      0->No iniciado
     *      1->En Proceso
     *      2->Terminado
     *      n->Algun otro ?
     *@return bool
     */
    public function Set_MetaStatus($new_status , $id_prospect)
    {
        return parent::Update("sales_prospect", array("meta_estado"=>$new_status ) , "id_prospect LIKE $id_prospect");
    }
    
    
   /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo establece el estado (activo->1 , inactivo->0)
     *@param string $id_coutry
     *@return bool
     */ 
    public function Set_Estatus($new_status , $id_prospect)
    {
         return parent::Update("sales_prospect", array("estado"=>$new_status ) , "id_prospect LIKE $id_prospect");
    }
    
    
      
   /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo actualiza las notas del contacto
     *@param string $notes las notas dentro del textarea o textbox
    * @param string $id_prospect id del prospecto
     *@return bool
     */ 
    public function Set_NewNotes($notes , $id_prospect){
        return parent::Update("sales_prospect", array("notas"=>$notes ) , "id_prospect LIKE $id_prospect");
    }
    
    
    public function Get_ProspectProgress($id_prospect)
    {
        $this->QUERY = "SELECT nombre , direccion , direccion2 , provincia , ciudad , id_pais "
                . ", zip , telefono , fax , pagina_web , email , facebook , twitter , notas FROM sales_prospect"
                . " WHERE id_prospect LIKE $id_prospect";
        $result = parent::RawQuery($this->QUERY);
        $total = count($result[0]);
        $empty = 0;
        foreach ($result[0] as $value){
            if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($value)){
                $empty += 1;
            }
        }
        return round(($empty/$total)*100, 2);
    }
    
    
    /**
     * ----------------------------------------------------------------------------
     * SALES CONTACT y CONTACT PHONE
     * ----------------------------------------------------------------------------
     * 
     */
    
    
    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo obtiene todos los contactos del prospecto asignado en el ID
     *@params $id_prospect , el id del prospecto a obtener
     *@return Array devuelve un arreglo del los contactos mediante ese ID (Arreglo asociado)
     */
    public function Get_ContactProspect($id_prospect)
    {
        $this->QUERY = "SELECT * FROM  sales_prospect_contact WHERE id_prospect LIKE $id_prospect";
        $result = parent::RawQuery($this->QUERY);
        $this->CONTACT_COUNT = count($result);
        return $result;
    }
    
     /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo obtiene la cantidad de contactos encontrados despues de ejecutarse Get_ContactProspect
     *@return INT 
     */
    public function Get_ContactCount(){
        return $this->CONTACT_COUNT;
    }
    
    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo obtiene los telefonos mediante el id_contact asignado
     *@param string $id_contact el id del contacto 
     *@return array
     */
    public function Get_PhonesContact($id_contact){
        $this->QUERY = "SELECT * FROM sales_phone_contact WHERE id_prospect_contact LIKE $id_contact";
        return parent::RawQuery($this->QUERY);
    }
    
    
    /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo establece un nuevo telefono al contacto mediante su ID
     *@param string $id_contact el id del contacto
     *@param string $name nombre o titulo del telefono
     *@param string $phone telefono asignado
     *@return bool
     */
    public function SetContactPhone($id_contact , $name , $phone)
    {
        return parent::Insert("sales_phone_contact" , array(
            "id_prospect_contact"=>$id_contact,
            "phone_name"=>$name,
            "number"=>$phone
        ));
    }
    
    
     /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo establece un nuevo contacto a base de un arreglo
     *@param array $params
     *@test $params =array(
            "id_prospect"=> $id,
            "nombres"=>$name,
            "apellidos"=>$name2,
            "titulo"=>$title,
            "email"=>$mail,
            "notas"=>$notes
          ));
     *@return bool
     */
    public  function SetContact( array $params)
    {
        return parent::Insert("sales_prospect_contact" , $params );
    }
    
     /**
     *@author Rolando Antonio Arriaza
     *@version 0.1
     *@todo elimina un contacto y todos los telefono agregados en la agenda
     *@param string $id_contact el id del contacto
     *@return bool
     */
    public function DestroyContact($id_contact)
    {
        $phones = $this->Get_PhonesContact($id_contact);
        if(count($phones) >= 1){
            parent::Delete("sales_phone_contact", " id_prospect_contact LIKE $id_contact");
        }
        return parent::Delete("sales_prospect_contact", " id_prospect_contact LIKE $id_contact");
    }
    
    
    
    public function EditContact($id_contact , $name , $name2 , $title , $mail , $notes){
        $array_c = array(
            "nombres"=>$name,
            "apellidos"=>$name2,
            "titulo"=>$title,
            "email"=>$mail,
            "notas"=>$notes
        );
        return parent::Update("sales_prospect_contact" , $array_c , " id_prospect_contact LIKE $id_contact");
    }
    
    
    public function DestroyPhoneContact($id_phone){
        return parent::Delete("sales_phone_contact", " id_phone_contact LIKE $id_phone");
    }
    
    
    public function EditPhoneContact($id_phone , $name , $number){
        
    }
     
    /**
     * ----------------------------------------------------------------------------
     * BITACORA 
     * ----------------------------------------------------------------------------
     * 
     */
    
    
    public function GetBitacora($id_prospect){
        
    }
    
    
    

    
}
