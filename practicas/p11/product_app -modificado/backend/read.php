<?php
    include_once __DIR__.'/database.php';

    // ARREGLO PARA DEVOLVER LOS DATOS EN JSON
    $data = array();

    // SE VERIFICA SI SE RECIBIÓ UN TÉRMINO DE BÚSQUEDA
    if( isset($_POST['search']) ) {
        $search = $_POST['search'];
        
        // SE REALIZA LA CONSULTA UTILIZANDO LIKE PARA BUSCAR COINCIDENCIAS
        $query = "SELECT * FROM productos 
                  WHERE nombre LIKE '%{$search}%' 
                  OR marca LIKE '%{$search}%' 
                  OR detalles LIKE '%{$search}%'";
        
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // SE CODIFICAN A UTF-8 LOS DATOS
                foreach($row as $key => $value) {
                    $row[$key] = utf8_encode($value);
                }
                // SE AGREGA CADA PRODUCTO AL ARREGLO
                $data[] = $row;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }
    
    // SE ENVÍA LA RESPUESTA EN FORMATO JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
