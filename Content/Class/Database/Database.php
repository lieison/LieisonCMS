<?php



class Database {
    
    
    private $dsn        = NULL;
    
    private $driver     = NULL;
    
    private $db         = NULL;
    
    private $prefix     = NULL;
    
    private $request    = NULL;
    
    
    var $query          = NULL;
    

    public function __construct() {
        
        global $CONFIG_;
        
        /*VARIABLE QUE SERVIRA PARA VERIFICAR EL DRIVER DE CONEXION PDO**/
        $this->driver   = $CONFIG_["DB_CONFIG"]["driver"];
        $this->prefix   = $CONFIG_["DB_CONFIG"]["prefix"];
        
        //CONFIGURACION QUE TIPO DE DRIVER INSTALO
        switch ($CONFIG_["DB_CONFIG"]["driver"]){
            case "sqlite":
                    $this->dsn = "sqlite:" . $CONFIG_["DB_CONFIG"]["sqlite_db"];
                break;
            case "mysql":
            case "oci":
            case "pgsql":  
                
                    $this->dsn = $CONFIG_["DB_CONFIG"]["driver"].
                     ':host='.$CONFIG_["DB_CONFIG"]["host"].
                     ';dbname='.$CONFIG_["DB_CONFIG"]["database"];
                     
                     if(!empty($CONFIG_["DB_CONFIG"]["port"])){
                        $this->dsn .= ';port='.$CONFIG_["DB_CONFIG"]["port"];
                     }
                
                break;
        }
        
        try{
                $this->db = new PDO(
                        $this->dsn,
                        $CONFIG_["DB_CONFIG"]["user"] ,
                        $CONFIG_["DB_CONFIG"]["password"] 
                );
        } catch (PDOException $ex){
            echo "Opps !! Algo esta mal (" . $ex->getMessage() . ")";
            $this->SetLog($ex->getMessage(), $ex->getLine());
        }

    }
    
    
    /***
     * REGION DE FUNCIONES GENERALES Y PUBLICAS 
     * QUERYS 
     * 
     */
    
     public function RawQuery($query , $style = PDO::FETCH_CLASS)
    {
            $this->query = $query;
            $this->request = $this->db->query($this->query);
            $result = $this->request->fetchAll($style);
           
            return $result;
    }
    
    
    public function  CountRows(){
         return $this->request->rowCount();
    }
    
    
    
    /****
     * REGION DE FUNCIONES CRUD 
     * 
     */
    
    public function Insert($table , $params = array())
    {
        if(!empty($this->prefix)){
            $table = $this->prefix . $table;
        }
        
        $this->query = "INSERT INTO $table ";
        $this->query .= "(". implode(",", array_keys($params)).")";
        $this->query .= " VALUES ('" . implode("', '", array_values($params)) . "')";
        
        try{
            $IsOk = parent::exec($this->query);
            if ($IsOk >= 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw "Error en insertar values $ex";
        }
        return false;
    }
    
    
    
    /**
     * REGION DE FUNCIONES PRIVADAS 
     * EN GENERAL
     * 
     * **/
    
    private function SetLog($error , $line  ){
        try{
            $file = new SplFileObject("db_log" , "w+");
            $file->fwrite($this->driver .
                  " ERROR IN LINE" . 
                  $line 
                  . " , THAT MESSAGE (" 
                  . $error . ")"
                  . "ON date " . date("d-M-y")
            );
            
            unset($file);
            
        } catch (Exception $ex){
            echo $ex->getMessage();
        }
    }
    
    
}
