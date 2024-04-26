$(document).ready(function() {  

    $(document).on('click', '#btnCerrarPOP_CEA', function() {
    $('#Pop_ComisionEA').modal('hide');
    $('#TComisiones tbody tr').removeClass('selected');

    //  location.reload();
    });

    
    $(document).on('click', '#Closedes', function() {
        $('#Pop_ComisionEA').modal('hide');
        $('#TComisiones tbody tr').removeClass('selected');
    });

    $("#Pop_ComisionEA").modal({
        backdrop: "static",
        keyboard: false
      });
  
      // agregar evento clic al botón de cerrar
      $("#Pop_ComisionEA .modal-footer button[data-dismiss='modal']").click(function() {
        // cerrar el modal
        $("#Pop_ComisionEA").modal("hide");
      });


    
});
