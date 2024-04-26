$(document).ready(function() {

    
    $(document).on("click", "#editaravatar", function(e){
        $.ajax({
            url: "../../Vista/Participante/EditarIco.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Popup1").modal('show');
            }
        });
    
    });

    $('#editardatos').click(function(){

        $.ajax({
            url: "../../Vista/Participante/EditarCuenta.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Popup2").modal('show');
                $("#idInputCodReg").css({
                    "width": "20%",
                    "left" : "40%"
                });
            }
        });
    });

    $('#historial').click(function(){

        $.ajax({
            url: "../../Vista/Participante/Historial.php",
            type: "POST",
            cache: false,
            success:function (result){
                $("#contenedor").html(result);
                $("#Popup4").modal('show');
                
            }
        });
    });

    $(document).on('click', '#btnatras', function(e){
        $("#Popup4").modal('hide');
        location.reload();
    
    });
    
    $(document).on('click', '#btnguardar', function(e){
        
        event.preventDefault();
        
        var img = imgAvatarSeleccionado.getAttribute("src"); 
        console.log( img);
        
        $.ajax({
            url: "../../Controlador/Participante/ActualizarIcono.php",
            type: "POST",
            data: {img:img},
            cache: false,
            success:function (result){
                console.log(result);
                if(result.length == 0){
                    //alert('Cambio realizado con exito');
                    funActivarAlerta("success", "Cambio realizado éxito", "Cambio realizado éxito");
                    // Swal({
                    //     title: "Cambio realizado éxito",
                    //     icon: "success",
                    //     closeOnClickOutside: false,
                    //   });
                    $("#Popup1").modal('hide');
        location.reload();
                    }
                    else{
                        Swal({
                            title: "Cambio No logrado",
                            icon: "error",
                            closeOnClickOutside: false,
                          });
                    }
            }
        });

        
    
    });

    $(document).on('click', '#btncancelar', function(e){
        $("#Popup1").modal('hide');
        location.reload();
    
    });  

    $(document).on('click', '#EnviarConsulta', function(e){

        
    
        var Cde = document.getElementById("email2").value;
        var Asunto =  document.getElementById("title").value;
        var CuerpoM = document.getElementById("message").value;
        var NameProyecto = vlocNombre;

        if (Asunto.length == 0 || /^\s+$/.test(Asunto)) {
            alert("¿Cuál es el asunto?");
            return false;
        }

        if (CuerpoM.length == 0 || /^\s+$/.test(CuerpoM)) {
            alert("¿Cuál es la consulta?");
            return false;
        }
        
            
        console.log(Cde);
        console.log(Asunto);
        console.log(CuerpoM);
        console.log(NameProyecto);
        
        $.ajax({
            url: "../../Controlador/Participante/CConsulta.php",
            type: "POST",
            data: {Envia:Cde,Asunto:Asunto,Contenido:CuerpoM,NombreProyecto:NameProyecto},
            cache: false,
            success:function (result){
                console.log(result);
                if(result.length != 0){
                    alert('logrado');
                    
                    $("#Popup2").modal('hide');
                    location.reload();
                    }
                    else{
                        alert('No logrado');
                    }
            }
        });
    
    });    

    $(document).on('click', '#ConfirmarParticipacion2', function(e){
        e.preventDefault();
        // alert("Ingresamos carnal, vamos bien!");

        if ($('#fileUpload')[0].files[0] && $('#imagenSeleccionar')[0].files[0] 
            && document.getElementById("message").value != ""){

            var formData = new FormData(); // Crear un objeto FormData

            formData.append('Mensaje', document.getElementById("message").value);
            formData.append('NombreProyecto', vlocNombre);
            formData.append('NombreParticipante1', vlocNombreIntegrante1);
            formData.append('NombreParticipante2', vlocNombreIntegrante2);
            formData.append('NombreParticipante3', vlocNombreIntegrante3);
            formData.append('noCarnet1', vlocNoCarnet1);
            formData.append('noCarnet2', vlocNoCarnet2);
            formData.append('noCarnet3', vlocNoCarnet3);
            formData.append('Cedula', $('#imagenSeleccionar')[0].files[0]);
            formData.append('Protocolo', $('#fileUpload')[0].files[0]); // Agregar el archivo al objeto FormData
        
            console.log("=== Datos a enviar por correo ===");
            console.log("Mensaje: " + document.getElementById("message").value);
            console.log("Protocolo: " + $('#fileUpload')[0].files[0]);
            console.log("NombreProyecto: " + vlocNombre);
            console.log("NombreParticipante1: " + vlocNombreIntegrante1);
            console.log("NombreParticipante2: " + vlocNombreIntegrante2);
            console.log("NombreParticipante3: " + vlocNombreIntegrante3);
            console.log("noCarnet1: " + vlocNoCarnet1);
            console.log("noCarnet2: " + vlocNoCarnet2);
            console.log("noCarnet3: " + vlocNoCarnet3);
            console.log("====================================");
            
            $.ajax({
                url: "../../Controlador/Participante/CConfirmacionParticipacion.php",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function (result){
                    console.log(result);
                    if(result.length != 0){
                        
                        $("#Popup2").modal('hide');

                        // var vlocCarnetParticipante = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerCarnetParticipante=" + Cnt_Obtener_Carnet);
                        var vlocCarnetParticipante1 = vlocNoCarnet1;
                        var vlocCarnetParticipante2 = vlocNoCarnet2;
                        var vlocCarnetParticipante3 = vlocNoCarnet3;
                        
                        var vlocConfirmacion = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparIdProyectoConfirmacion=" + IdProyecto + 
                        "&vparIdParticipante1Confirmacion=" + vlocCarnetParticipante1 + 
                        "&vparIdParticipante2Confirmacion=" + vlocCarnetParticipante2 +
                        "&vparIdParticipante3Confirmacion=" + vlocCarnetParticipante3);
                        
                        if (vlocConfirmacion == Cnt_Participacion_Confirmada){                            
                            // funActivarAlerta("success", "Participante confirmado!", "La confirmación del participante, ha sido registrado exitosamente");
                            FunActivarAlertaBotonConfirmacion("Paticipantes confirmados!", "Todos los participantes del proyecto han sido confirmados", "success", false, "OK!", "location.reload();");

                            // alert(vlocBoolConfirmacion);

                            // if (vlocBoolConfirmacion){
                            //     location.reload();
                            // }
                        }else{
                            funActivarAlerta("error", "Error de confirmación!", "Ha ocurrido un error al intentar confirmar el participante");
                        }
                        
                        // Espera de 4 segundos antes que se reinicie la pantalla
                        // setTimeout(location.reload(), 4000);
                    }
                    else{
                        alert('No logrado');
                    }
                },
                error: function(xhr, status, error) {
                console.log(error);
                alert("Error Ajax: " + error);
                }
            });
        }else{
            funActivarAlerta("warning", "Falta de información del proyecto!", "Brinde un mensaje, imagen de la cédula y el documento de su proyecto para confirmar su participación");
        }
    
    });
   
});