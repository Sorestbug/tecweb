<?php

//Ejercicio 1
echo "<b>Ejercicio 1: </b> <br> <br>";
$_myvar = "\$_myvar es válida <br> <br>";
echo $_myvar;
unset($_myvar);

$_7var = "\$_7var es válida <br> <br>";
echo $_7var;
unset($_7var);

// myvar
echo "myvar NO es válida por no empezar con $ <br> <br>";

$myvar = "\$myvar es válida <br> <br>";
echo $myvar;
unset($myvar);

$var7 = "\$var7 es válida <br> <br>";
echo $var7;
unset($var7);

$_element1 = "\$_element1 es válida <br> <br>";
echo $_element1;
unset($_element1);

//$house*5
echo "\$house*5 NO es válida por tener * <br> <br>"; 

//Ejercicio 2 
echo "<b>Ejercicio 2: </b> <br> <br>";
$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a;
echo $a . "<br> <br>";
echo $b . "<br> <br>";
echo $c . "<br> <br>";
$a = "PHP server";
$b = &$a;
echo $a . "<br> <br>";
echo $b . "<br> <br>";
echo $c . "<br> <br>";
unset($a);
unset($b);
unset($c);

//Ejercicio 3
echo "<b>Ejercicio 3: </b> <br> <br>";
$a = "PHP5";
echo $a . "<br> <br>";

$z[] = &$a;
print_r($a);
echo "<br> <br>";

$b = "5a version de PHP";
echo $b . "<br> <br>";

$c = $b*10;
echo $c . "<br> <br>";

$a .= $b;
echo $a . "<br> <br>";

$b *= $c;
echo $b . "<br> <br>";

$z[0] = "MySQL";
print_r($a);
echo "<br> <br>";
unset($a);
unset($b);
unset($c);
unset($z);

//Ejercicio 4
echo "<b>Ejercicio 4: </b> <br> <br>";
$GLOBALS['a'] = "PHP5";
echo $a . "<br> <br>";

$GLOBALS['z'][] = &$GLOBALS['a'];
print_r($a);
echo "<br> <br>";

$GLOBALS['b'] = "5a version de PHP";
echo $b . "<br> <br>";

$GLOBALS['c'] = $b*10;
echo $c . "<br> <br>";

$a .= $b;
echo $a . "<br> <br>";

$b *= $c;
echo $b . "<br> <br>";

$z[0] = "MySQL";
print_r($a);
echo "<br> <br>";
unset($a);
unset($b);
unset($c);
unset($z);

//Ejercicio 5
echo "<b>Ejercicio 5: </b> <br> <br>";
$a = "7 personas";
echo $a . "<br> <br>";
$b = (integer) $a;
echo $b . "<br> <br>";
$a = "9E3";
echo $a . "<br> <br>";
$c = (double) $a;
echo $c . "<br> <br>";

unset($a);
unset($b);
unset($c);

//Ejercicio 6
echo "<b>Ejercicio 6: </b> <br> <br>";
$a = "0";
echo "Valor de \$a: ";
var_dump($a);
echo "<br>";

$b = "TRUE";
echo "Valor de \$b: ";
var_dump($b);
echo "<br>";

$c = FALSE;
echo "Valor de \$c: ";
var_dump($c);
echo "<br>";

$d = ($a OR $b);
echo "Valor de \$d: ";
var_dump($d);
echo "<br>";

$e = ($a AND $c);
echo "Valor de \$e: ";
var_dump($e);
echo "<br>";

$f = ($a XOR $b);
echo "Valor de \$f: ";
var_dump($f);
echo "<br>";

echo "Valor de \$c como cadena: " . var_export($c, true) . "<br>";
echo "Valor de \$e como cadena: " . var_export($e, true) . "<br>";
echo "<br>";

unset($a);
unset($b);
unset($c);
unset($d);
unset($e);
unset($f);

//Ejercicio 7
echo "<b>Ejercicio 7: </b> <br> <br>";
if (isset($_SERVER['SERVER_SOFTWARE'])) {
    $apache_version = $_SERVER['SERVER_SOFTWARE'];
    echo "Versión de Apache: " . $apache_version . "<br>";
} else {
    echo "No se puede determinar la versión de Apache.<br>";
}
echo "Versión de PHP: " . phpversion() . "<br>";

echo "Sistema operativo del servidor: " . php_uname('s') . "<br>";

echo "Idioma del navegador (cliente): " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
echo "<br>";

?>