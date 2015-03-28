<?php

/*
 * CLASE DASHBOARD CONTROLLER 
 * ESTA CLASE ES PRIMORDIAL EN LA CUAL MOSTRARA LOS ELEMENTOS U OBJETOS DEL 
 * DASHBOARD SIDEBAR
 * 
 * VERSION ESTABLE 1.4 
 */

class DashboardController extends MysqlConection {
    
    protected $format;
    protected $puntero;
    protected $dashboard_key = array();


    public function __construct() {
        parent::__construct();
    }
    
    
    
    /**
     *
     *@todo Funcion en la cual verifica que objetos debe ir en el dashboard y apunta a ese objeto
     *      una funcion muy importante en la cual consiste de dos parametros 
     * 
     *@param String $privilegios Nombre del privilegio 
     *@param string $puntero , Nombre del script a apuntar 
     *
     * @version 1.2
     *  -Se repararon bug en cuestion de privilegios administrativos
     * @version 1.3
     *  -Version Actual (creacion de la funcion ComparePriv para obtener mejor proceso )
     *  -Se agrego el multi privilegio , consiste en que el usuario pueda agregar privilegios de terceros
     * @version 1.4
     *  -Muy pronto , se agregara la opcion de $privilegios por nivel ...
     * 
     * @return Mixed devuelve el dashboard menu sidebar en fortmato HTML
     *
     */
   
    public function get_dashboard_sidebar_menu($privilegios , $puntero = null )
    {
      
        
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
            if($nivel == $v['privilegios'] || $v['privilegios'] == 0 || $nivel == 55 ){
            $id = $v["id_seccion"];
            $array_seccion[$id] = array(
                "icono" =>$v["icono"] , 
                "titulo"=>$v["titulo"],
                "numero"=>$v['numero']);
            }
        }
        
        foreach ($array_seccion as $key=>$value)
        {
            $query = "SELECT dashboard.id_dashboard , dashboard.privilegios , dashboard.icono as icono , dashboard.link"
                . ", dashboard.titulo FROM dashboard INNER JOIN seccion_dashboard ON "
                . " dashboard.id_seccion=seccion_dashboard.id_seccion WHERE seccion_dashboard.id_seccion LIKE '$key'"
                . " ORDER BY dashboard.start ASC";
            
            $result = $this->RawQuery($query);
            $array_seccion[$key] = array($value , $result);
        }

        $this->format = '<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- PUENTE -->
				<li class="sidebar-search-wrapper">
                                    <br><br>
				</li>';
        
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
                $id = $v['id_dashboard'];
                
                    if(count($priv) >= 2)
                    {
                       
                        foreach ($priv as $p)
                        {
                             if(!in_array($id, $this->dashboard_key)){
                                $this->ComparePriv($nivel , $p , $link , $titulo , $icon ,$id);
                             }
                        }
                    }
                    else{
                        $this->ComparePriv( $nivel , $priv[0], $link , $titulo , $icon , $id);
                    } 
            }
            
            $this->format .= "</ul></li>";

        }
       
         return $this->format;
  
    }
    
    /**FUNCION QUE COMPLEMENTA LA FUNCION PRINCIPAL get_dashboard_sidebar_menu*/
    private function ComparePriv($priv_user , $priv_dashboard , $link , $titulo , $icon , $id )
    {

          if($priv_dashboard == $priv_user || 
                  $priv_dashboard==0 || 
                  $priv_user == 55)
                {
                    
                    if($this->puntero != null && $this->puntero == $titulo){
                         $this->format.='<li class="start active open">';
                    }
                    else{
                         $this->format.='<li>';
                    }
                   
                    $this->format.= '<a href="' . FunctionsController::GetUrl($link) .'">';
                    $this->format.= '<i class="'.$icon.'"></i>&nbsp&nbsp';
                    $this->format.= $titulo .'</a></li>';
                    
                    array_push($this->dashboard_key, $id);
                }
    }
    
    
   
}
