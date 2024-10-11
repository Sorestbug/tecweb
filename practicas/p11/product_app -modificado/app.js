// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarProducto(e) {
    e.preventDefault();  // Evita que el formulario recargue la página

    var searchQuery = document.getElementById('search').value.trim();

    if (searchQuery === "") {
        alert("Por favor ingresa un término de búsqueda.");
        return;
    }

    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n' + client.responseText);
            let productos = JSON.parse(client.responseText);

            if (productos.length > 0) {
                let template = '';
                productos.forEach(function (producto) {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;

                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = '<tr><td colspan="3">No se encontraron productos.</td></tr>';
            }
        }
    };

    client.send("search=" + encodeURIComponent(searchQuery));
}

// FUNCIÓN PARA AGREGAR PRODUCTO
function agregarProducto(e) {
    e.preventDefault();

    if (!validarFormulario()) {
        return;
    }

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
        }
    };
    client.send(productoJsonString);
}

// VALIDACIONES DEL FORMULARIO
function validarNombre() {
    const nombre = document.getElementById("name").value.trim();
    if (nombre === "" || nombre.length > 100) {
        alert("El nombre es requerido y debe tener 100 caracteres o menos.");
        return false;
    }
    return true;
}

function validarModelo() {
    const modelo = document.getElementById("modelo").value.trim();
    const modeloRegex = /^[a-zA-Z0-9]+$/;
    if (!modeloRegex.test(modelo) || modelo.length > 25) {
        alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
        return false;
    }
    return true;
}

function validarPrecio() {
    const precio = parseFloat(document.getElementById("precio").value);
    if (isNaN(precio) || precio <= 99.99) {
        alert("El precio debe ser mayor a 99.99.");
        return false;
    }
    return true;
}

function validarDetalles() {
    const detalles = document.getElementById("detalles").value.trim();
    if (detalles.length > 250) {
        alert("Los detalles pueden tener hasta 250 caracteres.");
        return false;
    }
    return true;
}

function validarUnidades() {
    const unidades = parseInt(document.getElementById("unidades").value);
    if (isNaN(unidades) || unidades < 0) {
        alert("Las unidades son requeridas y deben ser un número mayor o igual a 0.");
        return false;
    }
    return true;
}

function validarImagen() {
    const imagen = document.getElementById("imagen").value.trim();
    if (imagen === "") {
        document.getElementById("imagen").value = './img/default.png';
    }
    return true;
}

function validarFormulario() {
    return validarNombre() && validarModelo() && validarPrecio() &&
           validarDetalles() && validarUnidades() && validarImagen();
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        try{
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}
