function CambiarTextoSegunAnchoPantalla(){ 
  const vlocAnchoPantalla = FunObtenerAnchoPantalla(); 
}

CambiarTextoSegunAnchoPantalla();

window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);
$(this.document).ready(function() {
    
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

  FunVerificarExitenciaProyectosInscritos();

  function FunVerificarExitenciaProyectosInscritos(){
    const vlocVerificacionProyectoInscrito = FunEjecutarAjax("../../Controlador/Participante/CDetallesProyectosInscritos.php?vparBoolVerificarProyectosInscritos=" + Cnt_Verificar_Existencia_Proyecto);
    // alert("vlocVerificacionProyectoInscrito: " + vlocVerificacionProyectoInscrito);
    if (vlocVerificacionProyectoInscrito > Cnt_No_Existe_Proyecto_Inscrito)
      $("#butDetallesDeProyectos").show();
    else
      $("#butDetallesDeProyectos").hide(); 

  }

  //FIN CAMBIO DE MENU MÓVIL

  //Eventos

  $("#liInstruccionesGenerales").click(function() {
    FunBotonSeleccionado("#liInstruccionesGenerales");
    FunBotonDeseleccionado("#liContacto");
    FunCambiarPanelSeleccionado('#idDivInstruccionesGenerales', '#idDivContactoTI');
  });

  $("#liContacto").click(function() {
    FunBotonSeleccionado("#liContacto");
    FunBotonDeseleccionado("#liInstruccionesGenerales");
    FunCambiarPanelSeleccionado('#idDivContactoTI', '#idDivInstruccionesGenerales');
  });

  // Gestionar Usuarios
  $(".boton-imagen:eq(0)").click(function() {
    window.location.href = "../../Vista/Administrador/AdministracionUsuarios.php";
  });

  // Gestionar secciones animadas
  $(".boton-imagen:eq(1)").click(function() {
    window.location.href = "../../Vista/Administrador/SubPanelSeccionesAnimadas.php";
  });

  // // Gestionar Sección de Noticias
  // $(".boton-imagen:eq(2)").click(function() {
  //   window.location.href = "../../Vista/Administrador/SubPanelSeccionesAnimadas.php";
  // });

  // // Gestionar Invitados
  // $(".boton-imagen:eq(3)").click(function() {
  //   window.location.href = "../../Vista/Administrador/AdministracionInvitado.php";
  // });

  // // Gestionar Estudiantes
  // $(".boton-imagen:eq(4)").click(function() {
  //   window.location.href = "../../Vista/Administrador/AdministracionEstudiantes.php";
  // });
  
  //Funciones

  function FunBotonSeleccionado(vparIdBoton){
    $(vparIdBoton).css({
      'background-color': '#86a2dc'
    });

    $(vparIdBoton + '>p').css({
      'color': 'white'
    });
  }

  function FunBotonDeseleccionado(vparIdBoton){
    $(vparIdBoton).css({
      'background-color': 'white'
    });

    $(vparIdBoton + '>p').css({
      'color': '#102461'
    });
  }

  function FunCambiarPanelSeleccionado(vparIdPanelAActivar, vparIdPanelADesactivar){
    $(vparIdPanelAActivar).css({
      'visibility': 'visible'
    });

    $(vparIdPanelADesactivar).css({
      'visibility': 'hidden'
    });
  }

});

