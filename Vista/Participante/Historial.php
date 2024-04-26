<?php
session_start();

if (!isset($_SESSION['Participantes']) or $_SESSION['Participantes']['ID_Tipo_Usuario']  != "1")  {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

?>

<?php
require_once ("../../Modelo/Participante/MHistorial.php");

$id = $_SESSION['Idpersona'];
$modelH = new MHistorial();
$lista = $modelH->ConsultarEventosParticipados($id);
?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Assets/css/Participante/historial.css">
    <link rel="stylesheet" href="../../Assets/herramientas/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../../Assets/herramientas/DataTables/DataTables-1.13.1/css/dataTables.bootstrap4.min.css">

  <div class="modal" id="Popup4" tabindex="-1">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Historial de Eventos Participados</h5>
      </div>
      <div class="modal-body">
        <div class="scroll-div">
          <table id="tablaH" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Tipo evento</th>
                    <th>Evento</th>
                    <th>Eslogan</th>
                    <th>Nombre proyecto</th>
                    <th>Subcategoría</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Resultado</th>
                </tr>
            </thead>

            <?php
            while($mostrar = mysqli_fetch_array($lista)){
            ?>
            <tbody>
              <tr>
                <td> <?php echo $mostrar['Nombre_Eventos']?> </td>
                <td> <?php echo $mostrar['Nombre_Evento']?> </td>
                <td> <?php echo $mostrar['Eslogan']?> </td>
                <td> <?php echo $mostrar['Nombre']?> </td>
                <td> <?php echo $mostrar['Nombre_SubCategoria']?> </td>
                <td> <?php echo $mostrar['Fecha']?> </td>
                <td> <?php echo $mostrar['Nombre_Sitio']?> </td>
                <td> <?php echo $mostrar['CalificacionFinal']?> </td>
              </tr>
            </tbody>
            <?php
              }
            ?>

          </table>
        </div>
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" id="btnatras" data-bs-dismiss="modal">Atrás</button>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../../Assets/js/General/jquery.min.js"></script>
  <script type="text/javascript" src="../../Assets/js/General/bootstrap.min.js"></script>
  <script src="../../Assets/js/Participante/historial.js"></script>
  <script type="text/javascript" src="../../Assets/herramientas/DataTables/datatables.min.js"></script>
