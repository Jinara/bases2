<?php

require_once '../database/Entity.php';

class Usuario extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("usuario");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Usuario();
        }

        return self::$instance;
    }
}
