// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "titulo": "",
    "tipo": "",
    "region": "",
    "genero": "",
    "duracion": ""
};

let JsonString; // Declaración global

$(document).ready(function () {
    let edit = false;

    JsonString = JSON.stringify(baseJSON, null, 2); // Asignación a la variable global
    $('#description').val(JsonString);
    $('#content-result').hide();
    listarContenidos();

    function listarContenidos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const contenidos = JSON.parse(response);

                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if (Object.keys(contenidos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    contenidos.forEach(contenido => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL CONTENIDO
                        let descripcion = '';
                        descripcion += '<li>tipo: ' + contenido.tipo + '</li>';
                        descripcion += '<li>region: ' + contenido.region + '</li>';
                        descripcion += '<li>genero: ' + contenido.genero + '</li>';
                        descripcion += '<li>titulo: ' + contenido.titulo + '</li>';
                        descripcion += '<li>duracion: ' + contenido.duracion + '</li>';

                        template += `
                            <tr contentId="${contenido.id}">
                                <td>${contenido.id}</td>
                                <td><a href="#" class="content-item">${contenido.titulo}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="content-delete btn btn-danger" onclick="eliminarContenido()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "contenidos"
                    $('#contents').html(template);
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
                        const contenidos = JSON.parse(response);

                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if (Object.keys(contenidos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            contenidos.forEach(contenido => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL CONTENIDO
                                let descripcion = '';
                                descripcion += '<li>tipo: ' + contenido.tipo + '</li>';
                                descripcion += '<li>region: ' + contenido.region + '</li>';
                                descripcion += '<li>genero: ' + contenido.genero + '</li>';
                                descripcion += '<li>titulo: ' + contenido.titulo + '</li>';
                                descripcion += '<li>duracion: ' + contenido.duracion + '</li>';

                                template += `
                                    <tr contentId="${contenido.id}">
                                        <td>${contenido.id}</td>
                                        <td><a href="#" class="content-item">${contenido.titulo}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="content-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${contenido.titulo}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#content-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "contenidos"
                            $('#contents').html(template);
                        }
                    }
                }
            });
        }
        else {
            $('#content-result').hide();
        }
    });

    const validationRules = {
        titulo: {
            required: true,
            maxLength: 50
        },
        tipo: {
            required: true,
            options: ['Película', 'Serie'] // Ejemplo de tipos permitidos
        },
        region: {
            required: true,
            maxLength: 10
        },
        genero: {
            required: true,
            maxLength: 20
        },
        duracion: {
            optional: true
        }
        // Otros campos pueden agregarse según sea necesario
    };

    // Manejar la validación al cambiar de campo
    $('#titulo, #tipo, #region, #genero, #duracion').on('blur', function () {
        const fieldName = $(this).attr('id');
        const value = $(this).val();

        const validation = validationRules[fieldName];
        if (validation) {
            if (validation.required && value === '') {
                // Mensaje de campo requerido
                // Puedes mostrar un mensaje o realizar una acción específica
                console.log(`El campo ${fieldName} es requerido.`);
            } else if (validation.maxLength && value.length > validation.maxLength) {
                // Mensaje de exceder la longitud máxima
                console.log(`El campo ${fieldName} excede el límite de caracteres.`);
            }
        }
    });

    // Modificar el evento de submit para realizar la validación final antes de agregar el contenido a la BD
    $('#content-form').submit(e => {
        e.preventDefault();

        const titulo = $('#titulo').val().trim();

        if (!titulo) {
            let errorMessage = '';

            if (!titulo) {
                errorMessage += 'Por favor, ingresa un título para el contenido.<br>';
            }

            $('#error-message').html(errorMessage);
            $('#error-message').show();
            return;
        } else {
            $('#error-message').hide();
        }

        let postData = {
            "titulo": titulo,
            "tipo": $('#tipo').val(),
            "region": $('#region').val(),
            "genero": $('#genero').val(),
            "duracion": $('#duracion').val()
            // Otros campos pueden agregarse según sea necesario
        };

        postData['id'] = $('#contentId').val();

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

        $.post(url, postData, (response) => {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
            $('#titulo').val('');
            $('#description').val(JsonString);
            $('#content-result').show();
            $('#container').html(template_bar);
            listarContenidos();
            edit = false;
        });
    });

    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Quieres eliminar el producto?')) {
            const element = $(this)[0].parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('backend/product-delete.php', { id }, function (response) {
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                fetchProducts();
                let mensaje = respuesta.message;
                alert(mensaje);
            });
        }
    });

    $(document).on('click', '.content-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('contentId');
        $.post('./backend/product-single.php', { id }, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let contenido = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#titulo').val(contenido.titulo);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#contentId').val(contenido.id);
            // SE ELIMINA titulo, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete (contenido.titulo);
            delete (contenido.eliminado);
            delete (contenido.id);
            // SE ACTUALIZA EL VALOR DE LA VARIABLE GLOBAL EN LUGAR DE REDEFINIRLA LOCALMENTE
            JsonString = JSON.stringify(contenido, null, 2);
            // SE MUESTRA STRING EN EL <textarea>
            $('#description').val(JsonString);

            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });
});
