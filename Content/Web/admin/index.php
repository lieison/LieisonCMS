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
    
<input type="hidden" id="rol_value" value="<?php echo $rol; ?>" />
<input type="hidden" id="page_value" value="<?php echo $page_name; ?>" />
<input type="hidden" id="route_value" value="<?php echo AdminHeader::$relative_route; ?>" />

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
                                            <?php //aca va la imagen de sesion
                                                AdminHeader::Get_ImgSesion($imagen);
                                            ?>
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
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
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
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features 
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
  // Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
   
   var load_dashboard_sidebar = function()
   {
     
       var rol = document.getElementById("rol_value").value;
       var page = document.getElementById("page_value").value;
       var route = document.getElementById("route_value").value;
       
       var d_params = {
                       "rol" : rol,
                       "page": page
         };

          $.ajax({
                    type: "POST",
                    url: route  + "admin/ControlPage/GetDashboardSidebar.php",
                    data: d_params,
                    beforeSend: function()
                    {
                         $("#dashboard_sidebar_load").html("<br><br><br><br><li><img src='" + route + "/admin/img/assert/loading.gif' width='40' height='40' /></li>");
                    },
                    success: function(value){
                          $("#dashboard_sidebar_load").html(value);
                          
                     }
             });
   }
   load_dashboard_sidebar();
   
   
   
    /*var iniciargraficos_visita = function () {
            if (!jQuery.plot) {
                return;
            }

            function showChartTooltip(x, y, xValue, yValue) {
                $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 40,
                    border: '0px solid #ccc',
                    padding: '2px 6px',
                    'background-color': '#fff'
                }).appendTo("body").fadeIn(200);
            }
            
            
            function getresponsivedata()
            {
                
                 var fecha = new Date();
                 var mes = fecha.getMonth();
                 var anio = fecha.getYear();
                
                 var parametros = {
                       "mes" : mes,
                       "anio": anio
                 };

                $.ajax({
                      type: "POST",
                      url: "ControlPage/GetVisits.php",
                      data: parametros,
                      success: function(json){
                      var visitors = [];    
                      console.log(json);
                      var valores = $.parseJSON(json || "null");
                      for(var i in valores)
                      {
                        visitors.push(valores[i]);
                        console.log(valores[i]);
                      }
                           if ($('#site_statistics').size() != 0) {

                $('#site_statistics_loading').hide();
                $('#site_statistics_content').show();

                var plot_statistics = $.plot($("#site_statistics"),
                    [{
                        data: visitors,
                        lines: {
                            fill: 0.6,
                            lineWidth: 0
                        },
                        color: ['#f89f9f']
                    }, {
                        data: visitors,
                        points: {
                            show: true,
                            fill: true,
                            radius: 5,
                            fillColor: "#f89f9f",
                            lineWidth: 3
                        },
                        color: '#fff',
                        shadowSize: 0
                    }],

                    {
                        xaxis: {
                            tickLength: 0,
                            tickDecimals: 0,
                            mode: "categories",
                            min: 0,
                            font: {
                                lineHeight: 14,
                                style: "normal",
                                variant: "small-caps",
                                color: "#6F7B8A"
                            }
                        },
                        yaxis: {
                            ticks: 5,
                            tickDecimals: 0,
                            tickColor: "#eee",
                            font: {
                                lineHeight: 14,
                                style: "normal",
                                variant: "small-caps",
                                color: "#6F7B8A"
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#eee",
                            borderColor: "#eee",
                            borderWidth: 1
                        }
                    });

                var previousPoint = null;
                $("#site_statistics").bind("plothover", function (event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + ' visitas');
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
                      }
                 });
            }
            
                getresponsivedata();
        }*/
   
   // iniciargraficos_visita();
   
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>