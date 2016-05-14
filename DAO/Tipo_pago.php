
<?php

require_once '../database/Entity.php';

class tipo_pago extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.tipo_pago");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new tipo_pago();
        }

        return self::$instance;
    }
    
}