$(document).ready(function () {

    $('#Btnlog').on("click", function () {

        let v1 = $("#User").val();
        let v2 = $("#Pass").val();

        console.log(v1);
        console.log(v2);

        $.ajax({
            url: "../Modelo/LogUser.php",
            type: "POST",
            data: {User: v1, Pass: v2},
            datatype : 'json',
            cache: false,
            success: function (data) {

                var respuesta = JSON.parse(data);

                if ("OK" == respuesta.status) {
                    // en realidad con el error tambien damos un Location (index.php),
                    // pero por el momento sólo redireccionamos si todo OK
                    window.location.assign(respuesta.Location);
                    var mens = respuesta.mensaje;
                }
                /*if ("ERR" == respuesta.status) {
                    window.location.assign(respuesta.Location);
                    var mens = respuesta.mensaje;
                }*/



                console.log(mens)
                /*swal("Mensaje", mens, "Warning", 3000);*/

                /*
                sweetAlert({
                    title: "Good job!",
                    text: mens,
                    icon: "success",
                    button: "Aww yiss!",
                    timer: 5000
                });
                */
            }


        });
    });
});





