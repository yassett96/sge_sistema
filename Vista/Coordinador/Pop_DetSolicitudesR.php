<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once ("../../Modelo/Coordinador/MComisionAsignada.php");
$MCAsignada = new ModComisionA();

$ID_Comision_Asig_Sel = $_POST['IDComisionAsig'];
$TablaSolicitudes = $MCAsignada->Listar_SolicitudesRea($ID_Comision_Asig_Sel);

?>


<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetSolicitudesR.css">

<div class="modal" id="Pop_DetSolR" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Solicitudes Realizadas</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="form-group col-md-8">
                        <div id="MarcoDetSol" class="table-wrapper-scroll-y my-custom-scrollbar-11">
                            <table id="TDetSol" class="table  table-hover table-condensed table-striped table-bordered "
                                style="z-index:3;">
                                <thead>
                                    <tr>
                                        <th> N </th>
                                        <th> Solicitud </th>
                                        <th> Descripcion </th>
                                        <th> Fecha </th>
                                        <th> Comision solicitada </th>
                                        <th> Solicitado por </th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="Tabla_DetSol">
                                    <?php echo  $TablaSolicitudes; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">

                    <button type="button" class="btnCancelDetSR" id="btnCancelDetSR" data-dismiss="modal">Cerrar</button>
                        </button>

                </div>
            </div>
        </div>
    </div>
