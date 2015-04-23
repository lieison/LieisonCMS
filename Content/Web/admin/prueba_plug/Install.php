<?php


class BaseInstall extends \Plugin\Install\InstallClass{
    
    var $path_plugin    = null;
    
    public function __construct($conect_dsn = array(), $directory = null) {
        $this->class = new PluginController("../");
        parent::__construct($conect_dsn, $directory);
    }
    
    
    public function  SetPath($path){
        $this->path_plugin = $path;
    }
    
    public function Install() {
        
        //INSTALAMOS LAS TABLAS QUE USAREMOS EN EL MODULO
        parent::SetTable(
                "Prueba_usuario",
                array(
                     "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                     "firstname VARCHAR(30) NOT NULL",
                     "lastname VARCHAR(30) NOT NULL"
                ));
        
        parent::SetTable(
                "Prueba_log",
                array(
                     "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
                     "log VARCHAR(30) NOT NULL",
                     "title VARCHAR(30) NOT NULL"
                ));
        
        //FIN DE LA INSTALACION
        
        //EJECUTAMOS QUERYS DE LAS QUE PODRIAN OBTENER INFORMACION POR DEFECTO 
        //ASI COMO PROCEDIMIENTOS ALMACENADOS , INSERT UPDATE O DELETE
        parent::SetQuery("Insert Into Prueba_usuario (firstname , lastname) VALUES ('rolando' , 'arriaza');");
        parent::SetQuery("Insert Into Prueba_usuario (firstname , lastname) VALUES ('ramon' , 'arriaza');");
      
       
        //VERIFICAMOS LA CONFIGURACION DE LA CLASE config.json
        $config = $this->class->GetConfigPlugin($this->path_plugin . "");
       
        
        //NOS DEVUELVE UN OBJETO JSON DECODE
        if(!is_object($config)){
             return "Error , No existe archivo de configuracion ...";
        }
        
        //VERIFICAMOS SI EL PLUGIN SE HIZO UNA INSTALACION 
        //SOLO POR SEGURIDAD , ES REDUNDANTE PERO UNO NUNCA SABE
        if($config->install == "true"){
             return "Modulo ya se ha instalado ...";
        }

        //COMIENZA LA INSTALACION ...
        //parent::ConfigDatabases(); //CONFIGURA LA DATABASE
       // parent::MysqlInstallTables(); //VERIFICA E INSTALA LAS TABLAS NECESARIAS
       // parent::MysqlInstallQuerys(); //INSTALA LAS QUERYS
       

        //VERIFICA SI NO EXISTE ALGUN ERROR 
        $error = $this->EchoError();
        if(count($error)>= 1){
            return $error;
        }
        
        //VERIFICAMOS SI EXISTE ALGUN MODELO Y CONTROLADOR DEPENDE DE LA CONFIGURACION
        
       /* if($config->model != "null" && $config->model != null){
            $model = $config->model;
           $this->class->InstallModel($model , $this->path_plugin);
        }
        
        if($config->controller != "null" && $config->controller != null){
            $controler = $config->controller;
            $this->class->InstallController($controler , $this->path_plugin);
        }*/
        
        

        //INSTALAMOS EL DASHBOARD EL MODULO
      /*  $this->class->SetDashboard
        (
                "5",
                "fa fa-plug" ,
                "prueba_plug/dashboard_index.php" ,
                "PRUEBA MODULO" , 
                "3" ,
                "55" 
        );*/
      
        //CONFIGURAMOS COMO INSTALADO EL MODULO
        //$config->install = "true";
       // $this->class->SetNewConfig($config ,$this->path_plugin);
   
        return true;
        
    }
    
    private function EchoError(){
        return parent::GetError();
    }

    public function Unistall() {
        
    }
    
    public function __call($name, $arguments) {
         $this->class->name($arguments[0]);
    }
  
}



