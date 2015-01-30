<?php


/**
 * Description of SliderModel
 *
 * @author rolandoantonio
 */

define("SLIDER_STANDAR", 0);
define ("SLIDER_TWIN_IMAGE" , 1);
define ("SLIDER_VIDEO" , 2);

class SliderModel {
    
 
    
   static function GetSliderScript($type = SLIDER_STANDAR)
   {
       switch ($type)
       {
           case SLIDER_STANDAR:
               return self::StandarImageSlider();
           default:
              return self::StandarImageSlider();
       }
   }
   
    private static function StandarImageSlider()
    {
        $slider = '<img src="{slider_imagen}" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">';
        $slider .= '<div class="tp-caption large_text customin customout start"'
                .' data-x="center"'
                .' data-hoffset="0"'
                .' data-y="center"'
                .' data-voffset="60"'
                .' data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"'
                .' data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"'
                .' data-speed="{slider_speed}"'
                .' data-start="{slider_start}"'
                .' data-easing="Back.easeInOut"'
                .' data-endspeed="300">'
                .'<div class="promo-like"><i class="{slider_icon}"></i></div>'
                .'<div class="promo-like-text">';
        $slider .= "<h2>{slider_title}</h2>";
        $slider .= "<p>{slider_body}</p>";  
        $slider .= "</div></div>";
        $slider .= '<div class="tp-caption large_bold_white fade"
                    data-x="center"
                    data-y="center"
                    data-voffset="-110"
                    data-speed="300"
                    data-start="1700"
                    data-easing="Power4.easeOut"
                    data-endspeed="500"
                    data-endeasing="Power1.easeIn"
                    data-captionhidden="off"';
        $slider .= 'style="z-index: 6">{slider_header}';
        $slider .= '</div>';
        return $slider;
    }
   
    
}
