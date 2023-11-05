<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Obtener los valores del formulario
    $nombre   = validarTexto($_POST["nombre"], 99, "Nombre");
    $marca    = validarTexto($_POST["marca"], 25, "Marca");
    $modelo   = validarTexto($_POST["modelo"], 25, "Modelo");
    $precio   = $_POST["precio"];
    $detalles = $_POST["detalles"];
    $unidades = $_POST["unidades"];
    $imagen   = $_POST["urlImagen"];

    // Validar si ha ocurrido un error durante la validación
    if (isset($error)) {
        mostrarError($error);
    } else {
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
            /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        /** Crear una tabla que devuelve un conjunto de resultados */
        $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}',0)";
        if ($link->query($sql)) 
        {
            echo "<br>";
            echo "Nombre: " . $nombre . "<br>";
            echo "Marca: " . $marca . "<br>";
            echo "Modelo: " . $modelo . "<br>";
            echo "Precio: " . $precio . "<br>";
            echo "Detalles: " . $detalles . "<br>";
            echo "Unidades: " . $unidades . "<br>";
            echo "URL de la Imagen: " . $imagen . "<br>";
            echo 'Producto insertado con ID: '.$link->insert_id;
        }
        else
        {
            mostrarError('ERROR: Producto no insertado');
        }

        $link->close();
    }
}

// Función para validar texto con una longitud máxima
function validarTexto($texto, $longitudMaxima, $campo) {
    $longitud = strlen($texto);

    if ($longitud > $longitudMaxima) {
        global $error;
        $error = "$campo no puede tener más de $longitudMaxima caracteres.";
        return ''; // Devuelve una cadena vacía para indicar que hay un error.
    }

    return $texto;
}

// Función para mostrar errores
function mostrarError($mensaje) {
    echo "Error: " . $mensaje;
}
?>