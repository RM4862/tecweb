<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        ol, ul { 
            list-style-type: none;
        }
    </style>
    <title>Formulario</title>
</head>


<?php
// Supongamos que $_GET['id'] contiene el ID del registro que deseas editar
$registroId = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó un ID válido
if ($registroId) {
    // Establecer la conexión a la base de datos
    $link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error);
    }

    // Consultar la base de datos para obtener los detalles del registro
    $sql = "SELECT * FROM productos WHERE id = $registroId";
    if ($result = $link->query($sql)) {
        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener los detalles del registro
            $registro = $result->fetch_assoc();
        } else {
            echo 'No se encontraron registros con el ID proporcionado.';
        }

        // Liberar el resultado
        $result->free();
    } else {
        echo 'Error en la consulta: ' . $link->error;
    }

    // Cerrar la conexión a la base de datos
    $link->close();
}

// Resto del código HTML y del formulario
?>

<body>
<h1>Registro de Productos</h1>

    <form id="productosForm" action="" method="post">
        <fieldset>
            <legend>Información</legend>

            <ul>
                <li>
                <label for="Nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= isset($registro['nombre']) ? htmlspecialchars($registro['nombre']) : '' ?>" required>
                </li>
                <li>
                <label for="marca">Marca:</label>
                <select id="marca" name="marca" required>
                    <option value="" disabled>Selecciona una marca</option>
                    <option value="VAGABOX" <?= isset($registro['marca']) && $registro['marca'] == 'VAGABOX' ? 'selected' : '' ?>>VAGABOX</option>
                    <option value="MndMeld" <?= isset($registro['marca']) && $registro['marca'] == 'MndMeld' ? 'selected' : '' ?>>MndMeld</option>
                    <option value="Dosyu" <?= isset($registro['marca']) && $registro['marca'] == 'Dosyu' ? 'selected' : '' ?>>Dosyu</option>
                    <option value="Shein" <?= isset($registro['marca']) && $registro['marca'] == 'Shein' ? 'selected' : '' ?>>Shein</option>
                    <option value="Ilusion" <?= isset($registro['marca']) && $registro['marca'] == 'Ilusion' ? 'selected' : '' ?>>Ilusion</option>
                    <option value="Suburbia" <?= isset($registro['marca']) && $registro['marca'] == 'Suburbia' ? 'selected' : '' ?>>Suburbia</option>
                    <option value="Noonstop" <?= isset($registro['marca']) && $registro['marca'] == 'Noonstop' ? 'selected' : '' ?>>Noonstop</option>
                    <option value="Bridals" <?= isset($registro['marca']) && $registro['marca'] == 'Bridals' ? 'selected' : '' ?>>Bridals</option>
                    <option value="Mariposa" <?= isset($registro['marca']) && $registro['marca'] == 'Mariposa' ? 'selected' : '' ?>>Mariposa</option>
                </select>
                </li>
                <li>
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="Modelo" name="Modelo" value="<?= isset($registro['modelo']) ? htmlspecialchars($registro['modelo']) : '' ?>" required>
                </li>
                <li>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" value="<?= isset($registro['precio']) ? htmlspecialchars($registro['precio']) : '' ?>" step="0.01" required min="99.99"><br>
                </li>
                <li>
                    <label for="detalles">Detalles:</label>
                    <input type="text" id="detalles" name="detalles" rows="4" cols="50" value="<?= isset($registro['detalles']) ? htmlspecialchars($registro['detalles']) : '' ?>" ></input><br>
                </li>

                <li>
                    <label for="unidades">Unidades:</label>
                    <input type="number" id="unidades" name="unidades" value="<?= isset($registro['unidades']) ? htmlspecialchars($registro['unidades']) : '' ?>" required min="0"><br>
                </li>

                <li>
                    <label for="urlImagen">URL de la Imagen:</label>
                    <input type="text" id="urlImagen" name="urlImagen" value="<?= isset($registro['imagen']) ? htmlspecialchars($registro['imagen']) : '' ?>">
                    <br>
                </li>
            </ul>
        </fieldset>

        <p>
            <input type="submit" value="Actualizar Producto">
            <input type="reset">
        </p>
    </form>
</body>
</html>