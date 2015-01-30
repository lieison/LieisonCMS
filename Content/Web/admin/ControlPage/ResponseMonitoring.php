<?php
    include '../../../Conf/Include.php';
    
    if(!isset($_REQUEST['input'])):
        exit();
    endif;
    
    $datalog = $_REQUEST['input'];
    $date = $_REQUEST['date'] ?: null;
    
   
    switch ($datalog){
        case "io":
             echo '<table class="table table-striped table-bordered table-hover" id="io_1">'
            . '<thead><tr><th></th>';
            GetMonitorIO($datalog , $date);
            break;
        case "":
            break;
    }
        
    

?>


<?php

    function GetMonitorIO($datalog , $date )
    {
        $result = array();
        $admin_log = new AdminController();
        
        echo '<th>Usuario</th>';
        echo '<th>Hora Entrada</th>';
        echo '<th>Hora salida</th>';
        echo '<th>Fecha</th></tr></thead>';
        
        if($date != null):
           $result =  $admin_log->Show_log($date);
        else:
             $result =  $admin_log->Show_log();
        endif;
        
        if(count($result) >=1 ):
            echo "<tbody>";
            foreach ($result as $key=>$value):
                    $id = $value["id"];
                    $entrada = $value["entrada"];
                    $salida = $value["salida"];
                    $nombre = $value["nombre"];
                    $fecha = $value["fecha"];
               
                if($salida == null):
                    $salida = '<span class="label label-sm label-success">Sesion Activa</span>';
                endif;
                    
                echo '<tr class="odd gradeX">';
                echo '<td><a href="javascript:' . "eliminar('$id' , 'io');" . '"><i class="fa fa-times"></a></i>';
                echo "<td>$nombre</td>";
                echo "<td>$entrada</td>";
                echo "<td>$salida</td>";
                echo "<td>$fecha</td>";
                echo '</tr>';   
            endforeach;
            echo "</tbody></table>";
           // print_r($result);
        endif;
        
    }


?>

