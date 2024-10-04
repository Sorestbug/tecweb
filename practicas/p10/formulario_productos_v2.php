<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function validarNombre() {
            const nombre = document.getElementById("nombre").value.trim();
            if (nombre === "" || nombre.length > 100) {
                alert("El nombre es requerido y debe tener 100 caracteres o menos.");
                return false;
            }
            return true;
        }

        function validarModelo() {
            const modelo = document.getElementById("modelo").value.trim();
            const modeloRegex = /^[a-zA-Z0-9]+$/;
            if (!modeloRegex.test(modelo) || modelo.length > 25) {
                alert("El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.");
                return false;
            }
            return true;
        }

        function validarPrecio() {
            const precio = parseFloat(document.getElementById("precio").value);
            if (isNaN(precio) || precio <= 99.99) {
                alert("El precio debe ser mayor a 99.99.");
                return false;
            }
            return true;
        }

        function validarDetalles() {
            const detalles = document.getElementById("detalles").value.trim();
            if (detalles.length > 250) {
                alert("Los detalles pueden tener hasta 250 caracteres.");
                return false;
            }
            return true;
        }

        function validarUnidades() {
            const unidades = parseInt(document.getElementById("unidades").value);
            if (isNaN(unidades) || unidades < 0) {
                alert("Las unidades son requeridas y deben ser un número mayor o igual a 0.");
                return false;
            }
            return true;
        }

        function validarImagen() {
            const imagen = document.getElementById("imagen").value.trim();
            if (imagen === "") {
                document.getElementById("imagen").value = './img/default.png';
            }
            return true;
        }

        function validarFormulario() {
            return validarNombre() && validarModelo() && validarPrecio() &&
                   validarDetalles() && validarUnidades() && validarImagen();
        }
    </script>
</head>
<body>

<h2>Modificar Producto</h2>


<form action="set_producto_v2.php" method="post" onsubmit="return validarFormulario()">
    <label for="id">ID del Producto:</label>
    <input type="text" id="id" name="id" value="<?= !empty($_POST['id']) ? htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8') : (isset($_GET['id']) ? htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8') : '') ?>" readonly>

    <label for="nombre">Nombre del Producto:</label>
    <input type="text" id="nombre" name="nombre" maxlength="100" value="<?= !empty($_POST['nombre']) ? htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8') : (isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre'], ENT_QUOTES, 'UTF-8') : '') ?>" required>

    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" maxlength="25" value="<?= !empty($_POST['marca']) ? htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8') : (isset($_GET['marca']) ? htmlspecialchars($_GET['marca'], ENT_QUOTES, 'UTF-8') : '') ?>" required>

    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" maxlength="25" value="<?= !empty($_POST['modelo']) ? htmlspecialchars($_POST['modelo'], ENT_QUOTES, 'UTF-8') : (isset($_GET['modelo']) ? htmlspecialchars($_GET['modelo'], ENT_QUOTES, 'UTF-8') : '') ?>" required>

    <label for="precio">Precio:</label>
    <input type="number" step="0.01" id="precio" name="precio" value="<?= !empty($_POST['precio']) ? htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8') : (isset($_GET['precio']) ? htmlspecialchars($_GET['precio'], ENT_QUOTES, 'UTF-8') : '') ?>" required>

    <label for="detalles">Detalles:</label>
    <input type="text" id="detalles" name="detalles" maxlength="250" value="<?= !empty($_POST['detalles']) ? htmlspecialchars($_POST['detalles'], ENT_QUOTES, 'UTF-8') : (isset($_GET['detalles']) ? htmlspecialchars($_GET['detalles'], ENT_QUOTES, 'UTF-8') : '') ?>">

    <label for="unidades">Unidades:</label>
    <input type="number" id="unidades" name="unidades" value="<?= !empty($_POST['unidades']) ? htmlspecialchars($_POST['unidades'], ENT_QUOTES, 'UTF-8') : (isset($_GET['unidades']) ? htmlspecialchars($_GET['unidades'], ENT_QUOTES, 'UTF-8') : '') ?>" required>

    <label for="imagen">Nombre del archivo de la imagen:</label>
    <input type="text" id="imagen" name="imagen" maxlength="100" placeholder="./img/Botella.png" value="<?= !empty($_POST['imagen']) ? htmlspecialchars($_POST['imagen'], ENT_QUOTES, 'UTF-8') : (isset($_GET['imagen']) ? htmlspecialchars($_GET['imagen'], ENT_QUOTES, 'UTF-8') : '') ?>">

    <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
