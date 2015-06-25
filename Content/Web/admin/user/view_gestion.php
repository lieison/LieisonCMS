<?php

    $header = new Http\Header();
    $adminc = new AdminController();
    
    if(isset($_POST['guardar_superpermisos']) && isset($_POST['txt_superpermisos'])):
        if(!\SivarApi\Tools\Validation::Is_Empty_OrNull($_POST['txt_superpermisos'])):
             $nombre_rol = $_POST['txt_superpermisos'];
             $is_ok = $adminc->add_rols($nombre_rol);
                if($is_ok):
                    echo "<script>alert('Se agrego nuevo privilegio');</script>";
                else:
                    echo "<script>alert('No se pudo agregar el nuevo privilegio');</script>";
               endif; 
        endif;
    elseif(isset($_POST['cmd_padre_guardar']) && isset($_POST['txt_namehijo'])):
                $nombre_rol_hijo = $_POST['txt_namehijo'];
                $opt_padre = $_POST['opt_padre'];
                $is_ok = $adminc->add_rols($nombre_rol_hijo , $opt_padre);
                if($is_ok):
                    echo "<script>alert('Se agrego nuevo privilegio hijo');</script>";
                else:
                    echo "<script>alert('No se pudo agregar el nuevo privilegio hijo');</script>";
                endif;
    elseif(isset($_REQUEST['id_rol'])):
           $is_ok = $adminc->delete_rols($_REQUEST['id_rol']);
            if($is_ok):
                    echo "<script>alert('Se ha eliminado el privilegio');</script>";
                    $header->redirect("dashboard_gestion_usuarios.php");
                else:
                    echo "<script>alert('Error al eliminar el privilegio');</script>";
                endif;
     else:
        $priv = $adminc->get_permission_page($rol, FunctionsController::get_actual_page());
        if(!$priv):
            $header->redirect("index.php");
        endif;
    endif;
    

?>

