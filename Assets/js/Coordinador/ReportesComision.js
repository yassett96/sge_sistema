$(document).ready(function () {

    $("#btnPlanTrabajoC").click(function () {

        $.ajax({
            url: "../../Vista/Coordinador/Pop_DescargarPlan_Reporte.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_DesRepo").modal('show');

            }
        });
    });

    $("#btnIntegranteC").click(function () {

        $.ajax({
            url: "../../Vista/Coordinador/Pop_DescargarInt_Reporte.php",
            type: "POST",
            cache: false,
            success: function (result) {
                $("#contenedor").html(result);
                $("#Pop_DesRepo").modal('show');

            }
        });
    });
});