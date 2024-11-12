<?php
namespace TECWEB\MYAPI\Delete;

use TECWEB\MYAPI\DataBase;

class Delete extends DataBase {

    public function performAction($data) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $this->execute($sql, $data);
        return json_encode(['status' => 'success', 'message' => 'Producto eliminado correctamente']);
    }
}
?>
