<?php

if(!function_exists("set_dependencies")){

    function set_dependencies(array $controllers ){

          $dir_controller       = \Url\Url::GetRootUrl("Controllers" , true) ;


          foreach($controllers as $values){

               $depend = $dir_controller . $values . ".php";

               if(file_exists($depend)){
                    include $depend;
               }

          }


    }

}
