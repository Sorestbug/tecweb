<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Práctica 7</title>
</head>
<body>

    <h2>Ejercicio 1</h2>
    <h3>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</h3>

    <?php
    include './src/funciones.php';
    if (isset($_GET['numero'])) { // Verificar si se ha pasado el número como parámetro en la URL
        $numero = $_GET['numero'];
        if (Multiplo5y7($numero)) {
            echo "<p>El número " . htmlspecialchars($numero) . " es múltiplo de 5 y 7.</p>";
        } else {
            echo "<p>El número " . htmlspecialchars($numero) . " no es múltiplo de 5 y 7.</p>";
        }
    } else {
        echo "<p>Por favor, proporciona un número en la URL como ?numero=.</p>";
    }
    ?>

    <h2>Ejercicio 2</h2>
    <h3>Generar 3 números aleatorioa hasta tener impar/par/impar</h3>
    <?php
    generarSecuencia();
    ?>


</body>
</html>
