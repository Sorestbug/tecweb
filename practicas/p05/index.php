<?php

//Ejercicio 1
echo "<br>";
$_myvar = "\$_myvar es válida <br> <br>";
echo $_myvar;
unset($_myvar);

$_7var = "\$_7var es válida <br> <br>";
echo $_7var;
unset($_7var);

// myvar
echo "myvar NO es válida por no empezar con $ <br> <br>";

$myvar = "\$myvar es válida <br> <br>";
echo $myvar . "\n";
unset($myvar);

$var7 = "\$var7 es válida <br> <br>";
echo $var7 . "\n";
unset($var7);

$_element1 = "\$_element1 es válida <br> <br>";
echo $_element1 . "\n";
unset($_element1);

//$house*5
echo "\$house*5 NO es válida por tener * <br> <br>"; 


?>