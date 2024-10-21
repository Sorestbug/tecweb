<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

$data = array(
    'status'  => 'error',
    'message' => 'Error al agregar el producto.'
);

// Verificar que se recibió el producto
if (!empty($producto)) {
    // SE DECODIFICA EL JSON A UN OBJETO
    $jsonOBJ = json_decode($producto);

    // Comprobación de si JSON se decodificó correctamente
    if (json_last_error() !== JSON_ERROR_NONE) {
        $data['message'] = 'Error al decodificar JSON: ' . json_last_error_msg();
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // VERIFICAR SI EL NOMBRE YA EXISTE Y NO ESTÁ ELIMINADO
    $sql = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        $data['message'] = 'Error en la preparación de la consulta: ' . $conexion->error;
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    $stmt->bind_param('s', $jsonOBJ->nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // ESTABLECER CODIFICACIÓN UTF-8
        $conexion->set_charset("utf8");

        // PREPARAR LA CONSULTA DE INSERCIÓN
        $sql = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            $data['message'] = 'Error en la preparación de la consulta de inserción: ' . $conexion->error;
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
        }

        // VINCULAR PARÁMETROS PARA EVITAR INYECCIÓN SQL
        $stmt->bind_param('sssdsis', 
            $jsonOBJ->nombre, 
            $jsonOBJ->marca, 
            $jsonOBJ->modelo, 
            $jsonOBJ->precio, 
            $jsonOBJ->detalles, 
            $jsonOBJ->unidades, 
            $jsonOBJ->imagen
        );

        // EJECUTAR LA CONSULTA
        if ($stmt->execute()) {
            $data['status'] = "success";
            $data['message'] = "Producto agregado exitosamente";
        } else {
            $data['message'] = "Error en la inserción: " . $stmt->error;
        }
    } else {
        $data['message'] = 'Ya existe un producto con ese nombre';
    }

    // LIBERAR RESULTADOS Y CERRAR CONEXIÓN
    $result->free();
    $stmt->close();
    $conexion->close();
} else {
    $data['message'] = 'No se recibió ningún producto.';
}

// ENVIAR RESPUESTA COMO JSON
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>
