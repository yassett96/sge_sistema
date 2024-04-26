function validarcampos(){
    //alert("Todo en orden");

    var formulario = document.form_estu;

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
    }else */if (validarletras(formulario.sname.value) == false){
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
        res = "Campo Deshabilitado";

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

    /* */

    /* SEDE */ 

    if (formulario.sede.value == "Selecciona su sede"){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Sede</div>';
        formulario.sede.focus();
        
        return false;
    
    }else{
        document.getElementById("Alerta").innerHTML = "";
    }

    /* sede  */

    
    if (formulario.carnet.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Carnet</div>';
        formulario.carnet.focus();
        
        return false;
    }
    // else if(validarcarnet(formulario.carnet.value) ==false){
    //     document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Número de carnet Incorrecto o no corresponde a su Sede</div>';
    //     formulario.carnet.value = "";
    //     formulario.carnet.focus();
        
    //     return false;
    // }
    else{
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

    if (formulario.pInputUsuario.value == ""){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Favor ingresar Su Usuario</div>';
        formulario.pInputUsuario.focus();
        
        return false;
    }else if(validaruser(formulario.pInputUsuario.value) ==false){
        document.getElementById("Alerta").innerHTML = '<div class="alert alert-danger"><a href="" class="close" data-dismiss="alert">&times;</a>Formato de usuario no valido</div>';
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

// $( document ).ready(function() {
    function validarletras(parametro){
        var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]*$/;
        if(parametro.search(patron)){
            return false;
        }else{
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
    
    function validarNumeros(parametro){
        if(!/^([0-9])*$/.test(parametro)){
            return false;
        } else{
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
    
    function validarcarnet(parametro){
    
        /*console.log(parametro);*/
        sede = $("#sede").val();
    
        console.log(sede);
    
        if(sede == 1){
            //var patron = /^[0-9]{4}-\d{4}([A-Z]){1}$/; //carnet que pueede iniciar en cualquier numero
            var patron = /^[1|2][0|9][0-9][0-9]-\d{4}([U]){1}$/;
            //var patron = /^[2][0][0-9]{2}-\d{4}([A-Z]){1}$/;  //carnet que solo puede iniciar en "2" seguido de "0" ([20(0-9)(0-9)]-[(0-9)(0-9)(0-9)(0-9)(A-Z)])
            if(!patron.test(parametro)){
                return false;
            } else {
                return true;
            }
        }else if (sede == 2){
            var patron = /^[1|2][0|9][0-9][0-9]-\d{4}([N]){1}$/; 
         
            if(!patron.test(parametro)){
                return false;
            } else {
                return true;
            }
        }else if (sede == 3){
            var patron = /^[1|2][0|9][0-9][0-9]-\d{4}([I]){1}$/; 
         
            if(!patron.test(parametro)){
                return false;
            } else {
                return true;
            }
        }else if (sede == 4){
            var patron = /^[[1|2][0|9][0-9][0-9]-\d{4}([J]){1}$/; 
         
            if(!patron.test(parametro)){
                return false;
            } else {
                return true;
            }
        }else if (sede == 5){
            var patron = /^[1|2][0|9][0-9][0-9]-\d{4}([S]){1}$/; 
         
            if(!patron.test(parametro)){
                return false;
            } else {
                return true;
            }
        }
    
        
    }
    
    function validaruser(parametro){
        var patron = /^[A-Za-zñÑ-áéíóúÁÉÍÓÚ\d]{5,10}$/;
    
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
    
    
        $("#sede").change(function () {
            sede = $("#sede").val();
    
           $.ajax({
               url: "../../Controlador/Participante/CBuscargrupo.php",
               type: "POST",
               data: {sede},
               cache: false,
               success: function (result){
                   $("#grupo").html(result);
               }
           });
    
        });
    
        $('#pCedula').mask("000-000000-0000S");
        $('#tel').mask("0000-0000");
        $('#carnet').mask("0000-0000S");
        $('#inputCarnetParticipante').mask("0000-0000S");
        
        
    
        /*$('#tel').keyup(function() {
            var foo = $(this).val().split("-").join(""); // remove hyphens
            if (foo.length > 0) {
              foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
            }
            $(this).val(foo);
    
            console.log(foo);
        });*/
    
    });    
    
    window.onload = function() {
    // var myInput = document.getElementById('pInputContraseña');
    var myInput = $("#pInputContraseña");
    myInput.onpaste = function(e) {
        e.preventDefault();
        alert("Lamentablemente no puede realizar la accion de pegar");
    }
    
    myInput.oncopy = function(e) {
        e.preventDefault();
        alert("esta acción está prohibida");
        }

    var myInput = document.getElementById('pInputRepContraseña');
    myInput.onpaste = function(f) {
        f.preventDefault();
        alert("Lamentablemente no puede realizar la accion de pegar");
    }
    
    myInput.oncopy = function(f) {
        f.preventDefault();
        alert("Lamentablemente no puede realizar la accion de copiar");
    }
    }

    document.querySelector('.M1').addEventListener('click', e => {
        const passwordInput = document.querySelector('#pInputContraseña');
        //const passwordInput = $('#pInputContraseña');
        
        passwordInput.type = 'text';
        //  alert(e.target.classList.contains('show'));
        if (e.target.classList.contains('show')) {
            // alert("Entramos");
            e.target.classList.remove('show');
            e.target.textContent = 'Ocultar';
            passwordInput.type = 'password';
        } else {
            e.target.classList.add('show');
            e.target.textContent = 'Mostrar';
            passwordInput.type = 'text';
        }
    });

    document.querySelector('.M2').addEventListener('click', e => 
    {
        const passwordInputR = document.querySelector('#pInputRepContraseña');
        
        if (e.target.classList.contains('show')) {
            e.target.classList.remove('show');
            e.target.textContent = 'Ocultar';
            passwordInputR.type = 'password';
        } else {
            e.target.classList.add('show');
            e.target.textContent = 'Mostrar';
            passwordInputR.type = 'text';
        }
    });
// });
