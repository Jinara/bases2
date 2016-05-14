
<?php

require_once '../database/Entity.php';

class Credito extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("credito");
    }

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Credito();
        }

        return self::$instance;
    }
    
}