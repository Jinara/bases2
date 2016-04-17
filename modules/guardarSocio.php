<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    require_once '../DAO/Socio.php';
    require_once '../DAO/Socio_Administrador.php';
    require_once '../DAO/Fondo.php';


    $usuario_obj = Usuario::getInstance();
    $data_usuario = array(); //datos para tabla usuario
    $data_socio = array(); //datos para tabla socio o admin
    $name = $_POST['nombre'];
    $pass = $_POST['password'];
    $socio_obj = NULL;

    $type = $_POST['type'];
    $fecha_ingreso = $_POST['fingreso'];
   // if ($_POST['id'] == '') {//crear Usuario
            //organiza el array de datos del nuevo Usuario
            $data_usuario[] = array('field' => 'K_ID_USUARIO', 'content' => '1236', 'type' => 'text');
            $data_usuario[] = array('field' => 'N_USUARIO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_APELLIDO_USUARIO', 'content' => $_POST['apellido'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_TIPO_DOC', 'content' => $_POST['tipo_doc'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_NUM_DOC', 'content' => $_POST['documento'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_TARJETA_PROFESIONAL', 'content' => '1234', 'type' => 'text');
            $data_usuario[] = array('field' => 'N_OCUPACION', 'content' => $_POST['ocupacion'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_ESTADO_CIVIL', 'content' => $_POST['estado_civil'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_SEXO', 'content' => $_POST['sexo'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_TELEFONO', 'content' => $_POST['tdomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_DIRECCION', 'content' => $_POST['ddomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_CORREO_ELECTRONICO', 'content' => $_POST['email'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_PASSWORD', 'content' => $pass, 'type' => 'text');
		
	    $last_socio = $usuario_obj->getLast();
	    $last_socio_id = $last_socio['K_ID_USUARIO'];
	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast();
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];


    	if($type == 'socio'){
	    $socio_obj = Socio::getInstance();	
	    $data_socio = array('field' => 'O_ESTADO_SOCIO', 'content' => 'P', 'type' => 'text');	    
	    $data_socio = array('field' => 'F_INICIO', 'content' => "to_date('$fecha_ingreso','yyyy-mm-dd')", 'type' => 'date');
	    $data_socio = array('field' => 'K_NIT_FONDO', 'content' => $last_fondo_id, 'type' => 'text');
	    $data_socio = array('field' => 'K_ID_SOCIO', 'content' => $last_socio_id, 'type' => 'text');
	}else{
	    $socio_obj = Socio_Administrador::getInstance();	
	}
	    $usuario_nomb = NULL;
	    $socio_o_admin_tabla = NULL;
            $usuario_tabla = $usuario_obj->create($data_usuario); 
	    echo '----------'.$usuario_tabla.'+++++++++++++++++++++++';
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
    $retorno['mensaje'] = 'Error al intentar crear o editar Usuario.'.$e->getMessage();
}


echo json_encode($retorno);
?>
