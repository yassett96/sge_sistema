let tiempoSegundos = 59
let tiempoMinutos = 59
let tiempoHoras = 23
let tiempoDias = 44
let contador = 0

cifrasInicialesTemporizador()
temporizar()

function cifrasInicialesTemporizador(){
    tiempoSegundos += 1
    modificarContenidoPorId("h2DigitoSegundos").innerHTML = tiempoSegundos
    modificarContenidoPorId("h2DigitoMinutos").innerHTML = tiempoMinutos
    modificarContenidoPorId("h2DigitoHoras").innerHTML = tiempoHoras
    modificarContenidoPorId("h2DigitoDias").innerHTML = tiempoDias
}

function temporizar(){    
    let contando = tiempoSegundos > 0        

    if(contando){
        tiempoSegundos = tiempoSegundos - 1
        modificarContenidoPorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
           temporizar() 
        }, 1000);
    }else if(tiempoMinutos > 0){        
        tiempoMinutos = tiempoMinutos - 1
        modificarContenidoPorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        modificarContenidoPorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else if(tiempoHoras > 0){
        tiempoHoras = tiempoHoras - 1
        modificarContenidoPorId("h2DigitoHoras").innerHTML = tiempoHoras
        tiempoMinutos = 59
        modificarContenidoPorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        modificarContenidoPorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else if(tiempoDias > 0){
        tiempoDias = tiempoDias -1
        modificarContenidoPorId("h2DigitoDias").innerHTML = tiempoDias
        tiempoHoras = 23
        modificarContenidoPorId("h2DigitoHoras").innerHTML = tiempoHoras
        tiempoMinutos = 59
        modificarContenidoPorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        modificarContenidoPorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else{
        window.alert("La feria ha comenzado!")
    }
}


function modificarContenidoPorId(id){
    return document.getElementById(id)
}