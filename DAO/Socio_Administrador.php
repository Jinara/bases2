

<?php

require_once '../database/Entity.php';

class Socio_Administrador extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.socio_administrador");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Socio_administrador();
        }

        return self::$instance;
    
    }
}
