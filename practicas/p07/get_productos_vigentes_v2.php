<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN” 
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Tabla de objetos</title>
</head>
<?php
    $data = array();
    if(isset($_GET['tope']))
        $tope = $_GET['tope'];

    if (!empty($tope))
    {
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

         /*Estas son las condiciones para saber que hay productos disponibles*/
        if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope AND eliminado = 0 AND unidades > 0")) 
        {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            
            $result->free();
        }

        $link->close();
    }
?>

<body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo</th>
            <th scope="col">Precio</th>
            <th scope="col">Unidades</th>
            <th scope="col">Detalles</th>
            <th scope="col">Imagen</th>
            <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                    foreach ($row as $registro) {
                        echo '<tr>';
                        echo '<td>' . $registro['id'] . '</td>';
                        echo '<td>' . $registro['nombre'] . '</td>';
                        echo '<td>' . $registro['marca'] . '</td>';
                        echo '<td>' . $registro['modelo'] . '</td>';
                        echo '<td>' . $registro['precio'] . '</td>';
                        echo '<td>' . $registro['unidades'] . '</td>';
                        echo '<td>' . $registro['detalles'] . '</td>';
                        echo '<td><img src="' . $registro['imagen'] . '"></td>';
                        echo '<td><a href="formulario_v2.php?id=' . $registro['id'] . '">Editar</a></td>'; // Edit button linking to the edit page
                        echo '</tr>';
                    }
                ?>
                
            </tr>
        </tbody>
    </table>
 <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
  
</body>
	
</html>