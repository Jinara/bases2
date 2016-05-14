<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    require_once '../DAO/Socio.php';
    require_once '../DAO/Socio_Administrador.php';
    require_once '../DAO/Fondo.php';
    require_once '../DAO/Credito.php';
    require_once '../DAO/Tipo_Credito.php'


    $credito_obj = Credito::getInstance();
    $usuario_obj = Usuario::getInstance();
    $data_credito = array(); //datos para tabla credito
   
    $name = $_POST['nombre'];
    $pass = $_POST['password'];
    $socio_obj = NULL;

    $usuario_logueado = $usuario_obj->findByField('n_username', $_SESSION['USERNAME'], 'text');
    $id = $usuario_logueado['k_id_usuario'];

    $type = $_POST['type'];
    $fecha_solicitud = $_POST['fsolicitud'];
   
            //organiza el array de datos para solicitar el crédito
            $data_credito[] = array('field' => 'K_ID_CREDITO', 'content' => '002111', 'type' => 'text');
            $data_credito[] = array('field' => 'N_ESTADO_CREDITO', 'content' => 'P', 'type' => 'text');
            $data_credito[] = array('field' => 'V_MONTO_PRESTADO', 'content' => $_POST['val_cred'], 'type' => 'text');
            $data_credito[] = array('field' => 'V_NUM_CUOTAS', 'content' => $_POST['n_cuotas'], 'type' => 'text');
            $data_credito[] = array('field' => 'F_APROBACION', 'content' => "to_date('$fsolicitud','yyyy-mm-dd')", 'type' => 'date');
            //$data_credito[] = array('field' => ,'V_PLAZO', 'content' => $_POST[] );
            $data_credito[] = array('field' => 'K_ID_SOCIO', 'content' => $id, 'type' => 'text');
            $data_credito[] = array('field' => 'K_ID_TIPO_CREDITO', 'content' => $_POST['tipo_cred'], 'type' => 'text');
            

	    //Creacion de credito
            $credito_tabla = $credito_obj->create($data_credito);
	    //accedo al ultimo usuario creado para obterner su id
	    $last_credito = $credito_obj->getLast('K_ID_CREDITO');
	    $last_socio_id = $last_credito['K_ID_SOCIO'];
	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast('K_NIT_FONDO');
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];


    	
/*	    $usuario_nomb = NULL;
	    $socio_o_admin_tabla = NULL;
	    if($usuario_tabla){
	    	$socio_o_admin_tabla = $socio_obj->create($data_socio);
		if($socio_o_admin_tabla == true){
			$usuario_nomb = $usuario_obj->createUsuarioBD($type,$_POST['nick'],$pass);
	    	}
	    }
	    
	    $resp = 0;
	    if(!is_null($usuario_nomb)){
	    	$resp++;
	    	if(!is_null($usuario_tabla)){
			$resp++;	
			if(!is_null(socio_o_admin_tabla)){
				$resp++;
			}
		}
	    }
	    $retorno['respuesta'] = $resp == 3 ? 'true': $usuario_nomb .'  '. $usuario_tabla . '  ' . $socio_o_admin_tabla; 
	    print_r($retorno['respuesta']);
            $retorno['mensaje'] = $retorno['respuesta'] == 'true' ? 'Operación Exitosa.' : 'Error al Crear Usuario ' . $_POST['nombre'];
  //  } else {

    //}
} */
catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al intentar crear credito.'.$e->getMessage();
}


echo json_encode($retorno);
?>
