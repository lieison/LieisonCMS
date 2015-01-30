<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

                include  '/Conf/Include.php';
                $conn = new MysqlConection();
                $values = $conn->GetformatQuery("select * from datos" );
                $values = $conn->RawQuery("select * from datos" , PDO::FETCH_ASSOC);
                $values = $conn->Query("select * from datos" );
                
                 echo "<pre>";
                print_r($values);
                echo "</pre>";
                
                $find = $conn->Find("datos", "Id = 8" , array("Nombre" => "name" , "valor"=>"value"));
              
                
                echo"<br><br><br><pre>";
                print_r($find);
                echo"</pre>";