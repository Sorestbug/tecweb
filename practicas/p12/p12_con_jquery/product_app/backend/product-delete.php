<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array(
    'status'  => 'error',
    'message' => 'La consulta falló'
);

// SE VERIFICA HABER RECIBIDO EL ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    $sql = "UPDATE productos SET eliminado=1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);

    // VINCULAR PARÁMETROS PARA EVITAR INYECCIÓN SQL
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $data['status'] = "success";
        $data['message'] = "Producto eliminado";
    } else {
        $data['message'] = "ERROR: No se ejecutó $sql. " . $stmt->error;
    }

    // CERRAR CONEXIÓN
    $stmt->close();
    $conexion->close();
} else {
    $data['message'] = 'ID no recibido';
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
