<?php
/**
 * Description of DataBase
 *
 * @author Nathaly
 */
class Database {
    private $dbConn;
    private static $instance = NULL; //Instancia patrón Singleton
    private $user = null;
    private $pass = null;
    private $str_conn = null;
    /**
     * 
     * @param type $user Usuario de la BD
     * @param type $pass Password del usuario
     * @param type $str_conn String de la conexión (servidor).
     */
    protected function __construct() {
    	$user = "fondo";
	$pass = "fondo";
	$str_conn = "localhost/XE";
        if(($user != NULL && $pass != NULL) && (isset($user)&& isset($pass))){
            $this->dbConn = oci_connect($user, $pass, $str_conn);
        }else{
            $this->dbConn = oci_connect('no_registrado', 'admin', $str_conn);
        }
    }
    /**
     * Ejecuta un query. No retorna resultados.
     * @param String $query Sentencia SQL a ejecutar.
     * @param Object $conn Objeto de conexión con la Base de Datos.
     * @return boolean $error False si no existe error en la consulta.
     * En caso contrario retorna un array asociativo con la descripción del error. 
     */
    public function exec_query($query) {
        $error = false;
        
        $consulta = oci_parse($this->getConn(), $query);
        $has_error = oci_execute($consulta);
        $error = !$has_error ? oci_error($consulta) : true;
        return $error;
    }
    

    /**
     * Retorna el objeto de conexión.
     * @return Object Objeto de conexión actual.
     */
    public function getConn(){
        return $this->dbConn;
    }
    /**
     * Retorna los resutados de la consulta en un array asociativo
     * @param string $query Consulta SQL que se ejecutará.
     * @param Object $conn Objeto de conexion con la BD.
     * @return array Matriz con los resultados de la consulta 
     * incluido error si llega a existir.
     */
    public function getData($query) {
        
        $consulta = oci_parse($this->getConn(), $query);
        $has_error = oci_execute($consulta);
        
        $resultado = array();
        
        !$has_error == false?$error = oci_error():$error = false;
        while (($row = oci_fetch_array($consulta, OCI_BOTH)) != false) {
            $resultado[] = $row;
        }
        
        $resultado['error'] = $error;
        
        return $resultado;
    }
    /**
     * Método get que devuelve la instancia Singleton. 
     * Obtiene los datos de conexión del archivo de configuración.    
     */
    public static function getDBConnection() {
        self::$instance = new DataBase();
        return self::$instance;
    }
    /**
     * Función que retorna true si la conexión a la BD se ha realizado con éxito.
     * En caso contrario retorna false.
     * @return type
     */
    public function is_connected() {
        return $this->dbConn ? true : false;
    }
}
?>
