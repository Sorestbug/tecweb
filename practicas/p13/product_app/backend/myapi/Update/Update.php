<?php
namespace TECWEB\MYAPI\Update;

use TECWEB\MYAPI\DataBase;

class Update extends DataBase {

    public function performAction($data) {
        $sql = "UPDATE productos 
                SET nombre = :nombre, precio = :precio, unidades = :unidades, modelo = :modelo, 
                    marca = :marca, detalles = :detalles, imagen = :imagen
                WHERE id = :id";

        $this->execute($sql, $data);
        return json_encode(['status' => 'success', 'message' => 'Producto actualizado correctamente']);
    }
}
?>
