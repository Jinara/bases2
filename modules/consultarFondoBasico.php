<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/CuentaFondo.php';
    
    $cuenta_fondo_obj = CuentaFondo::getInstance();
    $cuenta= $cuenta_fondo_obj->getLast('k_id_cuenta_fondo'); 
    if(!array_key_exists(0,$cuenta)){
      $retorno['respuesta'] = true;
      $retorno['mensaje'] = "No hay registros";
    }else{
      $retorno['user'] = $cuenta;
      $retorno['mensaje'] = 'Fondo consultado.';
    }
} catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al consultar Cuenta del Fondo. '.$e->getMessage();
}


echo json_encode($retorno);
?>
