//Para gestionar la información de los proyectos e integrantes
var IdProyecto = "";
var NumeroCarnetParticipante = "";
var vlocNombre = "";
var vlocDescripcion = "";
var vlocNombreCategoria = "";
var vlocNombreSubCategoria = "";
var vlocPrimerNombreTutor = "";
var vlocPrimerApellidoTutor = "";
var vlocNombreIntegrante1 = "";
var vlocNombreIntegrante2 = "";
var vlocNombreIntegrante3 = "";
var vlocNoCarnet1 = "";
var vlocNoCarnet2 = "";
var vlocNoCarnet3 = "";
// Para asegurarse de que cargue toda la página antes de activar las funciones
$(document).ready(function() { 

  FunObtenerProyectosInscritosSegunCodigoRegistroParticipante();

  //INICIO CAMBIO DE MENU MÓVIL
    //  seleccionamos los dos elementos que serán clickables

    const toggleButton = document.getElementById("button-menu");
    const navWrapper = document.getElementById("nav");
    const menuDes = document.getElementById("imgLogUsuario");
    const DivMenuDespliegue = document.getElementById("divMenuDespliegue");

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

    menuDes.addEventListener("mouseover", e => {
      FunActivarAlerta();
    });

    menuDes.addEventListener("mouseout", e => {
      FunDesactivarAlerta();
    });

    DivMenuDespliegue.addEventListener("mouseover", e => {
      FunActivarAlerta();  
    });

    DivMenuDespliegue.addEventListener("mouseout", e => {
      FunDesactivarAlerta();
    });

    function FunActivarAlerta(){
      let tag = document.getElementById("divMenuDespliegue"); 
      tag.style.top = '-20px';
      tag.style.visibility = 'visible';    
    }

    function FunDesactivarAlerta(){
      let tag = document.getElementById("divMenuDespliegue"); 
      tag.style.top = '-40px';
      tag.style.visibility = 'hidden';    
    }
  //FIN CAMBIO DE MENU MÓVIL

  //INICIO FUNCIONALIDAD
    
    //Funciones para el evento clic de las pestañas
    $(".divPestaña").eq(0).click(function() {      
      FunPestañaDatosProyectoBlanco();
      FunPestañaIntegrantesAzul();
      FunActivarFormularioDatosProyectos();
      FunDesactivarFormularioIntegrante();
    });

    $(".divPestaña").eq(1).click(function() {      
      FunPestañaDatosProyectoAzul();
      FunPestañaIntegrantesBlanco();
      FunDesactivarFormularioDatosProyecto();
      FunActivarFormularioIntegrante();
    });

    //Para hacer la carga general
    $("#selectProyecto").change(function() {
      IdProyecto = $("#selectProyecto").val();
      NumeroCarnetParticipante = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerCarnetParticipante=" + Cnt_Obtener_Carnet);
      FunLimpiarCamposFormularios();
      obtenerEImprimirDatosSegunProyecto();
      FunActivarODesactivarBotonCofirmacionParticipacion();
    });

    function FunActivarODesactivarBotonCofirmacionParticipacion(){
      let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparIdParticipanteConfirmacionParticipante=" + NumeroCarnetParticipante + "&vparIdProyectoConfirmacionParticipante=" + IdProyecto);
      var confirmarParticipacion = JSON.parse(vlocResultadoAjax);
      var valor = confirmarParticipacion[0];
      if (valor == 1){
        $("#confirmarParticipacion").prop("disabled", true);
      }else{
        $("#confirmarParticipacion").prop("disabled", false);
      }
    }

    function FunPestañaDatosProyectoBlanco(){
      $(".divPestaña").eq(0).css({
        "background-color":"white"    
      });

      $("#h1PestañaDatosProyecto").css({
        "color":"#181D43"
      });
    }

    //Click al botón 'Darme baja'
    $("#bajaProyecto").click(function(){
      if(IdProyecto != ""){
        var vlocNumeroCarnetParticipante = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerCarnetParticipante=" + Cnt_Obtener_Carnet);

        Swal.fire({
          title: "¡Baja de proyecto!",
          text: "¿Estás seguro que quieres darte de baja de este proyecto?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: Cnt_Color_Boton_Confirmacion,
          cancelButtonColor: Cnt_Color_Boton_Cancelacion,
          confirmButtonText: "Darme de baja",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {
            
            var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparIdParticipante=" + vlocNumeroCarnetParticipante + "&vparIdProyecto=" + IdProyecto);
            if(vlocResultadoAjax == 1){
              Swal.fire({
                title: "¡Baja de integrante!",
                text: "Has sido dado de baja del proyecto exitosamente!",
                icon: "success",
                confirmButtonColor: Cnt_Color_Boton_Confirmacion,
                confirmButtonText: "OK"
              }).then((result) => {
                var vlocResultadoAjaxAbandono = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparIdProyectoAbandono=" + IdProyecto);
                
                if (vlocResultadoAjaxAbandono == Cnt_Proyecto_Abandonado){
                  funActivarAlerta("info", "Eliminación de proyecto!", "Todos los integrantes han abandonado el proyecto, por ende se eliminó el proyecto");

                  //Espera de 4 segundos para recargar la página
                  setTimeout(function(){location.reload();}, 4000);
                }
                setTimeout(function(){
                  location.href = '../../Vista/Participante/inicioParticipanteConEvento.php';
                }, 1500);
              });
            }else{
              funActivarAlerta("error", "¡Eliminación de integrante!", "Ha ocurrido un problema al intentar eliminar el integrante del proyecto.");
            }
            
          }else
              return false;        
        })
      }else{
        funActivarAlerta("warning", "No ha seleccionado un proyecto!", "Seleccione un proyecto para poder abandonar");
      }   
    });

    $(document).on("click", "#enviaconsulta", function(e){
      if(IdProyecto != ""){
          $.ajax({
              url: "../../Vista/Participante/RealizaConsulta.php",
              type: "POST",
              cache: false,
              success:function (result){
                  $("#contenedor").html(result);
                  $("#Popup2").modal('show');
              }
          });
      }else{
          funActivarAlerta("warning", "No ha seleccionado un proyecto!", "Seleccione un proyecto antes de realizar una consulta");
      }
    
    });

    $(document).on("click", "#confirmarParticipacion", function(e){
      if(IdProyecto != ""){
          $.ajax({
              url: "../../Vista/Participante/ConfirmarParticipacion.php",
              type: "POST",
              cache: false,
              success:function (result){
                  $("#contenedor").html(result);
                  $("#Popup2").modal('show');
                  FunCargarImagenVacia();
              }
          });
      }else{
          funActivarAlerta("warning", "No ha seleccionado un proyecto!", "Seleccione un proyecto antes de confirmar participación");
      }
    
    });  

    $("#aAtras").click( function() {
      history.back();
    })    

    //Funciones para obtener los proyectos inscritos
    function FunCargarImagenVacia(){
      $("#idImgPopUpConfirmar").attr("src", "../../Assets/Imagenes/LogosEventos/no-image.jpg");
    }

    function FunObtenerProyectosInscritosSegunCodigoRegistroParticipante(){
      $vlocResultadoAjax = FunEjecutarAjax('../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerProyectos=' + Cnt_Obtener_Proyectos );

      $vlocResultadoAjax = $vlocResultadoAjax.slice(0, -1);      

      console.log("Proyectos: " + $vlocResultadoAjax);
      // Utiliza decodeURIComponent() para convertir las secuencias de escape Unicode en caracteres reales
      var texto_corregido = $vlocResultadoAjax.replace(/\\u([\d\w]{4})/gi, function (match, grp) {
        return String.fromCharCode(parseInt(grp, 16));
      });
      
      $("#selectProyecto").html(texto_corregido);
    }

    function obtenerEImprimirDatosSegunProyecto(){
      // IdProyecto = $("#selectProyecto").val();
      FunObtenerEImprimirDatosProyectoSegunIdProyecto(IdProyecto);
      FunObtenerEImprimirDatosParticipantesSegunIdProyecto(IdProyecto);          
    }

    //Funciones para activar y desactivar los formularios
    function FunPestañaDatosProyectoAzul(){
      $(".divPestaña").eq(0).css({
        "background-color":"#181D43"    
      });

      $("#h1PestañaDatosProyecto").css({
        "color":"white"
      });
    }

    function FunPestañaIntegrantesBlanco(){
      $(".divPestaña").eq(1).css({
        "background-color":"white"
      });

      $("#h1PestañaIntegrantes").css({
        "color":"#181D43"
      });
    }

    function FunPestañaIntegrantesAzul(){
      $(".divPestaña").eq(1).css({
        "background-color":"#181D43"
      });

      $("#h1PestañaIntegrantes").css({
        "color":"white"
      });
    }

    function FunActivarFormularioDatosProyectos(){
      $("#FormularioDatosProyectos").css({
        "visibility":"visible"
      });
    }

    function FunDesactivarFormularioDatosProyecto(){
      $("#FormularioDatosProyectos").css({
        "visibility":"hidden"
      });
    }

    function FunActivarFormularioIntegrante(){
      $("#FormularioIntegrantes").css({
        "visibility":"visible"
      });
    }

    function FunDesactivarFormularioIntegrante(){
      $("#FormularioIntegrantes").css({
        "visibility":"hidden"
      });
    }

    //Funciones para obtener los datos del proyecto y de los integrantes
    function FunObtenerEImprimirDatosProyectoSegunIdProyecto(vparIdProyecto){
      //Para obtener los datos del proyecto
      $vlocResultadoAjax = FunEjecutarAjax('../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerDatosProyectos=' + Cnt_Obtener_Datos_Proyectos + "&vparIdProyecto=" + vparIdProyecto);
      
      $vlocResultadoAjax = $vlocResultadoAjax.split(",");
      console.log("Datos Proyectos: " + $vlocResultadoAjax);

      vlocNombre = $vlocResultadoAjax[Cnt_Nombre];
      vlocDescripcion = $vlocResultadoAjax[cnt_Descripcion];
      vlocNombreCategoria = $vlocResultadoAjax[Cnt_Nombre_Categoria];
      vlocNombreSubCategoria = $vlocResultadoAjax[Cnt_Nombre_SubCategoria];
      vlocPrimerNombreTutor = $vlocResultadoAjax[Cnt_Primer_Nombre_Tutor];
      vlocPrimerApellidoTutor = $vlocResultadoAjax[Cnt_Primer_Apellido_Tutor];

      $("#inputNombreProyecto").val(vlocNombre);
      $("#inputDescripcionProyecto").val(vlocDescripcion);
      $("#inputCategoria").val(vlocNombreCategoria);
      $("#inputSubCategoria").val(vlocNombreSubCategoria);
      $("#inputTutor").val(vlocPrimerNombreTutor + " " + vlocPrimerApellidoTutor);
    }

    function FunObtenerEImprimirDatosParticipantesSegunIdProyecto(vparIdProyecto){
      $vlocResultadoAjax = FunEjecutarAjax('../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolObtenerDatosIntegrantes=' + Cnt_Obtener_Datos_Integrantes + "&vparIdProyecto=" + vparIdProyecto);
      console.log("Datos Integrantes: " + $vlocResultadoAjax);      

      $vlocIntegrantes = JSON.parse($vlocResultadoAjax);
      
      var $vlocTRow = "";

      for(var i=0; i<$vlocIntegrantes.length; i++){
        var vlocIntegrante = $vlocIntegrantes[i];        
        
        vlocIntegrante = vlocIntegrante.split(",");        

        console.log("Integrante "+i+": " + vlocIntegrante); 

        if(i == Cnt_Integrante_1){                    
          vlocNombreIntegrante1 = vlocIntegrante[Cnt_Primer_Nombre] + " " + vlocIntegrante[Cnt_Primer_Apellido];
          vlocNoCarnet1 = vlocIntegrante[Cnt_ID_Numero_Carnet];
        }

        if(i == Cnt_Integrante_2){          
          vlocNombreIntegrante2 = vlocIntegrante[Cnt_Primer_Nombre] + " " + vlocIntegrante[Cnt_Primer_Apellido];
          vlocNoCarnet2 = vlocIntegrante[Cnt_ID_Numero_Carnet];
        }

        if(i == Cnt_Integrante_3){          
          vlocNombreIntegrante3 = vlocIntegrante[Cnt_Primer_Nombre] + " " + vlocIntegrante[Cnt_Primer_Apellido];
          vlocNoCarnet3 = vlocIntegrante[Cnt_ID_Numero_Carnet];
        }

        if(vlocIntegrante[Cnt_Cedula] == '' || vlocIntegrante[Cnt_Cedula] == null){
          vlocIntegrante[Cnt_Cedula] = 'No tiene cédula';
        }
        
        $vlocTRow += "<tr><td>" + vlocIntegrante[Cnt_Primer_Nombre] + " " + vlocIntegrante[Cnt_Segundo_Nombre] + "</td><td>" + vlocIntegrante[Cnt_Primer_Apellido] + " " 
        + vlocIntegrante[Cnt_Segundo_Apellido] + "</td><td>" + vlocIntegrante[Cnt_Cedula] + "</td><td>" + vlocIntegrante[Cnt_ID_Numero_Carnet] + "</td><td>" 
        + vlocIntegrante[Cnt_Id_Grupo_Participante] + "</td><td>" + vlocIntegrante[Cnt_Año_Academico] + "</td><td>" + vlocIntegrante[Cnt_Sede] + "</td></tr>";
      } 
      
      $("tbody").html($vlocTRow);      
    }

    function FunRellenarCamposIntegrante(vparIntCampoNombres, vparInteCampoCarnet, vparIntegrante){      
      $(".inputIntegrantes").eq(vparIntCampoNombres).val(vparIntegrante[Cnt_Primer_Nombre] + " " + vparIntegrante[Cnt_Primer_Apellido]);
      $(".inputIntegrantes").eq(vparInteCampoCarnet).val(vparIntegrante[Cnt_ID_Numero_Carnet]);                 
    }

    function FunLimpiarCamposFormularios(){
      $(".inputDatosProyecto").val("");
      $(".inputIntegrantes").val("");
    }

    CambiarTextoSegunAnchoPantalla();

    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

    function CambiarTextoSegunAnchoPantalla(){ 
      const vlocAnchoPantalla = FunObtenerAnchoPantalla();   
      // console.log("Ancho de la pantalla: " + vlocAnchoPantalla);
      if (vlocAnchoPantalla < 931){        
        $("#firstOptionProyectos").html("Seleccione");        
      }else{
        $("#firstOptionProyectos").html("Seleccione proyecto");                
      }
      
      if(vlocAnchoPantalla < 790){
        $("#inputSubCategoria").attr('placeholder', 'Subcategoría');
        $("#inputCategoria").attr('placeholder', 'Categoría');
      }else{
        $("#inputSubCategoria").attr('placeholder', 'Subcategoría del proyecto');
        $("#inputCategoria").attr('placeholder', 'Categoría del proyecto');
      }

      if(vlocAnchoPantalla < 500){        
        $(".inputIntegrantes").eq(0).val("Nombres");
        $(".inputIntegrantes").eq(1).val("Carnet");
        $(".inputIntegrantes").eq(2).val("Nombres");
        $(".inputIntegrantes").eq(3).val("Carnet");
        $(".inputIntegrantes").eq(4).val("Nombres");
        $(".inputIntegrantes").eq(5).val("Carnet");        
        
      }else{
        $(".inputIntegrantes").eq(0).val("Nombre integrante");
        $(".inputIntegrantes").eq(1).val("Carnet integrante");
        $(".inputIntegrantes").eq(2).val("Nombre integrante");
        $(".inputIntegrantes").eq(3).val("Carnet integrante");
        $(".inputIntegrantes").eq(4).val("Nombre integrante");
        $(".inputIntegrantes").eq(5).val("Carnet integrante");
      }

      if(vlocAnchoPantalla < 295){
        $("#inputNombreProyecto").attr("placeholder", "Proyecto");
      }else{
        $("#inputNombreProyecto").attr("placeholder", "Nombre del proyecto");
      }
    }    
  //FIN FUNCIONALIDAD
});