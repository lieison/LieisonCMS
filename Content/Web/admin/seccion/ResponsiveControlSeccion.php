<?php

  include '../../../Conf/Include.php';
  
   set_dependencies(array(
      "PageController",
      "AdminController"
  ));


  $pagecontroller = new PageController();
  $pages = $pagecontroller->get_seccion_dashboard(2);

  echo "<thead>";
  echo '<th></th>';
  echo '<th>Nombre</th>';
  echo '<th>Inicio</th>';
  echo '<th>Privilegios</th>';
  echo '<th>Estado</th>';
  echo '<th></th>';
  echo '</tr></thead>';
  
  echo '<tbody>';
  
   foreach ($pages as $key=>$value)
  {
       echo '<tr class="odd gradeX">';
       echo "<td><span class='" . $value['icono'] . "'></span></td>";
       echo "<td>" . $value['titulo'] . "</td>";
       echo "<td>" . $value['numero'] . "</td>";
       echo "<td>" . $pagecontroller->ConvertPrivToString($value['privilegios']) . "</td>";
       if($value['status'] == 1 ){
            echo "<td>Activo</td>";
       }else{
           echo "<td>No Activo</td>";
       }
       echo "<td><a class='btn btn-primary' href='edit_dashboard_seccion.php?id=" 
                    . $value['id_seccion'] . "'><i class='fa fa-pencil'></i></a> <a class='btn green' href='add_dashboard_seccion.php?id=" 
                    . $value['id_seccion'] . "" . "'><i class='fa fa-check'></a>" . "</td>";
       echo "</tr>";
  }
  
  echo "</tbody>";
  