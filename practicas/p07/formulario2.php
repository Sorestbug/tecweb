<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Práctica 7</title>
</head>
<body>

    <h2>Ejercicio 6</h2>
    <form action="./src/vehiculos.php" method="post">
        <label for="matricula">Consultar por matrícula:</label>
        <input type="text" id="matricula" name="matricula" />
        <input type="submit" value="Consultar">
    </form>

    <form action="./src/vehiculos.php" method="post">
        <input type="hidden" name="todos" value="1" />
        <input type="submit" value="Consultar Todos">
    </form>

</body>
</html>
