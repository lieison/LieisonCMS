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
 */

  include   '../../../Conf/Include.php';
  
  $page = new PageController();
  
  
 $datos = '<div class="input-group col-md-12">';
            $datos .= "<input  type='text' class='form-control' value='' placeholder='Titulo' id='seccion_titulo' />";
            $datos .= "<br><input type='text' class='form-control' value='' placeholder='Fa fa  Icono' id='seccion_icono' />";
            
 
  $numeros = array_values(array_unique( $page->get_numbers_seccion()));       
  
  $datos .= '<div class="dropdown">';
  $datos .= "<select class='form-control'  id='seccion_numero'>";
  $datos .= "<option>Seleccione un numero de nivel</option>";
  for($i=0; $i< 20 ; $i++)
  {
      if(count($numeros) > $i){
        if($numeros[$i] == ($i+1))
        {
          $datos .= "<option class='alert alert-warning' value='$i'>" . ($i+1) . " (alerta )Numeros Utilizados </option>";
        }else{
           $datos .= "<option value='$i'>" . ($i+1) . "</option>";
        }
     }else
     {
         $datos .= "<option value='$i'>" . ($i+1) . "</option>";
     }
  }
  $datos .= "</select>";
  $datos .= "</div>";
  
  unset($page);
  
  $admin = new AdminController();
  $privilegios = $admin->Get_MasterPrivilegios();
  
  $datos .= '<div class="dropdown">';
  $datos .= "<select class='form-control'  id='seccion_privilegio'>";
  $datos .= "<option>Seleccione el permiso para la seccion </option>";
  
  foreach($privilegios as $key=>$value)
  {
      $nivel = $value['nivel'];
      $nombre = $value['nombre'];
      $datos .= "<option value='$nivel'>$nombre</option>";
  }
  
  $datos .= "</select>";
  $datos .= "</div>";
  
  $datos .= '<div class="btn-group-horizontal">';
  $datos .= '<div class="alert alert-success" role="alert">Todos estos campos son necesarios, favor llenarlos </div>';
  $datos .= ' <button type="button" onclick="set_seccion();" class="btn btn-primary">Guardar Seccion</button>';
  $datos .= ' <button type="button" onclick="restaurar_seccion();" class="btn btn-primary">Regresar/Cancelar</button>';
  $datos .= '</div>';
  $datos .= '</div>';  
            
  echo $datos;

