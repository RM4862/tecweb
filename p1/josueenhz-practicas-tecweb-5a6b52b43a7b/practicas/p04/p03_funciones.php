<?php
function multiplo($num)
{
    if ($num % 5 == 0 && $num % 7 == 0) {
        echo "El numero [$num] si es multiplo de 5 y 7 <br>";
    } else {
        echo "El numero [$num] no es multiplo de 5 y 7 <br>";
    }
}

function impar_par()
{
    $i = 0;

    $array = array(
        'impar' => array(rand(1, 500)),
        'par' => array(rand(1, 500)),
        'impar2' => array(rand(1, 500))
    );

    do {

        if ($array['impar'][$i] % 2 == 1 && $array['par'][$i] % 2 == 0 && $array['impar2'][$i] % 2 == 1) {
            $i = $i + 1;
            break;
        } else {
            $array['impar'][] = rand(1, 500);
            $array['par'][] = rand(1, 500);
            $array['impar2'][] = rand(1, 500);
        }

        $i = $i + 1;
    } while ($i < 100);

    $n = $i * 3;

    print_r($array);

    echo '<br><br>' . $n . ' numeros en ' . $i . ' iteraciones';
}

function multiplo2($num)
{
    $i = 0;

    while ($i < 100) {
        $nm = rand(1, 10000);

        if ($nm % $num == 0) {
            $i = $nm;
            break;
        } else {
            $i = $i + 1;
        }
    }

    echo "$i es multiplo de $num con while";

    do {
        $nm = rand(1, 10000);

        if ($nm % $num == 0) {
            $i = $nm;
            break;
        } else {
            $i = $i + 1;
        }
    } while ($i > 100);

    echo "<br><br>$i es multiplo de $num con do_while";
}

function ascii()
{
    $letras = array();

    for ($n = 97; $n <= 122; $n++) {
        $letras[$n] = chr($n);
    }

    echo '<tr><th>ASCII</th><th>LETRAS</th>';
    echo '</tr>';

    foreach ($letras as $key => $value) {
        echo '<tr><td>'.$key.'</td><td>'.$value.'</td>';
        echo '</tr>';
    }
}
