<?php
include_once __DIR__.'/database.php';

$data = array(
    'status'  => 'error',
    'message' => 'Ya existe un contenido con ese título'
);

if (isset($_POST['titulo'])) {
    $jsonOBJ = json_decode(json_encode($_POST));
    
    $sql = "SELECT * FROM contenido WHERE titulo = '{$jsonOBJ->titulo}' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows == 0) {
        $conexion->set_charset("utf8");
        $sql = "INSERT INTO contenido VALUES (null, '{$jsonOBJ->tipo}', '{$jsonOBJ->region}', '{$jsonOBJ->genero}', '{$jsonOBJ->titulo}', {$jsonOBJ->duracion}, 0)";
        
        if ($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Contenido agregado";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
        }
    }

    $result->free();
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>