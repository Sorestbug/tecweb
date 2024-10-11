<?php
include_once __DIR__ . '/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // VALIDAR QUE EL NOMBRE DEL PRODUCTO NO EXISTA
    $nombre = $jsonOBJ->nombre;

    // CONSULTA PARA VERIFICAR SI EL PRODUCTO YA EXISTE
    $checkQuery = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
    $result = $conexion->query($checkQuery);

    if ($result && $result->num_rows > 0) {
        // PRODUCTO EXISTENTE
        echo json_encode(["message" => "Error: El producto '$nombre' ya existe y no puede ser agregado."]);
    } else {
        // CONSULTA PARA INSERTAR EL NUEVO PRODUCTO
        $modelo = $jsonOBJ->modelo;
        $precio = $jsonOBJ->precio;
        $unidades = $jsonOBJ->unidades;
        $marca = $jsonOBJ->marca;
        $detalles = $jsonOBJ->detalles;
        $imagen = $jsonOBJ->imagen;

        $insertQuery = "INSERT INTO productos (nombre, modelo, precio, unidades, marca, detalles, imagen, eliminado) 
                        VALUES ('$nombre', '$modelo', '$precio', '$unidades', '$marca', '$detalles', '$imagen', 0)";

        if ($conexion->query($insertQuery)) {
            // INSERCIÓN EXITOSA
            echo json_encode(["message" => "Éxito: Producto '$nombre' agregado con éxito."]);
        } else {
            // ERROR EN LA INSERCIÓN
            echo json_encode(["message" => "Error al agregar el producto: " . $conexion->error]);
        }
    }

    // CERRAR LA CONEXIÓN
    $conexion->close();
} else {
    echo json_encode(["message" => "Error: No se recibieron datos."]);
}
?>
