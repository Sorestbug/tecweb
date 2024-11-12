<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

class Read extends DataBase {

    public function performAction($data = null) {
        $sql = "SELECT * FROM productos";
        
        if ($data && isset($data['id'])) {
            $sql .= " WHERE id = :id";
            $result = $this->query($sql, [':id' => $data['id']]);
        } else {
            $result = $this->query($sql);
        }

        $productos = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }

        return json_encode($productos);
    }
}
?>
