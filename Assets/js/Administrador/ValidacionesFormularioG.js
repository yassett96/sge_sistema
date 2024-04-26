
function validarletras(parametro){
    var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]*$/;
    if(parametro.search(patron)){
        return false;
    }else{
        return true;
    }

}

function validarNumeros(parametro){
    if(!/^([0-9])*$/.test(parametro)){
        return false;
    } else{
        return true;
    }
}

function validarcedula(parametro){
    var patron = /^[0-9]{3}-([0][1-9]|[12][0-9]|3[01])([0][1-9]|[1][0-2])(\d{2})-\d{4}([A-Z]){1}$/; 

    ///^(?:(?:(?:0?[1-9]|1\d|2[0-8])[/](?:0?[1-9]|1[0-2])|(?:29|30)[/](?:0?[13-9]|1[0-2])|31[/](?:0?[13578]|1[02]))[/](?:0{2,3}[1-9]|0{1,2}[1-9]\d|0?[1-9]\d{2}|[1-9]\d{3})|29[/]0?2[/](?:\d{1,2}(?:0[48]|[2468][048]|[13579][26])|(?:0?[48]|[13579][26]|[2468][048])00))$/
    if(!patron.test(parametro)){
        return false;
    } else {
        return true;
    }
}

function validarCorreo(parametro){
    var patron = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(!patron.test(parametro)){
        return false;
    }else{
        return true;
    }
}

function validartelefono(parametro){
    //var patron1 = /^\d{8}$/;//00000000
    var patron1 = /^\d{4}-\d{4}$/;//0000-0000
    //0000 0000
    
    if(!patron1.test(parametro)){
        return false;
    } else {
        return true;
    }
}



function validaruser(parametro){
    var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\d]{5,15}$/;

    if(!patron.test(parametro)){
        return false;
    } else {
        return true;
    }
}

function validacontra(parametro){
    var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?_&\-])[A-Za-z\d$@$!%*?&\-]{6,16}$/;

    /* Explicacion:  
     Minimo 8 caracteres, maximo 16
     minimo una letra mayuscula
     minimo una letra minuscula
     minimo un digito
     minimo una caracter especial*/

    if(!patron.test(parametro)){
        return false;
    } else {
        return true;
    }
}



function OrdenOracion() {
    
    /*var selecciona = function(ids){
        var valores = ids.split(",");
        for (var i in valores)
            document.getElementById(valores[i].replace(/\s/g, ""));
    };
    //var input = selecciona("pname,sname");*/

    var pname = document.getElementById('pname');
    var sname = document.getElementById('sname');
    var papellido = document.getElementById('papellido');
    var sapellido = document.getElementById('sapellido');
    var palabra = pname.value;
    var palabra2 = sname.value;
    var palabra3 =  papellido.value;
    var palabra4 =  sapellido.value;
    //-//
    if(!pname.value) return;

    var mayuscula = palabra.substring(0,1).toUpperCase();
    
    if (palabra.length > 0) {
      var minuscula = palabra.substring(1).toLowerCase();
    }
    
    pname.value = mayuscula.concat(minuscula);
    //--//
    if(!sname.value) return;

    var mayuscula = palabra2.substring(0,1).toUpperCase();
    
    if (palabra2.length > 0) {
      var minuscula = palabra2.substring(1).toLowerCase();
    }
    
    sname.value = mayuscula.concat(minuscula);
    //-//
    if(!papellido.value) return;

    var mayuscula = palabra3.substring(0,1).toUpperCase();
    
    if (palabra3.length > 0) {
      var minuscula = palabra3.substring(1).toLowerCase();
    }
    
    papellido.value = mayuscula.concat(minuscula);
    //-//
    if(!sapellido.value) return;

    var mayuscula = palabra4.substring(0,1).toUpperCase();
    
    if (palabra4.length > 0) {
      var minuscula = palabra4.substring(1).toLowerCase();
    }
    
    sapellido.value = mayuscula.concat(minuscula);

  }


  //onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"

  $( document ).ready(function() {

    $('#pCedula').mask("000-000000-0000S");
    $('#tel').mask("0000-0000");
    
    /*$('#pCedula').keyup(function(){
        var c = $("pCedula").val();
        console.log(c);
    })*/

    $('#C2').on("click",function(){
        var c = document.getElementById("C2").checked;
        let cedula = document.getElementById("pCedula");

        if(c){
          cedula.disabled = true;
        }
        else{
          cedula.disabled = false;
        }
    });

    

    /*
    $('#tel').keyup(function() {
        var foo = $(this).val().split("-").join(""); // remove hyphens
        if (foo.length > 0) {
          foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
        }
        $(this).val(foo);

        console.log(foo);
    });*/




  
  });


