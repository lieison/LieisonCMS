<?php



/*
 *FORNT END CONTROLLER NO SE LOGRARA TRABAJAR EN LA VERSION CMS
 *@deprecate 
 */



class FrontEndController extends MysqlConection  {
    
    var $query = null;
    
    var $result = null;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function __unset($name) {
        
    }
    
    public function __invoke() {
         
    }

    public function CreateSlider($slider_type = SLIDER_STANDAR , $args) 
    {
        if(!is_array($args)){
            return false;
        }
        
        $slider = SliderModel::GetSliderScript($slider_type);
    }
    
    public function InsertVisit($mes , $anio)
    {
         $this->query = "SELECT * FROM visitas WHERE mes like $mes and anio like $anio";
         $this->result = $this->RawQuery($this->query);
         if(count($this->result) == 0){
             echo "hola";
             $is_insert = $this->Insert("visitas", array(
                 "numero" =>1,
                 "mes"=> $mes,
                 "anio"=> $anio
             ) );
             if($is_insert) return true;
         }
         else
         {
             $this->query = "UPDATE visitas SET numero=numero+1 WHERE mes='$mes' and anio='$anio'";
             $is_update = $this->RawQuery($this->query);
             if($is_update) return true;
         }
         
         return false;
         
    }
    
    public function GetWebvisits($anio ){
          $this->query = "SELECT numero , mes , anio FROM visitas where anio like $anio ORDER BY mes ASC";
          $this->result = $this->RawQuery($this->query);
          return $this->result;
    }
    
    
    
}
