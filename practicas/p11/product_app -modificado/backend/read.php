<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL DATO A BUSCAR
    if( isset($_POST['search_term']) ) {
        $search_term = $_POST['search_term'];
        // SE ESCAPA EL DATO PARA EVITAR INYECCIÓN SQL
        $search_term = $conexion->real_escape_string($search_term);
        
        // SE REALIZA LA QUERY DE BÚSQUEDA USANDO LIKE PARA NOMBRE, MARCA O DETALLES
        $query = "
            SELECT * 
            FROM productos 
            WHERE nombre LIKE '%{$search_term}%' 
               OR marca LIKE '%{$search_term}%' 
               OR detalles LIKE '%{$search_term}%'
        ";
        
        if ( $result = $conexion->query($query) ) {
            // SE OBTIENEN LOS RESULTADOS
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
