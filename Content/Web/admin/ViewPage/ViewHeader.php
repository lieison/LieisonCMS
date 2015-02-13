<?php

   
class AdminHeader
{
    
    public static  $relative_route = "../";
    
    static function Get_CMS_Title($title , $version = null)
    {
        echo '<h3 class="page-title">
			' . $title . ' <small> ' . $version . '</small>
			</h3>';
    }
    
    static function Get_DropDown()
    {
        echo '<ul class="dropdown-menu dropdown-menu-default">
                <li>
                   <a href="../admin/perfil.php">
		   <i class="icon-user"></i> Mi Perfil</a>
                 </li>';
        
        echo '<li class="divider">
		</li>
                      <li>
			<a href="../admin/lock.php">
                            <i class="icon-lock"></i> Bloquear Pantalla </a>
			</li>
                            <li>
                           <a href="../admin/ControlPage/LogoutPage.php">
                                <i class="icon-key"></i> Cerrar Sesion </a>
			</li></ul>';
    }
    
    static function GetLogo()
    {
        
        echo '<a href="../admin/index.php">
                <img src="../img/logo/ls_logo_white.png" 
                    width="86" height="35" alt="logo" class="logo-default"/>
              </a>';
    }
    
    static function GetCopyRight()
    {
        echo date('Y') .  " &copy; Lieison S.A de S.V.";
    }
    
    static function GetTitle($name)
    {
        echo "<title>$name</title>";
    }
    
    static function GetIcon($url)
    {
        echo '<link rel="shortcut icon" href="' . $url . '"/>';
    }
    
    static function GetMeta()
    {
        echo '<meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>';
    }
    
    static function GetMetaContent($array_conent)
    {
        foreach ($array_conent as $key=>$value)
        {
            echo "<meta content='$key' name='$value/>";
        }
    }
    
    static function GetCss()
    {
        echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
              <link href="'. self::$relative_route . 'assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
              <link href="'. self::$relative_route . 'assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
              <link href="'. self::$relative_route . 'assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
              <link href="'. self::$relative_route . 'assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
              <link href="'. self::$relative_route . 'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
                <!-- END GLOBAL MANDATORY STYLES -->
                <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
            <link href="'. self::$relative_route . 'assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
            <link href="'. self::$relative_route . 'assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
            <link href="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>';
        
        echo '<!-- END PAGE LEVEL PLUGIN STYLES -->
                <!-- BEGIN PAGE STYLES -->
                <link href="'. self::$relative_route . 'assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
                <!-- END PAGE STYLES -->
                <!-- BEGIN THEME STYLES -->
                <!-- DOC: To use "rounded corners" style just load "components-rounded.css" stylesheet instead of "components.css" in the below style tag -->
                <link href="'. self::$relative_route . 'assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
                <link href="'. self::$relative_route . 'assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
                <link href="'. self::$relative_route . 'assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
                <link href="'. self::$relative_route . 'assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>

                <link href="'. self::$relative_route . 'assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>';
    }
    
    static function GetJs()
    {
            echo '<!--[if lt IE 9]>
                    <script src="'. self::$relative_route . 'assets/global/plugins/respond.min.js"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/excanvas.min.js"></script> 
                 <![endif]-->
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
                    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
                <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
                    <script src="'. self::$relative_route . 'assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>';
            
            echo '<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/pages/scripts/index.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>';
    }
    
}

?>
