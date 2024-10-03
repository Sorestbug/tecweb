<?php
// Capturar los datos del formulario enviados por POST
$nombre = $_POST['nombre'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['detalles'];
$unidades = $_POST['unidades'];
$imagen =  $_POST['imagen'];

/** SE CREA EL OBJETO DE CONEXIÓN */
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

/** Comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

/** Crear la consulta SQL */
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
        VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

/** Ejecutar la consulta */
if ($link->query($sql)) {
    echo 'Producto insertado con ID: ' . $link->insert_id;
} else {
    echo 'El Producto no pudo ser insertado =('; 
}

/** Cerrar la conexión */
$link->close();
?>
