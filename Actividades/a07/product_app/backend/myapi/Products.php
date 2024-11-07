<?php
namespace App;

require_once 'DataBase.php';

use \PDO;
use \Exception;

class Products extends DataBase {
    private array $data = [];

    public function __construct(string $db, string $user = 'root', string $pass = '12345678a') {
        parent::__construct($user, $pass, $db);
    }

    // Método para agregar un producto (ADD)
    public function add($data) {
        // Preparamos la conexión y datos
        $conexion = $this->conexion;
        
        // Verificamos si el producto ya existe
        $sql = "SELECT * FROM productos WHERE nombre = '{$data->nombre}' AND eliminado = 0";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            // Si el producto existe, devolvemos un error
            return json_encode(['status' => 'error', 'message' => 'Ya existe un producto con ese nombre']);
        }
        
        // Si no existe, procedemos a insertar el producto
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                VALUES ('{$data->nombre}', '{$data->marca}', '{$data->modelo}', {$data->precio}, '{$data->detalles}', {$data->unidades}, '{$data->imagen}', 0)";
        
        if ($conexion->query($sql)) {
            // Si la inserción fue exitosa, devolvemos una respuesta positiva
            return json_encode(['status' => 'success', 'message' => 'Producto agregado correctamente']);
        } else {
            // Si hubo un error en la inserción, devolvemos el error
            return json_encode(['status' => 'error', 'message' => 'Error al agregar el producto']);
        }
    }
    
    
    

    // Método para eliminar un producto por ID
    public function delete(string $id): void {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // Método para editar un producto existente
    public function edit(array $product): void {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, unidades = :unidades, modelo = :modelo, marca = :marca, detalles = :detalles, imagen = :imagen WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($product);
    }

    // Método para listar todos los productos
    public function list(): void {
        $sql = "SELECT * FROM productos";
        $stmt = $this->conexion->query($sql);
        $this->data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar productos por un término
    public function search(string $term): void {
        $sql = "SELECT * FROM productos WHERE nombre LIKE :term";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['term' => '%' . $term . '%']);
        $this->data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener un solo producto por ID
    public function single(string $id): void {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id' => $id]);
        $this->data = $stmt->fetch(PDO::FETCH_ASSOC) ? [$stmt->fetch(PDO::FETCH_ASSOC)] : [];
    }

    // Método para obtener un solo producto por nombre
    public function singleByName(string $name): void {
        $sql = "SELECT * FROM productos WHERE nombre = :name";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['name' => $name]);
        $this->data = $stmt->fetch(PDO::FETCH_ASSOC) ? [$stmt->fetch(PDO::FETCH_ASSOC)] : [];
    }

    // Método para obtener los datos en formato JSON
    public function getData(): string {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }
}
?>
