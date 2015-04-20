<?php

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

