<?php


 /**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 * 
 * 
 * 
 */
 
include   '../../../Conf/Include.php';

 set_dependencies(array(
      "ProspectController",
      "AdminController"
    ));

$exist_country = false;
if(isset($_REQUEST['country'])){
    $exist_country = true;
}
if(!isset($_REQUEST['id'])){
    $paises = FunctionsController::get_paises();
    $values = '<select id="combo_pais" name="combo_pais" class="form-control">';
    foreach ($paises as $key=>$value):
     $id = $value['id'];
     $nombre = $value['nombre'];
     if($id == 68 && $exist_country == FALSE):
            $values .= "<option selected value='$id'>$nombre</option>";
     elseif($exist_country == true && $id == $_REQUEST['country']):
          $values .= "<option selected value='$id'>$nombre</option>";
     else:
          $values .= "<option value='$id'>$nombre</option>";
     endif;
    endforeach;
    $values .= "</select>";
    unset($paises);
    echo $values; 
}else{
    $prospect = new ProspectController();
    $data = $prospect->Get_Prospect_ById($_REQUEST['id']);
    $id_pais = $data['id_pais'];
    $paises = FunctionsController::get_paises();
    $values = '<select id="combo_pais" name="combo_pais" class="form-control">';
    foreach ($paises as $key=>$value):
     $id = $value['id'];
     $nombre = $value['nombre'];
     if($id == $id_pais && $exist_country == FALSE):
            $values .= "<option selected value='$id'>$nombre</option>";
     elseif($exist_country == true && $id == $_REQUEST['country']):
          $values .= "<option selected value='$id'>$nombre</option>";
     else:
          $values .= "<option value='$id'>$nombre</option>";
     endif;
    endforeach;
    $values .= "</select>";
    unset($paises);
    echo $values; 
}
												
                                                                                  