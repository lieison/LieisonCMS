<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of page
 *
 * @author rolandoantonio
 */
class ViewPage {
   
    public function __construct() {
        
    }
    
   
    
    public function _slider1(
            $img , 
            $text_header ,
            $text_body ,
            $text_title ,
            $bootstrap_icon = "fa fa-thumbs-up",
            $data_speed = "1000",
            $data_start = "500"
            )
    {
        $slider = '<img src="' . $img . '" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">';
        $slider .= '<div class="tp-caption large_text customin customout start"'
                .' data-x="center"'
                .' data-hoffset="0"'
                .' data-y="center"'
                .' data-voffset="60"'
                .' data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"'
                .' data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"'
                .' data-speed="' . $data_speed . '"'
                .' data-start="' . $data_start . '"'
                .' data-easing="Back.easeInOut"'
                .' data-endspeed="300">'
                .'<div class="promo-like"><i class="' . $bootstrap_icon . '"></i></div>'
                .'<div class="promo-like-text">';
        $slider .= "<h2>$text_title</h2>";
        $slider .= "<p>$text_body</p>";  
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
        $slider .= 'style="z-index: 6">' . $text_header;
        $slider .= '</div>';
        return $slider;
    }
    
    
    /**
     *     <img src="assets/frontend/onepage/img/silder/Slide2_bg.jpg" alt="slidebg2" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
            <div class="caption lft start"
              data-y="center"
              data-voffset="40"
              data-x="center"
              data-hoffset="-250"
              data-speed="600" 
              data-start="500" 
              data-easing="easeOutBack"><img src="assets/frontend/onepage/img/silder/Slide2_iphone_left.png" alt="">
            </div>
            <div class="caption lft start"
              data-y="center"
              data-voffset="130"
              data-x="center"
              data-hoffset="170"
              data-speed="600" 
              data-start="1200" 
              data-easing="easeOutBack"><img src="assets/frontend/onepage/img/silder/Slide2_iphone_right.png" alt="">
            </div>
            <div class="tp-caption large_bold_white fade"
              data-x="center"
              data-y="40"
              data-speed="300"
              data-start="1700"
              data-easing="Power4.easeOut"
              data-endspeed="500"
              data-endeasing="Power1.easeIn"
              data-captionhidden="off"
              style="z-index: 6">Extremely <span>Responsive</span> Design
            </div>
     */
    
    /**
     *
     * @param Mixed $slider_img 
     *<code>
     * 
     * $data = array();
     * $val1 = array("image"=>"http://", "speed"=>"500" , "start"=>"500" )
     * $val2 = array("image"=>"http://", "speed"=>"500" , "start"=>"500" )
     * 
     *</code>
     * 
     */
    public function _slider2($parent_img , $title , $slider_img = array() )
    {

        $slide_ = '<img src="' . $parent_img .'" alt="slidebg2" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">';
        if(!count($slider_img)== 0):
            for($i=0 ; $i < count($slider_img) ; $i++):
                $value = $slider_img[$i];
                $speed = $value['speed'];
                $start = $value['start'];
                $image = $value['image'];
                $h = $value['hoffset'];
                $v = $value['vhoffset'];
                $slide_ .= ' <div class="caption lft start"
                            data-y="center"
                            data-voffset="' . $v . '"
                            data-x="center"
                            data-hoffset="' . $h . '"
                            data-speed="' . $speed .'" 
                            data-start="' . $start .'" 
                            data-easing="easeOutBack"><img src="'. $image  .'" alt="">
                            </div>';
            endfor;
        endif;
        
        $slide_ .= '<div class="tp-caption large_bold_white fade"
              data-x="center"
              data-y="40"
              data-speed="300"
              data-start="1700"
              data-easing="Power4.easeOut"
              data-endspeed="500"
              data-endeasing="Power1.easeIn"
              data-captionhidden="off"
              style="z-index: 6">' . $title . '</div>';
        
        return $slide_;
    }
    
}
