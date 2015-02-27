<!DOCTYPE html>

<?php 
 
    /**
     *@todo LIEISOFT CMS SCRIPT AUTOGENERACION
     *@author Rolando Arriaza <rmarroquin@lieison.com>
     *@version 1.x
     *@since 0.1
     */

    //INICIAMOS SESION 
    session_start();
    
    //INCLUIMOS LIBRERIA PRINCIPAL DONDE SE CARGAN TODAS LAS DEMAS LIBRERIAS O SCRIPTS
    include   '../../../Conf/Include.php';
    
    //INSTANCIAMOS UN NUEVO HEADER DE REDIRECCIONAMIENTO
    $header = new Http\Header();
    
    //VERIFICAMOS SI LA SESION EXISTE
    if(!isset($_SESSION['login'])):
        $header->redirect("Login.php");
    endif;
    
    //EN CASO DE QUE LA PANTALLA ESTE BLOQUEADA REVISAMOS SI LA SESION DE BLOQUEO EXISTE
    //LUEGO DE ESO VERIFICAMOS SI EL BLOQUEO CONTINUA O SE HA DESHABILITADO
     if(isset($_SESSION['lock'])):
        if($_SESSION['lock']== true):
            $header->redirect("lock.php");
        endif; 
    endif;
    
    //VARIABLES DE SESION
    $usuario = $_SESSION['login']['user'];
    $rol = $_SESSION['login']['rol'];
    $nombre = $_SESSION['login']['nombre'];
    $mail = $_SESSION['login']['email'];
    $activo = $_SESSION['login']['activo'];
    $id_user = $_SESSION['login']['id'];
    
    //VERIFICAR SI EL AVATA ESTA VACIO (ASIGNARLE AVATAR EMPTY) O SI EXISTE AVATAR (EN IMAGEN)
    $imagen = UserController::Verify_Avatar();
    
    //VER SI LA CUENTA ACTUAL ESTA ACTIVA
    if($activo == 0):
        $header->redirect("cuenta_desactivada.php");
    endif;
    
    

    $adminc = new AdminController();
    $adminc->Get_Permission($rol, FunctionsController::get_actual_page());
    
    $page_name="Agregar Prospecto";
   
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=271330856288382&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
<!-- BEGIN HEADER -->

