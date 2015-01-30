<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author rolandoantonio
 */
class DashboardController extends MysqlConection {
    
    
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function GetUrl($link)
    {
        return $url = "http://" . $_COOKIE['SERVER'] . "/" . $_COOKIE['FOLDER'] . "/Content/Web/admin/$link";
    }
    
    public function get_dashboard_sidebar_menu($privilegios , $puntero = null)
    {
        $nivel = 0;
        $array_seccion = array();
        
        
        $query = "SELECT nivel FROM privilegios WHERE nombre LIKE '$privilegios'";
        $result = $this->RawQuery($query);
        $nivel =  $result[0]["nivel"];
        
        $query = "SELECT id_seccion , seccion_dashboard.icono , seccion_dashboard.titulo , numero"
                . " FROM seccion_dashboard ORDER BY numero ASC";
       
        $result_d = $this->RawQuery($query);
        

        foreach ($result_d as $k=>$v)
        {
            $id = $v["id_seccion"];
            $array_seccion[$id] = array(
                "icono" =>$v["icono"] , 
                "titulo"=>$v["titulo"],
                "numero"=>$v['numero']);
        }
        
        foreach ($array_seccion as $key=>$value)
        {
            $query = "SELECT dashboard.privilegios , dashboard.icono as icono , dashboard.link"
                . ", dashboard.titulo FROM dashboard INNER JOIN seccion_dashboard ON "
                . " dashboard.id_seccion=seccion_dashboard.id_seccion WHERE seccion_dashboard.id_seccion LIKE '$key'"
                . " ORDER BY dashboard.start ASC";
            
            $result = $this->RawQuery($query);
            $array_seccion[$key] = array($value , $result);
        }

        $format = "";
        foreach ($array_seccion as $key=>$value)
        {
            
            
            $side = $value[0];
            
            if($side["numero"] == 1)
            {
                
                $format .= '<li class="start active open">';
                $format .= '<a href="javascript:;">';
                $format .= '<i class="' . $side['icono'] .'"></i>';
                $format .= '<span class="title">' . $side['titulo'] .'</span>';
                $format .= '<span class="selected"></span>
                            <span class="arrow open"></span></a>';
            }
            else
            {
                
                $format .= '<li><a href="javascript:;">';
                $format .= '<i class="' . $side['icono'] .'"></i>';
                $format .= '<span class="title">' . $side['titulo'] .'</span>';
                $format .= '<span class="arrow"></span></a>';
            }
            
            $data = $value[1];
            $format .= '<ul class="sub-menu">';
            foreach ($data as $k=>$v)
            {
               
                $priv = $v["privilegios"];
                $icon = $v['icono'];
                $link = $v['link'];
                $titulo = $v['titulo'];
                
                if($priv <= $nivel )
                {
                    
                    if($puntero != null && $puntero == $titulo){
                         $format.='<li class="start active open">';
                    }
                    else{
                         $format.='<li>';
                    }
                   
                    $format.= '<a href="' . $this->GetUrl($link) .'">';
                    $format.= '<i class="'.$icon.'"></i>';
                    $format.= $titulo . '</a></li>';
                }
            }
            
            $format .= "</ul></li>";

        }
        
         //$format .= '</li>';
         return $format;
  
    }
    
    
    public function  get_dashboard_copyright()
    {
        
    }
    
    
    public function set_dashboard_copyrigth()
    {
        
    }
    
   
}
