
<?php

require_once '../database/Entity.php';

class Socio extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("socio");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Socio();
        }

        return self::$instance;
    }
    
}
