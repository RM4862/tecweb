<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        ol,
        ul {
            list-style-type: none;
        }

        #form {
            width: 30%;
        }

        #boton {
            background-color: black;
            color: white;
            border-radius: 1em;
        }
    </style>

    <script type="text/javascript">
        function verificarEntrada(control) {
            if (control.value == '')
                alert('Debe ingresar datos');
        }

        function verificar(control) {
            if (control.value.length > 100) {
                control.focus();
                alert('No exceda los 100 carateres');
                control.value = "";
            }
        }

        function verificarM(control) {
            if (control.value == "") {
                alert('Elige una marca');
            }
        }

        function verificarMod(control) {
            if (control.value.length > 25) {
                control.focus();
                alert('No exceda los 25 carateres');
                control.value = "";
            }
        }

        function verificarP(control) {

            precio = parseFloat(control.value);
            if (precio < 99.99) {
                control.focus();
                alert('El precio debe ser mayor de $99.99');
                control.value = "";
            }
        }

        function verificarD(control) {
            if (control.value.length > 250) {
                control.focus();
                alert('No exceda los 250 carateres');
                control.value = "";
            }
        }

        function verificarU(control) {
            uni = parseInt(control);
            if (uni <= 0) {
                control.focus();
                alert('Dato erroneo');
                control.value = "";
            }
        }

        function verificarImg(control) {
            if (control.value == "") {
                control.value = "img/imagen.png";
            }
        }
    </script>

    <title>PRACTICA 7</title>
</head>

<body>
    <div id="form">
        <form method="POST" action="http://localhost/tecnologiasweb/practicas/p07/set_producto_v3.php" style="font-family: Arial, Helvetica, sans-serif;">
            <h1><strong>Registro de Productos</strong></h1>
            <h3>Llena cada campo con la informacion correcta.</h3>
            <p><br></p>
            <ul>
                <li>ID: <input id="id" name="id" type="text" value="<?= !empty($_POST['id']) ? $_POST['id'] : $_GET['id'] ?>" required /></li>
                <br>
                <li>Nombre: <input id="nombre" name="nombre" type="text" onBlur="verificar(this)" value="<?= !empty($_POST['nombre']) ? $_POST['nombre'] : $_GET['nombre'] ?>" required /></li>
                <br>
                <li>Marca: <select name="marca" id="marca" onchange="verificarM(this)">
                        <option value="<?= !empty($_POST['marca']) ? $_POST['marca'] : $_GET['marca'] ?>">Elegir</option>
                        <option value="Logitech">Logitech</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Sony">Sony</option>
                        <option value="Xiaomi">Xiaomi</option>
                        <option value="Raizer">Raizer</option>
                        <option value="Steren">Steren</option>
                        <option value="Acteck">Acteck</option>
                        <option value="Hyperx">Hyperx</option>
                        <option value="Perfect Choice">Perfect Choice</option>
                    </select>
                    <br><br>
                <li>Modelo: <input id="modelo" name="modelo" type="text" onBlur="verificarMod(this)" value="<?= !empty($_POST['modelo']) ? $_POST['modelo'] : $_GET['modelo'] ?>" required /></li>
                <br>
                <li>Precio: <input id="precio" name="precio" type="text" placeholder="$000.00" onchange="verificarP(this)" value="<?= !empty($_POST['precio']) ? $_POST['precio'] : $_GET['precio'] ?>" required /></li>
                <br>
                <li>Detalles: <br>
                    <textarea name="detalles" rows="3" cols="50" id="detalles" placeholder="No más de 250 caracteres de longitud" onBlur="verificarD(this)">
                    <?php echo !empty($_POST['detalles']) ? $_POST['detalles'] : $_GET['detalles']; ?>
                    </textarea>
                    <br><br>
                <li>Unidades: <input id="unidades" name="unidades" type="text" onBlur="verificarU(this)" value="<?= !empty($_POST['unidades']) ? $_POST['unidades'] : $_GET['unidades'] ?>" required />
                </li>
                <br>
                <li>Imagen: <input id="imagen" name="imagen" type="text" placeholder="img/ejemplo.png" value="<?= !empty($_POST['imagen']) ? $_POST['imagen'] : $_GET['imagen'] ?>" /></li>
                <br>
            </ul>
            <p style="text-align: center;"><input id="boton" type="submit" value="ACTUALIZAR" onclick="verificarImg(imagen)" /></p>
        </form>
    </div>
</body>

</html>