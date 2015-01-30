<?php

/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2015, ROLIGNU
 * @version 1.2
 * @license GPL
 * @link https://github.com/rolignu2/SivarApi github del proyecto
 * --------------------------------------------------------------
 * 
 * CLASE DE CONEXION MYSQL HEREDADA DE PDO CLASS
 * ESTA CLASE FUE DESARROLLADA CON EL PROPOSITO DE 
 * CREAR UN CODIGO MAS ORDENADO UTILIZANDO POO.
 * 
 * DEPENDENCIAS:
 *          ---->STD:CLASS:PDO
 *          ---->Config.php (EL SCRIPT CONFIG ES DONDE CONFIGURARA LA BASE DE DATOS A UTILIZAR)
 * 
 * POSIBLES CAMBIOS MANUALES:
 *          --> PUEDE SER POSIBLE QUE CAMBIE LA DIRECCION DEL INCLUDE DENTRO DEL CONSTRUCTOR
 *              SI EXISTE ALGUN CAMBIO DE DIRECTORIO O RUTA 
 *              
 *              include "Conf/Config.php";
 *              cambiar por 
 *              iclude ".../Nueva_Ruta/Config.php"
 * 
 * EDICIONES Y FUNCIONES NUEVAS VERSION 1.2:
 *      -->SE AGREGO LA NUEVA FUNCION  CreateUpdateTransaction
 *      -->SE AGREGO LA FUNCION Find
 *      -->SE MEJORO LA FUNCION Update , Insert y Delete
 *      -->SE DEPRECO LA FUNCION CreateTransaction
 * --------------------------------------------------------------
 */


define("JSON_OUT", 0);
define("OBJECT_OUT" , 1);
define("ARRAY_OUT" , 2);

class MysqlConection extends PDO
{
 
    /**
     * VARIABLES PROTEGIDAS 
     * @version 1.1 
     * **/
    
    protected $response = null;
    protected $dns = null;
    protected $query=null;
    protected $count = 0;
   
