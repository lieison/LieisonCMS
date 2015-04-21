<?php

    $session = Session::GetSession("login");
    $usuario = $session['user'];
    $rol = $session['rol'];
    $nombre = $session['nombre'];
    $mail = $session['email'];
    $activo = $session['activo'];
    $id_user = $session['id'];
    $imagen =  $session['imagen'];
    
    $user_controller = new UserController($id_user);
    $header = new \Http\Header();
     
   if(isset($_REQUEST['avatar_guardar'])):
        $is_save =$user_controller->SetNew_Avatar(FunctionsController::GetRootUrl("admin/img/users"), "avatar_imagen");
        if(!$is_save):
            echo "<script>alert('Imposible subir la imagen intente de nuevo mas tarde ...');</script>";
        else:
            $_SESSION['login']['imagen'] = $user_controller->get_file_name();
            $imagen =  $_SESSION['login']['imagen'];
        endif;
    elseif(isset($_REQUEST['usuario_datos'])): 
         $campos = array(
             "telefono"=>$_REQUEST['txt_telefono'],
             "celular"=>$_REQUEST['txt_celular']
            );
         $user_controller->Update_user($campos);
    elseif(isset($_REQUEST['id_contrato'])):
        $user_controller->set_contract($_REQUEST['id_contrato']); 
    elseif(isset($_REQUEST['password_enviar'])):
        $is_ok = $user_controller->Get_Password($_REQUEST['txt_current_pass'], $_REQUEST['txt_new_pass']);
        if(!$is_ok):
            $a=1;
        else:
            $a=2;
        endif;
    endif;
    
?>

