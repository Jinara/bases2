<?php

class Database {

    //atributos de la clase    
    private $dbConn = NULL;
    //para conectar con mysql        
    private $host = NULL;
    private $user = NULL;
    private $password = NULL;
    private $database = NULL;
    private static $isMysql = true;
    private static $instance = NULL; //Instancia patrón Singleton

    private function __construct() {
        $configuracion = $this->obtenerConfiguracion();
        self::$isMysql = $configuracion['is_mysql'];
        
        if (self::$isMysql) {
            $this->host = $configuracion['host'];
            $this->user = $configuracion['user'];
            $this->database = $configuracion['database'];
            $this->password = $configuracion['password'];

            $this->dbConn = new mysqli($this->host, $this->user, $this->password, $this->database);
            
        } else {
            
            $this->dbConn = new SQLite3($configuracion['database'], SQLITE3_OPEN_READWRITE);
            $this->dbConn->enableExceptions(true);
            $this->dbConn->busyTimeout(3000);
        }
    }

    public function exec_query($query) {
        return $this->dbConn->query($query);
    }

    public function getData($query) {
        $array = array();
        $data = $this->dbConn->query($query);
        if (self::$isMysql) {
            while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
                $array[] = $row;
            }
        } else {
            while ($row = $data->fetchArray(SQLITE3_ASSOC)) {
                $array[] = $row;
            }
        }
        
        return $array;
    }
    
    private function getConfiguration(){
        $json_informacion = file_get_contents('../config/configuracionBaseDatos.json');
        return json_decode($json_informacion, true);
    }
}

?>
