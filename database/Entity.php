<?php

require_once 'Database.php';

class Entity {

    protected $tableName;

    function __construct($tableName) {
        $this->tableName = $tableName;
    }

    /**
     * Método que ejecuta un BEGIN TRANSACTION.
     * Se usa para dar inicio a una transacción.
     */
    public static function beginTransaction() {
        self::getConn()->exec_query("BEGIN TRANSACTION;");
    }

    /**
     * Método que ejecutao un END TRANSACTION o, lo que es lo mismo en SQLITE,
     * un COMMIT.
     * Se usa cuando se quieren confirmar los cambios en la Base de Datos en 
     * medio de una transacción.
     */
    public static function endTransaction() {
        self::getConn()->exec_query("END TRANSACTION;");
    }

    /**
     * Método que hace rollback a una transacción.
     * Se usa en caso de que no se quieran confirmar los cambios en la 
     * Base de Datos en medio de una transacción.
     */
    public static function rollBack() {
        self::getConn()->exec_query('ROLLBACK');
    }
    public static function commit() {
    	return self::getConn()->exect_query('COMMIT');
    }

    /**
     * @return string retorna el nombre de la tabla.
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * @return Database retorna la conexión actual con la BD.
     */
    public static function getConn() {
        return Database::getDBConnection();
    }

    /**
     * Método que crea un nuevo registro en la BD.
     * @param array $data array('field','content',type)
     * field: nombre del campo.
     * content: Los datos a agregar en el insert.
     * type: tipo de dato.
     */
    public function create(array $data) {


        $query = "INSERT INTO " . $this->tableName . "(";

        foreach ($data as $d) {
            $query .= $d['field'] . ",";
        }

        $query = substr($query, 0, strlen($query) - 1) . ") VALUES (";

        foreach ($data as $d) {
            switch ($d['type']) {
                case 'int':
                    if (is_null($d['content'])) {
                        $query.= "NULL,";
                    } else {
                        $query.= $d['content'] . ",";
                    }
                    break;
                case 'text':
                    if (is_null($d['content'])) {
                        $query.= "NULL,";
                    } else {
                        $query.= "'" . $d['content'] . "',";
                    }
                    break;
                case 'date':
                    if (is_null($d['content'])) {
                        $query.= "NULL,";
                    } else {
                        $query.= $d['content'] . ",";
                    }
                    break;
                default:
                    $query.= "'" . $d['content'] . "',";
                    break;
            }
        }
        
        $query = substr($query, 0, strlen($query) - 1) . ")";
        return self::getConn()->exec_query($query);
    }

    /**
     * Método que actualiza uno o varios registros en la BD.
     * @param array $data contiene la siguiente informacion ('data'('field','content','type'))
     * @param string $condition Condiciones para hacer el update.
     */
    public function update(array $data, $condition = "") {
        $query = "UPDATE " . $this->tableName . " SET ";

        foreach ($data as $d) {
            $query .= $d['field'] . " = ";
            switch ($d['type']) {
                case 'int':
                    $query.= $d['content'] . ",";
                    break;
                case 'text':
                    $query.= "'" . $d['content'] . "',";
                    break;
                default:
                    $query.= "'" . $d['content'] . "',";
                    break;
            }
        }

        $query = substr($query, 0, strlen($query) - 1);
        if ($condition != "") {
            $query .= " WHERE " . $condition;
        }
        return self::getConn()->exec_query($query);
    }

    /**
     * Método que elimina uno o varios registros en la BD.
     * @param string $condition condiciones bajo las cuales se van a eliminar los campos.
     */
    public function delete($condition = "") {
        $query = "DELETE FROM " . $this->tableName . " WHERE " . $condition;
        return self::getConn()->exec_query($query);
    }

    /**
     * Método que retorna todos los elementos de la tabla.
     * @return array todos los registros en la base de datos.
     */
    public function getAll() {
        $query = "SELECT * FROM " . $this->tableName;

        return self::getConn()->getData($query);
    }

