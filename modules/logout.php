<?php

try{
  
  // remove all session variables
  //session_unset();

  // destroy the session
  session_start();
  $retorno['respuesta'] = session_unset(); 
  if ($retorno['respuesta']){
    $retorno['respuesta'] = true;
    $retorno['mensaje'] = "Salida exitosa";
  }
  else
    $retorno['mensaje'] = "error";
    $retorno['respuesta'] = false;
}catch(Exception $e){
  $retorno['respuesta'] = false; 
  $retorno['mensaje'] = "Usuario no eliminado";
}
echo json_encode($retorno);
