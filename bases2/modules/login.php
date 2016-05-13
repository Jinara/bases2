<?php

try{
  require_once('../DAO/Usuario.php');
   $username = $_POST['nick'];
  $pass= $_POST['pass'];
  $usuario = Usuario::getInstance();
  
  $retorno['respuesta'] = $usuario->loginDB($username,$pass);
  if ($retorno['respuesta']){
    $retorno['respuesta'] = true;
    $retorno['mensaje'] = "Usuario logueado";
  }
  else
    $retorno['mensaje'] = "Usuario invalido";
    $retorno['respuesta'] = false;
}catch(Exception $e){
  $retorno['respuesta'] = false; 
  $retorno['mensaje'] = "Usuario no logueado";
}
echo json_encode($retorno);
