
<!DOCTYPE html>
<?php 
    session_start();
    include   '../../../Conf/Include.php';
    
    $http = new Http\Header();
    if(!isset($_SESSION['login'])):
        $http->redirect("Login.php");
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
        $header = new Http\Header();
        $header->redirect("cuenta_desactivada.php");
    endif;
    
    if($rol != 'admin' && $rol != "ceo"):
         $http->redirect("Login.php");
    endif;
    
    $frontend = new FrontEndController();
    
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
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN PAGE STYLES -->
<link href="../assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>

<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<style>
    #sliderpreview{
        width: 1024px;
        height: 400px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
    }
</style>


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
                            <img src="../../img/logo/ls_logo_white.png" width="86" height="35" alt="logo" class="logo-default"/>
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
                                            <img alt="" class="img-circle" src="../img/users/<?php echo $imagen; ?>"/>
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
                                     echo $dashboard->get_dashboard_sidebar_menu($rol, "Slider");
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
			Lieison Dashboard <small>Front End v1.0</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Monitoreo</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Sistema Slider v0.1</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			
			<div class="clearfix">
			</div>
                        <!--CONTROL DE SLIDER -->
                        <div class="row">
                            <div class="col-md-12 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-pin font-yellow-lemon"></i>
								<span class="caption-subject bold font-yellow-lemon uppercase">
								Nuevo Slider </span>
							</div>
						</div>
                                            
                                              	<div class="portlet-body">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tabslider_imagen" data-toggle="tab">
									Crear Slider Imagen </a>
								</li>
								<li>
									<a href="#tabslider_video" data-toggle="tab">
									Crear Slider Video </a>
								</li>
                                                                <li>
									<a href="#tabslider_imagenes" data-toggle="tab">
									Crear Slider Imagenes </a>
								</li>
								
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="tabslider_imagen">
									
                                                                        <div class="portlet-body">
                                                                            <ul class="nav nav-tabs">
                                                                                <li >
                                                                                    <a href="#imagen_imagen" data-toggle="tab">
                                                                                    Seleccionar Imagen</a>
                                                                                </li>
                                                                                <li >
                                                                                    <a href="#imagen_titulos" data-toggle="tab">
                                                                                    Add Titulos</a>
                                                                                </li>
                                                                            </ul>
                                                                         
                                                                        </div>
                                                                    <div class="tab-content">
                                                                         <div class="tab-pane fade" id="imagen_imagen">
                                                                                <form>
                                                                                    <div id="sliderpreview"></div>
                                                                                    <br>
                                                                                    <input id="uploadslider" type="file" name="image" class="btn red" />
                                                                                    <input type="hidden" id="crop_x" name="x"/>
                                                                                    <input type="hidden" id="crop_y" name="y"/>
                                                                                    <input type="hidden" id="crop_w" name="w"/>
                                                                                    <input type="hidden" id="crop_h" name="h"/>
                                                                                </form>
                                                                            </div>
                                                                        <div class="tab-pane fade" id="imagen_titulos">
                                                                         
									 Aca agregare la opcion de titulos y toda la paja
                                                                            
                                                                        </div>
                                                                    </div>
								
								</div>
								<div class="tab-pane fade" id="tabslider_video">
									<p>
										 Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.
									</p>
								</div>
								<div class="tab-pane fade" id="tabslider_imagenes">
									<p>
										 Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.
									</p>
								</div>
								
							</div>
						</div>
					</div>
                            </div>
                        </div>
                        <div class="row" id="slider_sort">
				<div class="col-md-4 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title">
							<div class="caption font-green-sharp">
								<i class="icon-speech font-green-sharp"></i>
								<span class="caption-subject bold uppercase"> Portlet</span>
								<span class="caption-helper">details...</span>
							</div>
							<div class="actions">
								<a href="#" class="btn btn-circle btn-default btn-sm">
								<i class="fa fa-plus"></i> Add </a>
								<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
								<h4>Heading Text</h4>
								<p>
									 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
								</p>
								<p>
									 nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
								</p>
							</div>
						</div>
					</div>
					<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-paper-plane font-green-haze"></i>
								<span class="caption-subject bold font-green-haze uppercase">
								Input </span>
								<span class="caption-helper"></span>
							</div>
							<div class="actions">
								<div class="portlet-input input-inline input-small">
									<div class="input-icon right">
										<i class="icon-magnifier"></i>
										<input type="text" class="form-control input-circle" placeholder="search...">
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<h4>Heading text goes here...</h4>
							<p>
								 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis.
							</p>
						</div>
					</div>
					<div class="portlet portlet-sortable box green-haze">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Portlet
							</div>
							<div class="actions">
								<a href="#" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit </a>
								<a href="#" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add </a>
								<a class="btn btn-sm btn-icon-only btn-default fullscreen" href="#"></a>
							</div>
						</div>
						<div class="portlet-body">
							<h4>Heading Text</h4>
							<p>
								 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur
							</p>
						</div>
					</div>
					<!-- empty sortable porlet required for each columns! -->
					<div class="portlet portlet-sortable-empty">
					</div>
				</div>
				<div class="col-md-4 column sortable">
					<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption font-red-sunglo">
								<i class="icon-share font-red-sunglo"></i>
								<span class="caption-subject bold uppercase"> Portlet</span>
								<span class="caption-helper"></span>
							</div>
							<div class="actions">
								<div class="btn-group btn-group-devided" data-toggle="buttons">
									<label class="btn btn-circle btn-transparent grey-salsa btn-sm active">
									<input type="radio" name="options" class="toggle" id="option2">Week</label>
									<label class="btn btn-circle btn-transparent grey-salsa btn-sm">
									<input type="radio" name="options" class="toggle" id="option2">Month</label>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">
								<h4>Heading Text</h4>
								<p>
									 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
								</p>
								<p>
									 nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
								</p>
							</div>
						</div>
					</div>
					<div class="portlet portlet-sortable box red-sunglo">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Portlet
							</div>
							<div class="actions">
								<a href="#" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit </a>
								<a href="#" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add </a>
								<a class="btn btn-sm btn-icon-only btn-default fullscreen" href="#"></a>
							</div>
						</div>
						<div class="portlet-body">
							<p>
								 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis.
							</p>
							<p>
								 Nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus.
							</p>
						</div>
					</div>
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title">
							<div class="caption font-yellow-crusta">
								<i class="icon-share font-yellow-crusta"></i>
								<span class="caption-subject bold uppercase"> Portlet</span>
								<span class="caption-helper">stats...</span>
							</div>
							<div class="actions">
								<a class="btn btn-circle btn-icon-only btn-default" href="#">
								<i class="icon-cloud-upload"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default" href="#">
								<i class="icon-wrench"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default" href="#">
								<i class="icon-trash"></i>
								</a>
								<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a>
							</div>
						</div>
						<div class="portlet-body">
							 Nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
						</div>
					</div>
					<!-- empty sortable porlet required for each columns! -->
					<div class="portlet portlet-sortable-empty">
					</div>
				</div>
				<div class="col-md-4 column sortable">
					<div class="portlet portlet-sortable light bordered">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-pin font-yellow-lemon"></i>
								<span class="caption-subject bold font-yellow-lemon uppercase">
								Tabs </span>
							</div>
							<ul class="nav nav-tabs">
								<li>
									<a href="#portlet_tab2" data-toggle="tab">
									Tab 2 </a>
								</li>
								<li class="active">
									<a href="#portlet_tab1" data-toggle="tab">
									Tab 1 </a>
								</li>
							</ul>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="tab-pane active" id="portlet_tab1">
									<h4>Tab 1 Content</h4>
									<p>
										 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna.
									</p>
								</div>
								<div class="tab-pane" id="portlet_tab2">
									<h4>Tab 2 Content</h4>
									<p>
										 Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet portlet-sortable box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Portlet
							</div>
							<div class="actions">
								<a href="#" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit </a>
								<div class="btn-group">
									<a class="btn btn-sm btn-default" href="#" data-toggle="dropdown">
									<i class="fa fa-user"></i> User <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">
											<i class="fa fa-pencil"></i> Edit </a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-trash-o"></i> Delete </a>
										</li>
										<li>
											<a href="#">
											<i class="fa fa-ban"></i> Ban </a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											<i class="i"></i> Make admin </a>
										</li>
									</ul>
								</div>
								<a class="btn btn-sm btn-icon-only btn-default fullscreen" href="#"></a>
							</div>
						</div>
						<div class="portlet-body">
							 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis. eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis.
						</div>
					</div>
					<div class="portlet portlet-sortable light bg-inverse">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-puzzle font-red-flamingo"></i>
								<span class="caption-subject bold font-red-flamingo uppercase">
								Tools </span>
								<span class="caption-helper">actions...</span>
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="fullscreen">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<h4>Heading text goes here...</h4>
							<p>
								 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur.
							</p>
						</div>
					</div>
					<!-- empty sortable porlet required for each columns! -->
					<div class="portlet portlet-sortable-empty">
					</div>
				</div>
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

