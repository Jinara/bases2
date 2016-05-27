
<?php

require_once '../database/Entity.php';

class pago_aporte extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.pago_aporte");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new pago_aporte();
        }

        return self::$instance;
    }
    
}