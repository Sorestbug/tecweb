<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Servidor</title>
</head>
<body>

    <h2>Ejercicio 5 - Servidor</h2>
    <?php
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : null;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';

    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
    } else {
        echo "<p>Error: Usted no cumple con el rango de edad permitido o no es del sexo femenino.</p>";
    }
    ?>

</body>
</html>
