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

    public function consultarMovimientos(){
    	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
    	}
	try{
		$query = 'select m.v_monto_mov, m.f_movimiento, t.n_movimiento from fondo.movimiento_cuenta m, fondo.tipo_movimiento t where m.k_id_tipo_mov = t.k_id_tipo_mov';
        	$dbConn = parent::getDBConnection($_SESSION['USERNAME'], $_SESSION['PASS']);
        	return self::getData($dbConn, $query);
	}catch(Exception $e){
		return false;
	}
    }

}