function validarcampos(){
    //alert("Todo en orden");

    var formulario = document.form_general;

    if(formulario.pname.value == ""){
        //alert("Favor ingresar el Primer nombre");
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Primer nombre</div>';
        formulario.pname.focus();
        return false;
    }else if (validarletras(formulario.pname.value) == false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>No se permiten valores numericos </div>';
        formulario.pname.value = "";
        formulario.pname.focus();
        return false;
    }
    else{
        document.getElementById("Alerta").innerHTML = "";
    
    }


    /*if (formulario.sname.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Segundo nombre</div>';
        formulario.sname.focus();
        return false;
    }else*/ if (validarletras(formulario.sname.value) == false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>No se permiten valores numericos </div>';
        formulario.sname.value = "";
        formulario.sname.focus();
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }


    if (formulario.papellido.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Primer apellido</div>';
        formulario.papellido.focus();
        return false;
    }else if (validarletras(formulario.papellido.value) == false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>No se permiten valores numericos </div>';
        formulario.papellido.value = "";
        formulario.papellido.focus();
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }


    /*if (formulario.sapellido.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Segundo apellido</div>';
        formulario.sapellido.focus();
        return false;
    }else*/ if (validarletras(formulario.sapellido.value) == false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>No se permiten valores numericos </div>';
        formulario.sapellido.value = "";
        formulario.sapellido.focus();
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }


    if (formulario.tel.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Teléfono</div>';
        formulario.tel.focus();
        
        return false;
    }
    else if(validartelefono(formulario.tel.value) == false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Numero telefonico ingresado no valido</div>';
        formulario.tel.value = "";
        formulario.tel.focus();
        return false;
    }

    else{
        document.getElementById("Alerta").innerHTML = "";
    }


    


     /* CEDULA */


     if(formulario.pCedula.disabled){
        res = "Campo desabilitado";

    }

    if(!formulario.pCedula.disabled){
        if(formulario.pCedula.value == ""){
            document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a> Ingrese Numero de Cédula</div>';
            formulario.pCedula.value = "";
            formulario.pCedula.focus();
            return false;
        }else{
            if(validarcedula(formulario.pCedula.value) == false){
                document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a> Utilice el Formato Valido </div>';
                formulario.pCedula.value = "";
                formulario.pCedula.focus();
                return false;
            }else{
                res = formulario.pCedula.value;
            }
        }
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }



    if (formulario.correo.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Correo</div>';
        formulario.correo.focus();
        
        return false;
    }else if(validarCorreo(formulario.correo.value) ==  false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar formato de correo valido</div>';
        formulario.correo.value = "";
        formulario.correo.focus();
        
        return false;
    }
    else{
        document.getElementById("Alerta").innerHTML = "";
    }

    
       /* T_Usuario */ 

    //    if (formulario.tipoU.value == "Seleccione tipo de Usuario"){
    //         document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Ingresar el Tipo de Usuario</div>';
    //         formulario.tipoU.focus();
            
    //         return false;
    
    //     }else{
    //         document.getElementById("Alerta").innerHTML = "";
    //     }

    /* t_usuario  */

    if (formulario.pInputUsuario.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Usuario</div>';
        formulario.pInputUsuario.focus();
        
        return false;
    }else if(validaruser(formulario.pInputUsuario.value) ==false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Nombre de usuario no valido</div>';
        formulario.pInputUsuario.value = "";
        formulario.pInputUsuario.focus();
        
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }


    if (formulario.pInputContraseña.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Contraseña </div>';
        formulario.pInputContraseña.focus();
        
        return false;
    }else if(validacontra(formulario.pInputContraseña.value) ==false){
            document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Formato de Contraseña no valido. Su contraseña debe contener de 8 a 16 caracteres que incluyan al menos una letra Mayuscula, una minuscula, un número y un caracter especial</div>';
            formulario.pInputContraseña.value = "";
            formulario.pInputContraseña.focus();    
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
        

    }
    
    if (formulario.pInputRepContraseña.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Contraseña </div>';
        formulario.pInputRepContraseña.focus();
        
        return false;
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }

    if (formulario.pInputContraseña.value != formulario.pInputRepContraseña.value){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Contaseñas no coinciden </div>';
        formulario.pInputContraseña.value = "";
        formulario.pInputRepContraseña.value = "";
        formulario.pInputContraseña.focus();
        
        return false;
    } else {
        document.getElementById("Alerta").innerHTML = "";

    }

    return true;
    //formulario.submit();  
    }

    // window.onload = function() {
    // var myInput = document.getElementById('pInputContraseña');
    // myInput.onpaste = function(e) {
    //   e.preventDefault();
    //   alert("Lamentablemente no puede realizar la accion de pegar");
    // }
    
    // myInput.oncopy = function(e) {
    //     e.preventDefault();
    //     alert("esta acción está prohibida");
    //   }

    // var myInput = document.getElementById('pInputRepContraseña');
    // myInput.onpaste = function(f) {
    //   f.preventDefault();
    //   alert("Lamentablemente no puede realizar la accion de pegar");
    // }
    
    // myInput.oncopy = function(f) {
    //   f.preventDefault();
    //   alert("Lamentablemente no puede realizar la accion de copiar");
    // }
    // }

    document.querySelector('.M1').addEventListener('click', e => {
        // const passwordInput = document.querySelector('pInputContraseña');
        // alert("Entramos");
        const passwordInput = document.querySelector('#pinputContraseña');
        passwordInput.type = 'text';
        // alert(e.target.classList.contains('show'));
        if (e.target.classList.contains('show')) {
            e.target.classList.remove('show');
            e.target.textContent = 'Ocultar';
            passwordInput.type = 'text';
        } else {
            e.target.classList.add('show');
            e.target.textContent = 'Mostrar';
            passwordInput.type = 'password';
        }
    });

    document.querySelector('.M2').addEventListener('click', e => 
    {
        // alert('Entramos1');
        const passwordInputR = document.querySelector('#pInputRepContraseña');
        // alert('Entramos');
        if (e.target.classList.contains('show')) {
            e.target.classList.remove('show');
            e.target.textContent = 'Ocultar';
            passwordInputR.type = 'text';
        } else {
            e.target.classList.add('show');
            e.target.textContent = 'Mostrar';
            passwordInputR.type = 'password';
        }
    });