<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>



<script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->


<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/portlet-draggable.js"></script>


<script src="../../assets/global/plugins/jcrop/js/jquery.color.js"></script>
<script src="../../assets/global/plugins/jcrop/js/jquery.Jcrop.min.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>

jQuery(document).ready(function() {       
  
    //Metronic.init(); 
    //QuickSidebar.init(); 
   // Demo.init(); 
   // PortletDraggable.init();

    var ImagenPrev = function() {
   
    $("#uploadslider").on("change", function()
    {
        var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; 
 
        if (/^image/.test( files[0].type)){ 
            var reader = new FileReader(); 
            reader.readAsDataURL(files[0]); 
 
            reader.onloadend = function(){ 
                $("#sliderpreview").css("background-image", "url("+this.result+")");
            }
        }
       });
  
    }
    
   
    var CortarImagen = function() {
      
        $('#sliderpreview').Jcrop({
          onSelect: updateCoords
        });

        function updateCoords(c)
          {
            $('#crop_x').val(c.x);
            $('#crop_y').val(c.y);
            $('#crop_w').val(c.w);
            $('#crop_h').val(c.h);
          };

        /*  $('#demo8_form').submit(function(){
            if (parseInt($('#crop_w').val())){
                return true;
            }
            else 
            {
                
            }
            return false;
          });*/
          
    }
    
    ImagenPrev();
    CortarImagen();
    Layout.init(); 

});
</script>


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

