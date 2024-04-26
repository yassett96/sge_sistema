$( document ).ready(function() {

    $('#BtnAgregarP').click(function () {
        event.preventDefault();  
        
        
        var resultValidacion = validarcampos();
        console.log(resultValidacion);

        if (resultValidacion) {
            
            const fdatos = $("form#form_estu").serialize();
            $.ajax({
                url:"../../Controlador/Participante/CBuscarRegistros.php",
                type:'POST',
                data: fdatos,
                success:function(result){

                    if(result.length == 0){
                        $.ajax({
                            url: "../../Controlador/Participante/CAgregaPersona.php",
                            type: 'POST',
                            data: fdatos,
                            cache: false,
                            success: function(result){
                                //alert (result);
                                if(result.length !==0 ){
                        

                                    swal("Registro almacenado correctamente, Inicie sesion con sus credenciales")
                                    .then(() => { 
                                        window.location.href = "../../Vista/Participante/QueEs_InfoSisP.php";
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

/*
    $(document.body).on('click','#BtnAgregarP',function (){
        const fdatos = $("form#form_estu").serialize();
        $.ajax({
            url:"Controlador/CPersona/CBuscarRegistros.php",
            type:'POST',
            data: fdatos,
            success:function(result){
                if(result.length == 0){
                    $.ajax({
                        url: "Controlador/CPersona/CAgregarPersona.php",
                        type: 'POST',
                        data: fdatos,
                        cache: false,
                        success: function(result){
                            if(result.length == 0){
                            alert('Logrado');
                            }
                            else{
                                alert('No logrado');
                            }
                        }
                    });
                }else{
                    alert('Error'.result)
                }
            }
        });
    });
*/