<?php

require_once '../database/Entity.php';
require_once '../database/Database.php';

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
    /**
    *Crea el usuario nombrado en la base de datos
    */
    public function createUsuarioBD($type, $name, $pass){
	try{
		$query = 'create user ' . $name . ' identified by ' . $pass;
        	self::getConn()->exec_query($query);
    		if($type == "socio"){
			$query = 'grant socio to ' . $name;
		}else{
			$query = 'grant socio_admin to ' . $name;
		}
        	return self::getConn()->exec_query($query);
	}catch(Exception $e){
		return false;
	}

    }

    public function login($user, $pass){
      try{
	$str_conn = "localhost/XE";
        if(($user != NULL && $pass != NULL) && (isset($user)&& isset($pass))){
            $db = oci_connect($user, $pass, $str_conn);
        }else{
            $db->dbConn = oci_connect('no_registrado', 'admin', $str_conn);
        }
	return $db;	
      }catch(Exception $e){
        return false;
      }
    }
}
