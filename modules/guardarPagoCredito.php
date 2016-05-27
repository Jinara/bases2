<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    require_once '../DAO/Socio.php';
    require_once '../DAO/Socio_Administrador.php';
    require_once '../DAO/Fondo.php';
    require_once '../DAO/Credito.php';
    require_once '../DAO/Tipo_Credito.php'
    require_once '../DAO/Pago_Credito.php'

    $pcredito_obj = pago_credito::getInstance();
    $credito_obj = Credito::getInstance();
    $data_pcredito = array(); //datos para tabla credito
   
    $name = $_POST['nombre'];
    $pass = $_POST['password'];
    $socio_obj = NULL;

    $usuario_logueado = $usuario_obj->findByField('n_username', $_SESSION['USERNAME'], 'text');
    $id = $usuario_logueado['k_id_usuario'];

    $type = $_POST['type'];
    $fecha_solicitud = $_POST['fsolicitud'];
   
            //organiza el array de datos para pagar el crédito
            $data_pcredito[] = array('field' => 'K_ID_PAGO_CREDITO', 'content' => '002111', 'type' => 'text');
            $data_pcredito[] = array('field' => 'O_NUM_CONSIGNACION', 'content' => $_POST['n_consig'], 'type' => 'text');
            $data_pcredito[] = array('field' => 'F_PAGO', 'content' => "to_date('$fpago','yyyy-mm-dd')", 'type' => 'date');
            $data_pcredito[] = array('field' => 'V_MONTO_CUOTA', 'content' => $_POST['v_cuota'], 'type' => 'text');
            $data_pcredito[] = array('field' => 'V_MONTO_CAPITAL', 'content' => $_POST['v_cap'], 'type' => 'text');
            $data_pcredito[] = array('field' => 'V_MONTO_INTERES', 'content' => $_POST['v_int'], 'type' => 'text');
            $data_pcredito[] = array('field' => 'K_ID_TIPO_PAGO', 'content' => $_POST['tpago'], 'type' => 'text');

            $data_pcredito[] = array('field' => 'K_ID_SOCIO', 'content' => $id, 'type' => 'text');
            $data_pcredito[] = array('field' => 'K_ID_CREDITO', 'content' => $_POST['id_cred'], 'type' => 'text');
            

	    //Creacion de pago credito
            $pcredito_tabla = $pcredito_obj->create($data_pcredito);
	    //accedo al ultimo pago realizado para obterner su id
	    $last_credito = $pcredito_obj->getLast('K_ID_CREDITO');
	    $last_socio_id = $last_credito['K_ID_SOCIO'];
	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast('K_NIT_FONDO');
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];


/*    	
	    $usuario_nomb = NULL;
	    $socio_o_admin_tabla = NULL;
	    if($usuario_tabla){
	    	echo 'hola';
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
