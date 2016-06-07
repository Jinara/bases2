<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    require_once '../DAO/Socio.php';
    require_once '../DAO/Socio_Administrador.php';
    require_once '../DAO/Fondo.php';


    $usuario_obj = Usuario::getInstance();
    $data_usuario = array(); //datos para tabla usuario
    $name = $_POST['nombre'];
    $pass = $_POST['password'];
    $socio_obj = NULL;

    $type = $_POST['type'];
    $fecha_ingreso = $_POST['fingreso'];
    $fecha_fin= $_POST['fsalida'];

    if ($_POST['id'] == '') {//crear Usuario
            //organiza el array de datos del nuevo Usuario
            $data_usuario[] = array('field' => 'N_USUARIO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_USERNAME', 'content' => $_POST['nick'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_APELLIDO_USUARIO', 'content' => $_POST['apellido'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_TIPO_DOC', 'content' => $_POST['tipo_doc'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_NUM_DOC', 'content' => $_POST['documento'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_TARJETA_PROFESIONAL', 'content' => $_POST['tarjeta'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_OCUPACION', 'content' => $_POST['ocupacion'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_ESTADO_CIVIL', 'content' => $_POST['estado_civil'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_SEXO', 'content' => $_POST['sexo'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_TELEFONO', 'content' => $_POST['tdomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_DIRECCION', 'content' => $_POST['ddomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_CORREO_ELECTRONICO', 'content' => $_POST['email'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_CAUSAL', 'content' => $_POST['causal'], 'type' => 'text');
		
	    //Creacion de usuario
            $usuario_tabla = $usuario_obj->create($data_usuario);
	    //accedo al ultimo usuario creado para obterner su id
	    $last_socio = $usuario_obj->getLast('K_ID_USUARIO');
	    $last_socio_id = $last_socio['K_ID_USUARIO'];
	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast('K_NIT_FONDO');
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];


    	$data_socio = array(); //datos para tabla socio o admin
    	if($type == 'socio'){
	    $socio_obj = Socio::getInstance();	
	    $data_socio[] = array('field' => 'O_ESTADO_SOCIO', 'content' => 'P', 'type' => 'text');	    
	    $data_socio[] = array('field' => 'F_INICIO', 'content' => "to_date('$fecha_ingreso','yyyy-mm-dd')", 'type' => 'date');
	    $data_socio[] = array('field' => 'F_FIN', 'content' => "to_date('$fecha_fin','yyyy-mm-dd')", 'type' => 'date');
	    $data_socio[] = array('field' => 'K_NIT_FONDO', 'content' => $last_fondo_id, 'type' => 'text');
	    $data_socio[] = array('field' => 'K_ID_SOCIO', 'content' => $last_socio_id, 'type' => 'text');
	}else{
	    $socio_obj = Socio_Administrador::getInstance();	
	}
	    $usuario_nomb = NULL;
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
			if(!is_null($socio_o_admin_tabla)){
				$resp++;
			}
		}
	    }
	    $retorno['respuesta'] = $resp == 3 ? 'true': $usuario_nomb .'  '. $usuario_tabla . '  ' . $socio_o_admin_tabla; 
            $retorno['mensaje'] = $retorno['respuesta'] == 'true' ? 'Operación Exitosa.' : 'Error al Crear Usuario ' . $_POST['nombre'];
    } else {
      $fi = strpos($fecha_ingreso,'undefined');
      if($fi !== false){
    	$fecha_ingreso = $fi[count($fi) - 1];
      }  
      $fs = strpos($fecha_fin,'undefined');
      if($fs !== false){
    	$fecha_fin = $fs[count($fs) - 1];
      }
            //organiza el array de datos del nuevo Usuario
            $data_usuario[] = array('field' => 'N_USUARIO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_USERNAME', 'content' => $_POST['nick'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_APELLIDO_USUARIO', 'content' => $_POST['apellido'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_TIPO_DOC', 'content' => $_POST['tipo_doc'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_OCUPACION', 'content' => $_POST['ocupacion'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_ESTADO_CIVIL', 'content' => $_POST['estado_civil'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_SEXO', 'content' => $_POST['sexo'], 'type' => 'text');
            $data_usuario[] = array('field' => 'V_TELEFONO', 'content' => $_POST['tdomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_DIRECCION', 'content' => $_POST['ddomicilio'], 'type' => 'text');
            $data_usuario[] = array('field' => 'O_CORREO_ELECTRONICO', 'content' => $_POST['email'], 'type' => 'text');
            $data_usuario[] = array('field' => 'N_CAUSAL', 'content' => $_POST['causal'], 'type' => 'text');

            $usuario_tabla = $usuario_obj->update($data_usuario, 'K_id_usuario = '.$_POST['id']);

	    $fondo_obj = Fondo::getInstance();
	    $last_fondo = $fondo_obj->getLast('K_NIT_FONDO');
	    $last_fondo_id = $last_fondo['K_NIT_FONDO'];

    	$data_socio = array(); //datos para tabla socio o admin
    	if($type == 'socio'){
	    $socio_obj = Socio::getInstance();	
	    $aux = strpos($fecha_ingreso,'/');
	    if($aux !== false){
	       $data_socio[] = array('field' => 'F_INICIO', 'content' => "to_date('$fecha_ingreso','yyyy-mm-dd')", 'type' => 'date');
	    }
	    $aux = strpos($fecha_fin,'/');
	    if($aux !== false){
	       $data_socio[] = array('field' => 'F_FIN', 'content' => "to_date('$fecha_fin','yyyy-mm-dd')", 'type' => 'date');
	    }
	    $data_socio[] = array('field' => 'O_ESTADO_SOCIO', 'content' => 'P', 'type' => 'text');	    
	    $data_socio[] = array('field' => 'K_NIT_FONDO', 'content' => $last_fondo_id, 'type' => 'text');
	}else{
	    $socio_obj = Socio_Administrador::getInstance();	
	    $aux = strpos($fecha_ingreso,'/');
	    if($aux !== false){
	       $data_socio[] = array('field' => 'F_INICIO_ADMIN', 'content' => "to_date('$fecha_ingreso','yyyy-mm-dd')", 'type' => 'date');
	    }
	    $aux = strpos($fecha_fin,'/');
	    if($aux !== false){
	       $data_socio[] = array('field' => 'F_FIN_ADMIN', 'content' => "to_date('$fecha_fin','yyyy-mm-dd')", 'type' => 'date');
	    }
	}
	    $socio_o_admin_tabla = NULL;
	    if($usuario_tabla){
    	      if($type == 'socio'){
	    	$socio_o_admin_tabla = $socio_obj->update($data_socio, 'k_id_socio = '.$_POST['id']);
	      }else{
	    	$socio_o_admin_tabla = $socio_obj->update($data_socio, 'k_id_socio_admin = '.$_POST['id']);
	      }
	    }
	    $resp = 0;
	    if(!is_null($usuario_tabla)){
	       $resp++;	
	       if(!is_null($socio_o_admin_tabla)){
	       $resp++;
	    }
	    $retorno['respuesta'] = $resp == 2 ? 'true': $usuario_tabla . '  ' . $socio_o_admin_tabla; 
            $retorno['mensaje'] = $retorno['respuesta'] == 'true' ? 'Operación Exitosa.' : 'Error al Crear Usuario ' . $_POST['nombre'];
   	    }
    }
} catch (Exception $e) {
    $retorno['respuesta'] = $e->getMessage();
    $retorno['mensaje'] = 'Error al intentar crear o editar Usuario.'.$e->getMessage();
}
echo json_encode($retorno);
?>
