//INICIO CAMBIO DE MENU MÓVIL
//  seleccionamos los dos elementos que serán clickables

const toggleButton = document.getElementById("button-menu");
const navWrapper = document.getElementById("nav");
const menuDes = document.getElementById("imgLogUsuario");

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

menuDes.addEventListener("click", e => {
  let tag = document.getElementById("divMenuDespliegue"); 
  let tagElement = window.getComputedStyle(tag, 'target')
  let tagVisibility = tagElement.getPropertyValue('visibility');
  
  if ( tagVisibility == "hidden") {
    tag.style.top = '15px';
    tag.style.visibility = 'visible'; 
  }else{
    tag.style.top = '0px';
    tag.style.visibility = 'hidden'; 
  }
});

$("#sectionLinkUni").click(function () {
  window.location = "https://www.uni.edu.ni/#/";
})
//FIN CAMBIO DE MENU MÓVIL