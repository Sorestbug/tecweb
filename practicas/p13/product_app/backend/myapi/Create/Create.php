<?php
namespace TECWEB\MYAPI\Create;

use TECWEB\MYAPI\DataBase;

class Create extends DataBase {

    public function performAction($data) {
        $sql = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen)
                VALUES (:nombre, :precio, :unidades, :modelo, :marca, :detalles, :imagen)";
        
        $this->execute($sql, $data);
        return json_encode(['status' => 'success', 'message' => 'Producto creado correctamente']);
    }
}
?>
