$(document).ready(function () {
    let edit = false;
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);

                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if (Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search=' + $('#search').val(),
                data: { search },
                type: 'GET',
                success: function (response) {
                    if (!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);

                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if (Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: ' + producto.precio + '</li>';
                                descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                                descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                                descripcion += '<li>marca: ' + producto.marca + '</li>';
                                descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        let img;
        if ($('#imagen').val() == "") {
            img = 'img/imagen.png'
        }

        const postData = {
            nombre: $('#name').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: img,
            id: $('#product_Id').val()
        };

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        console.log(postData);
        $.post(url, postData, (response) => {
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">Status: ${respuesta.status}</li>
                        <li style="list-style: none;">Mensaje: ${respuesta.message}</li>
                    `;
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', { id }, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', { id }, function (response) {
            const producto = JSON.parse(response);
            console.log(response);
            $('#name').val(producto.nombre);
            $('#product_Id').val(producto.id);
            $('#unidades').val(producto.unidades);
            $('#modelo').val(producto.modelo);
            $('#marca').val(producto.marca);
            $('#detalles').val(producto.detalles);
            $('#imagen').val(producto.imagen);
            $('#precio').val(producto.precio);
            edit = true;
        })
    });
});

$('#name').keyup(function () {
    if ($('#name').val()) {
        let search = $('#name').val();
        $.ajax({
            url: './backend/product-search_name.php?search=' + $('#name').val(),
            data: { search },
            type: 'GET',
            success: function (response) {
                if (!response.error) {
                    // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                    const productos = JSON.parse(response);

                    // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                    if (Object.keys(productos).length > 0) {
                        // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                        let template_bar =
                            `
                            <li style="list-style: none;">PRODUCTOS CON NOMBRES SIMILARES</li>
                            <li style="list-style: none;">&nbsp;</li>
                        `;

                        productos.forEach(producto => {
                            template_bar += `
                                <li>${producto.nombre}</il>
                            `;
                        });
                        // SE HACE VISIBLE LA BARRA DE ESTADO
                        $('#product-result').show();
                        // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                        $('#container').html(template_bar);
                    } else {
                        // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                        let template_bar =
                            `
                            <li style="list-style: none;">PRODUCTOS CON NOMBRES SIMILARES</li>
                            <li style="list-style: none;">&nbsp;</li>
                            <li >NINGUNO</li>
                        `;
                        // SE HACE VISIBLE LA BARRA DE ESTADO
                        $('#product-result').show();
                        // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                        $('#container').html(template_bar);
                    }
                }
            }
        });
    }
    else {
        $('#product-result').hide();
    }
});

function verificarEntrada(control) {
    if (control.value == '') {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Ingrese el nombre</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    } else {
        if (control.value.length > 100) {
            control.focus();
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Excede los 100 caracteres</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
            control.value = "";
        } else {
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
        }
    }
}

function verificarM(control) {
    if (control.value == "") {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Selecciona una marca</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    } else {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    }
}

function verificarMod(control) {
    if (control.value == '') {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Ingrese el modelo</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    } else {
        if (control.value.length > 25) {
            control.focus();
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Excede los 25 caracteres</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
            control.value = "";
        } else {
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
        }
    }
}

function verificarP(control) {

    precio = parseFloat(control.value);
    if (control.value == '') {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Ingrese el precio</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    } else {
        if (precio < 99.99) {
            control.focus();
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: El precio debe ser mayor de $99.99</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
            control.value = "";
        } else {
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
        }
    }
}

function verificarD(control) {
    if (control.value.length > 250) {
        control.focus();
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Excede los 250 caracteres</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
        control.value = "";
    } else {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    }
}

function verificarU(control) {
    uni = parseInt(control.value);
    if (control.value == '') {
        let template_bar = '';
        template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Ingrese el numero de unidades</li>
                `;
        $('#product-result').show();
        $('#container').html(template_bar);
    } else {
        if (uni <= 0) {
            control.focus();
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: error</li>
                    <li style="list-style: none;">Mensaje: Numero de unidades erroneo</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
            control.value = "";
        } else {
            let template_bar = '';
            template_bar += `
                    <li style="list-style: none;">Status: success</li>
                    <li style="list-style: none;">Mensaje: Campo correcto</li>
                `;
            $('#product-result').show();
            $('#container').html(template_bar);
        }
    }
}
