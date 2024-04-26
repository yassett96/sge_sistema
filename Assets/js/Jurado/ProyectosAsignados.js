
$(this.document).ready(function () {
    function CambiarTextoSegunAnchoPantalla() {
        const vlocAnchoPantalla = FunObtenerAnchoPantalla();
    }
    
    CambiarTextoSegunAnchoPantalla();
    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

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
    if($("#button-menu").length){
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
    }

    function FunActivarAlerta() {
        let tag = document.getElementById("divMenuDespliegue");
        tag.style.top = '15px';
        tag.style.visibility = 'visible';
    }

    function FunDesactivarAlerta() {
        let tag = document.getElementById("divMenuDespliegue");
        tag.style.top = '0px';
        tag.style.visibility = 'hidden';
    }

    // Para administración de los proyectos
    var idProyectoSeleccionado = "";

    // Si el tipo de usuario es participante
    var noCarnetParticipante = null;
    var idSedeParticipante = null;
    var idGrupoParticipante = null;
    
    // Si el tipo de usuario es personal académico
    var idGradoAcademicoPersonalAcademico = null;
    var idSedePersonalAcademico = null;
    var idCargoPersonalAcademico = null;
    var idRolPersonalAcademico = null;

    var vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();        

    $(window).on('resize', function() {
        vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();
        FunActualizarPantalla();
    });
    
    //Para actualización de la tabla cuando se ingresa in caracter en el input de búsqueda
    $('#idSelectBusquedaPA').on('keyup', function () {
        const valorBusqueda = $(this).val().toLowerCase();
        $('#idTable tbody tr').each(function () {
            let coincide = false;
            $(this).find('td').each(function () {
                if ($(this).text().toLowerCase().includes(valorBusqueda)) {
                    coincide = true;
                    return false; // salimos del bucle
                }
            });
            if (coincide) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    //Acción al dar clic en el botón 'Resultados proyectos'
    $("#idBotonResultadosProyectos").click(function(){
        window.location.href = "../../Vista/Jurado/ResultadosEvaluaciones.php?";
    });

    // Acción al dar Clic en el botón 'Evaluar proyecto'
    $("#idBotonEvaluarProyecto").click(function() {
        if(idProyectoSeleccionado != ''){
            FunEjecutarAjax("../../Controlador/Jurado/CProyectosAsignados.php?vlocIdProyectoEvaluar=" + idProyectoSeleccionado);
            window.location.href = "../../Vista/Jurado/EvaluacionProyectos.php";
        }else{
            funActivarAlerta("info", "¡Proyecto no seleccionado!", "Seleccione un proyecto para evaluarlo");
        }
    });

    // Acciones al seleccionar una fila de la tabla
    $('#idTable').on('click', 'tr', function () {
        // Deselecciona todas las filas
        $('tr:nth-child(even)').css({
            'background-color': '#f2f2f2'
        });

        $('tr:nth-child(odd)').css({
            'background-color': '#ddd'
        });

        // Cambia el color de fondo de la fila seleccionada
        $(this).css({
            'background-color': 'rgb(139, 139, 133)'
        });

        idProyectoSeleccionado = $(this).find("#tdIdProyectoSeleccionado").text();    
    });

    

    //Clic al botón 'Atrás'
    $("#h4Atras").click(function () {
        window.history.back();
    });

    function FunActualizarPantalla(){
        const vlocAnchoPantalla2 = FunObtenerAnchoPantalla();

        if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Participante){     

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "1050px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "900px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1880px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "1930px"
                });
            }else if (vlocAnchoPantalla2 <= 480){
                $(".formulario_general").css({
                    "height" : "1620px"
                });
            }
        }
        else if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Personal_Academico){

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "1050px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "900px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1980px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "2030px"
                });
            }else if (vlocAnchoPantalla2 <= 480){
                $(".formulario_general").css({
                    "height" : "1680px"
                });
            }

        }else{

            if(vlocAnchoPantalla2 > 1000){
                $(".formulario_general").css({
                    "height" : "820px"
                });
            }else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767){
                $(".formulario_general").css({
                    "height" : "730px"
                });
            }else if(vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700){
                $(".formulario_general").css({
                    "height" : "1550px"
                });
            }else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480){
                $(".formulario_general").css({
                    "height" : "1600px"
                });
            }else if (vlocAnchoPantalla2 <= 480 && vlocAnchoPantalla2 > 405){
                $(".formulario_general").css({
                    "height" : "1300px"
                });
            }else if (vlocAnchoPantalla2 <= 405){
                $(".formulario_general").css({
                    "height" : "1330px"
                });
            }
            
        }
    }  

});
