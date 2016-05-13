<?php

require_once '../database/Entity.php';
require_once '../database/Database.php';

class Usuario extends Entity {

    private static $instance = NULL;

    public function __construct() {
        parent::__construct("fondo.usuario");
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
    	if (session_status() == PHP_SESSION_NONE) {
    		session_start();
    	}
	try{
		$query = 'create user ' . $name . ' identified by ' . $pass;
        	$dbConn = parent::getDBConnection($_SESSION['USERNAME'], $_SESSION['PASS']);
        	self::exec_query($dbConn, $query);
    		if($type == "socio"){
			$query = 'grant socio to ' . $name;
		}else{
			$query = 'grant socio_admin to ' . $name;
		}
        	return self::exec_query($dbConn, $query);
	}catch(Exception $e){
		return false;
	}

    }
    public function loginDB($user, $pass){
    	if (session_status() == PHP_SESSION_NONE) {
        	session_start();
		}
      try{
        $dbConn = parent::getDBConnection($user, $pass);
        $error = NULL;

        if($dbConn->is_connected() != 1){
          $error = oci_error();
        }

        $usuario['USERNAME'] = $user;
        $usuario['PASS'] = $pass;
        if($dbConn->is_connected() == 1){
          $this->iniciarSesion($usuario);
          return true;
        }else{
          return $error != NULL ? $error : false;
        }
        return $conn;   
    }catch(Exception $e){
        return false;
    }
    }

    private function iniciarSesion($usuario){
    	session_destroy();
    	if (session_status() == PHP_SESSION_NONE) {
          session_start();
	  }
        $_SESSION['USERNAME'] = isset($usuario['USERNAME']) ? $usuario['USERNAME'] : NULL;
        $_SESSION['PASS'] = isset($usuario['PASS']) ? $usuario['PASS'] : NULL;
        $conn = parent::getDBConnection($_SESSION['USERNAME'], $_SESSION['PASS']);
        $_SESSION['ID'] = $this->getID($_SESSION['USERNAME']);
    }

    private function getID($username){
    	$user = $this->findByField('N_USERNAME', "'".$username."'", 'text');
	return $user[0]['K_ID_USUARIO']; 
    }
}
