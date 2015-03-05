<!DOCTYPE html>

<?php 
    session_start();
    include   '../../../Conf/Include.php';

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
    
    
    if(!isset($_REQUEST['cmd_enviar'])):
        $header = new Http\Header();
        $header->redirect("dashboard_add_prospecto.php");
    endif;
    
 
    
   $fb = $_REQUEST['txt_facebook'];
   $tw = $_REQUEST['txt_twitter'];

    
?>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>

<?php 

    
    AdminHeader::$relative_route = "../../";
    AdminHeader::GetTitle("Lieison Dashboard");
    AdminHeader::GetMeta();
    AdminHeader::GetCss();
    
?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 

<input type="hidden" value="<?php echo $_REQUEST['txt_nombre']; ?>" id="nombre" />
<input type="hidden" value="<?php echo $_REQUEST['txt_direccion1']; ?>" id="direccion1"  />
<input type="hidden" value="<?php echo $_REQUEST['txt_direccion2']; ?>" id="direccion2" />
<input type="hidden" value="<?php echo $_REQUEST['txt_provincia']; ?>" id="provincia" />
<input type="hidden" value="<?php echo $_REQUEST['txt_ciudad']; ?>" id="ciudad" />
<input type="hidden" value="<?php echo $_REQUEST['combo_pais']; ?>" id="pais" />
<input type="hidden" value="<?php echo $_REQUEST['txt_zip']; ?>" id="zip"  />
<input type="hidden" value="<?php echo $_REQUEST['txt_telefono']; ?>" id="telefono" />
<input type="hidden" value="<?php echo $_REQUEST['txt_fax']; ?>" id="fax"  />
<input type="hidden" value="<?php echo $_REQUEST['txt_email']; ?>" id="mail"  />
<input type="hidden" value="<?php echo $_REQUEST['txt_web']; ?>" id="web"  />
<input type="hidden" value="<?php echo $fb; ?>" id="facebook"  />
<input type="hidden" value="<?php echo $tw; ?>" id="twitter"  />
<input type="hidden" value="<?php echo $_REQUEST['txt_notas']; ?>" id="notas"  />

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<?php AdminHeader::GetLogo();  ?>
			<div class="menu-toggler sidebar-toggler hide">
                            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <img alt="" class="img-circle" src="../img/users/<?php echo $imagen; ?>"/>
					<span class="username username-hide-on-mobile">
					 <?php
                                           echo $usuario;
                                         ?>
                                        </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<?php AdminHeader::Get_DropDown(); ?>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="javascript:;" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
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
				
                                <!-- ACA SE CREARA EL DASHBOARD DINAMICO -->
                                <?php
                                     $dashboard = new DashboardController();
                                     echo $dashboard->get_dashboard_sidebar_menu($rol, "Sales");
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
			
			
			<!-- BEGIN PAGE HEADER-->
			<?php AdminHeader::Get_CMS_Title("Dashboard"); ?>
			<div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN Portlet PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
                                                            <i class="fa fa-adjust" id="registrando"></i>
                                                            <div id="guardando_p">
                                                               
                                                            </div>
							</div>
							<div class="actions">
								<a href="dashboard_edit_prospecto.php?id=<?php ?>" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Editar </a>
								<a href="dashboard_add_prospecto.php" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Agregar Otro </a>
							</div>
                           
						</div>
						<div class="portlet-body">
							
						</div>
                                           
                                    
					<!-- END Portlet PORTLET-->
                                        
                           
  
				</div>
                            
                                             <div class="row">
				<div class="col-md-12">
					<table id="user" class="table table-bordered table-striped">
					<tbody>
					<tr>  <td style="width:15%">
                                        <div id="guardando_loading">
                                          
							
                                            
                                        </div></td>
						<td style="width:50%">
							<a href="#"  data-type="text" data-pk="1" data-original-title="Enter username">
                                                            Prospecto </a>: <?php echo $_REQUEST['txt_nombre']; ?><br>
                                                    <a href="#"  data-type="text" data-pk="1" data-original-title="Enter username">
							Estado </a>: Activo por defecto.
                                                        <br>
                                                        <div id="save_ok">
                                                            
                                                        </div>
						</td>
					
					</tr>
					
					</tbody>
					</table>
                            
                        </div>
                        
                        
	</div>
                                </div>
                            
                            
                            
                        </div>
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

<?php AdminHeader::GetJs(); ?>

<script>
    jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 

   Tasks.initDashboardWidget();
   
   var guardar_prospecto = function()
   {
       
       
       var n = document.getElementById("nombre").value;
       var d = document.getElementById("direccion1").value;
       var d2 = document.getElementById("direccion2").value;
          
       
       var p = document.getElementById("provincia").value;
       var c = document.getElementById("ciudad").value;
        
       var ps = document.getElementById("pais").value;
       var z= document.getElementById("zip").value;
       
       var t = document.getElementById("telefono").value;
       var f = document.getElementById("fax").value;
        
       var e = document.getElementById("mail").value;
       var w = document.getElementById("web").value;
       
       var fb = document.getElementById("facebook").value;
       var tw = document.getElementById("twitter").value;
       var nt = document.getElementById("notas").value;
       
       
        
           var parametros = {
                    "nombre" : n,
                    "direccion1":d,
                    "direccion2":d2,
                    "provincia":p,
                    "ciudad":c,
                    "pais":ps,
                    "zip":z,
                    "telefono":t,
                    "fax":f,
                    "mail":e,
                    "web":w,
                    "facebook":fb,
                    "twitter":tw,
                    "notas":nt
                 };

                $.ajax({
                      type: "POST",
                      url: "ajax_add_prospect.php",
                      data: parametros,
                      beforeSend: function()
                      {
                           
                          $("#guardando_p").html(" Guardando Prospecto");
                          $("#guardando_loading").html("<img src='../img/assert/loading.gif' width='100' height='100' />");
                         
                      },
                      success: function(value){
                          $("#guardando_p").html("");
                          $("#guardando_loading").html("<img src='../img/assert/checkok.png' width='100' height='100' />");
                          $("#save_ok").html( '<a href="#"  data-type="text" data-pk="1" data-original-title="Enter username">Prospecto Guardado </a>: <a href="dashboard_add_prospecto.php">Agregar Otro</a>.');
                      }
              });
       
   }
   
   guardar_prospecto();
    

   
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>