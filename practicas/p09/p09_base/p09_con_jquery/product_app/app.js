// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString; ///convertimos los detalles 
}

///Mostrar los productos de la base de datos con AJAX y se ejecuta sin necesidad de un evento
$.ajax({
        url : './backend/product-list.php',
        type : 'GET',
        success: function(response){
            let productos = JSON.parse(response);
            let template = '';
           productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
            });
            $('#products').html(template);
            console.log(response);
        }
    });

    //Busqueda de productos
    $('#search').keyup(function() { ///se leera lo que esta en teclado
        if($('#search').val()) {
          let search = $('#search').val();
          $.ajax({
            url: './backend/product-search.php',
            data: {search}, ///se envia el valor del input al servidor
            type: 'POST', ///llegara informacion del formulario con el metodo post 
            success: function (response) {
              if(!response.error) {
                let products = JSON.parse(response);
                let template = '';
                products.forEach(producto => {
                  template += `
                         <li><a href="#" class="product-item">${producto.nombre}</a></li>
                        ` 
                });
                $('#product-result').show();
                $('#container').html(template);
              }
            } 
          })
        }
      });