<?php

include '../../../Conf/Include.php';


$pagecontroller = new PageController();
$pages = $pagecontroller->get_dashboard_database();


  echo '<table class="table table-striped table-bordered table-hover" id="io_1">'
            . '<thead><tr>';
  
  echo '<th></th>';
  echo '<th>Nombre</th>';
  echo '<th>Pagina</th>';
  echo '<th>Seccion</th>';
  echo '<th>Privilegios</th>';
  echo '<th></th>';
  echo '</tr></thead>';
  
  echo '<tbody>';
 
  
  foreach ($pages as $key=>$value)
  {
       echo '<tr class="odd gradeX">';
       echo "<td><span class='" . $value['icono'] . "'></span></td>";
       echo "<td>" . $value['dash_titulo'] . "</td>";
       echo "<td>" . $value['link'] . "</td>";
       echo "<td>" . $value['sec_titulo'] . "</td>";
       echo "<td>" . $value['priv_nombre'] . "</td>";
       echo "<td><a href='ViewPage/EditControlPage.php?id=" 
                    . $value['id'] . "'>Editar</a>  | <a href='dashboard_control_paginas.php?id=" 
                    . $value['id'] . "&accion=1'>Eliminar</a>" . "</td>";
       echo "</tr>";
  }
  
  echo "</tbody></table>";
  
  
  