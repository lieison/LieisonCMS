<?php namespace Plugin\Install;


 define("TABLE_NAME", "name");
 define("TABLE_VALUE", "value" );

abstract class InstallClass extends \MysqlConection {
    
    var $tables             = array();
    
    var $error              = array();
    
    var $table_key_error    = array();
    
    var $class              = null;
    
    var $querys             = array();
    
    var $querys_result      = array();
    
    var $root               = null;
    
    
    public function __construct($conect_dsn = array(), $directory = null) {
        parent::__construct($conect_dsn, $directory);
    }
    
    
    public function SetTable($table_name , $table_values){
        $this->tables[] = array(
            TABLE_NAME      => $table_name , 
            TABLE_VALUE     => $table_values
          );
    }
    
    public function SetQuery($query){
        $this->querys[] = $query;
    }
    
    
    public function SetRoot($root){
        $this->root = $root;
    }


    public function GetError(){
        return $this->error;
    }
    
    
    public function  GetTableError(){
        return $this->table_key_error;
    }
    
    public function GetResultQuerys(){
        return $this->querys_result;
    }


    public function ConfigDatabases(array $mysql_tables = array() ){
        if(!empty($mysql_tables)){ $this->tables = $mysql_tables; }
        $tables_exist = $this->GetAllDatatables();
        foreach($this->tables as $key=>$value){
            $table = $value[TABLE_NAME];
            $flag = TRUE;
            for ($i=0; $i< count($tables_exist); $i++){
                if(strcmp($table, $tables_exist[$i][0] ) == 0){
                    $this->error[] = "Error, Ya existe la tabla con el nombre de $table";
                    $flag = FALSE;
                    break;
                }
            }
            if(!$flag){
               $this->table_key_error[] = $key;
            }
        }
    }
    
    public function GetAllDatatables(){
       return  $db_tables = parent::RawQuery("show tables " , \PDO::FETCH_NUM);
    }
    
    public function MysqlInstallQuerys(){
        if(count($this->querys) == 0){
            return;
        }
        parent::beginTransaction();
        for($i=0; $i<count($this->querys); $i++){
            try{
                parent::exec($this->querys[$i]);
            } catch (PDOException $ex){
                $this->error[] = "Error Introducir query : " .  $ex->getMessage() . " Code: " . $ex->getCode() ;
            }
        }
        parent::commit();
    }
    
    public function MysqlInstallTables(){
         $mysql_table = "";
         parent::beginTransaction();
         if(count($this->table_key_error) >= 1){
              foreach ($this->tables as $key=>$value){
                   $flag = false;
                   for($i=0; $i<count($this->table_key_error); $i++){
                       if($key == $this->table_key_error[$i]){
                           $flag = true;
                           break;
                       }
                   }
                   if(!$flag){
                        $mysql_table = "CREATE TABLE " . $value[TABLE_NAME] 
                                 . " (" 
                                 . implode(",", $value[TABLE_VALUE])
                                 . "); ";
                       parent::exec($mysql_table);
                   }
              }
         }else{
              foreach ($this->tables as $key=>$value){
                    $mysql_table .= "CREATE TABLE " . $value[TABLE_NAME] 
                                 . " (" 
                                 . implode(",", $value[TABLE_VALUE])
                                 . "); ";
                 }
            parent::exec($mysql_table);
         }
         parent::commit();
         
    }
    
    public abstract function  Install();
    
    public abstract function  Unistall();

 
}
