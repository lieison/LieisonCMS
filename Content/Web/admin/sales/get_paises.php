<?php
 
include   '../../../Conf/Include.php';

$paises = FunctionsController::get_paises();
$values = '<select id="combo_pais" name="combo_pais" class="form-control">';
foreach ($paises as $key=>$value):
     $id = $value['id'];
     $nombre = $value['nombre'];
     if($id == 68):
            $values .= "<option selected value='$id'>$nombre</option>";
         else:
          $values .= "<option value='$id'>$nombre</option>";
     endif;
endforeach;
$values .= "</select>";
unset($paises);
echo $values; 
												
                                                                                  