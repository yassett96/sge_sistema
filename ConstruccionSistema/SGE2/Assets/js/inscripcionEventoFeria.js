//Seleccionamos los objetos a los que se le hacen clic
    //Estos objetos son de la clase
const buttonNavForm = document.getElementsByClassName("liNavegacionInscripcionEvento");
const sectionDatosInscripcionFeria = document.getElementsByClassName("secDatosInscripcionFeria");
//const sectionDatosInscripcionFeriaid = document.getElementById("secDatosProyecto");

buttonNavForm[0].addEventListener("click", e => {        
    botonDatosProyectoAzul();    
    botonDatosParticipante1Blanco();    
    botonDatosParticipante2Blanco();    
    botonDatosParticipante3Blanco();
    
    seccionElegido(0);
    
});

buttonNavForm[1].addEventListener("click", () => {    
    botonDatosProyectoBlanco();       
    botonDatosParticipante1Azul();    
    botonDatosParticipante2Blanco();    
    botonDatosParticipante3Blanco();

    seccionElegido(1);
});

buttonNavForm[2].addEventListener("click", () => {    
    botonDatosProyectoBlanco();    
    botonDatosParticipante1Blanco();    
    botonDatosParticipante2Azul();    
    botonDatosParticipante3Blanco();

    seccionElegido(2);
});

buttonNavForm[3].addEventListener("click", () => {    
    botonDatosProyectoBlanco();    
    botonDatosParticipante1Blanco();
    botonDatosParticipante2Blanco();    
    botonDatosParticipante3Azul();

    seccionElegido(3);
});

function seccionElegido(i){ 
    
    for(j=0;j<sectionDatosInscripcionFeria.length;j++){
        //alert(j);    
        if(i==j){
            sectionDatosInscripcionFeria[j].style.visibility = "visible"; 
        }else{
            sectionDatosInscripcionFeria[j].style.visibility = "hidden"; 
        }
    }
}

function botonDatosProyectoBlanco(){
    buttonNavForm[0].style.backgroundColor = 'white';
    buttonNavForm[0].style.color = '#102461';
    buttonNavForm[0].style.opacity = 0.5;            
 }

function botonDatosProyectoAzul(){
    buttonNavForm[0].style.backgroundColor = '#181d43';    
    buttonNavForm[0].style.color = "white";
    buttonNavForm[0].style.opacity = 1;
}

function botonDatosParticipante1Blanco(){
    buttonNavForm[1].style.backgroundColor = 'white';
    buttonNavForm[1].style.color = '#102461';
    buttonNavForm[1].style.opacity = 0.5;
}

function botonDatosParticipante1Azul(){
    buttonNavForm[1].style.backgroundColor = '#181d43';    
    buttonNavForm[1].style.color = "white";
    buttonNavForm[1].style.opacity = 1;
}

function botonDatosParticipante2Blanco(){
    buttonNavForm[2].style.backgroundColor = 'white';
    buttonNavForm[2].style.color = '#102461';
    buttonNavForm[2].style.opacity = 0.5;
}

function botonDatosParticipante2Azul(){
    buttonNavForm[2].style.backgroundColor = '#181d43';    
    buttonNavForm[2].style.color = "white";
    buttonNavForm[2].style.opacity = 1;
}

function botonDatosParticipante3Blanco(){
    buttonNavForm[3].style.backgroundColor = 'white';
    buttonNavForm[3].style.color = '#102461';
    buttonNavForm[3].style.opacity = 0.5;
}

function botonDatosParticipante3Azul(){
    buttonNavForm[3].style.backgroundColor = '#181d43';    
    buttonNavForm[3].style.color = "white";
    buttonNavForm[3].style.opacity = 1;
}