<?php

require_once '../database/Entity.php';

class MovimientoCuenta extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.movimiento_cuenta");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new MovimientoCuenta();
        }

        return self::$instance;
    }

}
