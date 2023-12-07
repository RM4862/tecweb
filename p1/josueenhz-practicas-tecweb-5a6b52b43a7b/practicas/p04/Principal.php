<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 4</title>
</head>

<body>

    <div class="primer">

        <h3><strong>PRIMER EJERCICIO</strong></h3>
        <?php
        include('p03_funciones.php');
        $num = $_GET['numero'];
        multiplo($num);
        ?>
    </div>

    <div class="segundo">
        <h3><strong>SEGUNDO EJERCICIO</strong></h3>
        <pre>
            <?php
            impar_par();
            ?>
        </pre>
    </div>

    <div class="tercero">
        <h3><strong>TERCER EJERCICIO</strong></h3>
        <?php
        $num = $_GET['numero'];
        multiplo2($num);
        ?>
    </div>

    <div class="cuarto">
        <h3><strong>CUARTO EJERCICIO</strong></h3>
        <table style="border-collapse: collapse; width: 20%; height: 180px;" border="1">
            <?php
                ascii();
            ?>
        </table>
    </div>

</body>

</html>