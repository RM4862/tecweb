<?php
libxml_use_internal_errors(true);

// Cargar el XML desde el archivo
$xmlFile = 'catalogovod.xml';
$documento = file_get_contents($xmlFile);
$xml = new DOMDocument();
$xml->loadXML($documento, LIBXML_NOBLANKS);

// Ruta del XSD de validación
$xsdFile = 'serviciovod.xsd';

// Validar el XML contra el XSD
if ($xml->schemaValidate($xsdFile)) {
    // Procesar el contenido del XML
    $catalogoVOD = simplexml_load_string($documento);

    // Mostrar el contenido en una página HTML5
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catalogo VOD</title>
    </head>
    <body>
        <h1>Catalogo VOD</h1>';

    // Mostrar información de la cuenta
    echo '<h2>Cuenta:</h2>';
    echo '<p>Correo: ' . $catalogoVOD->cuenta['correo'] . '</p>';
    
    // Mostrar perfiles
    echo '<h2>Perfiles:</h2>';
    foreach ($catalogoVOD->cuenta->perfiles->perfil as $perfil) {
        echo '<p>Usuario: ' . $perfil['usuario'] . ', Idioma: ' . $perfil['idioma'] . '</p>';
    }

    // Mostrar contenido (peliculas y series)
    echo '<h2>Contenido:</h2>';
    foreach ($catalogoVOD->contenido->children() as $tipoContenido) {
        echo '<h3>' . ucfirst($tipoContenido->getName()) . '</h3>';
        foreach ($tipoContenido->genero as $genero) {
            echo '<p><strong>Genero:</strong> ' . $genero['nombre'] . '</p>';
            foreach ($genero->titulo as $titulo) {
                echo '<p><strong>Titulo:</strong> ' . $titulo . ', Duración: ' . $titulo['duracion'] . '</p>';
            }
        }
    }

    echo '</body></html>';
} else {
    // Mostrar errores de validación
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';
    foreach ($errors as $error) {
        $lista = $lista . '[' . ($noError++) . ']: ' . $error->message . ' ';
    }
    echo $lista;
}

libxml_clear_errors();
?>
