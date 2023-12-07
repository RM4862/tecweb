<?php
include_once __DIR__.'/database.php';

$data = array();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM contenido WHERE (id = '{$search}' OR tipo LIKE '%{$search}%' OR region LIKE '%{$search}%' OR genero LIKE '%{$search}%' OR titulo LIKE '%{$search}%') AND eliminado = 0";
    
    if ($result = $conexion->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if (!is_null($rows)) {
            foreach ($rows as $num => $row) {
                foreach ($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
        }

        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }

    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>