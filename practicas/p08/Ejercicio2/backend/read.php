<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();

// SE VERIFICA HABER RECIBIDO EL TEXTO DE BÚSQUEDA
if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];

    //LA CONSULTA SE MODIFICADA
    if ($result = $conexion->query("SELECT * FROM productos WHERE 
        nombre LIKE '%{$searchText}%' OR
        marca LIKE '%{$searchText}%' OR
        detalles LIKE '%{$searchText}%'")) {

        // SE OBTIENEN LOS RESULTADOS
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            $productData = array();
            foreach ($row as $key => $value) {
                $productData[$key] = utf8_encode($value);
            }
            $data[] = $productData; // Agrega cada producto al array de respuesta
        }

        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }

    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>