const menu = this.document.getElementById("imgAvatarSeleccionado");
const imgAvatar = this.document.getElementsByClassName("imgAvatar");
const imgAvatarId = this.document.getElementById("imgIdAvatar0");


menu.addEventListener("click", ()=>{
    
    let tag = document.getElementById("divImagenSeleccion");    
    let tagElement = window.getComputedStyle(tag, 'target');    
    let tagVisibility = tagElement.getPropertyValue('visibility');

    let tagImgAvatar = document.getElementsByClassName('imgAvatar');
    
    if (tagVisibility == "hidden"){
        tag.style.width = '330px';
        tag.style.top = '40px';
        tag.style.visibility = 'visible';
        tag.style.right = '75%'; 
        
        for($i=0; $i<tagImgAvatar.length ; $i++){
            tagImgAvatar[$i].style.width = '60px';
            //alert("Aqui");       
            tagImgAvatar[$i].style.height = '60px';   
            tagImgAvatar[$i].style.visibility = 'visible'; 
            tagImgAvatar[$i].style.top = '3px';
            tagImgAvatar[$i].style.left = '2px';              
        }
        
    }else{
        tag.style.width = '200px';
        tag.style.height = '65px';
        tag.style.top = '15px';
        tag.style.visibility = 'hidden';
        tag.style.right = '35%';
        for($i=0; $i<tagImgAvatar.length ; $i++){
            tagImgAvatar[$i].style.width = '30px';
            //alert("Aqui");       
            tagImgAvatar[$i].style.height = '30px';
            tagImgAvatar[$i].style.visibility = 'hidden'; 
            tagImgAvatar[$i].style.top = '15px';
            tagImgAvatar[$i].style.left = '15px';
        }
    }  

});

function get_avatar_img(imgSeleccionada){            
    var img = imgAvatar[imgSeleccionada].getAttribute("src");    
    var tagImg = document.getElementById("imgAvatarSeleccionado");

    tagImg.setAttribute("src", img);
    tagImg.style.left = '15px';
    tagImg.style.top = '15px';       
}

