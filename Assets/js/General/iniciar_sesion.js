$(document).ready(function(){
    
  $('ul.nav-tabs li a:first').addClass('active');
    $('.secciones article').hide();
    $('.secciones article:first').show();
    
    $('ul.nav-tabs li a').click(function(){
        $('ul.nav-tabs li a').removeClass('active');
        $(this).addClass('active');
        $('.secciones article').hide();

        var pestañaActive = $(this).attr('href');        
        $(pestañaActive).show();    
        return false;
    });

});    



function ValidarPestaña(valPes) {
      
  if(valPes == 1){
    document.getElementById("accionD").value="login";
    document.getElementById("accionE").value="";
    document.getElementById("accionG").value="";   
    document.querySelector('#usuarioD').required = true; 
    document.querySelector('#contraD').required = true; 
    document.querySelector('#menuAcceso').required = false;
    document.querySelector('#usuarioE').required = false; 
    document.querySelector('#contraE').required = false; 
    document.querySelector('#usuarioG').required = false; 
    document.querySelector('#contraG').required = false;     
  }else if(valPes == 2){
    document.getElementById("accionD").value="";
    document.getElementById("accionE").value="loginE";
    document.getElementById("accionG").value="";
    document.querySelector('#usuarioD').required = false; 
    document.querySelector('#contraD').required = false; 
    document.querySelector('#menuAcceso').required = false;
    document.querySelector('#usuarioE').required = true; 
    document.querySelector('#contraE').required = true; 
    document.querySelector('#usuarioG').required = false; 
    document.querySelector('#contraG').required = false;  
  }else if(valPes == 3){
    document.getElementById("accionD").value="";
    document.getElementById("accionE").value="";
    document.getElementById("accionG").value="loginG";
    document.querySelector('#usuarioD').required = false; 
    document.querySelector('#contraD').required = false; 
    document.querySelector('#menuAcceso').required = false;
    document.querySelector('#usuarioE').required = false; 
    document.querySelector('#contraE').required = false; 
    document.querySelector('#usuarioG').required = true; 
    document.querySelector('#contraG').required = true; 
  }
}









    