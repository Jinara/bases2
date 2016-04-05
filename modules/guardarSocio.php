<?php

try {
    require_once '../DAO/Usuario.php';


    $usuario_obj = Usuario::getInstance();
    $data = array();

    
   // if ($_POST['id'] == '') {//crear Almacen
            
            //organiza el array de datos del nuevo Almacen
            $data[] = array('field' => 'N_USUARIO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'N_APELLIDO_USUARIO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_TIPO_DOC', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'V_NUM_DOC', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'V_TARJETA_PROFESIONAL', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'N_OCUPACION', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_ESTADO_CIVIL', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_SEXO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'V_TELEFONO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_DIRECCION', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_CORREO_ELECTRONICO', 'content' => $_POST['nombre'], 'type' => 'text');
            $data[] = array('field' => 'O_PASSWORD', 'content' => $_POST['nombre'], 'type' => 'text');

            //crea el Almacen
            $retorno['respuesta'] = $usuario_obj->create($data);
            $retorno['mensaje'] = $retorno['respuesta'] ? 'Operación Exitosa.' : 'Error al Crear Usuario ' . $_POST['nombre'];

  //  } else {

    //}
} catch (Exception $e) {
    $retorno['respuesta'] = false;
    $retorno['mensaje'] = 'Error al intentar crear o editar Usuario.'.$e->getMessage();
    echo "holi";
    joder();
}


echo json_encode($retorno);
?>