<div class="row">
                              <!-- PRIMERA TABLA ENTRADA Y SALIDA -->
                                <div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Control De Usuarios 
							</div>
						
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<button id="nuevo_usuario" class="btn green">
											Nuevo Usuario <i class="fa fa-plus"></i>
											</button>
                                                                                    <div class="alert-info" id="alertas_usuarios"></div>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="tabla_usuarios_">
							<thead>
							<tr>
								<th>
									 Usuario
								</th>
								<th>
									 Nombre
								</th>
								<th>
									 E-Mail
								</th>
								<th>
									 Privilegios
								</th>
								<th>
									 Estado
								</th>
								<th>
									 Editar
								</th>
                                                                <th>
									 Eliminar
								</th>
                                                                <th>
									 
								</th>
                                                                <th>
									 User Key
								</th>
							</tr>
							</thead>
                                                        <tbody>
							<?php
                                                            $datos_usuario = $adminc->Get_Users();
                                                            foreach ($datos_usuario as $key=>$value):
                                                                echo "<tr>";
                                                                foreach ($value as $k=>$v):
                                                                    switch ($k)
                                                                    {
                                                                        
                                                                        case "activo":
                                                                            if($v == 0):
                                                                                echo "<td>Desactivado</td>";
                                                                            else:
                                                                                 echo "<td>Activo</td>";
                                                                            endif;
                                                                            break;
                                                                         case "id_usuario":
                                                                         case "id_login":
                                                                            break;   
                                                                        default:
                                                                            echo "<td>$v</td>";
                                                                            break;
                                                                    }
                                                                endforeach;
                                                                echo '<td><a class="edit" href="javascript:;">Editar</a></td>';
                                                                echo '<td><a class="delete" href="javascript:;">Eliminar</a></td>';
                                                                echo '<td><a class="desactivate" href="javascript:;"></a></td>';
                                                                $id_u = $value['id_usuario'];
                                                                $id_log = $value['id_login'];
                                                                echo '<td>'. $id_u. ',' . $id_log . '</td>';
                                                                echo "</tr>";
                                                            endforeach;
                                                        ?>
                                                        </tbody>
							</table>
						</div>
					</div>
				</div>
                              <!-- FIN DE LA PRIMERA TABLA -->
                                <!-- SEGUNDA TABLA ENTRADA Y SALIDA -->
                                <div class="col-md-6">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Control De Super Permisos
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
                                                                    <form class="form-inline" method="POST" role="form" name="frm_priv" id="frm_priv">
									<div class="col-md-6">
										<div class="form-group">
                                                                                    <input type="text" name="txt_superpermisos" class="form-control input-sm" value="" placeholder="Nuevo Privilegio">
                                                                                    <input type="submit" name="guardar_superpermisos" class="btn btn-primary" value="Guardar">
                                                                                    <div class="alert-info" id="alertas_usuarios"></div>
										</div>
									</div>
                                                                    <div class=""clearfix></div>
                                                                    </form>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="tabla_usuarios_">
							<thead>
							<tr>
								<th>
									 Privilegios
								</th>
								<th>
									 Nivel
								</th>
								<th>
									
                                                                </th>
							</tr>
							</thead>
                                                        <tbody>
							<?php
                                                            $rols = $adminc->get_master_rols();
                                                            if(SivarApi\Tools\Validation::Is_Empty_OrNull($rols)):
                                                                echo "<tr><td>ERROR AL MOSTRAR LOS DATOS</td></tr>";
                                                                echo "<tr><td>ERROR AL MOSTRAR LOS DATOS</td></tr>";
                                                                echo "<tr><td>ERROR AL MOSTRAR LOS DATOS</td></tr>";
                                                            endif;
                                                            foreach ($rols as $key=>$value):
                                                                echo "<tr>";
                                                                foreach ($value as $k=>$v):
                                                                    switch ($k)
                                                                    {
                                                                        
                                                                        case "id_privilegios":
                                                                        case "padre":
                                                                            break;
                                                                        default:
                                                                            echo "<td>$v</td>";
                                                                            break;
                                                                    }
                                                                endforeach;
                                                                $id_u = $value['id_privilegios'];
                                                                if($value['nombre'] != "admin"):
                                                                      echo '<td><a class="delete" href="dashboard_gestion_usuarios.php?id_rol=' . $id_u . '">Eliminar</a></td>';
                                                                else:
                                                                    echo "<td>Irrevocable</td>";
                                                                endif;
                                                                echo "</tr>";
                                                            endforeach;
                                                        ?>
                                                        </tbody>
							</table>
						</div>
					</div>
				</div>
                                <div class="col-md-6">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Control De Permisos Hijos 
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
                                                                            <form  name="frm_subpriv" id="frm_subpriv" action="dashboard_gestion_usuarios.php" method="POST">
										<div class="form-group">
                                                                                    <input type="text" name="txt_namehijo" class="form-control input-sm" value="" placeholder="Nombre Privilegio">
                                                                                    <br>
                                                                                    <select name="opt_padre" class="form-control">
                                                                                        <?php
                                                                                        
                                                                                            $rols = $adminc->get_master_rols();
                                                                                            foreach ($rols as $k=>$v):
                                                                                                $idp = $v['nivel'];
                                                                                                $nombrep = $v['nombre'];
                                                                                                echo "<option value='$idp'>$nombrep</option>";
                                                                                            endforeach;
                                                                                        ?>
                                                                                    </select>
                                                                                     <br>
                                                                                    <input type="submit" name="cmd_padre_guardar" class="btn btn-primary" value="Guardar">
                                                                                    <div class="alert-info" id="alertas_usuarios"></div>
										</div>
                                                                            </form>
									</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="tabla_usuarios_">
							<thead>
							<tr>
								<th>
									 Privilegios
								</th>
								<th>
									 Nivel
								</th>
								<th>
									Padre
                                                                </th>
                                                                <th></th>
							</tr>
							</thead>
                                                        <tbody>
							<?php
                                                            $rols = $adminc->get_master_rols(false);
                                                            if(SivarApi\Tools\Validation::Is_Empty_OrNull($rols)):
                                                                echo "<tr><td>No Hay datos !!</td></tr>";
                                                            else:
                                                                foreach ($rols as $key=>$value):
                                                                echo "<tr>";
                                                                foreach ($value as $k=>$v):
                                                                    switch ($k)
                                                                    {
                                                                        
                                                                        case "id_privilegios":
                                                                            break;
                                                                        default:
                                                                            echo "<td>$v</td>";
                                                                            break;
                                                                    }
                                                                endforeach;
                                                                $id_u = $value['id_privilegios'];
                                                                echo '<td><a class="delete" href="dashboard_gestion_usuarios.php?id_rol=' . $id_u . '">Eliminar</a></td>';
                                                                echo "</tr>";
                                                            endforeach;
                                                            endif;
                                                        
                                                        ?>
                                                        </tbody>
							</table>
						</div>
					</div>
				</div>
                              <!-- FIN DE LA SEGUNDA TABLA -->
			</div>