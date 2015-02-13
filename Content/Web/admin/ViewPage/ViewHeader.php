<?php

   
class AdminHeader
{
    
    public static  $relative_route = "../";
    
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
        
    }
    
}

?>
