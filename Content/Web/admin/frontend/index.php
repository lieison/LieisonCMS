<?php

 include   '../../../Conf/Include.php';
 
 $header = new \Http\Header();
 
 $header->redirect("http://lieison.com");
 
$url = "http://lieison.com/wp-admin";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);  
curl_setopt($ch, CURLOPT_COOKIESESSION, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_URL, $url);
echo curl_exec($ch);
curl_close($ch);
 

 