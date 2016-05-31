<?php

require_once '../database/Entity.php';

class CuentaFondo extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.cuenta_fondo");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new CuentaFondo();
        }

        return self::$instance;
    }

}
