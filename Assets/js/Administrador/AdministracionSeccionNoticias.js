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
  var numeroNoticia = '';
  var src_imagen = '';
  var descripcion = '';

  //Variables para guardar en tabla
  var valor_src_imagen = '';
  var valor_descripcion = '';
  var fileName = '';
  var archivo = '';

  //Acciones
    // Clic a la noticia 1
    $("#div_Contenedor_Noticia_Principal").click(function () {
      FunDeseleccionarNoticias();
      FunSeleccionarNoticia("div_Contenedor_Noticia_Principal");
      numeroNoticia = Cnt_Imagen_Seccion_Noticia_1;
      src_imagen = $("#div_Contenedor_Noticia_Principal img").attr('src');
      descripcion = $("#div_Contenedor_Noticia_Principal div h3").text();
    });

    // Clic a la noticia 2
    $("#div_Noticia_Secundario").click(function () {
      FunDeseleccionarNoticias();
      FunSeleccionarNoticia("div_Noticia_Secundario");
      numeroNoticia = Cnt_Imagen_Seccion_Noticia_2;
      src_imagen = $("#div_Noticia_Secundario img").attr('src');
      descripcion = $("#div_Noticia_Secundario div h3").text();
    });

    // Clic a la noticia 3
    $("#div_Noticia_Terciario").click(function () {
      FunDeseleccionarNoticias();
      FunSeleccionarNoticia("div_Noticia_Terciario");
      numeroNoticia = Cnt_Imagen_Seccion_Noticia_3;
      src_imagen = $("#div_Noticia_Terciario img").attr('src');
      descripcion = $("#div_Noticia_Terciario div h3").text();
    });

    //Clic al botón 'Editar noticia'
    $("#idBotonEditar").click(function () {
      if (numeroNoticia != '') {
        $("#idImgPopUpEditar").attr('src', src_imagen);

        $(".camposPopUpEditar:eq(1)").val(descripcion);

        $("#divFondoPopUpEditar").css({
          "visibility": "visible"
        });
      } else
        funActivarAlerta("info", "No ha seleccionado una noticia!", "Por favor seleccione una noticia para poder editar!");
    });

    //Clic al botón 'Cancelar' del PopUp Editar
    $("#buttonCancelarPopUpEditar").click(function () {
      $("#divFondoPopUpEditar").css({
        "visibility": "hidden"
      });
    });

    //Clic al botón 'Guardar cambios'.
    $("#buttonGuardarCambiosPopUpEditar").click(function () {

      valor_descripcion = $("#textAreaDescripcionPopUpEditar").val();

      uploadImage();

      valor_src_imagen = '../../Assets/imagenes/Noticias/' + fileName;

      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionSeccionNoticias.php?" +
      "vparIdNoticias=" + numeroNoticia + "&vparDescripcion=" + valor_descripcion + "&vparImagen=" + valor_src_imagen);
      // alert(vlocResultadoAjax);
      if(vlocResultadoAjax == 1){
        funActivarAlerta("success", "Noticia Editada!", "Se ha editado la noticia con éxito");

        $("#divFondoPopUpEditar").css({
          "visibility": "hidden"
        });

        ActualizarSeccionNoticias();
        FunDeseleccionarNoticias();
      }else{
        funActivarAlerta("error", "Error al editar la noticia!", "Ha ocurrido un problema al intentar editar la noticia.");
      }

    });

    //Cuando cambia la imagen seleccionado
    $("#imagenSeleccionar").change(function () {
      const inputImagen = $("#imagenSeleccionar");
      const vistaPrevia = $("#idImgPopUpEditar");
      // Obtener el archivo seleccionado
      archivo = inputImagen[0].files[0];
      
      // Verificar que se haya seleccionado un archivo
      if (archivo) {
        // Crear un objeto FileReader para leer el archivo
        const lector = new FileReader();

        // Definir lo que sucede cuando el FileReader termina de leer el archivo
        lector.onload = function() {
          // Mostrar la vista previa de la imagen
          vistaPrevia.attr('src', lector.result);
        };
        fileName = archivo.name;
        // Leer el archivo como una URL
        lector.readAsDataURL(archivo);
      }
    });

    //Cuando se da clic 'Atrás'
    $("#aAtras").click(function () {
      window.history.back();
    });
      
  //Funciones
    function FunDeseleccionarNoticias(){
      $("#div_Contenedor_Noticia_Principal").css({
        "background-color" : "#ccc"
      });
      $("#div_Noticia_Secundario").css({
        "background-color" : "#ccc"
      });
      $("#div_Noticia_Terciario").css({
        "background-color" : "#ccc"
      });
      numeroNoticia = '';
      src_imagen = '';
      descripcion = '';
    }

    function FunSeleccionarNoticia(vparNoticiaSeleccionada){
      $("#" + vparNoticiaSeleccionada).css({
        "background-color" : "#46547e"
      });
    }

    function uploadImage() {
      // Enviar la imagen al servidor
      const formData = new FormData();
      formData.append('imagen', archivo);
      $.ajax({
        url: '../../Modelo/Administrador/cargarImagen.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
          console.log('Imagen subida exitosamente.');
          // alert(data);
        },
        error: function(xhr, textStatus, errorThrown){
          console.log('Error al subir la imagen.');
          console.log(xhr.responseText);
        }
      });
    }

    function ActualizarSeccionNoticias(){
      
      var vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Administrador/CAdministracionSeccionNoticias.php?vparBoolObtenerListaNoticias=" + Cnt_Obtener_Informacion_Noticias);
      
      var elementos = vlocResultadoAjax.split(';');
      
      for (i=0; i<elementos.length; i++){
        var subelementos = elementos[i].split('-_-');

        if (i == 0){
          $(".h3_Titulo_Noticia:eq(0)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Contenedor_Noticia_Principal img").attr('src', subelementos[Cnt_Posicion_Url_Imagen]);
        }

        if (i == 1){
          $(".h3_Titulo_Noticia:eq(1)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Secundario img").attr('src', subelementos[Cnt_Posicion_Url_Imagen]);
        }

        if (i == 2){
          $(".h3_Titulo_Noticia:eq(2)").html(subelementos[Cnt_Posicion_Descripcion]);
          $("#div_Noticia_Terciario img").attr('src', subelementos[Cnt_Posicion_Url_Imagen]);
        }

      }
    }
  
    ActualizarSeccionNoticias();

});
  
  