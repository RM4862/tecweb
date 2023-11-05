<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__ .'/Tabla.php';
        $Tab1= new Tabla(2, 3,'border: 1px solid');
        ///FILA 0
        $Tab1->cargar(0,0,'A');
        $Tab1->cargar(0,1,'B');
        $Tab1->cargar(0,2,'C');

        ///FILA 1
        $Tab1->cargar(1,0,'D');
        $Tab1->cargar(1,1,'E');
        $Tab1->cargar(1,2,'F');
        $Tab1->graficar();
    ?>
</body>
</html>