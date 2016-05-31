<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    
    $usuario_obj = Usuario::getInstance();
    $cond = $_POST['documento'];
    $user = $usuario_obj->findByField('V_NUM_DOC', $cond, 'text'); 
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
