<?php

/**
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2015, Rolignu
 * @version 1.0
 * @access public
 * 
 * SCRIPT CONFIG EN EL CUAL SE EJECUTA TODAS LAS CONFIGURACIONES
 * DE LA BASES DE DATOS EN DADO CASO EXISTA DE FORMA RELATIVA
 * 
 * 
 */
$FOLDER_ = null;
$SERVER_DIR = getcwd();
$ARRAY_DIR = explode("\\", $SERVER_DIR);
$DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];

if(!is_array($ARRAY_DIR)):
     $ARRAY_DIR = explode("/", $SERVER_DIR);
 endif;
 $DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];

/**
 * verifica si la cookie FOLDER existe en dado caso
 * no exita eliminar dicha condicion o dejarla (No importa ), agregando el folder 
 * inicial manualmente  $FOLDER_ = "SivarPlugin";
 */
if (isset($_COOKIE['FOLDER'])) {
    $FOLDER_ = $_COOKIE['FOLDER'];
} else {
    $FOLDER_ = "LieisonCMS";
}

$CONFIG_ = array(
    
    "DB_MYSQL" =>[
         "classname" => '',//tipo de la clase
	 'driver' => "mysql",//driver de conexion , defecto mysql
	 'persistent' => false,//datos persistentes falso
	 'host' => "lieison.com",//hosting
	 'user' => "lieison", //usuario
	 'password' => "Lieison2014",//password de la base de datos si es requerido
	 'database' => "lieison_soft", //base de datos a utilizar
         'port' => "3306", //puerto de la base de datos si es requerido
	 'prefix' => false, //uso de prefijos defecto falso
	 'encoding' => 'utf8',//codificacion utf-8 segun normalizaciones
	 'timezone' => 'UTC',//zona horaria
	 'cacheMetadata' => true,//uso de metadatos
         'prefix'=> "sv_"
    ],
    
    "DB_SQLITE" => [
        "dir"=> "$SERVER_DIR/Class/Database/sqlitedb/example.db"//direccion donde se encuentra la bdd 
    ],
    
    
    "DB_ORACLE" => [
        "host"=>"localhost",//host
        "user"=>"",//user
        "password"=>"",//password
        "database"=>""//database name
    ],
    
    "DIR" =>[
        "root"=> $_SERVER['DOCUMENT_ROOT'],
        "directory"=> $DIR_NAME  ,
        "server" => $_SERVER["SERVER_NAME"],
        "user_agent"=> $_SERVER["HTTP_USER_AGENT"],
        "protocol" => "http://"
    ],
    
    "APP_FOLDER" => $FOLDER_ ?: "LieisonCMS"
     
)



?>



