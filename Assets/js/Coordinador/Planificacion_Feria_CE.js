

$(document).on('click', '#btnFinalizarE', function (e) {
    Swal.fire({
        title: "¿Estás seguro de que deseas finalizar el evento actual?",
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../../Controlador/Coordinador/CDelEvento.php",
                type: "POST",
                cache: false,
                success: function (result) {
                    console.log(result);
                    if (result.length == 1) {
                        Swal.fire(
                            'Exito',
                            'Dato Eliminado correctamente',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            'Ocurrio un problema, intenta nuevamente',
                            'error'
                        );
                    }
                }
            });

            window.location = "../../Vista/Coordinador/Admin_Feria.php";

        } else {
            Swal.close();
        }
    });
});
