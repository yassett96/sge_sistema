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

        var checkboxPDF = $('#ReporteTPDF');
        var checkboxExcel = $('#ReporteTExcel');
        var resultText = '';

        console.log(ComisionAsig);

        if (checkboxPDF.is(':checked')) {
            console.log('Seleccionaste el checkbox PDF');
            console.log(ComisionAsig);
            console.log(NombreComision);
            /*var variable = $("#ComisionesAsig").val();
            var NombreC = $("#ComisionesAsig option:selected").text();*/ // Aquí defines el valor de la variable que deseas enviar
            var url = "../../Controlador/Coordinador/CReporte_ActividadesComision.php?variable1=" + encodeURIComponent(ComisionAsig) + "&variable2=" + encodeURIComponent(NombreComision);
            $(".loader").css({ 'visibility': 'visible' });
            $(".CargaTextL").css({ 'visibility': 'visible' });
            $("#loaderPercentage").css({ 'visibility': 'visible' });
            requestAnimationFrame(animateLoader);
            window.location.href = url;
        } else if (checkboxExcel.is(':checked')) {
            console.log('Seleccionaste el checkbox Excel');
            //var variable = $("#ComisionesAsig").val();
            //var NombreC = $("#ComisionesAsig option:selected").text(); // Aquí defines el valor de la variable que deseas enviar
            var url = "../../Controlador/Coordinador/CReporte_ActividadesComisionEXCEL.php?variable1=" + encodeURIComponent(ComisionAsig) + "&variable2=" + encodeURIComponent(NombreComision)
            window.location.href = url;
        } else {
            Swal.fire(
                'Advertencia',
                'Debes selecciona un tipo de archivo',
                'warning'
            )
        }

    });



    $(document).on('click', '#btnCerrar_Des', function () {
        $('#Pop_DesRepo').modal('hide');
    });


});