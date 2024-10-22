<?php
include_once __DIR__.'/database.php';

$data = array(
    'status' => 'error',
    'message' => 'No se proporcionaron datos'
);

$json = file_get_contents('php://input');
$producto = json_decode($json, true);

if (isset($producto['id']) && isset($producto['nombre'])) {
    $id = $producto['id'];
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $unidades = $producto['unidades'];
    $modelo = $producto['modelo'];
    $marca = $producto['marca'];
    $detalles = $producto['detalles'];
    $imagen = $producto['imagen'];

    $sql = "UPDATE productos SET nombre = '$nombre', precio = $precio, unidades = $unidades, modelo = '$modelo', marca = '$marca', detalles = '$detalles', imagen = '$imagen' WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        $data['status'] = 'success';
        $data['message'] = 'Producto actualizado correctamente';
    } else {
        $data['message'] = 'Error al actualizar el producto: ' . mysqli_error($conexion);
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>
