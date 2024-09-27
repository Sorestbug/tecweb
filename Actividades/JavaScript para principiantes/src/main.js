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
    var nombre;
    var edad;
    
    nombre = prompt('Ingresa tu nombre:', '');
    edad = prompt('Ingresa tu edad:', '');
    var mensaje = 'Hola ' + nombre + ', así que tienes ' + edad + ' años.';

    document.getElementById("div3").innerHTML = mensaje;
}

