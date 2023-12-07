<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
if (isset($_GET['tope'])) {
	$tope = $_GET['tope'];
} else {
	die('Parámetro "tope" no detectado...');
}

if (!empty($tope)) {
	/** SE CREA EL OBJETO DE CONEXION */
	@$link = new mysqli('localhost', 'root', '9GJBuXtwzDMSU6Ia', 'marketzone');

	/** comprobar la conexión */
	if ($link->connect_errno) {
		die('Falló la conexión: ' . $link->connect_error . '<br/>');
		/** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
	}

	/** Crear una tabla que no devuelve un conjunto de resultados */
	if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
		$row = $result->fetch_all(MYSQLI_ASSOC);
		/** útil para liberar memoria asociada a un resultado con demasiada información */
		foreach ($row as $num => $registro) {            // Se recorren tuplas
			foreach ($registro as $key => $value) {      // Se recorren campos
				$data[$num][$key] = $value;
			}
		}
		$result->free();
	}

	$link->close();
}
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Producto</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>

<body>
	<h3>PRODUCTO</h3>

	<?php if (isset($data)) : ?>

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
				<?php

				foreach ($data as $key => $value) {
					echo '<tr>';
					echo '<th scope="value"> ' . $value["id"] . ' </th>';
					echo '<td> ' . $value["nombre"] . '</td>';
					echo '<td> ' . $value["marca"] . '</td>';
					echo '<td> ' . $value["modelo"] . '</td>';
					echo '<td> ' . $value["precio"] . '</td>';
					echo '<td> ' . $value["unidades"] . '</td>';
					echo '<td> ' . $value['detalles'] . '</td>';
					echo '<td><img src=' . $value['imagen'] . ' width="200px" height="200px" /></td>';
					echo '</tr>';
				}
				?>

			</tbody>
		</table>
	<?php endif; ?>

	<p>
		<a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
	</p>
</body>

</html>