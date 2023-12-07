<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 4 PARTE 2</title>
</head>

<body>
    <div style="text-align: center;">
        <?php

        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];

        if ($edad >= 18) {
            if ($sexo == "femenino" || $sexo == "Femenino" || $sexo == "FEMENINO") {
                echo '<h1>Bienvenida, usted está en el rango de edad permitido.</h1>';
            } else {
                echo '<h1>Bienvenido, usted está en el rango de edad permitido.</h1>';
            }
        } else {
            echo "USTED NO TIENE PERMITIDO ENTRAR";
        }

        ?>
    </div>
</body>

</html>