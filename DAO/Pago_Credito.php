
<?php

require_once '../database/Entity.php';

class pago_credito extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.pago_credito");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new pago_credito();
        }

        return self::$instance;
    }
    
}