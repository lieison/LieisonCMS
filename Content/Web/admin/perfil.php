<?php


    session_start();
    include   '../../Conf/Include.php';
    $header = new Http\Header();
    
    $usuario = $_SESSION['login']['user'];
    $rol = $_SESSION['login']['rol'];
    $nombre = $_SESSION['login']['nombre'];
    $mail = $_SESSION['login']['email'];
    $activo = $_SESSION['login']['activo'];
    $id_user = $_SESSION['login']['id'];
    $imagen =  $_SESSION['login']['imagen'];
    
    if(\SivarApi\Tools\Validation::Is_Empty_OrNull($imagen)):
        $imagen = "avatar.png";
    endif;

    if(!isset($_SESSION['login'])):
        $header->redirect("login.php");
    endif;
    
        
    $user_controller = new UserController($id_user);
    
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
            $header->redirect("perfil.php?a=1");
        endif;
    endif;

   // print_r($user_controller->Get_DataUser());
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    
<?php 

    
    AdminHeader::$relative_route = "../";
    AdminHeader::GetTitle("Perfil");
    AdminHeader::GetMeta();
    AdminHeader::GetCss();
    AdminHeader::GetIcon();
?>


<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<?php AdminHeader::GetLogo(); ?>
		</div>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <img alt="" class="img-circle" src="img/users/<?php echo $imagen; ?>"/>
					<span class="username username-hide-on-mobile">
					 <?php
                                           echo $usuario;
                                         ?>
                                        </span>
					<i class="fa fa-angle-down"></i>
					</a>
					
                                        <?php AdminHeader::Get_DropDown(); ?>
					
				</li>
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- PUENTE -->
				<li class="sidebar-search-wrapper">
                                    <br><br>
				</li>
                                <!-- ACA SE CREARA EL DASHBOARD DINAMICO -->
                                <?php
                                     $dashboard = new DashboardController();
                                     echo $dashboard->get_dashboard_sidebar_menu($rol, "Menu");
                                ?>
				<!--FINAL DEL DASHBOARD DINAMICO -->
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row margin-top-20">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar">
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
                                                            <img src="img/users/<?php echo $imagen;  ?>" class="img-responsive" alt="">
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
                                                            <a href="ControlPage/LogoutPage.php" class="btn btn-circle green-haze btn-sm">Cerrar Sesion</a>
                                                            <a href="lock.php" class="btn btn-circle btn-danger btn-sm">Bloquear Pantalla</a>
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
							<!-- STAT -->
							<div class="row list-separated profile-stat">
								<div class="col-md-4 col-sm-4 col-xs-6">
									<div class="uppercase profile-stat-title">
										 37
									</div>
									<div class="uppercase profile-stat-text">
										 Projects
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-6">
									<div class="uppercase profile-stat-title">
										 51
									</div>
									<div class="uppercase profile-stat-text">
										 Tasks
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-6">
									<div class="uppercase profile-stat-title">
										 61
									</div>
									<div class="uppercase profile-stat-text">
										 Uploads
									</div>
								</div>
							</div>
							<!-- END STAT -->
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
                                                                                                    if(isset($_REQUEST['a'])):
                                                                                                        if($_REQUEST['a']==1):
                                                                                                            echo ' <div class="alert alert-danger" role="alert">
                                                                                                                   La contraseña actual es incorrecta, intenta de nuevo.
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
                                                                                                                            <img src="img/users/<?php echo $imagen; ?>" alt=""/>
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
                                                                                            <form action="#" method="get">
                                                                                                
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
                                                                                                                          echo "<label class='uniform-inline'><a href='perfil.php?id_contrato=" . $v['id'] .
                                                                                                                                  "' class='btn green-haze'>Aceptar Contrato</a></td>";
                                                                                                                     endif;
                                                                                                                     echo "<td>Enviado:<br>" . $v['fecha_envio'];
                                                                                                                     if($v['fecha_contrato'] === "" || $v['fecha_contrato'] === null):
                                                                                                                         echo "</td>";
                                                                                                                     else:
                                                                                                                         echo "<br>Firmado:<br>" . $v['fecha_contrato'] . "</td>";
                                                                                                                     endif;
                                                                                                                     
                                                                                                                     if($v['icono'] === "DocBroken.png"):
                                                                                                                          echo "<td><a href='alert('Archivo dañado');'><img src='img/documents/" 
                                                                                                                         . $v['icono'] . "' width='30' height='30' /></a></td>";
                                                                                                                     else:
                                                                                                                           echo "<td><a href='files/manifiest/" . $v['contrato'] . "'><img src='img/documents/" 
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
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		<?php AdminHeader::GetCopyRight(); ?>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

<?php

    AdminHeader::GetJs();

?>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    Profile.init(); // init page demo
});
</script>
<!-- END JAVASCRIPTS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'keenthemes.com');
  ga('send', 'pageview');
  
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
</body>

<!-- END BODY -->
</html>