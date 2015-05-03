<?php

include   '../../../../Conf/Include.php';

$name = $_REQUEST['name'] ? : null;
$url = $_REQUEST['url'] ? : null;

$json = new \SivarApi\Tools\Services_JSON();
$json_stack = null;

$stack = $_REQUEST['stack'] ? : null;

if($stack == null || $stack == '""'){
    
    $json_stack = $json->encode( 
            array(
                "name"  => $name , 
                "url"   => $url
            ));
    
    echo "[" . $json_stack . "]";
    exit();      
}else{

    $json_stack = json_decode($stack , true);
    $json_stack[] = array(
                "name"  => $name , 
                "url"   => $url
            );
    echo $json->encode($json_stack);
    exit();
}




