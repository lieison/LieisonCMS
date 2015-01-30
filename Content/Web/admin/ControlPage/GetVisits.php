<?php


include '../../../Conf/Include.php';
$fontend = new FrontEndController();

date_default_timezone_set('UTC');
$anio = FunctionsController::get_year();

$visitas = $fontend->GetWebvisits($anio);

if(count($visitas) == 0):
    exit();
endif;

$arreglo_datos = array();
$i=0;
foreach ($visitas as $key=>$value):
        $numero = $value['numero'];
        $mes = $value['mes'];
        $anio = $value['anio'];
        $fecha = "$mes/$anio";
        $arreglo_datos[$i] = array($fecha , $numero);
        $i++;
endforeach;

echo json_encode($arreglo_datos);


