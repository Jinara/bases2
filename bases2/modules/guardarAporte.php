<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    require_once '../DAO/Socio.php';
    require_once '../DAO/Socio_Administrador.php';
    require_once '../DAO/Fondo.php';
    require_once '../DAO/Credito.php';
	require_once '../DAO/Pago_Aporte.php';
	require_once '../DAO/Tipo_pago.php';

    $aporte_obj = pago_aporte::getInstance();
    $data_aporte = array(); //datos para tabla pago_aporte
    
    $name = $_POST['nombre'];
    $pass = $_POST['password'];
    $socio_obj = NULL;

    $type = $_POST['type'];
    $fecha_solicitud = $_POST['fsolicitud'];
   
            //organiza el array de datos del nuevo aporte
            $data_aporte[] = array('field' => 'K_ID_PAGO_APORTE', 'content' => '002111', 'type' => 'text');
            $data_aporte[] = array('field' => 'O_NUM_CONSIGNACION', 'content' => $_POST['n_consig'], 'type' => 'text');
            $data_aporte[] = array('field' => 'F_PAGO', 'content' => "to_date('$fpago','yyyy-mm-dd')", 'type' => 'date');
            $data_aporte[] = array('field' => 'V_MONTO_PAGO', 'content' => $_POST['val_apor'], 'type' => 'text');
            $data_aporte[] = array('field' => 'K_ID_TIPO_PAGO', 'content' => $_POST['tipo_pago'], 'type' => 'text');
            $data_aporte[] = array('field' => 'K_ID_SOCIO', 'content' => $_SESSION['id'], 'type' => 'text');
            
            

	    //Creacion de aporte
            $aporte_tabla = $aporte_obj->create($data_aporte);
	    //accedo al ultima solicitud de credito para obterner su id
	    $last_credito = $credito_obj->getLast('K_ID_CREDITO');
	    $last_socio_id = $last_credito['K_ID_SOCIO'];
	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast('K_NIT_FONDO');
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];


    	
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
} catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al intentar crear credito.'.$e->getMessage();
}


echo json_encode($retorno);
?>
