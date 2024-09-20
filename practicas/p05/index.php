<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>Ejercicios PHP</title>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
</head>
<body>

<!-- Ejercicio 1 -->
<h2>Ejercicio 1:</h2>
<p>
    <?php
    $_myvar = "\$_myvar es válida <br />";
    echo $_myvar;
    unset($_myvar);

    $_7var = "\$_7var es válida <br />";
    echo $_7var;
    unset($_7var);
    ?>
</p>
<p>myvar NO es válida por no empezar con $ <br /></p>
<p>
    <?php
    $myvar = "\$myvar es válida <br />";
    echo $myvar;
    unset($myvar);

    $var7 = "\$var7 es válida <br />";
    echo $var7;
    unset($var7);

    $_element1 = "\$_element1 es válida <br />";
    echo $_element1;
    unset($_element1);
    ?>
</p>
<p>$house*5 NO es válida por tener * <br /></p>

<!-- Ejercicio 2 -->
<h2>Ejercicio 2:</h2>
<p>
    <?php
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;

    echo "$a<br />";
    echo "$b<br />";
    echo "$c<br />";

    $a = "PHP server";
    $b = &$a;

    echo "$a<br />";
    echo "$b<br />";
    echo "$c<br />";

    unset($a, $b, $c);
    ?>
</p>

<!-- Ejercicio 3 -->
<h2>Ejercicio 3:</h2>
<p>
    <?php
    $a = "PHP5";
    echo "$a<br />";

    $z[] = &$a;
    print_r($a);
    echo "<br />";

    $b = "5a version de PHP";
    echo "$b<br />";

    // Asegúrate de extraer un número de $b si es posible
    $c = 0;
    if (preg_match('/(\d+)/', $b, $matches)) {
        $c = (int)$matches[0] * 10; // Extrae el primer número y multiplica
    }
    echo "$c<br />";

    $a .= $b;
    echo "$a<br />";

    $b_numeric = 0;
    if (preg_match('/(\d+)/', $b, $matches)) {
        $b_numeric = (int)$matches[0]; // Extrae el primer número
    }
    $b_numeric *= $c; // Multiplica solo si se extrajo un número
    echo "$b_numeric<br />";

    $z[0] = "MySQL";
    print_r($a);
    echo "<br />";

    unset($a, $b, $c, $z);
    ?>
</p>

<!-- Ejercicio 4 -->
<h2>Ejercicio 4:</h2>
<p>
    <?php
    $GLOBALS['a'] = "PHP5";
    echo $GLOBALS['a'] . "<br />";

    $GLOBALS['z'][] = &$GLOBALS['a'];
    print_r($GLOBALS['a']);
    echo "<br />";

    $GLOBALS['b'] = "5a version de PHP";
    echo $GLOBALS['b'] . "<br />";

    // Asegúrate de extraer un número de $b si es posible
    $GLOBALS['c'] = 0;
    if (preg_match('/(\d+)/', $GLOBALS['b'], $matches)) {
        $GLOBALS['c'] = (int)$matches[0] * 10; // Extrae el primer número y multiplica
    }
    echo $GLOBALS['c'] . "<br />";

    $GLOBALS['a'] .= $GLOBALS['b'];
    echo $GLOBALS['a'] . "<br />";

    $b_numeric = 0;
    if (preg_match('/(\d+)/', $GLOBALS['b'], $matches)) {
        $b_numeric = (int)$matches[0]; // Extrae el primer número
    }
    $b_numeric *= $GLOBALS['c']; // Multiplica solo si se extrajo un número
    echo "$b_numeric<br />";

    $GLOBALS['z'][0] = "MySQL";
    print_r($GLOBALS['a']);
    echo "<br />";

    unset($GLOBALS['a'], $GLOBALS['b'], $GLOBALS['c'], $GLOBALS['z']);
    ?>
</p>

<!-- Ejercicio 5 -->
<h2>Ejercicio 5:</h2>
<p>
    <?php
    $a = "7 personas";
    echo "$a<br />";
    $b = (integer)$a;
    echo "$b<br />";

    $a = "9E3";
    echo "$a<br />";
    $c = (double)$a;
    echo "$c<br />";

    unset($a, $b, $c);
    ?>
</p>

<!-- Ejercicio 6 -->
<h2>Ejercicio 6:</h2>
<p>
    <?php
    $a = "0";
    echo "Valor de \$a: ";
    var_dump($a);
    echo "<br />";

    $b = "TRUE";
    echo "Valor de \$b: ";
    var_dump($b);
    echo "<br />";

    $c = FALSE;
    echo "Valor de \$c: ";
    var_dump($c);
    echo "<br />";

    $d = ($a OR $b);
    echo "Valor de \$d: ";
    var_dump($d);
    echo "<br />";

    $e = ($a AND $c);
    echo "Valor de \$e: ";
    var_dump($e);
    echo "<br />";

    $f = ($a XOR $b);
    echo "Valor de \$f: ";
    var_dump($f);
    echo "<br />";

    echo "Valor de \$c como cadena: " . var_export($c, true) . "<br />";
    echo "Valor de \$e como cadena: " . var_export($e, true) . "<br />";
    echo "<br />";

    unset($a, $b, $c, $d, $e, $f);
    ?>
</p>

<!-- Ejercicio 7 -->
<h2>Ejercicio 7:</h2>
<p>
    <?php
    if (isset($_SERVER['SERVER_SOFTWARE'])) {
        $apache_version = $_SERVER['SERVER_SOFTWARE'];
        echo "Versión de Apache: $apache_version<br />";
    } else {
        echo "No se puede determinar la versión de Apache.<br />";
    }
    echo "Versión de PHP: " . phpversion() . "<br />";

    echo "Sistema operativo del servidor: " . php_uname('s') . "<br />";
    echo "Idioma del navegador (cliente): " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br />";
    ?>
</p>

<p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>

</body>
</html>
