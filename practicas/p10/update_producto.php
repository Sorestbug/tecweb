<?php
/* MySQL Conexion */
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

// Chequea conexión
if ($link->connect_errno) {
    die("ERROR: No pudo conectarse con la DB. " . $link->connect_error);
}

// Verifica si se han recibido los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapa las entradas para evitar inyecciones SQL
    $id = $link->real_escape_string($_POST['id']);
    $nombre = $link->real_escape_string($_POST['nombre']);
    $marca = $link->real_escape_string($_POST['marca']);
    $modelo = $link->real_escape_string($_POST['modelo']);
    $precio = $link->real_escape_string($_POST['precio']);
    $unidades = $link->real_escape_string($_POST['unidades']);
    $detalles = $link->real_escape_string($_POST['detalles']);
    $imagen = $link->real_escape_string($_POST['imagen']);

    // Ejecuta la actualización del registro
    $sql = "UPDATE productos SET 
                nombre='$nombre', 
                marca='$marca', 
                modelo='$modelo', 
                precio='$precio', 
                unidades='$unidades', 
                detalles='$detalles', 
                imagen='$imagen' 
            WHERE id='$id'";

    if (mysqli_query($link, $sql)) {
        echo "Registro actualizado.";
    } else {
        echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
    }
} else {
    echo "No se recibieron datos.";
}

// Cierra la conexión
mysqli_close($link);
?>