    /**
     * Método que busca y retorna un elemento partiendo de su respectivo id. 
     * @param int $id recibe como parametro el id del elemento que se quiere encontrar.
     * @return array retorna el resultado de la busqueda.
     */
    public function find($id) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = " . $id;
        return self::getConn()->getData($query);
    }

    /**
     * Método que actualiza varios registros de una tabla HAS, 
     * borrando los registros existentes y luego insertando nuevos registros todo
     * respecto a un campo (el campo fijo). La tabla TIENE que ser de tipo HAS.
     * @param array $fields vector que contiene dos array (array del campo fijo, array de campos secundarios).
     * campo fijo ('field' => nombre_campo, 'value' => valor).
     * campos secundarios (nombre_campo_1, nombre_campo_2,..., nombre_campo_n)
     * @param array $data matriz con los valores de los campos secundarios.
     * $data = (array('campo_secundario_1'=>valor,'campo_secundario_2'=>valor,...,'campo_secundario_n'=>valor),...)
     * @param boolean $delete true: elimina los registros existentes (cuando se quiere actualizar)
     * false: no elimina los registros existentes (cuando se quiere insertar solamente)
     */
    public function updateHasTable(array $fields, array $data, $delete = false) {

        if ($delete) {
            //elimina los registros
            self::delete($fields[0]['field'] . "=" . $fields[0]['value']);
        }

        if (count($data) > 0) {
            
            foreach ($data as $d) {
                //crea el query
                $query = "INSERT INTO " . $this->tableName . "(";
                $count = 0;

                //agrega los campos
                foreach ($fields as $f) {
                    if ($count == 0) {
                        $query.= $f['field'] . ",";
                    } else {
                        foreach ($f as $s) {
                            $query.= $s . ",";
                        }
                    }
                    $count++;
                }

                $query = substr($query, 0, strlen($query) - 1);
                $query .= ")VALUES";
                $query .= "(" . $fields[0]['value'] . ",";

                //total de campos secundarios
                $totalCamposSec = count($fields[1]);

                for ($i = 0; $i < $totalCamposSec; $i++) {
                    $query .= $d[$fields[1][$i]] . ",";
                }
                $query = substr($query, 0, strlen($query) - 1);
                $query .= "),";

                $query = substr($query, 0, strlen($query) - 1);
                //ejecuta el query
                self::getConn()->exec_query($query);
            }
            return true;
        }
    }

    /**
     * Función que obtiene el último registro de la tabla.
     * @return Object array con los datos del registro 
     */
    public function getLast($cond) {
        $query = "SELECT * FROM " . $this->tableName . " "
                . "WHERE ROWNUM <= 1 "
                . "ORDER BY " . $cond . " DESC ";
        $result = self::getConn()->getData($query);
        return isset($result[0]) ? $result[0] : null;
    }

    public function findByData($data) {
        $query = "SELECT * FROM $this->tableName 
                  WHERE ";

        foreach ($data as $d) {
            switch ($d['type']) {
                case 'int':
                    $query.= $d['field'] . '=' . $d['content'] . " AND ";
                    break;
                case 'text':
                    $query.= $d['field'] . '="' . $d['content'] . '" AND ';
                    break;
                default:
                    $query.= $d['field'] . '="' . $d['content'] . '" AND ';
                    break;
            }
        }

        $query = substr($query, 0, strlen($query) - 4);
        return self::getConn()->getData($query);
    }
    
    /**
     * Método que busca y retorna los datos de una tabla, filtrados por un campo
     * específico y su valor.
     * @param string $field campo para filtrar.
     * @param string/int $value valor del campo para filtrar.
     * @param string $type Tipo de dato a buscar: 'int' o 'text'.
     * @return array Array con los resultados de la busqued.
     */
    function findByField($field, $value, $type){
        
        $query = "SELECT * FROM ".$this->tableName." 
                  WHERE $field ";
        
        switch ($type){
            case 'text':
                $query .= 'LIKE "'.$value.'"';
                break;
            case 'int':
                $query .= '='.$value;
                break;
            default :
                $query .= '='.$value;
                break;
        }
        
        return self::getConn()->getData($query);
    }

}

?>