    /**
     * @todo Constructor de la clase mysqlconection
     * @version 1.1
     * @since 1.1
     */
    public function __construct()
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        include $root . $_COOKIE['FOLDER'] . '/Content/Conf/Config.php';
        $this->dns = $CONFIG_["DB_MYSQL"]["driver"].
                ':host='.$CONFIG_["DB_MYSQL"]["host"].
                ';dbname='.$CONFIG_["DB_MYSQL"]["database"].
                ';port='.$CONFIG_["DB_MYSQL"]["port"];
        try{
                 parent::__construct( $this->dns, 
                         $CONFIG_["DB_MYSQL"]["user"]
                        ,$CONFIG_["DB_MYSQL"]["password"]); 
                parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
                if($ex->getMessage() == "could not find driver")
                    echo "No se pudo encontrar el driver , esta desactivado ...";
        }

    }
    
    /**
     * @todo Destructor de la clase 
     * @version 1.1
     */
    function __destruct()
    {
       unset($this);
    }
    
    /**
     * @todo Cierre de conexion PDO 
     * @version 1.1
     */
    function CloseConection()
    {
       unset($this);
    }

  
    /**
     * @todo Funcion en la cual devuelve el resultado de la consulta en formatos distintos
     *       estos formatos pueden ser ARRAY , STD:CLASS O JSON
     * @param String $query consulta pl/sql 
     * @param String $out Salida de datos , por defecto un arreglo o array
     * @version 1.1
     * @return Object salida de datos tipo $out
     */
    public function GetformatQuery($query  , $out = ARRAY_OUT )
    {
        $this->query = $query;
        $arr = array();
        $this->count = 0;
     try{
        foreach(parent::query($this->query , PDO::FETCH_INTO,(object) $arr) as $obj )
        {
           
            if ($out != null) {
                switch ($out) {
                    case OBJECT_OUT:
                        array_push($arr, $obj);
                        break;
                    case JSON_OUT:
                        array_push($arr, json_encode($obj));
                        break;
                    case ARRAY_OUT:
                        $r = get_object_vars($obj);
                        array_push($arr, $r);
                        break;
                }
            } else {
                $r = get_object_vars($obj);
                array_push($arr, $r);
            }
            $this->count++;
        }
      } catch (PDOException $ex)
      {
          throw "Error al momento de realizar la consulta $ex";
      }
     
       return $arr;
    }
    
    
    /**
     * @todo funcion en la cual devuelve una consulta en formato array 
     * @param String $query pl/sql consulta
     * @param PDO:CONST $style establece el estilo de los datos a devolver 
     *                  pueden ser de tipo asociados, object, numeric , list etc..
     * @version 1.1
     * @return Array retorna un arreglo de dichos datos
     */
    public function RawQuery($query , $style = PDO::FETCH_ASSOC)
    {
        $this->query = $query;
        $this->response = parent::query($this->query);
        $result = $this->response->fetchAll($style);
        $this->count = $this->response->rowCount();
        return $result;
    }
    
    /**
     * @todo funcion en el cual devuelve cualquier sentencia sql
     *       en formato objeto PDO
     * @param String $query pl/sql
     * @version 1.1
     * @return PDO 
     */
    public function Query($query)
    {
        $this->query = $query;
        $this->response = parent::query($this->query);
        return $this->response;
    }


    /**
     * @return String devuelve la ultima sentencia construida por el usuario o la clase
     * @version 1.1
     */
    public function GetQuery()
    {
        return $this->query;
    }
    
 
    /**
     * @return int devuelve la cantidad de filas encontradas en la ultima consulta
     * @version 1.1
     */
    public function RowsCount()
    {
        return $this->count;
    }
    

    /**
     * @todo Funcion insert la cual inserta un nuevo registro en la base de datos
     * @param String $table Nombre de la tabla a insertar
     * @param Array $params parametros de la tabla a insertar
     * @version 1.1
     * 
     * <code>
     * 
     *  $params = array(
     *      "usuario"=>"rolando@gmail.com",
     *      "password"=>"1234",
     *      "activo"=>TRUE  
     * );
     * 
     *  
     *  $registro = Insert("user" , $params);
     *  if($registro) ... hacer algo
     *  
     *  //usuario , password , activo == campos 
     * 
     * </code>
     */
    public function Insert($table , $params = array())
    {
        $this->query = "INSERT INTO $table ";
        $this->query .= "(". implode(",", array_keys($params)).")";
        $this->query .= " VALUES ('" . implode("', '", array_values($params)) . "')";
        
        try{
            $IsOk = parent::exec($this->query);
            if ($IsOk >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw "Error en insertar values $ex";
        }
        return false;
    }


      /**
     * @todo Funcion Update la cual actualiza una fila de la tabla asignada
     * @param String $table Nombre de la tabla a actualizar
     * @param Array $params parametros de la tabla a insertar
     * @param String $condition condicion de la actualizacion
     * @version 1.1
     * <code>
     * 
     *  $params = array(
     *      "usuario"=>"rolando@gmail.com",
     *      "password"=>"567",
     *      "activo"=>FALSE 
     * );
     * 
     *  
     *  $actualizar = Update("user" , $params , "ID like 1");
     *  if($actualizar) ... hacer algo
     * 
     * </code>
     */
    public function Update ($table , $params = array() , $condition )
    {
        $arr_count =1;
        $this->query = "UPDATE $table SET ";
        foreach ($params as $key=>$value)
        {
            if ($arr_count != count($params)) {
                $this->query .= "$key='$value',";
            } else {
                $this->query .= "$key='$value'";
            }
            $arr_count++;
        }
        $this->query .= " WHERE $condition";
        try {
            $IsOk = parent::exec($this->query);
            if ($IsOk >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
             throw "Error al momento de actualizar $ex";
        }
        
        return false;
        
    }
    
    
      /**
     * @todo Funcion Delete la cual elimina un registro de la tabla asignada
     * @param String $table Nombre de la tabla a eliminar
     * @param String $condition condicion
     * @version 1.1
     * <code>

     *  $eliminar = Delete("user" , "ID like 1");
     *  if($eliminar) ... hacer algo
     * 
     * </code>
     */
    public function Delete($table , $condition)
    {
        $this->query = "DELETE FROM $table WHERE $condition ";
        try{
            $IsOk = parent::exec($this->query);
            if ($IsOk >= 1) {
                return true;
            } else {
                return false;
            }
            
        } catch (Exception $ex) {
            throw "Error al momento de eliminar registro $ex";
        }
        
        return false;
    }
    
    
    /**
     * @todo Busca dentro de la tabla asignada el valor o los valores
     * @param String $table tabla a buscar
     * @param String $condition condicion de la busqueda
     * @param Array $args argumentos de la busqueda 
     * @version 1.2
     * @return Array Retorna un array asociado por defecto $style = PDO::FETCH_ASSOC
     * 
     * <code>
     * 
     * $find = $conn->Find("datos", "Id = 8" , array( "nombre" , "apellido" , "edad" ););
     * 
     * 
     * $find = $conn->Find("datos", "Id = 8" , array("Nombre" => "name" , "valor"=>"value"));
     * 
     * </code>
     */
    public function Find($table , $condition , $args=array() , $style = PDO::FETCH_ASSOC)
    {
        $this->query = "SELECT ";
        if (count($args) == 0) {
            $this->query .= "* FROM ";
        } 
        else {
            if ($this->is_assoc($args)) {
                $c = count($args);
                $i = 1;
                foreach ($args as $key => $value) {
                    if ($c != $i) {
                        $this->query .= "$key AS $value ,";
                    } else {
                        $this->query .= "$key AS $value ";
                    }
                    $i++;
                }
                $this->query .= "FROM ";
            }else {
                $this->query .= implode(",", $args) . " FROM ";
            }
        }
        $this->query .= "$table WHERE $condition";
        return $this->RawQuery($this->query , $style);
    }

    
    /**
     * @todo crea una nueva transaccion
     * @deprecated since version 1.2
     * @param String $query pl/sql de la transaccion
     * @version 1.1
     */
    public function CreateTransaction($query)
    {
        $this->query = $query;
        parent::beginTransaction();
        parent::exec($this->query);
    }
    
    
    /**
     *@todo Funcion crear una transaccion de forma atualizar 
     *@version 1.2
     *@return Boolean True si se logro la transaccion 
     *
     */
    public function CreateUpdateTransaction($table , $params = array() , $condition )
    {
        $arr_count =1;
        $this->query = "UPDATE $table SET ";
        foreach ($params as $key=>$value)
        {
            if ($arr_count != count($params)) {
                $this->query .= "$key='$value',";
            } else {
                $this->query .= "$key='$value'";
            }
            $arr_count++;
        }
        $this->query .= " WHERE $condition";
        try {
            parent::beginTransaction();
            $IsOk = parent::exec($this->query);
            parent::rollBack();
            if ($IsOk >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
             throw "Error al momento de actualizar $ex";
        }
        
        return false;
    }
    

    /**
     *@version 1.1
     */
    public function RollBack()
    {
        parent::rollBack();
    }

    /**
     * @version 1.1
     */
    public function InTransaction()
    {
        return parent::inTransaction();
    }
    
    
    /**
     *@version 1.2
     *@todo Verifica si el array entrante es un array de forma soaciada y no secuencial
     */
    private function is_assoc($array) {

     foreach(array_keys($array) as $key) {
         if (!is_int($key)) return true;
     }
     return false;
    }
    
   
}
     
?>