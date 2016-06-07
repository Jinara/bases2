<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    
    $usuario_obj = Usuario::getInstance();
    $cond = $_POST['documento'];
    $query = "SELECT u.k_id_usuario,u.n_apellido_usuario,u.n_usuario,u.o_tipo_doc,u.v_num_doc,u.v_tarjeta_profesional,u.n_ocupacion,
    u.o_estado_civil,u.o_sexo,u.v_telefono,u.o_direccion,u.o_correo_electronico,u.n_username,u.n_causal,s.o_estado_socio,
    s.f_inicio,s.f_fin FROM fondo.usuario u, fondo.socio s where u.k_id_usuario = s.k_id_socio and u.v_num_doc = "."'".$cond."'";
    if (session_status() == PHP_SESSION_NONE) {
          session_start();
    }
    $conn = $usuario_obj::getDBConnection($_SESSION['USERNAME'], $_SESSION['PASS']);
    $user = $usuario_obj::getData($conn, $query);
    if(!array_key_exists(0,$user)){
      $retorno['respuesta'] = $user;
      $retorno['mensaje'] = "El Usuario no existe";
    }else{
      $retorno['user'] = $user;
      $retorno['mensaje'] = 'Usuario consultado.';
    }
} catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al consultar crear o editar Usuario.'.$e->getMessage();
}
echo json_encode($retorno);
?>
