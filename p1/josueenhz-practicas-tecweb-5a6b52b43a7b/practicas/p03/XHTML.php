<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Practica 2 -VARIABLES- </title>
</head>

<body>
    <h1> PRACTICA 2 -VARIABLES- </h1>

    <div style="width: 50%;">

        <h2 style="text-align: justify;"><strong>1.</strong></h2>
        <h4><strong>RESPUESTA 1</strong></h4>
        <p style="text-align: justify;">Las variables <em>$_myvar, $_7var, $myvar, $var7, $_element1</em> son validas ya
            que llevan el formato correcto como comenzar con alguna letra y si no es asi comienzan con _ que las valida.
        </p>
        <p style="text-align: justify;">Por lo contrario la variable <strong>myvar</strong> no esta declarada con el
            simbolo $ lo cual no la vuelve variable. Además la variable <strong>$house*5</strong> parece estar
            bien en estructura pero contiene al simbolo * que determina una operacion y la vuelve incorrecta.</p>

    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>2.</strong></h2>

        <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo "Variables:<br>
            a= $a<br>
            b= $b<br>
            c= $c<br>";

        $a = "PHP server";
        $b = &$a;

        echo "<br>Variables:<br>
            a= $a<br>
            b= $b<br>
            c= $c<br>
            ";

        echo "<h4><strong>RESPUESTA 2</strong></h4>
        
        <p>El primer resultado obtenido nos muestra a y b con sus valores y ademas nos muestra como c obtiene el valor de a al hacer referencia a esta variable.<br>
        
        En el segundo resultado vemos que ahora como cambiamos el valor de a entonces cambia y tambien como ahora al hacer referencia b->a entonces b obtiene su valor y c
        se mantiene apuntando a a y con su valor.</p>"
        ?>
    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>3.</strong></h2>
        <?php
        $a = "PHP5";
        echo "a: $a <br>";
        $z[] = &$a;
        echo "z: <br>";
        var_dump($z);

        $b = "5a version de PHP";
        echo "b: $b <br>";
        $c = $b * 10;
        echo "c: $c <br>";
        $a .= $b;
        echo "a: $a <br>";
        $b *= $c;
        echo "b: $b <br>";
        $z[0] = "MySQL";
        echo "z: <br>";
        var_dump($z);

        echo "
        
        <h4><strong>RESPUESTA 3</strong></h4>
        
        <p>Como se observa, las variables cambiaron de tipo al asignarles otra de diferente tipo. Por ejemplo b que era string
        pero al hacer una operacion se volvio de tipo entero y tomo el nuevo que tenia en su cadena para hacer la operacion
        y asi darle a c el valor de 5*10=50. Asi siguio despues siendo entero para mas operaciones.<br>
        <br>        
        z no cambio de tipo ya que siempre fue una cadena de caracteres y solo reemplazo de su arreglo el dato que se le asigno despues.</p>";

        unset($a, $b, $c, $z);
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";
        ?>
    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>4.</strong></h2>

        <?php

        echo "<h4><strong>RESPUESTA 4</strong></h4>";
        global $a, $b, $c, $z;
        echo "a: $a <br>";
        echo "b: $b <br>";
        echo "c: $c <br>";
        echo "z: <br>";
        var_dump($z);
        unset($a, $b, $c, $z);
        ?>
    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>5.</strong></h2>
        <?php
        $a = "7 personas";
        $b = (int) $a;
        $a = "9E3";
        $c = (float) $a;

        echo "
        <h4><strong>RESPUESTA 5</strong></h4>
        a: $a <br>
        b: $b <br>
        c: $c <br>
        
        <p>Las variables toman dependiendo del tipo, los datos de a. b toma, al obtener un dato int,
        el numero 7 de a. c toma el valor float del resultado de de 9E3 que en notacion cientifica
        es 9000 y eso toma c.</p>";

        unset($a, $b, $c, $z);
        ?>
    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>6.</strong></h2>
        <?php

        echo "<h4><strong>RESPUESTA 6</strong></h4><br>";
        $a = TRUE;
        $b = FALSE;
        $c = TRUE;
        $d = FALSE;
        $e = TRUE;
        $f = FALSE;

        var_dump($a, $b, $c, $d, $e, $f);
        echo "<br>";

        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a or $b);
        $e = ($a and $c);
        $f = ($a xor $b);

        if ($c) {
            $c = "TRUE";
        } else {
            $c = "FALSE";
        }

        if ($d) {
            $d = "TRUE";
        } else {
            $d = "FALSE";
        }

        if ($e) {
            $e = "TRUE";
        } else {
            $e = "FALSE";
        }

        echo "a: $a <br>";
        echo "b: $b <br>";
        echo "c: $c <br>";
        echo "d: $d <br>";
        echo "e: $e <br>";
        echo "f: $f <br>";
        ?>
    </div>

    <div style="width: 50%; text-align: justify">
        <h2><strong>7.</strong></h2>
        <?php
        echo "<h4><strong>RESPUESTA 7</strong></h4>";
        echo $_SERVER['SERVER_SIGNATURE'];
        echo "<br>";
        echo $_SERVER['SERVER_NAME'];
        echo "<br>";
        echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        ?>
    </div>

    <p>
        <a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
</body>

</html>