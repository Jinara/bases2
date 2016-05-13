
<?php

require_once '../database/Entity.php';

class Fondo extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.fondo");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Fondo();
        }

        return self::$instance;
    }
}
