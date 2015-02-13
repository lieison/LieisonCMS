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
    
    protected $format;
    protected $puntero;


    public function __construct() {
        parent::__construct();
    }
    
    
    public function GetUrl($link)
    {
        return $url = "http://" . $_COOKIE['SERVER'] . "/" . $_COOKIE['FOLDER'] . "/Content/Web/admin/$link";
    }
    
    public function get_dashboard_sidebar_menu($privilegios , $puntero = null )
    {
        $nivel = 0;
        $array_seccion = array();
        
        $this->puntero = $puntero;
        $query = "SELECT nivel FROM privilegios WHERE nombre LIKE '$privilegios'";
        $result = $this->RawQuery($query);
        $nivel =  $result[0]["nivel"];
        
        $query = "SELECT id_seccion , seccion_dashboard.icono , seccion_dashboard.titulo , numero , privilegios"
                . " FROM seccion_dashboard ORDER BY numero ASC";
       
        $result_d = $this->RawQuery($query);
        

        foreach ($result_d as $k=>$v)
        {
            if($nivel == $v['privilegios'] || $v['privilegios'] == 0 ){
            $id = $v["id_seccion"];
            $array_seccion[$id] = array(
                "icono" =>$v["icono"] , 
                "titulo"=>$v["titulo"],
                "numero"=>$v['numero']);
            }
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

        $this->format = "";
        foreach ($array_seccion as $key=>$value)
        {
            
            
            $side = $value[0];
            
            if($side["numero"] == 1)
            {
                
                $this->format .= '<li class="start active open">';
                $this->format .= '<a href="javascript:;">';
                $this->format .= '<i class="' . $side['icono'] .'"></i>';
                $this->format .= '<span class="title">' . $side['titulo'] .'</span>';
                $this->format .= '<span class="selected"></span>
                            <span class="arrow open"></span></a>';
            }
            else
            {
                
                $this->format .= '<li><a href="javascript:;">';
                $this->format .= '<i class="' . $side['icono'] .'"></i>&nbsp&nbsp';
                $this->format .= '<span class="title">' . $side['titulo'] .'</span>';
                $this->format .= '<span class="arrow"></span></a>';
            }
            
            $data = $value[1];
            $this->format .= '<ul class="sub-menu">';
            foreach ($data as $k=>$v)
            {
               
                $priv = explode(",", $v["privilegios"]);
                $icon = $v['icono'];
                $link = $v['link'];
                $titulo = $v['titulo'];
                
                if(count($priv) >= 2)
                {
                    foreach ($priv as $p)
                    {
                        $this->ComparePriv($p, $nivel , $link , $titulo , $icon);
                    }
                }
                else{
                    $this->ComparePriv($priv[0], $nivel, $link , $titulo , $icon);
                } 
            }
            
            $this->format .= "</ul></li>";

        }
       
         return $this->format;
  
    }
    
    private function ComparePriv($priv_user , $priv_dashboard , $link , $titulo , $icon )
    {
          if($priv_dashboard == $priv_user || $priv_dashboard==0 || $priv_user == 55)
                {
                    
                    if($this->puntero != null && $this->puntero == $titulo){
                         $this->format.='<li class="start active open">';
                    }
                    else{
                         $this->format.='<li>';
                    }
                   
                    $this->format.= '<a href="' . $this->GetUrl($link) .'">';
                    $this->format.= '<i class="'.$icon.'"></i>&nbsp&nbsp';
                    $this->format.= $titulo . '</a></li>';
                }
    }
    
    
   
}
