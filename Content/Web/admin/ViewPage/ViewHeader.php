<?php

/**
 *@author Rolando Antonio Arriaza <rmarroquin@lieison.com>
 *@copyright (c) 2015, Lieison
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE. 
 * 
 *@version 1.0
 *@todo Lieison S.A de C.V 
 *@category Class Adminheader
 * 
 * 
 * 
 */

   
class AdminHeader
{
    
    public static  $relative_route = "../";
    
    static function Get_CMS_Title($title , $version = null)
    {
        echo '<h3 class="page-title" id="id_title" >
			' . $title . ' <small> ' . $version . '</small>
			</h3>';
    }
    
   
    static function Get_DropDown()
    {
        echo '<ul class="dropdown-menu dropdown-menu-default">
                <li>
                   <a href="' . self::$relative_route . 'admin/perfil/">
		   <i class="icon-user"></i> Mi Perfil</a>
                 </li>';
        
        echo '<li class="divider">
		</li>
                      <li>
			<a href="' . self::$relative_route . 'admin/lock.php">
                            <i class="icon-lock"></i> Bloquear Pantalla </a>
			</li>
                            <li>
                           <a href="' . self::$relative_route . '/admin/ControlPage/LogoutPage.php">
                                <i class="icon-key"></i> Cerrar Sesion </a>
			</li></ul>';
    }
    
    static function GetLogo($width = null , $height = null)
    {
        $logo = "LogoB.png";
        $dir = 'admin/img/assert/logos/';
        if(SivarApi\Tools\Validation::Is_Empty_OrNull($width) || SivarApi\Tools\Validation::Is_Empty_OrNull($height)){
            echo '<a href="' . self::$relative_route . 'admin/index.php">
                <img src="' . self::$relative_route . $dir . $logo . '"' .
                    'width="86" height="35" alt="logo" class="logo-default"/>
              </a>';
        }
        else
        {
             echo '<a href="' . self::$relative_route . 'admin/index.php">
                <img src="' . self::$relative_route . $dir . $logo . '"' .
                    'width="' . $width .'" height="' . $height .'" alt="logo" class="logo-default"/>
              </a>';
        }
    }
    
    static function GetCopyRight()
    {
        echo date('Y') .  " &copy; Lieison S.A de C.V.";
    }
    
    static function GetTitle($name)
    {
        echo "<title>$name</title>";
    }
    
    static function GetIcon()
    {
        echo '<link rel="shortcut icon" href="' . self::$relative_route . 'admin/img/assert/favicon.ico"/>';
    }
    
    static function GetMeta()
    {
        echo '<meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>';
        //meta para google translate
        echo '<meta name="google-translate-customization" content="f93064b84c026e43-56e6eb7a0108f43a-g592f3f3b223f149c-f"></meta>';
    }
    
    static function GetMetaContent($array_conent)
    {
        foreach ($array_conent as $key=>$value)
        {
            echo "<meta content='$key' name='$value/>";
        }
    }
    
    static function GetSystemContent()
    {
        echo '<li id="load_message" class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					
              </li>';
        echo '';
    }
    
    static function GetBasePlugin()
    {
        
    }
    
    
    static function GetJsSystemLoad()
    {
        /**
          * CARGA LOS  MENSAJES 
         **/
   
        echo ' load_message();';
        echo "setInterval('load_message()',1000*10);";
        
         /**CARGA LAS NOTIFICACIONES */
   
        echo 'load_notify();';
        echo "setInterval('load_notify()' , 1000*10);";    
        
          /**
            * CARGA EL DASHBOARD SIDEBAR
           * */
        echo 'load_dashboard_sidebar();';
        
        echo '';
             
    }
    
    
    static function GetJsAfterLoad()
    {
        
    }
    
    static function GetHiddenData()
    {
         echo '<input type="hidden" id="route_value" value=" ' .  AdminHeader::$relative_route . '" />';
       
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
        
        echo '<link rel="stylesheet" type="text/css" href="'. self::$relative_route . 'assets/global/plugins/select2/select2.css"/>
              <link rel="stylesheet" type="text/css" href="'. self::$relative_route . 'assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
              <link rel="stylesheet" type="text/css" href="'. self::$relative_route . 'assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
              <link rel="stylesheet" type="text/css" href="'. self::$relative_route . 'assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>';
        
    }
    
    static function GetJs()
    {
        
        /**
         *          <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
                    <script src="'. self::$relative_route . 'assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
         * 
         */
        
        
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
            
            
            echo '<script src="'. self::$relative_route . '/assets/global/scripts/metronic.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/pages/scripts/index.js" type="text/javascript"></script>
                  <script src="'. self::$relative_route . 'assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>';
            
            echo '<script src="' . self::$relative_route  . 'admin/js/AjaxFunctions.js" type="text/javascript"></script>';
            echo '<script src="' . self::$relative_route  . 'assets/admin/pages/scripts/form-validation.js"></script>';
            
            echo '<script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/select2/select2.min.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/ckeditor/ckeditor.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
                    <script type="text/javascript" src="' . self::$relative_route  . 'assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>';
           
      
    }
    
    static function Get_ImgSesion($imagen)
    {
        echo '<img alt="" class="img-circle" src="' . self::$relative_route . 'admin/img/users/' . $imagen . '" />';
    }
    
    static function Get_Quick_Sidebar()
    {
        echo '<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>';
        echo '<div class="page-quick-sidebar-wrapper">';
        
        echo '</div>';
    }
    
    
    static function Get_Sublinks($link= null , $link1 = null)
    {
        echo '<ul class="page-breadcrumb">
					<li id="id_sublinks_1">
                                                <i class="fa fa-home"></i>
						<a href="' . self::$relative_route . 'admin/index.php"> ' . $link . '</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li id="id_sublinks_2">
                                            <a href="#">' . $link1 . '</a>
					</li>               
		</ul>';
        echo ' <div class="page-toolbar">
			<div id="google_translate_element"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({pageLanguage: "es", includedLanguages: "de,en,es,pt", layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, "google_translate_element");
                        }
                         </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                 </div>';
    }
    
    
 
    
}

?>
