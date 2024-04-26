
$(this.document).ready(function () {
    function CambiarTextoSegunAnchoPantalla() {
        const vlocAnchoPantalla = FunObtenerAnchoPantalla();
    }

    CambiarTextoSegunAnchoPantalla();
    window.addEventListener("resize", CambiarTextoSegunAnchoPantalla);

    // Funcionalidades iniciales
    FunObtenerSubCategoriasEnSelect();
    // setTimeout(FunActualizarTablas(true), 3000);    

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
    if ($("#button-menu").length) {
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

    // Variables para la gestión de los ganadores
    var vlocTextoSelect = '';
    var vlocAñoActual = '';
    var vlocIdProyecto1 = '';
    var vlocDatosProyecto1 = '';
    var vlocIntegrantesProyecto1 = '';
    var vlocIdProyecto2 = '';
    var vlocDatosProyecto2 = '';
    var vlocIntegrantesProyecto2 = '';
    var vlocStrNombreProyecto1 = '';
    var vlocStrTutorProyecto1 = '';
    var vlocStrPuntajeProyecto1 = '';
    var vlocStrNombreProyecto2 = '---';
    var vlocStrTutorProyecto2 = '---';
    var vlocStrPuntajeProyecto2 = '---';
    var vlocStrNombreIntegrante1P1 = '---';
    var vlocStrNombreIntegrante2P1 = '---';
    var vlocStrNombreIntegrante3P1 = '---';
    var vlocStrNombreIntegrante1P2 = '---';
    var vlocStrNombreIntegrante2P2 = '---';
    var vlocStrNombreIntegrante3P2 = '---';
    var vlocStrFilaPrimerLugar = '';
    var vlocStrFilaSegundoLugar = '';

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

    var vlocValorSelectTipoUsuario = $("#tipoUNuevoAcceso").val();

    $(window).on('resize', function () {
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

    // Acción al dar Clic en el botón 'Evaluar proyecto'
    $("#idBotonEvaluarProyecto").click(function () {
        if (idProyectoSeleccionado != '') {
            FunEjecutarAjax("../../Controlador/Jurado/CProyectosAsignados.php?vlocIdProyectoEvaluar=" + idProyectoSeleccionado);
            window.location.href = "../../Vista/Jurado/EvaluacionProyectos.php";
        } else {
            funActivarAlerta("info", "¡Proyecto no seleccionado!", "Seleccione un proyecto para evaluarlo");
        }
    });

    // Acción al dar clic en el botón de 'Imprimir reporte'
    $("#idBotonGenerarGanadores").click(function () {

        vlocIdSubCategoria = $("#idSelectSubCat").find('option:selected').val();

        vlocTextoSelect = $("#idSelectSubCat").find('option:selected').text();
        vlocAñoActual = new Date().getFullYear();
        vlocIdProyecto1 = '';
        vlocDatosProyecto1 = '';
        vlocIntegrantesProyecto1 = '';
        vlocIdProyecto2 = '';
        vlocDatosProyecto2 = '';
        vlocIntegrantesProyecto2 = '';
        vlocStrNombreProyecto1 = '';
        vlocStrTutorProyecto1 = '';
        vlocStrPuntajeProyecto1 = '';
        vlocStrNombreProyecto2 = '---';
        vlocStrTutorProyecto2 = '---';
        vlocStrPuntajeProyecto2 = '---';
        vlocStrNombreIntegrante1P1 = '---';
        vlocStrNombreIntegrante2P1 = '---';
        vlocStrNombreIntegrante3P1 = '---';
        vlocStrNombreIntegrante1P2 = '---';
        vlocStrNombreIntegrante2P2 = '---';
        vlocStrNombreIntegrante3P2 = '---';
        vlocStrFilaPrimerLugar = '';
        vlocStrFilaSegundoLugar = '';

        FunActualizarTextoCertificado(vlocTextoSelect, vlocAñoActual);

        //Obtener los proyectos
        let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdSubCategoria=" + vlocIdSubCategoria);

        vlocResultadoAjax = JSON.parse(vlocResultadoAjax);

        //Obtenemos los ids de los proyectos
        vlocDatosProyecto1 = vlocResultadoAjax[0].split(",");
        vlocIdProyecto1 = vlocDatosProyecto1[0];

        if (vlocResultadoAjax[1]) {
            vlocDatosProyecto2 = vlocResultadoAjax[1].split(",");
            vlocIdProyecto2 = vlocDatosProyecto2[0];
        }

        //Obtenemos los datos de los 2 proyectos
        vlocStrNombreProyecto1 = vlocDatosProyecto1[1];
        vlocStrTutorProyecto1 = vlocDatosProyecto1[2] + " " + vlocDatosProyecto1[3];
        vlocStrPuntajeProyecto1 = vlocDatosProyecto1[4];

        if (vlocDatosProyecto2) {
            vlocStrNombreProyecto2 = vlocDatosProyecto2[1];
            vlocStrTutorProyecto2 = vlocDatosProyecto2[2] + " " + vlocDatosProyecto2[3];
            vlocStrPuntajeProyecto2 = vlocDatosProyecto2[4];
        }

        //Obtenemos los integrantes del proyecto de primer lugar
        let vlocAjaxIntegrantesProyecto1 = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdProyecto=" + vlocIdProyecto1);
        vlocIntegrantesProyecto1 = JSON.parse(vlocAjaxIntegrantesProyecto1);

        vlocStrNombreIntegrante1P1 = vlocIntegrantesProyecto1[0].split(',')[0] + ' ' + vlocIntegrantesProyecto1[0].split(',')[2];

        if (vlocIntegrantesProyecto1[1]) {
            vlocStrNombreIntegrante2P1 = vlocIntegrantesProyecto1[1].split(',')[0] + ' ' + vlocIntegrantesProyecto1[1].split(',')[2];
        }

        if (vlocIntegrantesProyecto1[2]) {
            vlocStrNombreIntegrante3P1 = vlocIntegrantesProyecto1[2].split(',')[0] + ' ' + vlocIntegrantesProyecto1[2].split(',')[2];
        }

        if (vlocIdProyecto2 != '') {



            //Obtenemos los integrantes del proyecto de segundo lugar
            let vlocAjaxIntegrantesProyecto2 = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdProyecto=" + vlocIdProyecto2);
            vlocIntegrantesProyecto2 = JSON.parse(vlocAjaxIntegrantesProyecto2);

            vlocStrNombreIntegrante1P2 = vlocIntegrantesProyecto1[0].split(',')[0] + ' ' + vlocIntegrantesProyecto1[0].split(',')[2];

            if (vlocIntegrantesProyecto2[1]) {
                vlocStrNombreIntegrante2P2 = vlocIntegrantesProyecto2[1].split(',')[0] + ' ' + vlocIntegrantesProyecto2[1].split(',')[2];
            }

            if (vlocIntegrantesProyecto2[2]) {
                vlocStrNombreIntegrante3P2 = vlocIntegrantesProyecto2[2].split(',')[0] + ' ' + vlocIntegrantesProyecto2[2].split(',')[2];
            }
        }

        //Rellenamos las 2 tablas
        vlocStrFilaPrimerLugar = '<tr class="trTabla"><td>' + vlocStrNombreProyecto1 + '</td><td>' + vlocStrNombreIntegrante1P1 + '</td><td>' + vlocStrNombreIntegrante2P1 + '</td><td>' + vlocStrNombreIntegrante3P1 + '</td><td>' + vlocStrTutorProyecto1 + '</td><td>' + vlocStrPuntajeProyecto1 + '</td></tr>';

        if (vlocDatosProyecto2) {
            vlocStrFilaSegundoLugar = '<tr class="trTabla"><td>' + vlocStrNombreProyecto2 + '</td><td>' + vlocStrNombreIntegrante1P2 + '</td><td>' + vlocStrNombreIntegrante2P2 + '</td><td>' + vlocStrNombreIntegrante3P2 + '</td><td>' + vlocStrTutorProyecto2 + '</td><td>' + vlocStrPuntajeProyecto2 + '</td></tr>';
        }

        console.log("vlocTextoSelect" + vlocTextoSelect);
        console.log("vlocAñoActual" + vlocAñoActual);
        console.log("vlocIdProyecto1" + vlocIdProyecto1);
        console.log("vlocIntegrantesProyecto1" + vlocIntegrantesProyecto1);
        console.log("vlocIdProyecto2" + vlocIdProyecto2);
        console.log("vlocDatosProyecto2" + vlocDatosProyecto2);
        console.log("vlocIntegrantesProyecto2" + vlocIntegrantesProyecto2);
        console.log("vlocStrNombreProyecto1" + vlocStrNombreProyecto1);
        console.log("vlocStrTutorProyecto1" + vlocStrTutorProyecto1);
        console.log("vlocStrPuntajeProyecto1" + vlocStrPuntajeProyecto1);
        console.log("vlocStrNombreProyecto2" + vlocStrNombreProyecto2);
        console.log("vlocStrTutorProyecto2" + vlocStrTutorProyecto2);
        console.log("vlocStrPuntajeProyecto2" + vlocStrPuntajeProyecto2);
        console.log("vlocStrNombreIntegrante1P1" + vlocStrNombreIntegrante1P1);
        console.log("vlocStrNombreIntegrante2P1" + vlocStrNombreIntegrante2P1);
        console.log("vlocStrNombreIntegrante3P1" + vlocStrNombreIntegrante3P1);
        console.log("vlocStrNombreIntegrante1P2" + vlocStrNombreIntegrante1P2);
        console.log("vlocStrNombreIntegrante2P2" + vlocStrNombreIntegrante2P2);
        console.log("vlocStrNombreIntegrante3P2" + vlocStrNombreIntegrante3P2);
        console.log("vlocStrFilaPrimerLugar" + vlocStrFilaPrimerLugar);
        console.log("vlocStrFilaSegundoLugar" + vlocStrFilaSegundoLugar);

        var url = "../../Controlador/Jurado/CReporte_Ganadores.php?" +
            "vparTextoSelect=" + vlocTextoSelect +
            "&vparAñoActual=" + vlocAñoActual +
            "&vparIdProyecto1=" + vlocIdProyecto1 +
            "&vparDatosProyecto1=" + vlocDatosProyecto1 +
            "&vparIntegrantesProyecto1=" + vlocIntegrantesProyecto1 +
            "&vparIdProyecto2=" + vlocIdProyecto2 +
            "&vparDatosProyecto2=" + vlocDatosProyecto2 +
            "&vparIntegrantesProyecto2=" + vlocIntegrantesProyecto2 +
            "&vparStrNombreProyecto1=" + vlocStrNombreProyecto1 +
            "&vparStrTutorProyecto1=" + vlocStrTutorProyecto1 +
            "&vparStrPuntajeProyecto1=" + vlocStrPuntajeProyecto1 +
            "&vparStrNombreProyecto2=" + vlocStrNombreProyecto2 +
            "&vparStrTutorProyecto2=" + vlocStrTutorProyecto2 +
            "&vparStrPuntajeProyecto2=" + vlocStrPuntajeProyecto2 +
            "&vparStrNombreIntegrante1P1=" + vlocStrNombreIntegrante1P1 +
            "&vparStrNombreIntegrante2P1=" + vlocStrNombreIntegrante2P1 +
            "&vparStrNombreIntegrante3P1=" + vlocStrNombreIntegrante3P1 +
            "&vparStrNombreIntegrante1P2=" + vlocStrNombreIntegrante1P2 +
            "&vparStrNombreIntegrante2P2=" + vlocStrNombreIntegrante2P2 +
            "&vparStrNombreIntegrante3P2=" + vlocStrNombreIntegrante3P2 +
            "&vparStrFilaPrimerLugar=" + vlocStrFilaPrimerLugar +
            "&vparStrFilaSegundoLugar=" + vlocStrFilaSegundoLugar;

        // window.location.href = url;
        window.open(url);
    });

    //Acción al cambiar el valor del select de la sub categoria
    $("#idSelectSubCat").change(function () {
        FunActualizarTablas(false);
    });

    function FunActualizarTablas(vparBoolValorInicial) {
        let vlocIdSubCategoria = '';
        if (vparBoolValorInicial) {
            vlocIdSubCategoria = $("#idSelectSubCat").find('option:selected').val();
        } else {
            vlocIdSubCategoria = $("#idSelectSubCat").val();
        }

        vlocTextoSelect = $("#idSelectSubCat").find('option:selected').text();
        vlocAñoActual = new Date().getFullYear();
        vlocIdProyecto1 = '';
        vlocDatosProyecto1 = '';
        vlocIntegrantesProyecto1 = '';
        vlocIdProyecto2 = '';
        vlocDatosProyecto2 = '';
        vlocIntegrantesProyecto2 = '';
        vlocStrNombreProyecto1 = '';
        vlocStrTutorProyecto1 = '';
        vlocStrPuntajeProyecto1 = '';
        vlocStrNombreProyecto2 = '---';
        vlocStrTutorProyecto2 = '---';
        vlocStrPuntajeProyecto2 = '---';
        vlocStrNombreIntegrante1P1 = '---';
        vlocStrNombreIntegrante2P1 = '---';
        vlocStrNombreIntegrante3P1 = '---';
        vlocStrNombreIntegrante1P2 = '---';
        vlocStrNombreIntegrante2P2 = '---';
        vlocStrNombreIntegrante3P2 = '---';
        vlocStrFilaPrimerLugar = '';
        vlocStrFilaSegundoLugar = '';

        FunActualizarTextoCertificado(vlocTextoSelect, vlocAñoActual);

        //Obtener los proyectos
        let vlocResultadoAjax = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdSubCategoria=" + vlocIdSubCategoria);

        if (vlocResultadoAjax != '[]') {
            vlocResultadoAjax = JSON.parse(vlocResultadoAjax);

            //Obtenemos los ids de los proyectos
            vlocDatosProyecto1 = vlocResultadoAjax[0].split(",");
            vlocIdProyecto1 = vlocDatosProyecto1[0];

            if (vlocResultadoAjax[1]) {
                vlocDatosProyecto2 = vlocResultadoAjax[1].split(",");
                vlocIdProyecto2 = vlocDatosProyecto2[0];
            }

            //Obtenemos los datos de los 2 proyectos
            vlocStrNombreProyecto1 = vlocDatosProyecto1[1];
            vlocStrTutorProyecto1 = vlocDatosProyecto1[2] + " " + vlocDatosProyecto1[3];
            vlocStrPuntajeProyecto1 = vlocDatosProyecto1[4];

            if (vlocDatosProyecto2) {
                vlocStrNombreProyecto2 = vlocDatosProyecto2[1];
                vlocStrTutorProyecto2 = vlocDatosProyecto2[2] + " " + vlocDatosProyecto2[3];
                vlocStrPuntajeProyecto2 = vlocDatosProyecto2[4];
            }

            //Obtenemos los integrantes del proyecto de primer lugar
            let vlocAjaxIntegrantesProyecto1 = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdProyecto=" + vlocIdProyecto1);
            vlocIntegrantesProyecto1 = JSON.parse(vlocAjaxIntegrantesProyecto1);

            vlocStrNombreIntegrante1P1 = vlocIntegrantesProyecto1[0].split(',')[0] + ' ' + vlocIntegrantesProyecto1[0].split(',')[2];

            if (vlocIntegrantesProyecto1[1]) {
                vlocStrNombreIntegrante2P1 = vlocIntegrantesProyecto1[1].split(',')[0] + ' ' + vlocIntegrantesProyecto1[1].split(',')[2];
            }

            if (vlocIntegrantesProyecto1[2]) {
                vlocStrNombreIntegrante3P1 = vlocIntegrantesProyecto1[2].split(',')[0] + ' ' + vlocIntegrantesProyecto1[2].split(',')[2];
            }
            if (vlocIdProyecto2 != '') {

                //Obtenemos los integrantes del proyecto de segundo lugar
                let vlocAjaxIntegrantesProyecto2 = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparIdProyecto=" + vlocIdProyecto2);
                // alert(vlocAjaxIntegrantesProyecto2);
                vlocIntegrantesProyecto2 = JSON.parse(vlocAjaxIntegrantesProyecto2);

                vlocStrNombreIntegrante1P2 = vlocIntegrantesProyecto1[0].split(',')[0] + ' ' + vlocIntegrantesProyecto1[0].split(',')[2];

                if (vlocIntegrantesProyecto2[1]) {
                    vlocStrNombreIntegrante2P2 = vlocIntegrantesProyecto2[1].split(',')[0] + ' ' + vlocIntegrantesProyecto2[1].split(',')[2];
                }

                if (vlocIntegrantesProyecto2[2]) {
                    vlocStrNombreIntegrante3P2 = vlocIntegrantesProyecto2[2].split(',')[0] + ' ' + vlocIntegrantesProyecto2[2].split(',')[2];
                }
            }

            //Rellenamos las 2 tablas
            vlocStrFilaPrimerLugar = '<tr class="trTabla"><td>' + vlocStrNombreProyecto1 + '</td><td>' + vlocStrNombreIntegrante1P1 + '</td><td>' + vlocStrNombreIntegrante2P1 + '</td><td>' + vlocStrNombreIntegrante3P1 + '</td><td>' + vlocStrTutorProyecto1 + '</td><td>' + vlocStrPuntajeProyecto1 + '</td></tr>';

            if (vlocDatosProyecto2) {
                vlocStrFilaSegundoLugar = '<tr class="trTabla"><td>' + vlocStrNombreProyecto2 + '</td><td>' + vlocStrNombreIntegrante1P2 + '</td><td>' + vlocStrNombreIntegrante2P2 + '</td><td>' + vlocStrNombreIntegrante3P2 + '</td><td>' + vlocStrTutorProyecto2 + '</td><td>' + vlocStrPuntajeProyecto2 + '</td></tr>';
            }

            $("#idTBodyPrimerLugar").html(vlocStrFilaPrimerLugar);
            $("#idTBodySegundoLugar").html(vlocStrFilaSegundoLugar);
            $(".trTabla").css({
                "position": "relative",
                "top": "25px"
            });

            // Habilitar botón para generar los ganadores
            $('#idBotonGenerarGanadores').prop("disabled", false);
        } else {
            funActivarAlerta("warning", "¡No hay proyectos inscritos!", "No se han evaluado proyectos en la sub categoria de '" + vlocTextoSelect + "'");
            $("#idTBodyPrimerLugar").html("");
            $("#idTBodySegundoLugar").html("");

            // Deshabilitar botón para generar los ganadores
            $('#idBotonGenerarGanadores').prop("disabled", true);
        }
    }

    function FunActualizarTextoCertificado(vparStrTextoSubCategoria, vparStrAñoActual) {
        let vlocStrTextoCertificacion = '';

        vlocStrTextoCertificacion = 'Nosotros, miembros del jurado evaluador de la sub categoría: ' + vparStrTextoSubCategoria + ', después de haber analizado todos los proyectos, según los criterios técnicos definidos por el comité organizador de la feria científica y tecnología ' + vparStrAñoActual + ', se declara como proyecto ganador a:'
        $("#h4TextoEnunciado").html(vlocStrTextoCertificacion);
    }


    //Clic al botón 'Atrás'
    $("#h4Atras").click(function () {
        window.history.back();
    });

    function FunActualizarPantalla() {
        const vlocAnchoPantalla2 = FunObtenerAnchoPantalla();

        if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Participante) {

            if (vlocAnchoPantalla2 > 1000) {
                $(".formulario_general").css({
                    "height": "1050px"
                });
            } else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767) {
                $(".formulario_general").css({
                    "height": "900px"
                });
            } else if (vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700) {
                $(".formulario_general").css({
                    "height": "1880px"
                });
            } else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480) {
                $(".formulario_general").css({
                    "height": "1930px"
                });
            } else if (vlocAnchoPantalla2 <= 480) {
                $(".formulario_general").css({
                    "height": "1620px"
                });
            }
        }
        else if (vlocValorSelectTipoUsuario == Cnt_Tipo_Usuario_Personal_Academico) {

            if (vlocAnchoPantalla2 > 1000) {
                $(".formulario_general").css({
                    "height": "1050px"
                });
            } else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767) {
                $(".formulario_general").css({
                    "height": "900px"
                });
            } else if (vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700) {
                $(".formulario_general").css({
                    "height": "1980px"
                });
            } else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480) {
                $(".formulario_general").css({
                    "height": "2030px"
                });
            } else if (vlocAnchoPantalla2 <= 480) {
                $(".formulario_general").css({
                    "height": "1680px"
                });
            }

        } else {

            if (vlocAnchoPantalla2 > 1000) {
                $(".formulario_general").css({
                    "height": "820px"
                });
            } else if (vlocAnchoPantalla2 <= 1000 && vlocAnchoPantalla2 > 767) {
                $(".formulario_general").css({
                    "height": "730px"
                });
            } else if (vlocAnchoPantalla2 <= 767 && vlocAnchoPantalla2 > 700) {
                $(".formulario_general").css({
                    "height": "1550px"
                });
            } else if (vlocAnchoPantalla2 <= 700 && vlocAnchoPantalla2 > 480) {
                $(".formulario_general").css({
                    "height": "1600px"
                });
            } else if (vlocAnchoPantalla2 <= 480 && vlocAnchoPantalla2 > 405) {
                $(".formulario_general").css({
                    "height": "1300px"
                });
            } else if (vlocAnchoPantalla2 <= 405) {
                $(".formulario_general").css({
                    "height": "1330px"
                });
            }

        }
    }

    function FunObtenerSubCategoriasEnSelect() {
        let vlocIdPersona = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparBoolObtenerIdPersona=" + true);
        // alert(vlocIdPersona);
        let vlocListaSubCategorias = FunEjecutarAjax("../../Controlador/Jurado/CGenerarResultados.php?vparBoolObtenerSubCategorias=" + true + "&vparIdPersonaSubCategorias=" + vlocIdPersona);
        // alert(vlocListaSubCategorias);
        $("#idSelectSubCat").html(vlocListaSubCategorias);

        let vlocValorSelect = $("#idSelectSubCat").find('option:selected').text();
        let vlocAñoActual = new Date().getFullYear();

        FunActualizarTextoCertificado(vlocValorSelect, vlocAñoActual);
        FunActualizarTablas(true);
    }

});
