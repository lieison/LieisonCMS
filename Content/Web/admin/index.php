<!DOCTYPE html>

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
    $page_name = "Principal";
 
?>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>

<?php 

    
    AdminHeader::$relative_route = "../";
    AdminHeader::GetTitle("Lieison Dashboard");
    AdminHeader::GetMeta();
    AdminHeader::GetCss();
    
?>
    
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
    
<?php AdminHeader::GetHiddenData(); ?>
<input type="hidden" id="rol_value" value="<?php echo $rol; ?>" />
<input type="hidden" id="page_value" value="<?php echo $page_name; ?>" />

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
                            
  
                                <?php 
                                    /**
                                     *  ESTA FUNCION SE AGREGARAN LOS DROPDOWN 
                                     *  COMO INBOX , TASK , NOTIFICACIONES ETC .
                                     */
                                     AdminHeader::GetSystemContent();
                                ?>
                                
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                            <?php AdminHeader::Get_ImgSesion($imagen);?>
					<span class="username username-hide-on-mobile">
					 <?php echo $usuario; ?>
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
			<ul id="dashboard_sidebar_load" class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                                <?php
                                   
                                    /*SE ACTUALIZO EL SIDEBAR POR AJAX SIDEBAR ...
                                     * 
                                     * id="dashboard_sidebar_load"
                                     * 
                                     * **/
                                ?>
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
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html"></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
                                            <a href="#"></a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
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
      
   <?php
   /*INICIA TODOS LOS AJAX COMO INBOX , NOTIFICACIONES ETC*/
   AdminHeader::GetJsSystemLoad();
   ?>   
   
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();


   /**
    * INICIA LOS GRAFICOS DE VISITAS EN EL FRONT END --- DESHABILITADO
    * */
   // iniciargraficos_visita();
   
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>