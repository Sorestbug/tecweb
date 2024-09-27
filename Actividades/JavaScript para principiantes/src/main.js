//Ejercicios JS:
function ejercicio1() {
    let mensaje = "Hola Mundo!";
    document.getElementById("div1").innerHTML = mensaje;
}

function ejercicio2() {
    var nombre = 'Juampy';
    var edad = 25;
    var altura = 1.68;
    var casado = false;
    
    var resultado = "Nombre: " + nombre + "<br>" +
                    "Edad: " + edad + "<br>" +
                    "Altura: " + altura + " metros<br>" +
                    "Casado: " + (casado ? "Sí" : "No");
    
    document.getElementById("div2").innerHTML = resultado;
}

function ejercicio3() {
    var nombre, edad;
    
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    var mensaje = 'Hola ' + nombre + ', así que tienes ' + edad + ' años.';

    document.getElementById("div3").innerHTML = mensaje;
}

function ejercicio4() {
    var valor1, valor2;
    
    valor1 = prompt('Introducir primer número:', '');
    valor2 = prompt('Introducir segundo número:', '');
    
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);
    var mensaje = 'La suma es ' + suma + '<br>' + 'El producto es ' + producto;

    document.getElementById("div4").innerHTML = mensaje;
}

function ejercicio5() {
    var nombre;
    var nota;
    
    nombre = prompt('Ingresa tu nombre:', '');
    nota = prompt('Ingresa tu nota:', '');
    
    if (nota >=4){
        var mensaje = nombre + 'esta aprobado con ' + nota;
    }else{
        var mensaje = nombre + 'esta reprobado con ' + nota;
    }
    
    document.getElementById("div5").innerHTML = mensaje;
}

function ejercicio6() {
    var num1, num2;
    
    num1 = prompt('Ingresa el primer número:', '');
    num2 = prompt('Ingresa el segundo número:', '');
    
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    
    var resultado = (num1 > num2) 
        ? 'El mayor es ' + num1 
        : 'El mayor es ' + num2;
    
    document.getElementById("div6").innerHTML = resultado;
}

function ejercicio7() {
    var nota1, nota2, nota3;
    
    nota1 = prompt('Ingresa 1ra. nota:', '');
    nota2 = prompt('Ingresa 2da. nota:', '');
    nota3 = prompt('Ingresa 3ra. nota:', '');
    
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);
    
    var promedio = (nota1 + nota2 + nota3) / 3;
    
    var resultado;
    if (promedio >= 7) {
        resultado = 'Aprobado';
    } else if (promedio >= 4) {
        resultado = 'Regular';
    } else {
        resultado = 'Reprobado';
    }
    
    document.getElementById("div7").innerHTML = resultado;
}

function ejercicio8() {
    var valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '');
    valor = parseInt(valor);
    
    var resultado;
    
    switch (valor) {
        case 1: 
            resultado = 'uno';
            break;
        case 2: 
            resultado = 'dos';
            break;
        case 3: 
            resultado = 'tres';
            break;
        case 4: 
            resultado = 'cuatro';
            break;
        case 5: 
            resultado = 'cinco';
            break;
        default: 
            resultado = 'Debe ingresar un valor comprendido entre 1 y 5.';
    }
    
    document.getElementById("div8").innerHTML = resultado;
}

function ejercicio9() {
    var col = prompt('Ingresa el color con que quieres pintar el fondo de la ventana (rojo, verde, azul):', '');
    
    switch (col) {
        case 'rojo': 
            document.body.style.backgroundColor = '#ff0000';
            break;
        case 'verde': 
            document.body.style.backgroundColor = '#00ff00';
            break;
        case 'azul': 
            document.body.style.backgroundColor = '#0000ff';
            break;
        default:
            alert('Color no reconocido. Por favor, ingresa rojo, verde o azul.');
    }
}

function ejercicio10() {
    var x = 1;
    var resultado = '';
    
    while (x <= 100) {
        resultado += x + '<br>';
        x = x + 1;
    }
    
    document.getElementById("div10").innerHTML = resultado;
}

function ejercicio11() {
    var x = 1;
    var suma = 0;
    var valor;

    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);
        suma += valor;
        x++;
    }

    document.getElementById("div11").innerHTML = "La suma de los valores es " + suma + "<br>";
}

function ejercicio12() {
    var valor;

    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        document.getElementById("div12").innerHTML += 'El valor ' + valor + ' tiene ';
        
        if (valor < 10) {
            document.getElementById("div12").innerHTML += '1 dígito<br>';
        } else if (valor < 100) {
            document.getElementById("div12").innerHTML += '2 dígitos<br>';
        } else if (valor < 1000) {
            document.getElementById("div12").innerHTML += '3 dígitos<br>';
        }
    } while (valor !== 0);
}

function ejercicio13() {
    var resultado = '';
    
    for (var f = 1; f <= 10; f++) {
        resultado += f + " ";
    }

    document.getElementById("div13").innerHTML = resultado;
}


