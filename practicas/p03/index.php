<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida

        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '</ul>';
    ?>
    <hr>

    <h2>Ejercicio 2</h2>
        <p>Proporcionar los valores de $a, $b, $c como sigue:
            <br>
            $a = “ManejadorSQL”;
            <br>
            $b = 'MySQL';
            <br>
            $c = &$a; <!--referencia de la variable a-->
        </p>

        <?php
            $a = "ManejadorSQL";
            $b = 'MySQL';
            $c = &$a;
        ?>
        <p>a. Ahora muestra el contenido de cada variable</p>
        <?php
            echo '<ul>';
            echo "<li>a tiene el valor: $a </li>";
            echo "<li>b tiene el valor: $b</li>";
            //echo "<li>".gettype($b). "</li>";  //echo "<li> gettype($b) </li>"; si se escribe asi el resultado será gettype(MySQL)
            echo "<li>c tiene el valor: $c</li>";
            echo '</ul>';
        ?>

    <p>b. Agrega al código actual las siguientes asignaciones:
        <br>
        $a = "PHP server";
        <br>
        $b = &$a; 
    </p>
    <?php
        $a = "PHP server";
        $b = &$a;
    ?>
    <p>c. Vuelve a mostrar el contenido de cada uno</p>
    <?php
            echo '<ul>';
            echo "<li>a tiene el valor: $a </li>";
            echo "<li>b tiene el valor: $b</li>";
            echo "<li>c tiene el valor: $c</li>";
            echo '</ul>';
    ?>
    <p>d. Describe y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones
        <br>
        En la primera parte del código $a es definido con el valor string "Manejador SQL"; b con el valor string 'MySQL' y $c
        hace referencia a $a, $c=&$a, por lo tanto contiene su mismo valor "ManejadorSQL".
        <br>
        La segunda parte del código  modifica el valor de $a con el string "PHP server"; el valor de $b con una referencia a $a; 
        mientras que $c conserva su valor de referencia a $a, $c=&$a, pero como $a fue alterado $c considera esta modificacion y 
        toma el valor "PHP server".
        En resumen $b y c$ referencían al mismo valor de $a.
    </p>
    <hr>
    <h2>Ejercicio 3</h2>
    <p>
        Muestra el contenido de cada variable inmediatamente después de cada asignación,
        verificar la evolución del tipo de estas variables (imprime todos los componentes 
        de los arreglos):
        <br>
        $a = "PHP5";
        <br>
        $z[] = &$a;
        <br>
        $b = “5a version de PHP”;
        <br>
        $c = $b*10;
        <br>
        $a .= $b; <!--concatenacion de $a con $b-->
        <br>
        $b *= $c;
        <br>
        $z[0] = “MySQL”;
    </p>

    <?php
           echo "Los valores asignados son: <br>";
           $a = "PHP5";
            echo "a tiene el valor: $a <br>";
            $z[] = &$a;
            echo "z[] tiene el valor: ";
            print_r($z);
            echo "<br>";
            $b = "5a version de PHP";
            echo "b tiene el valor: $b <br>";
            $c = $b*10;
            echo "c tiene el valor: $c <br>"; 
            $a .= $b;
            echo "a concatenado con b tiene el valor: ";
            print_r($a);
            $b *= $c;
            echo"<br>";
            echo "b tiene el valor: ";
             print_r($b);
             echo"<br>";
            $z[0] = "MySQL";
            echo "z[0] tiene el valor:";
            print_r($z);

    ?>
    <hr>
    <h2>Ejercicio 4</h2>
    <p>
        Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
        la matriz $GLOBALS o del modificador global de PHP.
    </p>
    <?php
        echo '$a en el ámbito global: ' . $GLOBALS['a'] . "<br>";
        global $z;
        foreach ($z as $contenido) {
            echo '$z en el ambito global es: '. $contenido . '<br>';
        }
        echo '$b en el ámbito global: ' . $GLOBALS['b'] . "<br>";
        echo '$c en el ámbito global: ' . $GLOBALS['c'] . "<br>";
        
    ?>


</body>
</html>