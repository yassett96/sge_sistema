$(document).ready(function () {

    // Obtenemos el elemento de la barra de carga y el elemento del porcentaje
    const loaderBar = document.getElementById("loaderBar");
    const loaderPercentage = document.getElementById("loaderPercentage");
    

    // Establecemos la duración de la animación en milisegundos (por ejemplo, 5000ms para 5 segundos)
    const animationDuration = 50000;

    // Iniciamos la animación de carga
    let startTime = null;
    function animateLoader(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min(1, (timestamp - startTime) / animationDuration);
        loaderBar.style.width = `${progress * 100}%`;
        loaderPercentage.innerText = `${Math.round(progress * 100)}%`;

        if (progress < 1) {
            requestAnimationFrame(animateLoader);
        } else {
            // La animación ha terminado
            loaderPercentage.innerText = "Carga Completa";
        }
    }

    

    $('#btnDescarga').click(function () {

        event.preventDefault();

        var variable = $("#ComisionesEA").val();
        var NombreC = $("#ComisionesEA option:selected").text();


        if (variable == "Seleccione una comisión") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar una comisión',
                'warning'
            )
            die();
        }


        var variable = $("#ComisionesEA").val();
        var NombreC = $("#ComisionesEA option:selected").text(); // Aquí defines el valor de la variable que deseas enviar
        var url = "../../Controlador/Coordinador/CReporte_ActividadesComision.php?variable1=" + encodeURIComponent(variable) + "&variable2=" + encodeURIComponent(NombreC)
        $(".loader").css({'visibility':'visible'});
        $(".CargaTextL").css({'visibility':'visible'});
        $("#loaderPercentage").css({'visibility':'visible'});
        requestAnimationFrame(animateLoader);
        window.location.href = url;
        

    });

    $('#btnDescarga2').click(function () {

        event.preventDefault();

        var variable = $("#ComisionesEA").val();
        var NombreC = $("#ComisionesEA option:selected").text();


        if (variable == "Seleccione una comisión") {

            Swal.fire(
                'Advertencia',
                'Debe seleccionar una comisión',
                'warning'
            )
            die();
        }


        var variable = $("#ComisionesEA").val();
        var NombreC = $("#ComisionesEA option:selected").text(); // Aquí defines el valor de la variable que deseas enviar
        var url = "../../Controlador/Coordinador/CReporte_IntegrantesComision.php?variable1=" + encodeURIComponent(variable) + "&variable2=" + encodeURIComponent(NombreC)
        $(".loader").css({'visibility':'visible'});
        $(".CargaTextL").css({'visibility':'visible'});
        $("#loaderPercentage").css({'visibility':'visible'});
        requestAnimationFrame(animateLoader);
        window.location.href = url;


    });



    $(document).on('click', '#btnCerrar_Des', function () {
        $('#Pop_DesRepo').modal('hide');
    });


});