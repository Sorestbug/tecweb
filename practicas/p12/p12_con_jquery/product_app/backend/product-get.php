<?php
include_once __DIR__.'/database.php';

$data = array(
    'status' => 'error',
    'message' => 'Producto no encontrado'
);

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    $producto = obtenerProductoPorNombre($nombre);

    if ($producto) {
        $data = array(
            'status' => 'success',
            'producto' => $producto
        );
    }
} else {
    $data['message'] = 'Nombre no proporcionado';
}

header('Content-Type: application/json');
echo json_encode($data);
?>

<?php
function obtenerProductoPorNombre($nombre) {
    global $conexion;

    $nombre = mysqli_real_escape_string($conexion, $nombre); // Escapar caracteres especiales
    $query = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0"; // Asegúrate de que no esté eliminado
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        return mysqli_fetch_assoc($resultado);
    }

    return null;
}
?>
