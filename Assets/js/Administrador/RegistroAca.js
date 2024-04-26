$( document ).ready(function() {

    $('#BtnAgregarP').click(function () {
        event.preventDefault();    
        var resultValidacion = validarcampos();
        console.log(resultValidacion);

        if (resultValidacion) {
            
            const fdatos = $("form#form_general").serialize();
            $.ajax({
                url:"../../Controlador/Administrador/CBuscarRegistroAca.php",
                type:'POST',
                data: fdatos,
                success:function(result){

                    if(result.length == 0){
                        $.ajax({
                            url: "../../Controlador/Administrador/CAgregarPersonaAca.php",
                            type: 'POST',
                            data: fdatos,
                            cache: false,
                            success: function(result){
                                alert("Prueba Samir: " + result);
                                if(result.length !== 0){
                        
                                swal("Registro almacenado correctamente")
                                .then(() => { 
                                    // window.location.href = "../../Vista/Administrador/Index-Admin.php";
                                    window.location.href = "../../Vista/Administrador/InicioAdministradorCE.php";
                                //swal(`The returned value is: ${value}`);
                                });
                                }
                                else{
                                    alert('No logrado');
                                }
                            }
                        });
                    }else{
                        swal({
                            title: "Atención!",
                            text: result,
                            icon: "warning",
                        });
                    }
                }
            });
        }else{
            return false;
        }

        event.preventDefault();
    });

}); //.DocumentReady