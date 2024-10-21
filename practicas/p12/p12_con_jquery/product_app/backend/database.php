<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '12345678a',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Error en la conexión a la base de datos: ' . mysqli_connect_error() . '!');
    }
?>