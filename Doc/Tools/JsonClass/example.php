<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

     include  '/Conf/Include.php';
                
               
                $jason_ = new \SivarApi\Tools\Json_class();
                $jason_->JsonFile('file/example.json');
                print_r($jason_->GetDecodeJsonFile());
                