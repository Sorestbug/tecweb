<?php
$vehiculos = array(
    "ABC1234" => array(
        "Auto" => array(
            "marca" => "Toyota",
            "modelo" => "2022",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Juan Pérez",
            "ciudad" => "Ciudad de México",
            "direccion" => "Av. Reforma 123"
        )
    ),
    "XYZ5678" => array(
        "Auto" => array(
            "marca" => "Honda",
            "modelo" => "2021",
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Ana Gómez",
            "ciudad" => "Guadalajara",
            "direccion" => "Calle 5 de Febrero 456"
        )
    ),
    "LMN9101" => array(
        "Auto" => array(
            "marca" => "Mazda",
            "modelo" => "2020",
            "tipo" => "hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Carlos Ruiz",
            "ciudad" => "Monterrey",
            "direccion" => "Calle 16 de Septiembre 789"
        )
    ),
    "DEF2345" => array(
        "Auto" => array(
            "marca" => "Ford",
            "modelo" => "2019",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "María López",
            "ciudad" => "Puebla",
            "direccion" => "Calle 3 Norte 123"
        )
    ),
    "GHI6789" => array(
        "Auto" => array(
            "marca" => "Chevrolet",
            "modelo" => "2018",
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Luis Martínez",
            "ciudad" => "Tijuana",
            "direccion" => "Avenida de la Revolución 456"
        )
    ),
    "JKL3456" => array(
        "Auto" => array(
            "marca" => "Nissan",
            "modelo" => "2021",
            "tipo" => "hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Laura Fernández",
            "ciudad" => "Querétaro",
            "direccion" => "Calle 5 de Febrero 789"
        )
    ),
    "MNO7890" => array(
        "Auto" => array(
            "marca" => "Hyundai",
            "modelo" => "2022",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "José Rodríguez",
            "ciudad" => "León",
            "direccion" => "Boulevard Adolfo López Mateos 123"
        )
    ),
    "PQR1234" => array(
        "Auto" => array(
            "marca" => "Kia",
            "modelo" => "2020",
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Ana Sánchez",
            "ciudad" => "San Luis Potosí",
            "direccion" => "Calle de la Paz 456"
        )
    ),
    "STU5678" => array(
        "Auto" => array(
            "marca" => "Volkswagen",
            "modelo" => "2019",
            "tipo" => "hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Ricardo Gómez",
            "ciudad" => "Toluca",
            "direccion" => "Avenida Las Torres 789"
        )
    ),
    "VWX9101" => array(
        "Auto" => array(
            "marca" => "Subaru",
            "modelo" => "2018",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Verónica Cruz",
            "ciudad" => "Chihuahua",
            "direccion" => "Calle del Carmen 123"
        )
    ),
    "YZA2345" => array(
        "Auto" => array(
            "marca" => "Mitsubishi",
            "modelo" => "2021",
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Fernando Rojas",
            "ciudad" => "Aguascalientes",
            "direccion" => "Avenida 28 de Octubre 456"
        )
    ),
    "BCD6789" => array(
        "Auto" => array(
            "marca" => "Peugeot",
            "modelo" => "2020",
            "tipo" => "hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Gabriela López",
            "ciudad" => "Hermosillo",
            "direccion" => "Calle 200 789"
        )
    ),
    "EFG3456" => array(
        "Auto" => array(
            "marca" => "Renault",
            "modelo" => "2019",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "David Pérez",
            "ciudad" => "Saltillo",
            "direccion" => "Boulevard Francisco I. Madero 123"
        )
    ),
    "HIJ7890" => array(
        "Auto" => array(
            "marca" => "Fiat",
            "modelo" => "2022",
            "tipo" => "camioneta"
        ),
        "Propietario" => array(
            "nombre" => "Mónica Reyes",
            "ciudad" => "Tuxtla Gutiérrez",
            "direccion" => "Calle Central 456"
        )
    ),
    "KLM1234" => array(
        "Auto" => array(
            "marca" => "Alfa Romeo",
            "modelo" => "2021",
            "tipo" => "hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Jorge Morales",
            "ciudad" => "Villahermosa",
            "direccion" => "Avenida Paseo Usumacinta 789"
        )
    ),
    "NOP5678" => array(
        "Auto" => array(
            "marca" => "Audi",
            "modelo" => "2020",
            "tipo" => "sedan"
        ),
        "Propietario" => array(
            "nombre" => "Isabel Fernández",
            "ciudad" => "Mazatlán",
            "direccion" => "Calle Sinaloa 123"
        )
    ),
);

if (isset($_POST['matricula']) && !empty($_POST['matricula'])) { // Consultar por matrícula
    
    $matricula = $_POST['matricula'];
    if (array_key_exists($matricula, $vehiculos)) {
        echo "<h3>Información del vehículo con matrícula $matricula:</h3>";
        echo "<pre>";
        print_r($vehiculos[$matricula]);
        echo "</pre>";
    } else {
        echo "<p>Matrícula no encontrada.</p>";
    }
} elseif (isset($_POST['todos']) && $_POST['todos'] == '1') { // Consultar todos los vehículos
    echo "<h3>Información de todos los vehículos:</h3>";
    echo "<pre>";
    print_r($vehiculos);
    echo "</pre>";
} else {
    echo "<p>Por favor, utilice el formulario para realizar una consulta.</p>";
}

?>
