<?php

    session_start();
    include   '../../Conf/Include.php';
    $header = new Http\Header();
    
    if(!isset($_SESSION['login'])):
        $header->redirect("Login.php");
    endif;
    
    $usuario = $_SESSION['login']['user'];
    $rol = $_SESSION['login']['rol'];
    $nombre = $_SESSION['login']['nombre'];
    $mail = $_SESSION['login']['email'];
    $activo = $_SESSION['login']['activo'];
    $id_user = $_SESSION['login']['id'];
    
    $imagen = $_SESSION['login']['imagen'];
    if(\SivarApi\Tools\Validation::Is_Empty_OrNull($imagen)):
        $imagen = "avatar.png";
    endif;
    
    if($activo == 0):
        $header->redirect("cuenta_desactivada.php");
    endif;
    
    $adminc = new AdminController();
    $priv = $adminc->get_permission_page($rol, FunctionsController::get_actual_page());
    if(!$priv):
        $header->redirect("index.php");
    endif;
   
    
   
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
    endif;
    
?>




<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Lieison Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>

<link href="../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<link rel="stylesheet" type="text/css" href="../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.php">
                            <img src="../img/logo/ls_logo_white.png" width="86" height="35" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
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
					<ul class="dropdown-menu dropdown-menu-default">
						<li class="divider">
						</li>
						<li>
							<a href="lock.php">
							<i class="icon-lock"></i> Bloquear Pantalla </a>
						</li>
						<li>
                                                    <a href="ControlPage/LogoutPage.php">
							<i class="icon-key"></i> Cerrar Sesion </a>
						</li>
					</ul>
				</li>
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
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
                                     echo $dashboard->get_dashboard_sidebar_menu($rol, "Gestionar Usuarios");
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Lieison Dashboard <small>CMS Version 0.1</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Monitoreo</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Sistema de Gestion Usuarios 1.0</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			
			<div class="clearfix">
			</div>
                        <!--CONTROL DE MONITOREO -->
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
                                                                echo '<td><a class="delete" href="dashboard_gestion_usuarios.php?id_rol=' . $id_u . '">Eliminar</a></td>';
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
                        </div>
		</div>
	</div>
	<!-- END CONTENT -->
	<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
        
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2015 &copy; Lieison S.A de S.V.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>



<script >
   
   
   var TablaUsuarios = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            
            var parametros = {
                       "type" : "rols",
                       "args": aData[3]
                    };

                $.ajax({
                        type: "POST",
                        url: "ControlPage/GetoRolResponsive.php",
                        data:parametros,
                        success: function(value){
                           // jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                           jqTds[3].innerHTML = value;
                       }
                   });
            
            jqTds[4].innerHTML = '<select class="form-control" ><option value="1">Activo</option><option value="0">Desactivado</option></select>';
            jqTds[5].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[6].innerHTML = '<a class="cancel" href="">Cancelar</a>';
 
            
        }
        
    
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            var jqselect = $('select', nRow);
            var aData = oTable.fnGetData(nRow);
            
            if(aData[8] == null || aData[8]== "")
            {
                 var parametros = {
                       "usuario" : jqInputs[0].value,
                       "nombre":jqInputs[1].value,
                       "email": jqInputs[2].value,
                       "privilegios": jqselect[0].value,
                       "estado":jqselect[1].value,
                       "key": "null"
                 };

                $.ajax({
                        type: "POST",
                        url: "ControlPage/GetSaveUserResponsive.php",
                        data:parametros,
                        success: function(value){
                            console.log(value);
                             var data = value.replace(/\s/g, '');
                             switch(data)
                             {
                                 case '1':
                                    oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                                    oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                                    oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                                    oTable.fnUpdate(jqselect[0].value, nRow, 3, false);
                                    if(jqselect[1].value==1){
                                        oTable.fnUpdate("Activo", nRow, 4, false);
                                    }else{
                                        oTable.fnUpdate("Desactivado", nRow, 4, false);
                                    }
                                     break;
                                 case '0':
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Error al guardar , favor revisar los datos";
                                     break;
                                 case "mail":
                                      document.getElementById("alertas_usuarios").innerHTML = "<br>Se Necesita un correo electronico";
                                     break;
                                 case "nombre":
                                     document.getElementById("alertas_usuarios").innerHTML= "<br>Se Necesita un nombre y/o apellido";
                                     break;
                                 case "user":
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Se Necesita un usuario";
                                     break;
                                 default:
                                     document.getElementById("alertas_usuarios").innerHTML = "<br>Error al guardar , servidor ocupado.";
                                     break;
                             }
                            
                            
                         
                         }
                   });
                
            }
            else{

               var parametros = {
                       "usuario" : jqInputs[0].value,
                       "nombre":jqInputs[1].value,
                       "email": jqInputs[2].value,
                       "privilegios": jqselect[0].value,
                       "estado":jqselect[1].value,
                       "key": aData[8]
                 };

                $.ajax({
                        type: "POST",
                        url: "ControlPage/GetUpdateUserResponsive.php",
                        data:parametros,
                        success: function(value){
                             console.log(value);
                             oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                             oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                             oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                             oTable.fnUpdate(jqselect[0].value, nRow, 3, false);
                             if(jqselect[1].value==1){
                                  oTable.fnUpdate("Activo", nRow, 4, false);
                             }else{
                                  oTable.fnUpdate("Desactivado", nRow, 4, false);
                             }
                         
                         }
                   });
                
            }
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_usuarios_');

        var oTable = table.dataTable({
           
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sistema_usuario");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#nuevo_usuario').click(function (e) {
           
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Fila anterior no se ha guardado. ¿deseas guardarla?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Alerta");
                    nEditing = null;
                    nNew = false;

                } else {
                    
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }
           
            var aiNew = oTable.fnAddData(['', '', '', '', '', '','','','']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();
           
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            
            if (confirm("¿Estas seguro que deseas eliminar " + aData[1] + " (" + aData[0] + ")?") == false) {
                return;
            }
              
            var parametros = {
                       "id": aData[8]
                    };

             $.ajax({
                        type: "POST",
                        url: "ControlPage/GetDeleteUserResponsive.php",
                        data:parametros,
                        success: function(value){
                            console.log(value);
                           oTable.fnDeleteRow(nRow);
                            alert("Se ha eliminado " + aData[0] + " con exito !!");
                       }
               });
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Guardar") {
                saveRow(oTable, nEditing);
                nEditing = null;
                
            } else {
                editRow(oTable, nRow);
                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

TablaUsuarios.init();
Layout.init();   
    
</script>




<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>