<?php

/**
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2015, Rolignu
 * @version 1.5
 * @access public
 * 
 * SCRIPT DE CONFIGURACION DEL SISTEMA 
 * 
 * -CONFIGURACION PARA LAS BASES DEE DATOS:
 * 
 *          -MYSQL
 *          -SQLITE
 *          -ORACLE
 *          
 * -DIRECTORIOS
 * -ENMASCARAMIENTO .htaccess
 */



$SERVER_DIR = getcwd();
$ARRAY_DIR = explode("\\", $SERVER_DIR);
if(count($ARRAY_DIR)<=1):
       $ARRAY_DIR = explode("/", $SERVER_DIR);
endif;
$DIR_NAME = $ARRAY_DIR[count($ARRAY_DIR)-1];


$CONFIG_ = array(
    
    "DB_MYSQL" =>[
         "classname"                => '',                                     //tipo de la clase
	 'driver'                   => "mysql",                                  //driver de conexion , defecto mysql
	 'persistent'               => FALSE,                               //datos persistentes falso
	 'host'                     => "lieison.com",                            //"localhost", //"lieison.com",//hosting
	 'user'                     => "lieison_soft",                                //"root", //"lieison", //usuario
	 'password'                 => "@@Support##",                       //password de la base de datos si es requerido
	 'database'                 => "lieison_soft",                    //base de datos a utilizar
         'port'                     => "3306",                               //puerto de la base de datos si es requerido
	 'prefix'                   => FALSE,                             //uso de prefijos defecto falso
	 'encoding'                 => 'utf8',                         //codificacion utf-8 segun normalizaciones
	 'timezone'                 => 'UTC',                         //zona horaria
	 'cacheMetadata'            => FALSE,                    //uso de metadatos
         'prefix'                   => "sv_"
    ],
    
    "DB_SQLITE" => [
        "dir"                       => "$SERVER_DIR/Class/Database/sqlitedb/example.db"//direccion donde se encuentra la bdd 
    ],
    
    
    "DB_ORACLE" => [
        "host"                      =>"localhost",        //host
        "user"                      =>"",                //user
        "password"                  =>"",           //password
        "database"                  =>""           //database name
    ],
    
    "DIR" =>[
        "root"                      => $_SERVER['DOCUMENT_ROOT'] . "/",    //DIRECTORIO RAIZ 
        "directory"                 => $DIR_NAME  ,                       //DIRECTORIO 
        "server"                    => $_SERVER["SERVER_NAME"],          //NOMBRE DEL SERVIDOR WEB
        "user_agent"                => $_SERVER["HTTP_USER_AGENT"],     //USER AGENT ACTUAL
        "protocol"                  => "http://",                      //PROTOCOLO
        "folder"                    => "LieisonCMS"                   //CARPETA DE LOCALIZACION SISTEMA
    ],
    
    "MASK" => [
        "enable"                    => TRUE,        //HABILITAR ENMASCARAMIENTO
        "type"                      => "0",        //TIPO DE ENMASCARAMIENTO RewriteRule ^0/(.*)$  Content/Web/$1  [L]
        "host"                      => FALSE      //ES UN HOSTING O SERVIDOR DE PRUEBA
    ]
    

);






