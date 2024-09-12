<?php

function Multiplo5y7($numero) { //Ejercicio 1
    return $numero % 5 == 0 && $numero % 7 == 0;
}

function generarSecuencia() { //Ejercicio 2
    $matriz = array();
    $iteraciones = 0;
    $numerosGenerados = 0;

    do {
        $num1 = rand(1, 999);
        $num2 = rand(1, 999);
        $num3 = rand(1, 999);

        $matriz[] = array($num1, $num2, $num3);
        $iteraciones++;
        $numerosGenerados += 3;     
    } while (!($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0)); // Verificar si la secuencia es impar, par, impar

    
    echo "<table border='1'>"; // Mostrar la matriz de secuencias generadas
    foreach ($matriz as $fila) {
        echo "<tr><td>{$fila[0]}</td><td>{$fila[1]}</td><td>{$fila[2]}</td></tr>";
    }
    echo "</table>";
    echo "<p>$numerosGenerados números obtenidos en $iteraciones iteraciones.</p>";
}

function encontrarMultiplo($multiplo) { // Ejercicio 3
    $numeroAleatorio = rand(1, 999);
    $intentos = 0;

    while ($numeroAleatorio % $multiplo != 0) {
        $numeroAleatorio = rand(1, 999);
        $intentos++;
    }
    echo "<p>Número aleatorio múltiplo de $multiplo: $numeroAleatorio (en $intentos intentos).</p>";
}


function crearArregloLetras() { // Ejercicio 4
    $arreglo = array();
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }

    echo "<table border='1'>";
    echo "<tr><th>Índice ASCII</th><th>Letra</th></tr>";
    foreach ($arreglo as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    echo "</table>";
}


?>
