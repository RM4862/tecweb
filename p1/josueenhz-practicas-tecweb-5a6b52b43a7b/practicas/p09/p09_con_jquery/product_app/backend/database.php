<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '9GJBuXtwzDMSU6Ia',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>