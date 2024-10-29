<?php
include_once __DIR__.'/database.php';

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    
    // Consulta para verificar si el nombre ya existe
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data['count'] > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
}
?>
