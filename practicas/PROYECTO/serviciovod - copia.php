<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<?php
// VALIDACION
libxml_use_internal_errors(true);
$xml = new DOMDocument();
$documento = file_get_contents('serviciovodN.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
$xsd = 'serviciovod4.xsd';
if (!$xml->schemaValidate($xsd)) {
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';
    foreach ($errors as $error) {
        $lista = $lista . '[' . ($noError++) . ']: ' . $error->message . ' ';
    }
    echo $lista;
} else {
    // CONEXIÓN A LA BASE DE DATOS
    $link = new mysqli('localhost', 'root', '12345678a', 'catalogovod');
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    // Obtener cuentas
    $cuentas = $xml->xpath('//cuenta');
    
    foreach ($cuentas as $cuenta) {
        $correo = (string)$cuenta['correo'];

        // Insertar cuenta
        $link->query("INSERT INTO cuenta (correo) VALUES ('$correo')");
        $idCuenta = $link->insert_id;

        // Obtener perfiles
        $perfiles = $cuenta->perfiles;
        foreach ($perfiles->perfil as $perfil) {
            $usuario = (string)$perfil['usuario'];
            $idioma = (string)$perfil['idioma'];

            // Insertar perfil
            $link->query("INSERT INTO perfiles (usuario, idioma, id) VALUES ('$usuario', '$idioma', $idCuenta)");
        }

        // Obtener contenido
        $contenido = $cuenta->contenido;

        // Insertar películas
        foreach ($contenido->peliculas->genero as $genero) {
            $nombreGenero = (string)$genero['nombre'];

            foreach ($genero->titulo as $titulo) {
                $duracion = (string)$titulo['duracion'];
                $nombrePelicula = (string)$titulo;
                
                // Insertar película
                $link->query("INSERT INTO contenido (peliculas, genero, titulo, duracion, id) VALUES (1, '$nombreGenero', '$nombrePelicula', '$duracion', $idCuenta)");
            }
        }

        // Insertar series
        foreach ($contenido->series->genero as $genero) {
            $nombreGenero = (string)$genero['nombre'];

            foreach ($genero->titulo as $titulo) {
                $duracion = (string)$titulo['duracion'];
                $nombreSerie = (string)$titulo;

                // Insertar serie
                $link->query("INSERT INTO contenido (series, genero, titulo, duracion, id) VALUES (1, '$nombreGenero', '$nombreSerie', '$duracion', $idCuenta)");
            }
        }
    }

    // Cerrar la conexión a la base de datos
    $link->close();
}
?>

<!--HTML-->
