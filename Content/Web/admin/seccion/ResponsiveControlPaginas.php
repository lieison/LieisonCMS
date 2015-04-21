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
       echo "<td><a class='btn btn-primary' href='edit_dashboard_page.php?id=" 
                    . $value['id'] . "&del=0'><i class='fa fa-pencil'></i></a> <a class='btn red' href='edit_dashboard_page.php?id=" 
                    . $value['id'] . "&del=1'><i class='fa fa-trash-o'></a>" . "</td>";
       echo "</tr>";
  }
  
  echo "</tbody></table>";
  
  
  