var menu = this.document.getElementById("imgAvatarSeleccionado");
var imgAvatar = this.document.getElementsByClassName("imgAvatar");
var imgAvatarId = this.document.getElementById("imgIdAvatar0");
var divButtonSeleccionAvatar = this.document.getElementById("buttonPopUp");
var divPopUp = this.document.getElementById("divPopUp");

//Para manipulación de la sección de selección de avatares
var vlocTagDivImagenSeleccion = document.getElementById("divImagenSeleccion");    
var vlocTagImgAvatar = document.getElementsByClassName('imgAvatar');
var boton = this.document.getElementById("Cambiarico");

menu.addEventListener("click", ()=>{    

    

    let vlocElementImagenSeleccion = window.getComputedStyle(vlocTagDivImagenSeleccion, 'target');    
    let vlocVisibilityImagenSeleccion = vlocElementImagenSeleccion.getPropertyValue('visibility');    
    
    if (vlocVisibilityImagenSeleccion == "hidden"){        
         
        this.setStylesAvatarVisible(vlocTagDivImagenSeleccion, vlocTagImgAvatar);        
    }else{      
        
        this.setStylesAvatarHidden(vlocTagDivImagenSeleccion, vlocTagImgAvatar);
    }  

});

boton.addEventListener("click", ()=>{
    let vlocElementImagenSeleccion = window.getComputedStyle(vlocTagDivImagenSeleccion, 'target');    
    let vlocVisibilityImagenSeleccion = vlocElementImagenSeleccion.getPropertyValue('visibility');    
    
    if (vlocVisibilityImagenSeleccion == "hidden"){        
         
        this.setStylesAvatarVisible(vlocTagDivImagenSeleccion, vlocTagImgAvatar);        
    }else{      
        
        this.setStylesAvatarHidden(vlocTagDivImagenSeleccion, vlocTagImgAvatar);
    }  
});

for(i=0; i<=imgAvatar.length - 1; i++){
    imgAvatar[i].addEventListener("click", ()=>{    
        
        this.setStylesAvatarHidden(vlocTagDivImagenSeleccion, vlocTagImgAvatar);
        
        
    }); 
} 



function setStylesAvatarVisible(vparTagDivImagenSeleccion, vparTagImgAvatar){    

    
    vparTagDivImagenSeleccion.style.width = '330px';
    vparTagDivImagenSeleccion.style.top = '40px';
    vparTagDivImagenSeleccion.style.visibility = 'visible';
    vparTagDivImagenSeleccion.style.right = '75%'; 
        
    for($i=0; $i<vparTagImgAvatar.length ; $i++){
        vparTagImgAvatar[$i].style.width = '60px';         
        vparTagImgAvatar[$i].style.height = '60px';   
        vparTagImgAvatar[$i].style.visibility = 'visible'; 
        vparTagImgAvatar[$i].style.top = '3px';
        vparTagImgAvatar[$i].style.left = '2px';              
    }
}

function setStylesAvatarHidden(vparTagDivImagenSeleccion, vparTagImgAvatar){

    vparTagDivImagenSeleccion.style.width = '200px';
    vparTagDivImagenSeleccion.style.height = '65px';
    vparTagDivImagenSeleccion.style.top = '15px';
    vparTagDivImagenSeleccion.style.visibility = 'hidden';
    vparTagDivImagenSeleccion.style.right = '35%';

    for($i=0; $i<vparTagImgAvatar.length ; $i++){
        vparTagImgAvatar[$i].style.width = '30px';        
        vparTagImgAvatar[$i].style.height = '30px';
        vparTagImgAvatar[$i].style.visibility = 'hidden'; 
        vparTagImgAvatar[$i].style.top = '15px';
        vparTagImgAvatar[$i].style.left = '15px';
    }
}

function setVisibilityPopUpAvatar(){
    let divPopUpElement = window.getComputedStyle(divPopUp, 'target');
    let divPopUpVisibility = divPopUpElement.getPropertyValue('visibility');
    let divPopUpIntern = this.document.getElementById("divPopUpIntern");

    if (divPopUpVisibility == 'hidden'){
        divPopUp.style.visibility = 'visible';
        divPopUpIntern.style.visibility = 'visible';
    }
    else{
        divPopUp.style.visibility = 'hidden';   
        divPopUpIntern.style.visibility = 'hidden';
    }
}

function get_avatar_img(imgSeleccionada){            
    var img = imgAvatar[imgSeleccionada].getAttribute("src");    
    var tagImg = document.getElementById("imgAvatarSeleccionado");

    tagImg.setAttribute("src", img);
    tagImg.style.left = '10px';
    tagImg.style.top = '10px';       
}
