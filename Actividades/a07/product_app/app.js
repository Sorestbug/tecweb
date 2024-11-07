// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "./img/default.png"
};

$(document).ready(function() {
    let edit = false;
    $('#product-result').hide();
    listarProductos();

    // Validaciones
    function validarNombre() {
        const nombre = $('#name').val();
        $('#name-status').text(''); // Limpiar el mensaje de estado antes de validar

        if (nombre.trim() === "") {
            $('#name-status').text('El nombre es requerido.').css('color', 'red');
            return false; // Nombre vacío es inválido
        } else if (nombre.length > 100) {
            $('#name-status').text('El nombre debe tener 100 caracteres o menos.').css('color', 'red');
            return false; // Nombre demasiado largo es inválido
        } else {
            // Validación asíncrona para verificar si el nombre ya existe
            $.ajax({
                url: './backend/product-check.php',
                type: 'GET',
                data: { nombre: nombre },
                dataType: 'json', // Esperamos recibir un JSON
                success: function(response) {
                    console.log(response); // Imprimir la respuesta para depuración

                    // Verificar si hay un error en la respuesta
                    if (response.error) {
                        $('#name-status').text(response.error).css('color', 'red');
                        return false; // Retornar falso si hay un error
                    }

                    if (response.exists) {
                        $('#name-status').text('El nombre ya existe.').css('color', 'red');
                    } else {
                        $('#name-status').text('Nombre Válido').css('color', 'green');
                    }
                },
                error: function(xhr, status, error) {
                    $('#name-status').text('Error al verificar el nombre.').css('color', 'red');
                    console.error('AJAX Error:', status, error); // Imprimir detalles del error
                }
            });
        }
        return true; // Retornar true mientras se realiza la verificación asíncrona
    }

    
    

    function validarMarca() {
        const marca = $('#marca').val();
        if (marca.trim() === "") {
            $('#marca-status').text('La marca es requerida.').css('color', 'red');
            return false;
        } else {
            $('#marca-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    function validarModelo() {
        const modelo = $('#modelo').val();
        const modeloRegex = /^[a-zA-Z0-9]+$/; // Alfanumérico
        if (modelo.trim() === "") {
            $('#modelo-status').text('El modelo es requerido.').css('color', 'red');
            return false;
        } else if (modelo.length > 25 || !modeloRegex.test(modelo)) {
            $('#modelo-status').text('El modelo debe ser alfanumérico y tener 25 caracteres o menos.').css('color', 'red');
            return false;
        } else {
            $('#modelo-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    function validarPrecio() {
        const precio = parseFloat($('#precio').val());
        if (isNaN(precio) || precio <= 99.99) {
            $('#precio-status').text('El precio es requerido y debe ser mayor a 99.99.').css('color', 'red');
            return false;
        } else {
            $('#precio-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    function validarUnidades() {
        const unidades = parseInt($('#unidades').val());
        if (isNaN(unidades) || unidades < 0) {
            $('#unidades-status').text('Las unidades son requeridas y deben ser mayor o igual a 0.').css('color', 'red');
            return false;
        } else {
            $('#unidades-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    function validarDetalles() {
        const detalles = $('#detalles').val();
        if (detalles.length > 250) {
            $('#detalles-status').text('Los detalles deben tener 250 caracteres o menos.').css('color', 'red');
            return false;
        } else {
            $('#detalles-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    function validarImagen() {
        const imagen = $('#imagen').val();
        if (imagen.trim() === "") {
            $('#imagen-status').text('Usando imagen por defecto.').css('color', 'orange');
            return true;
        } else {
            $('#imagen-status').text('¡Bien!').css('color', 'green');
            return true;
        }
    }

    // Evento focusout para validar al cambiar de campo
    $('#name').focusout(validarNombre);
    $('#marca').focusout(validarMarca);
    $('#modelo').focusout(validarModelo);
    $('#precio').focusout(validarPrecio);
    $('#unidades').focusout(validarUnidades);
    $('#detalles').focusout(validarDetalles);
    $('#imagen').focusout(validarImagen);

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);

                if (Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
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
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search=' + search,
                data: { search },
                type: 'GET',
                success: function(response) {
                    if (!response.error) {
                        const productos = JSON.parse(response);

                        if (Object.keys(productos).length > 0) {
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
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
                                    <li>${producto.nombre}</li>
                                `;
                            });
                            $('#product-result').show();
                            $('#container').html(template_bar);
                            $('#products').html(template);
                        }
                    }
                }
            });
        } else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        // Validar campos antes de agregar el producto
        if (validarNombre() && validarMarca() && validarModelo() && validarPrecio() && validarUnidades() && validarDetalles() && validarImagen()) {
            // Se crea el objeto JSON a partir de los valores de los campos de formulario
            let postData = {
                nombre: $('#name').val(),
                id: $('#productId').val(),
                precio: parseFloat($('#precio').val()) || 0.0,
                unidades: parseInt($('#unidades').val()) || 1,
                modelo: $('#modelo').val() || "XX-000",
                marca: $('#marca').val() || "NA",
                detalles: $('#detalles').val() || "NA",
                imagen: $('#imagen').val() || "./img/default.png"
            };

            const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

            $.post(url, postData, (response) => {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
                edit = false;

                // Reinicia los campos del formulario
                $('#product-form').trigger('reset');
                // Limpiar los estados de validación
                $('.form-text').text('');
            });
        } else {
            alert("Por favor corrige los errores en el formulario antes de enviar.");
        }
    });

    $(document).on('click', '.product-delete', (e) => {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(e.target).closest('tr'); // Cambiado a e.target para obtener el botón correcto
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', { id }, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(e.target).closest('tr');
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', { id }, (response) => {
            let product = JSON.parse(response);

            // Carga los valores del JSON en cada campo del formulario
            $('#name').val(product.nombre);
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            $('#productId').val(product.id);

            edit = true; // Cambia a modo edición
        });
        e.preventDefault();
    });
});
