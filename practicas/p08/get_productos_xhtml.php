<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS</h3>

    <?php
    if (isset($_GET['tope'])) {
        $tope = $_GET['tope'];

        if (!empty($tope) && is_numeric($tope)) {

            @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');
            if ($link->connect_errno) {
                die('Falló la conexión: '.$link->connect_error.'<br/>');
            }

            if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $result->free();
            }

            $link->close();
        } else {
            echo '<p>El parámetro "tope" debe ser un número válido.</p>';
        }
    } else {
        echo '<p>Parámetro "tope" no detectado...</p>';
    }
    ?>

    <?php if (isset($rows) && !empty($rows)) : ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['marca']) ?></td>
                    <td><?= htmlspecialchars($row['modelo']) ?></td>
                    <td><?= htmlspecialchars($row['precio']) ?></td>
                    <td><?= htmlspecialchars($row['unidades']) ?></td>
                    <td><?= htmlspecialchars(utf8_encode($row['detalles'])) ?></td>
                    <td><img src="<?= htmlspecialchars($row['imagen']) ?>" alt="Imagen del producto" /></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($tope)) : ?>
        <p>No se encontraron productos con unidades menores o iguales a <?= htmlspecialchars($tope) ?>.</p>
    <?php endif; ?>
</body>
</html>
