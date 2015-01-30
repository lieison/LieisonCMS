<?php  

/**
 * @depends Class.Paginacion.php
 * @author Rolando Arriaza 
 * @version 1.0
 * @todo Clase adaptador de la clase paginacion (Controlador)
 *             esta clase mejora las buenas practicas de programacion 
 *             haciendo asi mas facil la implementacion del metodo 
 * 
 * 
 */

//include "Class/Tools/Class.Paginacion.php";



class BasePagination extends Paginacion  {
   
    
    protected $ARRAY_PAGINATION = null;
    protected $POR_PAGINA = 10;
    protected $SEPARADOR = "&nbsp;";
    protected $NOMBRE_PAG = "pag";

    
    /**
     * @todo Constructor de la clase Opcional 
     */
    public function __construct(
            $conn = null , 
            $array_pagination = null,
            $perpage = 10 , 
            $separator = "&nbsp;",
            $nombre_pag = "pag"
            ) 
    {
        $this->POR_PAGINA = $perpage;
        $this->ARRAY_PAGINATION = $array_pagination;
        $this->NOMBRE_PAG = $nombre_pag;
        $this->SEPARADOR=$separator;
        parent::__construct($conn);
    }
    
   
    /**
     * @todo establece la cantidad de paginas a mostrar por enpaginado
     */
    public function SetPerPage($cant = 10)
    {
        $this->POR_PAGINA = $cant;
    }
    
    /**
     * @todo Establece el arreglo de datos a enpaginar
     */
    public function SetPagArrayData($array_data)
    {
        $this->ARRAY_PAGINATION = $array_data;
    }
    
    /**
     * @todo Establece el nombre que saldra de la pagina en el metodo get 
     * @example  index.php?pag=1
     */
    public function SetNameOfPage($name= "Pag")
    {
        $this->NOMBRE_PAG = $name;
    }
    
    /**
     *@todo separador por pagina 
     */
    public function SetSeparator($separator)
    {
        $this->SEPARADOR=$separator;
    }


    /**
     * @todo Obtiene la paginacion en un arreglo no asociado
     * @return Array arreglo 
     */
    public function GetPagination()
    {
          if(!is_array($this->ARRAY_PAGINATION))
              return FALSE;
          
          parent::agregarArray($this->ARRAY_PAGINATION);
          parent::porPagina($this->POR_PAGINA);
          parent::nombreVariable($this->NOMBRE_PAG);
          parent::linkSeparador($this->SEPARADOR);
          parent::ejecutar();
          return parent::fetchTodo();
    }
    
    /**
     * @todo obtiene la navegacion de las paginas
     * @return Link String 
     */
    public function Getnavigate()
    {
        return parent::fetchNavegacion();
    }
    
    
  
}
