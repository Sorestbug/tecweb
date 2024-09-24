<?php
// Conectar a la base de datos
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

/** Comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen = $_POST['imagen'];

// Validar que nombre, marca y modelo no existan ya en la BD
$sql_check = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    // Si el producto ya existe, mostrar mensaje de error en formato XHTML
    echo <<<EOT
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
        <head>
            <meta http-equiv="content-type" content="text/html;charset=utf-8" />
            <title>Error: Producto ya existe</title>
        </head>
        <body>
            <h1>Error</h1>
            <p>El producto con nombre '{$nombre}', marca '{$marca}', y modelo '{$modelo}' ya existe en la base de datos.</p>
        </body>
    </html>
    EOT;
} else {
    // Si no existe, insertar en la BD
    $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                   VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";

    if ($link->query($sql_insert)) {
        // Si la inserción fue exitosa, mostrar resumen de datos insertados
        echo <<<EOT
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
            <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8" />
                <title>Producto Insertado</title>
            </head>
            <body>
                <h1>Producto Insertado Exitosamente</h1>
                <ul>
                    <li><strong>Nombre:</strong> {$nombre}</li>
                    <li><strong>Marca:</strong> {$marca}</li>
                    <li><strong>Modelo:</strong> {$modelo}</li>
                    <li><strong>Precio:</strong> {$precio}</li>
                    <li><strong>Detalles:</strong> {$detalles}</li>
                    <li><strong>Unidades:</strong> {$unidades}</li>
                    <li><strong>Imagen:</strong> {$imagen}</li>
                    <li><strong>Eliminado:</strong> 0</li>
                </ul>
            </body>
        </html>
        EOT;
    } else {
        // Si hay un error en la inserción, mostrar mensaje de error
        echo <<<EOT
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
            <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8" />
                <title>Error al Insertar</title>
            </head>
            <body>
                <h1>Error</h1>
                <p>Hubo un error al insertar el producto en la base de datos.</p>
            </body>
        </html>
        EOT;
    }
}

/** Cerrar la conexión */
$link->close();
?>
