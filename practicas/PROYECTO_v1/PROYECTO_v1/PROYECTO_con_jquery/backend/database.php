<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '12345678a',
        'vod'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>