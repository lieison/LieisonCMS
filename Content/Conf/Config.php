<?php

/**
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2015, Rolignu
 * @version 1.5
 * @access public
 * 
 * SCRIPT DE CONFIGURACION DEL SISTEMA 
 * ACA SE REALIZAN TODA CONFIGURACION DE LA API EN CUANTO DIRECCIONES 
 * O RUTAS DESDE LAS CONFIGURACIONES DE LAS BASES DE DATOS
 * 
 * 
 */



$SERVER_DIR = getcwd();
$ARRAY_DIR = explode("\\", $SERVER_DIR);
if(count($ARRAY_DIR)<=1):
       $ARRAY_DIR = explode("/", $SERVER_DIR);
endif;
$DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];


$CONFIG_ = array(
    
    "DB_MYSQL" =>[
         "classname" => '',//tipo de la clase
	 'driver' => "mysql",//driver de conexion , defecto mysql
	 'persistent' => false,//datos persistentes falso
	 'host' => "lieison.com",//"localhost", //"lieison.com",//hosting
	 'user' =>"lieison", //"root", //"lieison", //usuario
	 'password' =>"Lieison2014", // "" ,//"Lieison2014",//password de la base de datos si es requerido
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
        "root"          => $_SERVER['DOCUMENT_ROOT'] . "/",
        "directory"     => $DIR_NAME  ,
        "server"        => $_SERVER["SERVER_NAME"],
        "user_agent"    => $_SERVER["HTTP_USER_AGENT"],
        "protocol"      => "http://",
        "folder"        => "LieisonCMS"
    ],
    
    "MASK" => [
        "enable" => TRUE,
        "type"   => "0",
        "host"   => FALSE
    ]
    

);


?>



