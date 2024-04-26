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
  tag.style.top = '-65px';
  tag.style.visibility = 'visible';    
}

function FunDesactivarAlerta(){
  let tag = document.getElementById("divMenuDespliegue"); 
  tag.style.top = '-85px';
  tag.style.visibility = 'hidden';    
}

$("#sectionLinkUni").click(function () {
  window.location = "https://www.uni.edu.ni/#/";
});
//FIN CAMBIO DE MENU MÓVIL