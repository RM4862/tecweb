<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__ .'/Operacion.php';
        ///como no se usa la clase operacion se vuelve una clase abstracta
        $sum1=new Suma; //se inicializa valor1 y valor2 con 0
        $sum1->setValor1(10); ///se usa metodo de superclase
        $sum1->setValor2(5); ///se usa metodo de superclase
        $sum1->operar(); ///se usa metodo propio
        echo '10+5 ='.$sum1->getResultado().'<br>'; ///se usa metodo 
        $res1=new Resta; //se inicializa valor1 y valor2 con 0
        $res1->setValor1(10); ///se usa metodo de superclase
        $res1->setValor2(5); ///se usa metodo de superclase
        $res1->operar(); ///se usa metodo propio
        echo '10-5 ='.$res1->getResultado(); ///se usa metodo de la superclase
    ?>
</body>
</html>