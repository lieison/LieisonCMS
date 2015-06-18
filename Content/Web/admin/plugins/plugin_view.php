
<?php
 $path_origin = "../";
 
 $plugin = new PluginController($path_origin);
 $modules = $plugin->GetAllModules();
 $count = count($modules);
 
 /*echo "<pre>";
 print_r($modules);
 echo "</pre>";*/

?>

<div class="row">
        <div class="col-md-12">
        <div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Instala un Nuevo Modulo</h3>
						</div>
						<div  class="panel-body">
                                            <form id="fileupload" action="UploadPlugin.php" method="POST" enctype="multipart/form-data">
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn green fileinput-button">
								<i class="fa fa-plus"></i>
								<span>
                                                                    Buscar Modulo </span>
                                                                <input type="file" name="plugin" id="plugin" multiple="">
								</span>
								<button type="submit" class="btn blue start">
								<i class="fa fa-upload"></i>
								<span>
                                                                    Iniciar Subida </span>
								</button>
							</div>
                                                   
                                                        <?php
                                                        
                                                            if(isset($_REQUEST['error'])):
                                                             
                                                                if($_REQUEST['error'] == "nofile"):
                                                                    echo '<br><br><br><div align="center" class="alert alert-success" role="alert"><i class="fa fa-exclamation"></i> ARCHIVO INCORRECTO</div>';
                                                                elseif($_REQUEST['error'] == "noupload"):
                                                                     echo '<br><br><br><div align="center" class="alert alert-success" role="alert"><i class="fa fa-exclamation"></i> EL ARCHIVO NO SE PUDO SUBIR</div>';
                                                                endif;
                                                                
                                                            endif;
                                                        
                                                        ?>
                                                    
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped clearfix">
						<tbody class="files">
						</tbody>
						</table>
					</form>
						</div>
					</div>
        
    </div>
  
    
	<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plug"></i>
                                                                <?php 
                                                                   if($count == 1){
                                                                       echo  $count . " Modulo Encontrado";
                                                                   }else{
                                                                       echo  $count . " Modulos Encontrados";
                                                                   }
                                                                
                                                                ?>
                                                                
							</div>
							
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 Modulo
									</th>
									<th>
										 Directorio
									</th>
									<th>
										 Estado
									</th>
									<th>
										 Version
									</th>
                                                                        <th>
										
									</th>
								</tr>
								</thead>
								<tbody>
								
                                                                    <?php

                                                                      for($i=0; $i< $count ; $i++):
                                                                          
                                                                          $root = $modules[$i]['root'];
                                                                          $name = $modules[$i]['decode']->name;
                                                                          $install =  $modules[$i]['decode']->install;
                                                                          $version = $modules[$i]['decode']->version;
                                                                          $actions = "<button title='Eliminar Modulo' type='button'  class='btn btn-warning' onclick='deletemodule(" . '"' . $root . '"' .");'>" 
                                                                                  . '<i class="fa fa-trash-o"></i>' . "</button>";
                                                                          
                                                                          echo "<tr>";
                                                                          echo "<td>" . ($i+1) . "</td>";
                                                                          echo "<td>$name</td>";
                                                                          echo "<td>$root</td>";
                     
                                                                          if( $install == "true"):
                                                                               echo "<td>Instalado</td>";
                                                                                $actions .= "<button title='Desinstalar Modulo' type='button' class='btn btn-primary' onclick='unistall(" . '"' . $root . '"' .");'>" 
                                                                                  . '<i class="fa fa-long-arrow-down"></i>' . "</button>";
                                                                          else:
                                                                               echo "<td>No Instalado</td>";
                                                                               $actions .= "<button title='Instalar Modulo ' type='button' class='btn btn-primary' onclick='install(" . '"' . $root . '"' .");'>" 
                                                                                  . '<i class="fa fa-long-arrow-up"></i>' . "</button>";
                                                                          endif;
    
                                                                          echo "<td>$version</td>";
                                                                          
                                                                          echo "<td>$actions</td>";
                                                                          
                                                                          
                                                                          echo "</tr>";
                                                                          
                                                                      endfor;
                                                                    
                                                                    ?>
								
								</tbody>
								</table>
                                                                
							</div>
                                                    <div align='center' id="action_plugins"></div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>

    	
			
			</div>
