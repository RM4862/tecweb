<?php

$data = array(
    'status'  => 'error',
    'message' => 'Ya existe un producto con ese nombre'
);
echo $_POST['check'];

if ($_POST['check'] == 'nombre') {
    $data['status'] =  "error";
    $data['message'] =  "Ingresa el nombre";
}

echo json_encode($data, JSON_PRETTY_PRINT);