<input type="hidden" id="rol_value" value="<?php echo $rol; ?>" />
<input type="hidden" id="page_value" value="<?php echo $page_name; ?>" />
<input type="hidden" id="route_value" value="<?php echo AdminHeader::$relative_route; ?>" />


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
			<ul id="dashboard_sidebar_load" class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				
                                <!-- ACA SE CREARA EL DASHBOARD DINAMICO -->
                                <?php
                                     //$dashboard = new DashboardController();
                                     //echo $dashboard->get_dashboard_sidebar_menu($rol, "Agregar Prospecto");
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
			<?php AdminHeader::Get_CMS_Title("PROSPECTOS" , " | AGREGAR PROSPECTOS"); ?>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Prospectos</a>
					</li>
				</ul>
				<div class="col-md-12 ">
                            <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Agrega un nuevo prospecto ...
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
                                                    <form class="form-horizontal" role="form" action="get_add_prospect.php" method="get">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Nombre del Prospecto *</label>
										<div class="col-md-9">
                                                                                    <input type="text" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Nombre o Empresa" onkeyup="verificar_prospecto(this.value);">
                                                                                        <span class="help-block" id="verificar_prospecto">
                                                                                            
											</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion *</label>
										<div class="col-md-9">
                                                                                    <input type="text" required name="txt_direccion1" id="txt_direccion1" class="form-control" placeholder="Introduzca la direccion">
											<span class="help-inline">
											</span>
										</div>
                                                                                <div id="map-canvas"></div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Direccion Alternativa </label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_direccion2" id="txt_direccion2" class="form-control" placeholder="(Opcional) Introduzca alguna direccion alternativa">
					
										</div>
	
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Provincia</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_provincia" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador)" >
                                           
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Ciudad</label>
										<div class="col-md-9">
                                                                                    <input type="text" name="txt_ciudad" class="form-control input-inline medium_text" id="txt_nombre" name="txt_nombre" placeholder="Ej: (San salvador)" >
                                           
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Pais *</label>
                                                                                <div class="col-md-9" id="drown_pais">
                                                                                    <!--AJAX DROPDOWN PAIS -->
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Codigo Zip</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-inbox"></i>
												</span>
                                                                                             <input type="text" name="txt_zip" class="form-control" placeholder="+503">
				
                                                                                        </div>
                                                                                        
										</div>
                                                                               
									</div>
                                                                    
                                                                     <div class="form-group">
										 <label class="col-md-3 control-label">Telefono *</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-phone"></i>
												</span>
                                                                                              <input required type="tel" name="txt_telefono" class="form-control" placeholder="">
				
                                                                                        </div>
                                                                                        
										</div>
									</div>
                                                                    
                                                                     <div class="form-group">
										 <label class="col-md-3 control-label">Fax</label>
										<div class="col-md-3">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-fax"></i>
												</span>
                                                                                             <input type="tel" name="txt_fax" class="form-control" placeholder="">
				
                                                                                        </div>
                                                                                        
										</div>
									</div>
                                                                        
									<div class="form-group">
										<label class="col-md-3 control-label">Email</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
												</span>
												<input type="email" name="txt_email" class="form-control" placeholder="Correo electronico ...">
											</div>
										</div>
									</div>
                                                                    
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Pagina Web</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-dashboard"></i>
												</span>
                                                                                            <input type="url" name="txt_web" class="form-control" placeholder="http://">
											</div>
										</div>
									</div>
                                                                    
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Facebook</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-facebook"></i>
												</span>
                                                                                            <input type="text" value="" class="form-control" name="txt_facebook" placeholder="https://"  onkeyup="verificar_facebook(this.value);">
                                                                                            <span class="help-block" id="verificar_facebook">
                                                                                            
                                                                                            </span>
											</div>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Twitter</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-twitter"></i>
												</span>
                                                                                            <input type="tex" value="" name="txt_twitter" class="form-control" placeholder="ejemplo: lieison (sin arroba '@')" onkeyup="verificar_twitter(this.value);">
                                                                                            <span class="help-block" id="verificar_twitter">
                                                                                            
                                                                                            </span>
											</div>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-md-3 control-label">Notas</label>
										<div class="col-md-9">
											<div class="input-group">
												<span class="input-group-addon">
												
												</span>
                                                                                           <textarea class="ckeditor form-control" name="txt_notas" id="txt_notas" rows="6" data-error-container="#editor2_error"></textarea>
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
                                                                                    <button type="submit" name="cmd_enviar" id="cmd_enviar" class="btn green">Guardar Prospecto</button>
                                                                                    <label class=" control-label alert-warning" id="txt_error"></label>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
                            
                        </div>
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
   
  Layout.init(); // init layout

   load_dashboard_sidebar();
        
   var get_paises = function()
   {
        $.ajax({
                      type: "POST",
                      url: "get_paises.php",
                      beforeSend: function()
                      {
                          $("#drown_pais").html("<p>Cargando datos ...</p>");
                      },
                      success: function(value){
                          document.getElementById("drown_pais").innerHTML = value;
                      },
                      error: function()
                      {
                          $("#combo_pais").html("Error al cargar");
                      }
                      
              });
   }
   
   get_paises();

});

 function verificar_prospecto(nombre)
    {
         
         var parametros = {
                    "nombre" : nombre
                 };

                $.ajax({
                      type: "POST",
                      url: "getexist_prospect.php",
                      data: parametros,
                      beforeSend: function()
                      {
                          $("#verificar_prospecto").html("<span class='fa fa-spinner'>Verificando</span>");
                      },
                      success: function(value){
                             if(value == 0){
                                 if(nombre == '' || nombre == null)
                                 {
                                      $("#verificar_prospecto").html("Prospecto vacio ..");
                                      $("#cmd_enviar").hide();
                                       $("#txt_error").text("Nombre del Prospecto esta vacio ...");
                                 }
                                 else{
                                    $("#verificar_prospecto").html("Prospecto Disponible");
                                     $("#cmd_enviar").show();
                                      $("#txt_error").text("");
                                }
                            }
                             else{
                                 $("#verificar_prospecto").text("Nombre ya Utilizado "); 
                                 $("#cmd_enviar").hide();
                                 $("#txt_error").text("No se puede guardar este prospecto ya existe , cambie el nombre");
                             }
                      }
              });
    }
    
  function verificar_facebook(fb)
  {
      
      document.getElementById("verificar_facebook").innerHTML='<iframe src="//www.facebook.com/plugins/likebox.php?href=' + fb + ';width&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=644055289044788" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:62px;" allowTransparency="true"></iframe>';
  }
  
  function verificar_twitter(tw)
  {
      
      document.getElementById("verificar_twitter").innerHTML='<iframe src="//platform.twitter.com/widgets/follow_button.html?screen_name=' + tw + '" style="width: 300px; height: 20px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>';
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
 <script>
     
function initialize() {

  var markers = [];
  var map = new google.maps.Map( {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng( 13.9336532,-89.2157002),
      new google.maps.LatLng( 13.9336532,-89.2157002));
  map.fitBounds(defaultBounds);

 
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('txt_direccion1'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
   (input));

 
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

  
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

    
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>