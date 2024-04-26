let tiempoSegundos = document.getElementById("h2DigitoSegundos").innerHTML;
let tiempoMinutos = document.getElementById("h2DigitoMinutos").innerHTML;
let tiempoHoras = document.getElementById("h2DigitoHoras").innerHTML;
let tiempoDias = document.getElementById("h2DigitoDias").innerHTML;

cifrasInicialesTemporizador()
temporizar()

function cifrasInicialesTemporizador(){        
    funReferenciarComponentePorId("h2DigitoSegundos").innerHTML = tiempoSegundos
    funReferenciarComponentePorId("h2DigitoMinutos").innerHTML = tiempoMinutos
    funReferenciarComponentePorId("h2DigitoHoras").innerHTML = tiempoHoras
    funReferenciarComponentePorId("h2DigitoDias").innerHTML = tiempoDias
}

function temporizar(){    
    let contando = tiempoSegundos > 0        

    if(contando){
         
        tiempoSegundos = tiempoSegundos - 1
             
        funReferenciarComponentePorId("h2DigitoSegundos").innerHTML = tiempoSegundos + 1
        setTimeout(() => {
           temporizar() 
        }, 1000);
    }else if(tiempoMinutos > 0){        
        tiempoMinutos = tiempoMinutos - 1
        funReferenciarComponentePorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        funReferenciarComponentePorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else if(tiempoHoras > 0){
        tiempoHoras = tiempoHoras - 1
        funReferenciarComponentePorId("h2DigitoHoras").innerHTML = tiempoHoras
        tiempoMinutos = 59
        funReferenciarComponentePorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        funReferenciarComponentePorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else if(tiempoDias > 0){
        tiempoDias = tiempoDias -1
        funReferenciarComponentePorId("h2DigitoDias").innerHTML = tiempoDias
        tiempoHoras = 23
        funReferenciarComponentePorId("h2DigitoHoras").innerHTML = tiempoHoras
        tiempoMinutos = 59
        funReferenciarComponentePorId("h2DigitoMinutos").innerHTML = tiempoMinutos
        tiempoSegundos = 59
        funReferenciarComponentePorId("h2DigitoSegundos").innerHTML = tiempoSegundos
        setTimeout(() => {
            temporizar() 
         }, 1000);
    }else{
        // funActivarAlerta("info", "Inicio de evento feria!", "La feria científica ha comenzado");
        Swal.fire({
            icon: "info",
            title: '<div style="color: rgb(16, 36, 97); ">¡La feria científica ha iniciado!</div>',
            width: 600,
            padding: '3em',
            color: '#716add',
            background: 'rgba(255, 255, 255, 1) url(../../Assets/imagenes/Recursos/mosaicos2.png) no-repeat',
            // backdrop: `
            //   rgba(16, 36, 97, 0.6)
            //   url("https://thumbs.gfycat.com/PoshHorribleGrunion-size_restricted.gif")
            //   left top
            //   no-repeat
            // `,
            confirmButtonColor: 'rgb(16, 36, 97)',
            onOpen: () => {
                const backdropElement = document.querySelector('.swal2-backdrop');
                // backdropElement.style.backgroundSize = '100px 50px'; // Cambia el tamaño del GIF aquí
            }
          })
        // window.alert("La feria ha comenzado!")
    }
}


function funReferenciarComponentePorId(id){
    return document.getElementById(id)
}