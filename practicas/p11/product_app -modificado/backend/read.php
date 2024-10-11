<?php
    include_once __DIR__.'/database.php';

    $data = array(); // Arreglo para devolver el JSON
    
    if( isset($_POST['search_term']) ) { // Se verifica el dato
        $search_term = $_POST['search_term'];
        $search_term = $conexion->real_escape_string($search_term); // Se escapa el dato para evitar la inyeccion de SQL
        
        // Query usando LIKE
        $query = " 
            SELECT * 
            FROM productos 
            WHERE nombre LIKE '%{$search_term}%' 
               OR marca LIKE '%{$search_term}%' 
               OR detalles LIKE '%{$search_term}%'
        ";
        
        if ( $result = $conexion->query($query) ) {  // Obtener los resultados
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

    
    echo json_encode($data, JSON_PRETTY_PRINT); // Se convierte a JSON
?>