<div class="row margin-top-20">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		<div class="profile-sidebar">
		<!-- PORTLET MAIN -->
		<div class="portlet light profile-sidebar-portlet">
		<!-- SIDEBAR USERPIC -->
		<div class="profile-userpic">
                    <img src="../img/users/<?php echo $imagen;  ?>" class="img-responsive" alt="">
		</div>
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                            <?php echo $nombre; ?>
                    </div>
		<div class="profile-usertitle-job">
			<?php echo $rol; ?>
		</div>
		</div>
		<!-- END SIDEBAR USER TITLE -->
		<!-- SIDEBAR BUTTONS -->
		<div class="profile-userbuttons">
                    <a href="../ControlPage/LogoutPage.php" class="btn btn-circle green-haze btn-sm">Cerrar Sesion</a>
                    <a href="../lock.php" class="btn btn-circle btn-danger btn-sm">Bloquear Pantalla</a>
		</div>
		<!-- END SIDEBAR BUTTONS -->
		<!-- SIDEBAR MENU -->
							<div class="profile-usermenu">
								<ul class="nav">
									<li>
										<a href="extra_profile.html">
										<i class="icon-home"></i>
										Overview </a>
									</li>
									<li class="active">
										<a href="extra_profile_account.html">
										<i class="icon-settings"></i>
										Account Settings </a>
									</li>
									<li>
										<a href="page_todo.html" target="_blank">
										<i class="icon-check"></i>
										Tasks </a>
									</li>
									<li>
										<a href="extra_profile_help.html">
										<i class="icon-info"></i>
										Help </a>
									</li>
								</ul>
							</div>
							<!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
    <!-- PORTLET MAIN -->
       <div class="portlet light">
						
            <div>
		<h4 class="profile-desc-title">About Marcus Doe</h4>
		<span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
		<div class="margin-top-20 profile-desc-link">
		<i class="fa fa-globe"></i>
		<a href="http://www.keenthemes.com">www.keenthemes.com</a>
		</div>
		<div class="margin-top-20 profile-desc-link">
		<i class="fa fa-twitter"></i>
		<a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
		</div>
		<div class="margin-top-20 profile-desc-link">
		<i class="fa fa-facebook"></i>
		<a href="http://www.facebook.com/keenthemes/">keenthemes</a>
		</div>
            </div>
	</div>
	<!-- END PORTLET MAIN -->
	</div>
	<!-- END BEGIN PROFILE SIDEBAR -->
	<!-- BEGIN PROFILE CONTENT -->
	<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">TU CUENTA</span>
                                                                                        
										</div>
                                                                               
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">Informacion Personal</a>
											</li>
											<li>
												<a href="#tab_1_2" data-toggle="tab">Cambiar Avatar</a>
											</li>
											<li>
												<a href="#tab_1_3" data-toggle="tab">Cambiar Contraseña</a>
											</li>
											<li>
												<a href="#tab_1_4" data-toggle="tab">Otros</a>
											</li>
										</ul>
                                                                            
									</div>
									<div class="portlet-body">
                                                                            <?php
                                                                                                    if(isset($a)):
                                                                                                        if($a==1):
                                                                                                            echo ' <div class="alert alert-danger" role="alert">
                                                                                                                   La contraseña actual es incorrecta, intenta de nuevo.
                                                                                                                </div>';
                                                                                                        elseif($a==2):
                                                                                                             echo ' <div class="alert alert-success" role="alert">
                                                                                                                   Contraseña cambiada con exito
                                                                                                                </div>';
                                     
                                                                                                        endif;
                                                                                                    endif;
                                                                                                  
                                                                               ?>
										<div class="tab-content">
                                                                                    <?php
                                                                                        //obteniendo datos del usuario
                                                                                       $data_user =$user_controller->Get_DataUser();
                                                                                       $data_login = $user_controller->get_login();

                                                                                    ?>
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
												<form role="form" action="#">
													<div class="form-group">
														<label class="control-label">Nombres</label>
                                                                                                                <input  disabled="true" value="<?php echo $data_user['nombre']; ?>" type="text" placeholder="" class="form-control" id="txt_nombre" name="txt_nombre"/>
													</div>
													<div class="form-group">
														<label class="control-label">Apellidos</label>
														<input disabled="true" value="<?php echo $data_user['apellido'];  ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Dui</label>
														<input disabled="true" value="<?php echo $data_user['dui'];  ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Nit</label>
														<input disabled="true" value="<?php echo $data_user['nit'];  ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Telefono</label>
                                                                                                                <input name="txt_telefono" maxlength="8" value="<?php echo $data_user['telefono'];  ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Celular</label>
                                                                                                                <input name="txt_celular" maxlength="8" value="<?php echo $data_user['celular'];  ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Usuario</label>
														<input disabled="true" value="<?php echo $data_login['user']; ?>" type="text" placeholder="" class="form-control"/>
													</div>
													<div class="margiv-top-10">
                                                                                                            <input type="submit"  class="btn green-haze" name="usuario_datos" id="usuario_datos" value="Guardar Cambios" />
	
													</div>
												</form>
											</div>
											<!-- END PERSONAL INFO TAB -->
											<!-- CHANGE AVATAR TAB -->
											<div class="tab-pane" id="tab_1_2">
												
                                                                                                <form action="#" role="form" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                           
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                                                            <img src="../img/users/<?php echo $imagen; ?>" alt=""/>
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
															</div>
															<div>
																<span class="btn default btn-file">
																<span class="fileinput-new">
                                                                                                                                Seleccionar Imagen</span>
																<span class="fileinput-exists">
																Cambiar </span>
                                                                                                                                    <input type="file" id="avatar_imagen" name="avatar_imagen" />
																</span>
																<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
																Remover </a>
															</div>
														</div>
														
													</div>
													<div class="margin-top-10">
                                                                                                            <input type="submit" value="Guardar" class="btn green-haze" id="avatar_guardar" name="avatar_guardar" />
														
														<a href="#" class="btn default">
														Cancelar </a>
													</div>
												</form>
											</div>
											<!-- END CHANGE AVATAR TAB -->
											<!-- CHANGE PASSWORD TAB -->
											<div class="tab-pane" id="tab_1_3">
                                                                                            <form action="index.php" method="post">
                                                                                                
													<div class="form-group">
														<label class="control-label">Contraseña Actual</label>
                                                                                                                <input name="txt_current_pass" type="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Nueva Contraseña</label>
                                                                                                                <input name="txt_new_pass"  id="txt_new_pass" type="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Repetir Nueva Contraseña</label>
                                                                                                                <input name="txt_new_pass2"  id="txt_new_pass2" type="password" class="form-control" onkeyup="comparar();"/>
													</div>
                                                                                                    <div class="margin-top-10" id="cmd_password">
                                                                                                        <input type="submit" name="password_enviar"   value="Cambiar Contraseña" class="btn green-haze" />
													</div>
												</form>
											</div>
											<!-- END CHANGE PASSWORD TAB -->
											<!-- PRIVACY SETTINGS TAB -->
                                                                                         <?php
                                                                                            
                                                                                              $contrato = $user_controller->find_contract(FunctionsController::GetRootUrl("admin/files/manifiest"));
                                                                                    
                                                                                            
                                                                                            ?>
                                                                                        
											<div class="tab-pane" id="tab_1_4">
                                                                                            <label>Tus Contratos</label>
													<table class="table table-light table-hover">
													
                                                                                                            <?php
                                                                                                            
                                                                                                              if(count($contrato) == 0):
                                                                                                                  echo "<tr><td>No Exiten contratos </td></tr>";
                                                                                                              endif;
                                                                                                        
                                                                                                              foreach($contrato as $k=>$v):
                                                                                                                  echo "<tr>";
                                                                                                              
                                                                                                                     echo "<td>" . $v['nombre'] . "</td>";
                                                                                                                     if($v['aceptado'] != 0):
                                                                                                                         echo "<td><label class='uniform-inline'>Contrato Aceptado</td>";
                                                                                                                     else:
                                                                                                                          echo "<td>";
                                                                                                                          echo "<label class='uniform-inline'><a href='index.php?id_contrato=" . $v['id'] .
                                                                                                                                  "' class='btn green-haze'>Aceptar Contrato</a></td>";
                                                                                                                     endif;
                                                                                                                     echo "<td>Enviado:<br>" . $v['fecha_envio'];
                                                                                                                     if($v['fecha_contrato'] === "" || $v['fecha_contrato'] === null):
                                                                                                                         echo "</td>";
                                                                                                                     else:
                                                                                                                         echo "<br>Firmado:<br>" . $v['fecha_contrato'] . "</td>";
                                                                                                                     endif;
                                                                                                                     
                                                                                                                     if($v['icono'] === "DocBroken.png"):
                                                                                                                          echo "<td><button class='btn' onclick='alert(" . '"' . "Archivo dañado" . '"' . ");'><img src='../img/documents/" 
                                                                                                                         . $v['icono'] . "' width='30' height='30' /></button></td>";
                                                                                                                     else:
                                                                                                                           echo "<td><a href='../files/manifiest/" . $v['contrato'] . "'><img src='../img/documents/" 
                                                                                                                         . $v['icono'] . "' width='30' height='30' /></a></td>";
                                                                                                                     endif;
                                          
                                                                                                                  echo "</tr>";
                                                                                                              endforeach;
                                                                                                            
                                                                                                            
                                                                                                            ?>
                                                                                                            
												
													</table>
													
												
											</div>
											<!-- END PRIVACY SETTINGS TAB -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>





<!-- END JAVASCRIPTS -->
<script>

  function comparar()
  {
      var p1 = document.getElementById('txt_new_pass').value;
      var p2 = document.getElementById('txt_new_pass2').value;
      if(p1===p2)
      {
          document.getElementById('cmd_password').innerHTML ='<input type="submit" name="password_enviar"   value="Cambiar Contraseña" class="btn green-haze" />';
      }else{
          document.getElementById('cmd_password').innerHTML ='<p><b>Las contraseñas deben ser iguales</b></p>';
      }
      
  }
 
</script>

