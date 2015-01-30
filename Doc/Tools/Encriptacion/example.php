<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 include  '/Conf/Include.php';
                
               
                $encript = new SivarApi\Tools\Encriptacion\Encriptacion();
                $text_encript = "THIS IS MY PASSWORD BABY ";
                $encript->CrearLLave(false , "PrivateKeyecnryptmd00012250");
                $text_encript = $encript->encrypt($text_encript);
                echo "Encriptado con exito ...<br><br>";
                $text_decrypt = $encript->decrypt($text_encript);
                echo "Descriptando resultado: $text_decrypt";
                
                