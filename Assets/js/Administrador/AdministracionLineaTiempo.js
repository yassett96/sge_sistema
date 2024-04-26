$(this.document).ready(function() {
    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);
    function CambiarTextoSegunAnchoPantalla(){ 
      const vlocAnchoPantalla = FunObtenerAnchoPantalla(); 
    }
    
    CambiarTextoSegunAnchoPantalla();
      
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
      tag.style.top = '15px';
      tag.style.visibility = 'visible';    
    }
  
    function FunDesactivarAlerta(){
      let tag = document.getElementById("divMenuDespliegue"); 
      tag.style.top = '0px';
      tag.style.visibility = 'hidden';    
    }
  
    //FIN CAMBIO DE MENU MÓVIL
  
    // Variables globales
    var numeroEnlace = 0;
    var textoFase = '';
    var linkFase = '';
    var descripcion = '';
    var numeroEnlaces = 0;
  
    //Variables para guardar en tabla
    var valor_src_imagen = '';
    var valor_descripcion = '';
    var fileName = '';
    var archivo = '';
  
    //Acciones
  
      //Clic al botón 'Editar enlace'
      $("#idBotonEditar").click(function () {
        if (numeroEnlace != '') {
          $("#idInputNombreFase").val(textoFase);
  
          $("#idInputLinkEnlace").val(linkFase);
  
          $("#divFondoPopUpEditar").css({
            "visibility": "visible"
          });
        } else
          funActivarAlerta("info", "No ha seleccionado un enlace!", "Por favor seleccione un enlace para poder editar!");
      });

      //Clic al botón 'Agregar enlace'
      $("#idBotonAgregar").click(function () {
          $("#divFondoPopUpAgregar").css({
            "visibility": "visible"
          });
      });
  
      //Clic al botón 'Cancelar' del PopUp Editar
      $("#buttonCancelarPopUpEditar").click(function () {
        FunDeseleccionarEnlaces();
        $("#divFondoPopUpEditar").css({
          "visibility": "hidden"
        });
      });

      //Clic al botón 'Cancelar' del PopUp Agregar
      $("#buttonCancelarPopUpAgregar").click(function () {
        FunDeseleccionarEnlaces();
        $("#divFondoPopUpAgregar").css({
          "visibility": "hidden"
        });
      });
  
      //Clic al botón 'Guardar cambios'.
      $("#buttonGuardarCambiosPopUpEditar").click(function () {
        var nuevoValorTextoFase =  $("#idInputNombreFase").val();
        var nuevoValorLinkFase =  $("#idInputLinkEnlace").val();
        // alert(numeroEnlace);
        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionLineaTiempo.php?" +
        "vparIdEnlaceLineaTiempo=" + numeroEnlace + "&vparFase=" + nuevoValorTextoFase + "&vparEnlace=" + nuevoValorLinkFase);
        // alert(vlocResultadoAjax);
        if(vlocResultadoAjax == Cnt_Enlace_Linea_Tiempo_Editado){
          funActivarAlerta("success", "Enlace editado!", "Se ha editado el enlace de línea de tiempo con éxito");
  
          $("#divFondoPopUpEditar").css({
            "visibility": "hidden"
          });
          numeroEnlaces = 0;
          ActualizarSeccionEnlaces();
          FunDeseleccionarEnlaces();
        }else{
          funActivarAlerta("error", "Error al editar el enlace!", "Ha ocurrido un problema al intentar editar el enlace.");
        }
  
      });

      //Clic al botón 'Guardar enlace'.
      $("#buttonGuardarCambiosPopUpAgregar").click(function () {
        var nuevoValorIdEnlaceLineaTiempo = numeroEnlaces + 1;
        var nuevoValorTextoFase =  $("#idInputNombreFaseAgregar").val();
        var nuevoValorLinkFase =  $("#idInputLinkEnlaceAgregar").val();
        // alert(nuevoValorIdEnlaceLineaTiempo + " " + nuevoValorTextoFase + " " + nuevoValorLinkFase);
        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionLineaTiempo.php?" +
        "vparIdEnlaceLineaTiempoAgregar=" + nuevoValorIdEnlaceLineaTiempo + "&vparFaseAgregar=" + nuevoValorTextoFase + "&vparEnlaceAgregar=" + nuevoValorLinkFase);
        
        if(vlocResultadoAjax == Cnt_Enlace_Linea_Tiempo_Agregado){
          funActivarAlerta("success", "Enlace agregado!", "Se ha agregado el enlace de línea de tiempo con éxito");
  
          $("#divFondoPopUpAgregar").css({
            "visibility": "hidden"
          });
          numeroEnlaces = 0;
          ActualizarSeccionEnlaces();
          FunDeseleccionarEnlaces();
          $(".inputsEnlace").val("");
        }else{
          funActivarAlerta("error", "Error al agregar el enlace!", "Ha ocurrido un problema al intentar agregar el enlace.");
        }
  
      });

      //Clic al botón 'Eliminar enlace'.
      $("#idBotonEliminar").click(function () {

        Swal.fire({
          title: "Eliminar enlace",
          text: "Se eliminará el enlace de la útlima fase registrada. ¿Seguro quieres eliminar?",
          icon: "info",
          showCancelButton: true,
          confirmButtonColor: Cnt_Color_Boton_Confirmacion,
          cancelButtonColor: Cnt_Color_Boton_Cancelacion,
          confirmButtonText: "Eliminar enlace"
        }).then((result) => {
          if (result.isConfirmed) {
            var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionLineaTiempo.php?vparBoolEliminarEnlaceLineaTiempo=" + Cnt_Eliminar_Enlace_Linea_Tiempo);
            
            if(vlocResultadoAjax == Cnt_Enlace_Linea_Tiempo_Eliminado){
              funActivarAlerta("success", "Último enlace eliminado!", "Se ha eliminado el último enlace de línea de tiempo con éxito");
              numeroEnlaces = 0;
              ActualizarSeccionEnlaces();
              FunDeseleccionarEnlaces();
            }else{
              funActivarAlerta("error", "Error al eliminar el enlace!", "Ha ocurrido un problema al intentar eliminar el último enlace.");
            } 
          }else if (result.dismiss === Swal.DismissReason.cancel){

          }      
        })  
      });
  
      //Cuando se da clic 'Atrás'
      $("#aAtras").click(function () {
        window.history.back();
      });

      //Cuando se da clic en el enlace de la fase 1
      $("#div_Contenedor_Primario").on("click", function () {        
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Primario",1);
        // numeroEnlace = 1;
      });

      //Cuando se da clic en el enlace de la fase 2
      $("#div_Contenedor_Secundario").on("click", function () {   
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Secundario", 2);
      });

      //Cuando se da clic en el enlace de la fase 3
      $("#div_Contenedor_Terciario").on("click", function () {        
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Terciario", 3);
      });

      //Cuando se da clic en el enlace de la fase 4
      $("#div_Contenedor_Cuatro").on("click", function () {        
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Cuatro", 4);
      });

      //Cuando se da clic en el enlace de la fase 5
      $("#div_Contenedor_Cinco").on("click", function () {        
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Cinco", 5);
      });

      //Cuando se da clic en el enlace de la fase 6
      $("#div_Contenedor_Seis").on("click", function () {        
        FunVerificarYSeleccionarEnlace("#div_Contenedor_Seis", 6);
      });

      //Para prevenir que se rediriga al link cuando se da clic en el enlace
      $(".aEnlaces").click(function(event){
        event.preventDefault();
      });
        
    //Funciones
   
      ActualizarSeccionEnlaces();       
  
      function ActualizarSeccionEnlaces(){
        
        var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionLineaTiempo.php?vparBoolObtenerListaEnlacesLineaTiempo=" + Cnt_Obtener_Informacion_Enlaces_Linea_Tiempo);

        var elementos = vlocResultadoAjax.split(';');

        var numeroCamposEnlaces = 6;

        var elementosLength = 0;

        if (elementos[0].split('-_-')[Cnt_Posicion_Fase] == undefined){
          elementosLength = 0;
        }else{
          elementosLength = elementos.length;
        }
        // alert(elementos[0].split('-_-')[Cnt_Posicion_Fase]);
        // alert(elementosLength);
        for (i=0; i<elementosLength; i++){
          var subelementos = elementos[i].split('-_-');
          if (i == 0){
            $(".aEnlaces:eq(0)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Primario");
            $(".aEnlaces:eq(0)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }
  
          if (i == 1){
            $(".aEnlaces:eq(1)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Secundario");
            $(".aEnlaces:eq(1)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }

          if (i == 2){
            $(".aEnlaces:eq(2)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Terciario");
            $(".aEnlaces:eq(2)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }

          if (i == 3){
            $(".aEnlaces:eq(3)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Cuatro");
            $(".aEnlaces:eq(3)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }

          if (i == 4){
            $(".aEnlaces:eq(4)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Cinco");
            $(".aEnlaces:eq(4)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }

          if (i == 5){
            $(".aEnlaces:eq(5)").html(subelementos[Cnt_Posicion_Fase]);
            FunActivarHoverEnlaces("#div_Contenedor_Seis");
            $(".aEnlaces:eq(5)").attr('href', subelementos[Cnt_Posicion_Enlace]);
          }
          numeroEnlaces += 1;
        }

        for(i=numeroEnlaces; i < numeroCamposEnlaces; i++ ){
          $(".div_contenedor_enlace:eq("+i+")").css({
            "background":"gray"
          });

          $(".aEnlaces:eq("+i+")").css({
            "color":"black"
          })

          $(".aEnlaces:eq("+i+")").html("Sin enlace");
        }

        if(numeroEnlaces >= 6){
          $("#idBotonAgregar").prop('disabled', true);
          $("#idBotonAgregar").css('color', 'gray');
        }else{
          $("#idBotonAgregar").prop('disabled', false);
          $("#idBotonAgregar").css('color', '#102461');
        }

        if(numeroEnlaces <= 0){
          $("#idBotonEliminar").prop('disabled', true);
          $("#idBotonEliminar").css('color', 'gray');
        }else{
          $("#idBotonEliminar").prop('disabled', false);
          $("#idBotonEliminar").css('color', '#102461');
        }
      }

      function FunActivarHoverEnlaces(vparIdEnlace){
        $(vparIdEnlace).hover(
          function() {
            $(vparIdEnlace).css('background-color', 'white');
            $(vparIdEnlace + " a").css('color', '#102461');
            $(vparIdEnlace).css("cursor", "pointer");
          }
          ,
          function() {
            $(vparIdEnlace).css('background-color', '#102461');
            $(vparIdEnlace + " a").css('color', 'white');
          }
        );
      }
      
      function FunSeleccionarEnlace(vparIdEnlace){        
        FunDeseleccionarEnlaces();
        $(vparIdEnlace).css('background-color', 'white');
        $(vparIdEnlace + " a").css('color', '#102461');
        $(vparIdEnlace).off('mouseenter mouseleave');
        textoFase = $(vparIdEnlace + " a").text().trim();
        linkFase = $(vparIdEnlace + " a").attr('href');
      }

      function FunVerificarYSeleccionarEnlace(vparIdContenedor, vparNumeroEnlace){
        var vlocTextoFase = $(vparIdContenedor).text().trim();

        if (vlocTextoFase != Cnt_Texto_Sin_Enlace){
          FunSeleccionarEnlace(vparIdContenedor);
          numeroEnlace = vparNumeroEnlace;
        }
      }

      function FunDeseleccionarEnlaces(){

        for(i=0; i < numeroEnlaces; i++){
          $(".div_contenedor_enlace:eq("+i+")").css({
            "background-color":"#102461",
          });
  
          $(".div_contenedor_enlace:eq("+i+") a").css({
            "color":"white",
          });
        }

        numeroEnlace = 0;
        // numeroEnlaces = 0;
        textoFase = '';
        linkFase = '';
      }
 
  });
    
    