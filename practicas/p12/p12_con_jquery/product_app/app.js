// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "./img/default.png"
};

function init() {
    //console.log("Init function called"); 
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    listarProductos(); // Cargar la lista de productos al iniciar la página
}


function listarProductos() { // Función para cargar todos los productos no eliminados
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        dataType: 'json',
        success: function(productos) {
            if (productos.length > 0) {
                let template = '';

                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                
                    template += `
                        <tr productId="${producto.id}">
                            <td><a href="#" onclick="cargarProducto('${producto.nombre}')">${producto.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto(${producto.id})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                $('#products').html(template);

               
                $('.product-name').on('click', function() {  // Cargar datos en el formulario
                    const productId = $(this).data('id');
                    cargarProducto(productId);
                });
            }
        }
    });
}


function cargarProducto(nombre) { // Función para cargar los datos de un producto 
    $.ajax({
        url: `./backend/product-get.php?nombre=${encodeURIComponent(nombre)}`,
        type: 'GET',
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.status === 'success') {
                let producto = respuesta.producto;
                let baseJSON = {
                    "precio": producto.precio,
                    "unidades": producto.unidades,
                    "modelo": producto.modelo,
                    "marca": producto.marca,
                    "detalles": producto.detalles,
                    "imagen": producto.imagen || './img/default.png',
                    "nombre": producto.nombre
                };

                // Cargar los datos en los campos
                $('#description').val(JSON.stringify(baseJSON, null, 2));
                $('#name').val(producto.nombre); 
                $('#product-id').val(producto.id);  
            } else {
                alert(respuesta.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar el producto:", error);
        }
    });
}


// Función para buscar productos según lo que se vaya tecleando
$('#search').on('keyup', function() {
    let search = $(this).val();
    $.ajax({
        url: './backend/product-search.php',
        type: 'GET',
        data: { search: search },
        dataType: 'json',
        success: function(productos) {
            if (productos.length > 0) {
                let template = '';
                let template_bar = '';

                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;

                    template += `
                        <tr productId="${producto.id}">
                            <td><a href="#" class="product-name" data-id="${producto.id}">${producto.nombre}</a></td>
                            <td>${producto.id}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger" onclick="eliminarProducto(${producto.id})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;

                    template_bar += `<li>${producto.nombre}</li>`;
                });

                $('#products').html(template);
                $('#container').html(template_bar);
                $('#product-result').addClass('d-block');
                $('.product-name').on('click', function() {
                    const productId = $(this).data('id');
                    cargarProducto(productId);
                });
            }
        }
    });
});

// Función para agregar un nuevo producto 
$('#add-product-form').on('submit', function(e) {
    e.preventDefault();

    let productoJsonString = $('#description').val();
    if (!productoJsonString) {
        alert("El campo de descripción está vacío.");
        return;
    }

    let finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $('#name').val();

    let productId = $('#product-id').val(); // Obtener el ID del producto
    if (productId) {
        finalJSON['id'] = productId; // Asegurarse de añadir el ID al JSON si es un producto existente
    }

    // Detectar si el producto ya existe
    let url = productId ? './backend/product-update.php' : './backend/product-add.php';

    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(finalJSON), 
        success: function(respuesta) {
            let template_bar = `
                <li>status: ${respuesta.status}</li>
                <li>message: ${respuesta.message}</li>
            `;

            $('#product-result').addClass('d-block');
            $('#container').html(template_bar);

            // Recargar la lista de productos
            listarProductos();

            // Limpiar el formulario después de agregar/actualizar
            $('#description').val('');
            $('#name').val('');
            $('#product-id').val(''); 
        },
        error: function(xhr, status, error) {
            console.error("Error en la llamada AJAX:", error);
            $('#container').html("<li>Error en la solicitud. Por favor, intenta nuevamente.</li>");
        }
    });
});



// Función para eliminar un producto
function eliminarProducto(id) {
    if (confirm("¿De verdad deseas eliminar el producto?")) {
        $.ajax({
            url: './backend/product-delete.php',
            type: 'GET',
            data: { id: id },
            dataType: 'json', // Asegúrate de especificar el tipo de dato esperado
            success: function(respuesta) {
                console.log(respuesta); // Añadir esta línea para ver la respuesta
                let template_bar = `
                    <li>status: ${respuesta.status}</li>
                    <li>message: ${respuesta.message}</li>
                `;

                $('#product-result').addClass('d-block');
                $('#container').html(template_bar);
                listarProductos();  // Recargar la lista de productos
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error); 
                alert("Ocurrió un error al eliminar el producto.");
            }
        });
    }
}

// Inicializar la aplicación al cargar la página
$(document).ready(function() {
    init();
});
