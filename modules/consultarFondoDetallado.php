<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/MovimientoCuenta.php';
    
    $movimiento_cuenta_obj = MovimientoCuenta::getInstance();
    $cuenta= $movimiento_cuenta_obj->getLast('id_movimiento'); 
    if(!array_key_exists(0,$cuenta)){
      $retorno['respuesta'] = true;
      $retorno['mensaje'] = "False";
    }else{
      $retorno['user'] = $cuenta;
      $retorno['mensaje'] = 'Movimientos consultados.';
    }
} catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al consultar Cuenta del Fondo. '.$e->getMessage();
}


echo json_encode($retorno);
?>
