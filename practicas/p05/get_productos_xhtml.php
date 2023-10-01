<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
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

		/** Crear una tabla que nos devuelve un conjunto de resultados de la base de datos*/
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) //localmente esta result
		{   var_dump($result);
			$row = $result->fetch_array(MYSQLI_ASSOC); ///arreglo row, fetch array es para sacar la consulta
			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();
	}
	?>
	<head> <!--empieza xhtml-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>
		
		<?php if( isset($row) ) : ?> <!--si el arreglo tiene info se muestra-->

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
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row"><?= $row['id'] ?></th>
						<td><?= $row['nombre'] ?></td>
						<td><?= $row['marca'] ?></td>
						<td><?= $row['modelo'] ?></td>
						<td><?= $row['precio'] ?></td>
						<td><?= $row['unidades'] ?></td>
						<td><?= utf8_encode($row['detalles']) ?></td>
						<td><img src=<?= $row['imagen'] ?> ></td>
					</tr>
				</tbody>
			</table>

		<?php elseif(!empty($tope)) : ?>

			 <script>
                alert('No hay tope de unidades');
             </script>

		<?php endif; ?>
	</body>
</html>