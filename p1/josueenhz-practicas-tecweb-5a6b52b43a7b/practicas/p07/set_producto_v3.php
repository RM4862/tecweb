<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<?php
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$marca  = $_POST["marca"];
$modelo = $_POST["modelo"];
$precio = $_POST["precio"];
$detalles = $_POST["detalles"];
$unidades = $_POST["unidades"];
$imagen   = $_POST["imagen"];
$eliminado = 0;

/* MySQL Conexion*/
$link = mysqli_connect('localhost', 'root', '9GJBuXtwzDMSU6Ia', 'marketzone');
// Chequea coneccion
if ($link == false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}
// Ejecuta la actualizacion del registro
$sql = "UPDATE productos SET nombre= '{$nombre}', marca='{$marca}', modelo='{$modelo}', precio={$precio}, detalles='{$detalles}', unidades={$unidades}, imagen='{$imagen}' WHERE id={$id}";
if (mysqli_query($link, $sql)) {
    echo "Registro actualizado.";

    echo '<p style="font-family: Arial, Helvetica, sans-serif;">';
    echo '<strong>PRODUCTO INSERTADO</strong> <br><br> <strong>ID: </strong>' . $id;
    echo '<br><br><strong>NOMBRE: </strong>' . $nombre;
    echo '<br><br><strong>MARCA: </strong>' . $marca;
    echo '<br><br><strong>MODELO: </strong>' . $modelo;
    echo '<br><br><strong>PRECIO: </strong>' . $precio;
    echo '<br><br><strong>DETALLES: </strong>' . $detalles;
    echo '<br><br><strong>UNIDADES: </strong>' . $unidades;
    echo '<br><br><strong>IMAGEN: </strong><br> <img src=http://localhost/tecnologiasweb/practicas/p05/' . $imagen . ' width="200px" height="200px" />';
    echo '</p>';
} else {
    echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
}
// Cierra la conexion
mysqli_close($link);

?>

</html>