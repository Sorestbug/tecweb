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
    console.log("Init function called"); // Verifica si la función se llama
    var JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);

    // Cargar la lista de productos al iniciar la página
    listarProductos();
}

// Función para cargar todos los productos no eliminados
function listarProductos() {
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
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
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
            }
        }
    });
}

// Función para buscar productos según lo que se vaya tecleando en el campo de búsqueda
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
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
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

    //console.log(finalJSON); // Verificar el JSON antes de validar

    // Validaciones
    if (!finalJSON['nombre'] || finalJSON['nombre'].trim() === "") { // Validación para nombre nulo o vacío
        alert("El nombre no puede ser nulo o vacío.");
        return;
    }

    if (finalJSON['nombre'].length > 100) {
        alert("El nombre debe tener menos de 100 caracteres.");
        return;
    }

    if (!/^[a-zA-Z0-9-]+$/.test(finalJSON['modelo']) || finalJSON['modelo'].length > 25) {
        alert("El modelo debe ser alfanumérico y tener menos de 25 caracteres.");
        return;
    }

    if (finalJSON['precio'] <= 99.99) {
        alert("El precio debe ser mayor a 99.99.");
        return;
    }

    if (finalJSON['detalles'].length > 250) {
        alert("Los detalles pueden tener hasta 250 caracteres.");
        return;
    }

    if (finalJSON['unidades'] < 0) {
        alert("Las unidades deben ser mayores o iguales a 0.");
        return;
    }

    if (!finalJSON['imagen']) {
        finalJSON['imagen'] = './img/default.png';  // Si no se proporciona una imagen, se usa la predeterminada
    }

    //console.log("Validaciones pasadas");  

    $.ajax({
        url: './backend/product-add.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(finalJSON),
        success: function(respuesta) {
            console.log(respuesta); // Agregado para verificar la respuesta
            let template_bar = `
                <li>status: ${respuesta.status}</li>
                <li>message: ${respuesta.message}</li>
            `;
    
            $('#product-result').addClass('d-block');
            $('#container').html(template_bar);
    
            // Recargar la lista de productos
            listarProductos();
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

                // Recargar la lista de productos
                listarProductos();
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud:", error); // Para ver errores
                alert("Ocurrió un error al eliminar el producto.");
            }
        });
    }
}


// Inicializar la aplicación al cargar la página
$(document).ready(function() {
    init();
});
