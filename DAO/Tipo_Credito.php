
<?php

require_once '../database/Entity.php';

class tipo_credito extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.tipo_credito");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new tipo_credito();
        }

        return self::$instance;
    }
    
}