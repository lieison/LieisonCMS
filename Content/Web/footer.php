<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of footer
 *
 * @author rolandoantonio
 */
class ViewFooter {
    
    
    private $js_dir = "assets/";
    private $js_root = "js/";
    
  

    public function get_footer_js()
    {
        $js = "";
        $js .= '<!--[if lt IE 9]>
                 <script src="' . $this->js_root . 'respond.min.js"></script>
             <![endif]-->
             <!-- Load JavaScripts at the bottom, because it will reduce page load time -->
             <!-- Core plugins BEGIN (For ALL pages) -->';
        
        $js .= '<script src="' . $this->js_dir .  'global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'frontend/onepage/scripts/revo-ini.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'global/plugins/jquery.easing.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'global/plugins/jquery.parallax.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir.   'global/plugins/jquery.scrollTo.min.js"" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'frontend/onepage/scripts/jquery.nav.js" type="text/javascript"></script>';
        $js .= '<script src="' . $this->js_dir .  'frontend/onepage/scripts/layout.js" type="text/javascript"></script>';
        return $js;
    }
    
}
