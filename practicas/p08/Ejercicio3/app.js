var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function buscarID(e) {
    e.preventDefault();

    var id = document.getElementById('search').value;
    var client = getXMLHttpRequest();

    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);

            let productos = JSON.parse(client.responseText);

            if (Object.keys(productos).length > 0) {
                let template = '';
                productos.forEach(function (producto) {
                    let descripcion = `<li>precio: ${producto.precio}</li>
                                       <li>unidades: ${producto.unidades}</li>
                                       <li>modelo: ${producto.modelo}</li>
                                       <li>marca: ${producto.marca}</li>
                                       <li>detalles: ${producto.detalles}</li>`;

                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>`;
                });

                document.getElementById("productos").innerHTML = template;
            } else {
                let template = `
                    <tr>
                        <td>No se encontraron resultados</td>
                        <td></td>
                        <td></td>
                    </tr>`;

                document.getElementById("productos").innerHTML = template;
            }
        }
    };

    client.send("id=" + id);
}

function agregarProducto(e) {
    
    e.preventDefault();

    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;

    var nombre = finalJSON['nombre'];
    var marca = finalJSON['marca'];
    var modelo = finalJSON['modelo'];
    var precio = finalJSON['precio'];
    var detalles = finalJSON['detalles'];
    var unidades = finalJSON['unidades'];
    var imagen = finalJSON['imagen'];

    if (nombre.length <= 0 || nombre.length > 100) {
        alert('El nombre debe tener entre 1 y 100 caracteres.');
        return;
    }

    modelo = modelo.trim();
    var esAlfanumerico = /^[A-Z]{2}-\d{3}$/.test(modelo);

    if (!esAlfanumerico) {
        alert('El campo "modelo" es obligatorio y debe tener el formato correcto.');
        return;
    }

    var esPrecioValido = !isNaN(parseFloat(precio)) && isFinite(precio) && parseFloat(precio) > 99.99;
    if (!esPrecioValido) {
        alert('El precio ingresado no es válido o debe ser mayor a 99.99.');
        return;
    }

    if (detalles.length >= 250) {
        alert('Los detalles deben tener menos de 250 caracteres.');
        return;
    }

    if (parseInt(unidades) === 0 || isNaN(parseInt(unidades))) {
        alert('Ingrese una cantidad de unidades válida.');
        return;
    }

    if (imagen.trim() === "") {
        imagen = 'img/default.png';
        finalJSON['imagen'] = imagen;
        alert('Se agregará una imagen por defecto.');
    }

    productoJsonString = JSON.stringify(finalJSON, null, 2);
    console.log(productoJsonString);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            window.alert(client.responseText);
        }
    };

    client.send(productoJsonString);
}

function getXMLHttpRequest() {
    var objetoAjax;

    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err) {
        objetoAjax = false;
    }
    return objetoAjax;
}

function init() {
    var jsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = jsonString;
}