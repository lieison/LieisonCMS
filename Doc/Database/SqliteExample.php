<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include  '/Conf/Include.php';
    $sqlite = new SQLite3Database();
                $sqlite->connect();
              
                $sqlite->insert("user", array(
                    "user_name"=> "user" .rand(0, 100),
                     "password"=>"125445li",
                     "state"=>1
                   ));
                        
                print_r($sqlite->get_rows("select * from user" , true));   