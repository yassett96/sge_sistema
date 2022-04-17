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
    })
});    
    
function ValidarPestaña(valPes) {
      
    if(valPes == 1){
      document.getElementById("accionD").value="login";
      document.getElementById("accionE").value="";
      document.getElementById("accionG").value="";
    }else if(valPes == 2){
      document.getElementById("accionD").value="";
      document.getElementById("accionE").value="loginE";
      document.getElementById("accionG").value="";
    }else if(valPes == 3){
      document.getElementById("accionD").value="";
      document.getElementById("accionE").value="";
      document.getElementById("accionG").value="loginG";
    }
  }