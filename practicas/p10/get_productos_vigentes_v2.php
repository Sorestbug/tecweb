<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS</h3>

    <?php
    $link = new mysqli('localhost', 'root', '12345678a', 'marketzone');

    // Comprobar la conexión
    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    // Establecer el conjunto de caracteres UTF-8
    $link->set_charset("utf8");

    // Consulta para obtener productos que no están eliminados
    $query = "SELECT * FROM productos WHERE eliminado = 0";
    if ($result = $link->query($query)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        echo 'Error en la consulta: ' . $link->error;
    }

    $link->close();
    ?>

    <?php if (!empty($rows)) : ?>
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
                    <th scope="col">Modificar</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?></th>
                    <td><?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['marca'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['modelo'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['precio'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['unidades'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(utf8_encode($row['detalles']), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <img src="<?= htmlspecialchars($row['imagen'], ENT_QUOTES, 'UTF-8') ?>" alt="Imagen de <?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?>" style="width: 100px; height: auto;">
                    </td>
                    <td>
                        <form action="http://localhost/tecweb/practicas/p10/formulario_productos_v2.php" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="nombre" value="<?= htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="marca" value="<?= htmlspecialchars($row['marca'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="modelo" value="<?= htmlspecialchars($row['modelo'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="precio" value="<?= htmlspecialchars($row['precio'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="unidades" value="<?= htmlspecialchars($row['unidades'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="detalles" value="<?= htmlspecialchars(utf8_encode($row['detalles']), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="imagen" value="<?= htmlspecialchars($row['imagen'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No se encontraron productos que no estén eliminados.</p>
    <?php endif; ?>
</body>
</html>
