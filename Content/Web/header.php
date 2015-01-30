




<?php 
echo '<!DOCTYPE html>
<!-- 
Version: 
Author: 
Website: 
Contact: 
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
License: Lieison Working Together
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->';


class ViewHeader
{
    
    
    private $js_dir = "js/";
    private $css_dir = "assets/";
    private $css_root = "css/";
    
    private $host_server = null;
    
    public function __construct($url_server = "http://localhost") {
        $this->host_server = $url_server;
    }
    
    public function Get_js()
    {
        $js = '<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
               <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>';
        return $js;
    }
    
    public function get_title($title)
    {
        return "<title>$title</title>";
    }
    
    public function  get_icon($icon_url)
    {
        return "<link rel='shortcut icon' href='$icon_url'>";
    }
    
    public function  get_css($theme =  "red.css")
    {
        $css = ' <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"> ';
        $css .= '<link href="' . $this->css_dir . 'global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'global/css/components.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'frontend/onepage/css/style.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'frontend/onepage/css/style-responsive.css" rel="stylesheet">';
        $css .= '<link href="' . $this->css_dir . 'frontend/onepage/css/themes/' . $theme . '" rel="stylesheet" id="style-color">';
        $css .= '<link href="' . $this->css_dir . 'frontend/onepage/css/" rel="stylesheet">';
        return $css;
    }
    
    
    public function _logotype($logo_url)
    {
       $convert_logo = $logo_url;
       echo $logo = "<a class='scroll site-logo' href='#promo-block'><img src='$convert_logo' alt='Lieison working together'></a>";
    }
    
    
    public function  __navigator($data , $main_name = "Inicio")
    {
        $nav = '<li class="current"><a href="#promo-block">Inicio</a></li>';
        foreach ($data as $key=>$value):
            $nav .= "<li><a href='#$key'>$value</a></li>";
        endforeach;
        
        return $nav;
    }

    
    
    
}

?>
