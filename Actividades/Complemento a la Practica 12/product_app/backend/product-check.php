<?php
include_once __DIR__.'/database.php'; // Incluir el archivo de conexión

$data = array(
    'exists' => false // Por defecto, asumimos que no existe
);

// Verificar si se ha recibido el nombre
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    // Preparar la consulta para verificar si el nombre ya existe
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre = ?";
    $stmt = $conexion->prepare($query); // Usa $conexion aquí
    if ($stmt) {
        $stmt->bind_param("s", $nombre); // Vincular parámetro
        $stmt->execute(); // Ejecutar consulta
        $result = $stmt->get_result(); // Obtener resultados

        // Obtener el conteo de resultados
        $data = $result->fetch_assoc();
        if ($data['count'] > 0) {
            echo json_encode(['exists' => true]); // Si existe, retornar true
        } else {
            echo json_encode(['exists' => false]); // Si no existe, retornar false
        }
        
        $stmt->close(); // Cerrar la declaración
    } else {
        // Si la preparación falla
        echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
    }
} else {
    // Manejo de error si no se recibe el nombre
    echo json_encode(['error' => 'No se recibió el nombre.']);
}

$conexion->close(); // Cerrar la conexión
?>
