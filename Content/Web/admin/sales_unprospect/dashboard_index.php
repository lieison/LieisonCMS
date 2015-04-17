<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
         include   '../../../Conf/Include.php';
           
         class BaseInstall extends Plugin\Install\InstallClass
         {
            
             public function __construct($conect_dsn = array(), $directory = null) {
                 parent::__construct($conect_dsn, $directory);
                 $this->class = new PluginController("../");
             }

            public function Install() {
             
            }
            
            public function __call($name, $arguments) {
                $this->class->name($arguments[0]);
            }
            
        }
        
        $class = new BaseInstall();
        $class->SetTable("contrato", "");
        $class->ConfigDatabases();
        $errores = $class->GetTableError();
        
        
        echo "<pre>";
        print_r($errores);
        echo "</pre>";
        
           
        
        ?>
    </body>
</html>
