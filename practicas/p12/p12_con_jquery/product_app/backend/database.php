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

/**
 * Función para obtener un producto por su ID
 * @param int $id
 * @return array|null
 */
function obtenerProductoPorId($id) {
    global $conexion; // Hacemos uso de la conexión definida globalmente

    $id = intval($id); // Asegúrate de que el ID sea un número entero
    $query = "SELECT * FROM productos WHERE id = $id"; // Ajusta el nombre de la tabla según tu base de datos
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        return mysqli_fetch_assoc($resultado); // Devuelve el producto como un array asociativo
    }

    return null; 
}
?>
