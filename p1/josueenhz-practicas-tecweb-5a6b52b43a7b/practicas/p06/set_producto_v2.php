<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    
<?php
$nombre = $_POST["nombre"];
$marca  = $_POST["marca"];
$modelo = $_POST["modelo"];
$precio = $_POST["precio"];
$detalles = $_POST["detalles"];
$unidades = $_POST["unidades"];
$imagen   = $_POST["imagen"];
$eliminado = 0;

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '9GJBuXtwzDMSU6Ia', 'marketzone');

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

if ($nombre != "" && $marca != "" && $modelo != "" && $precio != "" && $detalles != "" && $unidades != "" && $imagen != "") {
    $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', {$eliminado})";

    if ($link->query($sql)) {
        echo '<p style="font-family: Arial, Helvetica, sans-serif;">';
        echo '<strong>PRODUCTO INSERTADO</strong> <br><br> <strong>ID: </strong>' . $link->insert_id;
        echo '<br><br><strong>NOMBRE: </strong>' . $nombre;
        echo '<br><br><strong>MARCA: </strong>' . $marca;
        echo '<br><br><strong>MODELO: </strong>' . $modelo;
        echo '<br><br><strong>PRECIO: </strong>' . $precio;
        echo '<br><br><strong>DETALLES: </strong>' . $detalles;
        echo '<br><br><strong>UNIDADES: </strong>' . $unidades;
        echo '<br><br><strong>IMAGEN: </strong><br> <img src=http://localhost/tecnologiasweb/practicas/p05/' . $imagen . ' width="200px" height="200px" />';
        echo '</p>';
    } else {
        echo '<br><strong>UN ELEMENTO O VARIOS ESTAN EN UN FORMATO INCORRECTO. FAVOR DE CORREGIR ESOS DATOS</strong>';
    }
} else {
    echo '<br><strong>UN DATO REQUERIDO ESTA EN BLANCO. FAVOR DE LLENAR TODO CORRECTAMENTE</strong>';
}

$link->close();

?>

</html>