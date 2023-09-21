<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos_xhtml</title>
</head>
<body>
<?php
// Verificar si se ha proporcionado el parámetro "tope" en la solicitud GET
if (isset($_GET['tope'])) {
    $tope = $_GET['tope'];

    // Validar que "tope" sea un número válido
    if (is_numeric($tope)) {
        // Crear una conexión a la base de datos
        $link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

        // Verificar la conexión a la base de datos
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error);
        }

        // Escapar el valor de "tope" para prevenir inyección SQL
        $tope = $link->real_escape_string($tope);

        // Realizar una consulta SQL para seleccionar productos con unidades menores o iguales a "tope"
        $query = "SELECT * FROM productos WHERE unidades <= $tope";
        $result = $link->query($query);

        // Comprobar si se obtuvieron resultados
        if ($result) {
            // Iniciar la salida XHTML
            header("Content-Type: application/xhtml+xml; charset=utf-8");
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . "\n";
            echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
            echo '<head>' . "\n";
            echo '<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />' . "\n";
            echo '<title>Productos</title>' . "\n";
            echo '</head>' . "\n";
            echo '<body>' . "\n";

            // Crear una tabla para mostrar los productos
            echo '<table border="1">' . "\n";
            echo '<tr><th>ID</th><th>Nombre</th><th>Unidades</th></tr>' . "\n";

            // Recorrer los resultados de la consulta y mostrar cada producto
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                echo '<td>' . htmlspecialchars($row['unidades']) . '</td>';
                echo '</tr>' . "\n";
            }

            echo '</table>' . "\n";

            // Cerrar la conexión a la base de datos
            $link->close();

            // Cerrar el documento XHTML
            echo '</body>' . "\n";
            echo '</html>' . "\n";
        } else {
            // Error en la consulta
            echo 'Error en la consulta: ' . $link->error;
        }
    } else {
        // "tope" no es un número válido
        echo 'El parámetro "tope" debe ser un número válido.';
    }
} else {
    // "tope" no se proporcionó en la solicitud GET
    echo 'Parámetro "tope" no detectado...';
}
?>
Este script realiza la conexión a la base de datos, ejecuta una consulta SQL para obtener los productos que cumplen con el criterio y los muestra en un documento XHTML. Asegúrate de ajustar la configuración de la conexión a tu base de datos y adaptarla según tus necesidades.






</body>
</html>