<?php namespace PDF;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class PdfToImage extends Imagick {
    
    
    var $save_to = null;
    
    var $format = null;
    
    
    public function __construct($pdf_files) {
        parent::__construct($pdf_files . '[0]');
    }
    
   
    public function Save_to($save_file = "save.jpg")
    {
        $this->save_to = $save_file;
        $this->format = pathinfo($this->save_to , PATHINFO_EXTENSION);
        return $this->format;
    }
    
    
    public function ResizeImage($columns , $rows , $filter = Imagick::FILTER_LANCZOS , $blur = 0)
    {
        parent::resizeimage($columns, $rows, $filter, $blur);
    }
    
    
    public function ScaledImg($cols, $rows)
    {
        parent::scaleimage($cols, $rows);
    }
    
    
    public function Transparency($bool = false)
    {
        if($bool):
            parent::flattenimages();
        endif;
    }
    
    
    public function WritedataImage()
    {
        parent::setimageformat($this->format);
        parent::writeimage($this->save_to , false);
    }
    

}
