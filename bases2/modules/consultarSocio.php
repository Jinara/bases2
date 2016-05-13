<?php
ini_set('display_errors', '1');
try {
    require_once '../DAO/Usuario.php';
    
    $usuario_obj = Usuario::getInstance();
    $data_usuario = array(); //datos para tabla usuario
    $cond = $_POST['documento'];
    $user = $usuario_obj->findByField('V_NUM_DOC', $cond, 'text'); 
    $socio_obj = NULL;
