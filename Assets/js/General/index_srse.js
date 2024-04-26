var slideIndex = 0;
var box = document.getElementsByClassName("slideshow-container")[0];
var time;
var slides = document.getElementsByClassName("mySlides");
var dots = document.getElementsByClassName("dot");

$("#sectionLinkUni").click(function () {
    window.location = 'https://www.uni.edu.ni/#/';
  });

 // haz clic en el botón
function plusSlides(index) {
    clearInterval(time);
         // index == 1 representa la siguiente imagen
    if (index == 1) {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (var i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
    } else {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        if (--slideIndex < 1) {
            slideIndex = 3;
        }
        for (var i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
 // Utilizado en carrusel automático
function showSlides() {
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    for (var i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

time = setInterval(showSlides, 4000);

 // Cancele el carrusel cuando el mouse se mueva
box.onmouseenter = function () {
    clearInterval(time);
}
 // Carrusel continúa cuando el ratón se va
box.onmouseleave = function () {    
    time = setInterval(showSlides, 4000);
}

//INICIO CAMBIO DE MENU MÓVIL
//  seleccionamos los dos elementos que serán clickables

const toggleButton = document.getElementById("button-menu");
const navWrapper = document.getElementById("nav");
// const menuDes = document.getElementById("imgLogUsuario");

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

// menuDes.addEventListener("click", e => {
//   let tag = document.getElementById("divMenuDespliegue"); 
//   let tagElement = window.getComputedStyle(tag, 'target')
//   let tagVisibility = tagElement.getPropertyValue('visibility');
  
//   if ( tagVisibility == "hidden") {
//     tag.style.top = '15px';
//     tag.style.visibility = 'visible'; 
//   }else{
//     tag.style.top = '0px';
//     tag.style.visibility = 'hidden'; 
//   }
// });

//FIN CAMBIO DE MENU MÓVIL
