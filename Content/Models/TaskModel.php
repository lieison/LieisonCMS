<?php


class TaskModel extends MysqlConection {
    
    /**
     *@var string 
     */
    var $QUERY      = null;
    
    
    /**
     *@todo Constructor herencia mysqlconection 
     */
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
    
    
    /**
     *@todo obtiene la informacion del cliente su id y nombre
     *@return array->STD:CLASS devuelve un arreglo de objetos cuyo objeto lleva
     *                         un id->id , name->name
     *@example  STD_CLASS->id , STD:CLASS->name  
     */
    public function Get_InfoClients(){
        $this->QUERY = "SELECT id_client as id , nombre as name FROM sales_client ORDER BY fecha DESC";
        return parent::RawQuery($this->QUERY, PDO::FETCH_CLASS); 
    }
   
}
