//INICIO CAMBIO DE MENU MÓVIL
//  seleccionamos los dos elementos que serán clickables

const toggleButton = document.getElementById("button-menu");
const navWrapper = document.getElementById("nav");
const menuDes = document.getElementById("imgLogUsuario");
const DivMenuDespliegue = document.getElementById("divMenuDespliegue");

/* 
  cada ves que se haga click en el botón 
  agrega y quita las clases necesarias 
  para que el menú se muestre.
*/
toggleButton.addEventListener("click", () => {
  toggleButton.classList.toggle("close");
  navWrapper.classList.toggle("show");
});

/* 
  Cuándo se haga click fuera del contenedor de enlaces 
  el menú debe esconderse.
*/

navWrapper.addEventListener("click", e => {
  if (e.target.id === "nav") {
    navWrapper.classList.remove("show");
    toggleButton.classList.remove("close");
  }
});

menuDes.addEventListener("mouseover", e => {
  FunActivarAlerta();
});

menuDes.addEventListener("mouseout", e => {
  FunDesactivarAlerta();
});

DivMenuDespliegue.addEventListener("mouseover", e => {
  FunActivarAlerta();  
});

DivMenuDespliegue.addEventListener("mouseout", e => {
  FunDesactivarAlerta();
});

function FunActivarAlerta(){
  let tag = document.getElementById("divMenuDespliegue"); 
  tag.style.top = '15px';
  tag.style.visibility = 'visible';    
}

function FunDesactivarAlerta(){
  let tag = document.getElementById("divMenuDespliegue"); 
  tag.style.top = '0px';
  tag.style.visibility = 'hidden';    
}

FunVerificarExitenciaProyectosInscritos();

//Funciones
function FunVerificarExitenciaProyectosInscritos(){
  const vlocVerificacionProyectoInscrito = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolVerificarProyectosInscritos=" + Cnt_Verificar_Existencia_Proyecto);
  if (vlocVerificacionProyectoInscrito > Cnt_No_Existe_Proyecto_Inscrito)
    $("#butDetallesDeProyectos").show();
  else
    $("#butDetallesDeProyectos").hide(); 

}

$("#sectionLinkUni").on("click", function(){
  window.location.href = "https://www.uni.edu.ni/#/";
});

FunVerificarNumeroProyectosInscritos();

function FunVerificarNumeroProyectosInscritos(){
  let vlocCodRegistroParticipante = FunEjecutarAjax("../../Controlador/Participante/CInicioParticipanteConEvento.php?varObtenerCodRegInscriptor=" + Cnt_Obtener_Codigo_Registro_Inscriptor);
  let vlocNoProyectosParticipante = FunEjecutarAjax("../../Controlador/Participante/CInscripcionEventoFeria.php?vparCodRegParticipante=" + vlocCodRegistroParticipante);    
  
  if(vlocNoProyectosParticipante < Cnt_No_Maximo_Proyectos_Inscritos){ 
    $("#butInscribirAEvento").css({
      "visibility" : "visible"
    });

  }else{
    $("#butInscribirAEvento").css({
      "visibility" : "hidden"
    });
  }
}
//FIN CAMBIO DE MENU MÓVIL