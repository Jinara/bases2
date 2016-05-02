<?php

try{
  require_once('../database/Database.php');
  $username = $_POST['nick'];
  $pass= $_POST['pass'];
  
  $retorno['respuesta'] = Database::loginDB($username,$pass);
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
