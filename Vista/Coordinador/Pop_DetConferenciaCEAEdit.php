<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 6)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}

$ID_Conf = $_POST['idconfe'];

require_once ("../../Modelo/Coordinador/PlanificacionE.php");
require_once ("../../Modelo/Coordinador/MConferencia.php");

$PlanDG = new PlanificacionEM();
$DatosGEA = $PlanDG->ObtenerDatosGEvento();
$HoraEA = $DatosGEA['hora'];
$idsitioE =$DatosGEA['ID_Sitio'];

$PlanE4 = new MConferencia();

$DatosConferencia = $PlanE4->ObtenerDatosConferencia($ID_Conf);
$NConferencia = $DatosConferencia['Nombre_Conferencia'];
$NConferencista = $DatosConferencia['Nombre_Conferencista'];
$DetallesConferencia = $DatosConferencia['Detalles_Conferencista'];
$Hora_InicioC = $DatosConferencia['Hora_Inicio'];
$Hora_FinC = $DatosConferencia['Hora_Fin'];
$IDSalonC =$DatosConferencia['ID_Salon'];

$ListaSalonC = $PlanE4->select_sitiosalon($idsitioE,$IDSalonC);


?>

<link rel="stylesheet" href="../../Assets/css/Coordinador/Pop_DetConferencia.css">

<div class="modal" id="Pop_ConferenciaEA" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar detalles de conferencia </span></h5>
                <!--<button type="button" class="close" data-dismiss="modal" style="color: white;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>-->
                <button type="button" class="Closedes" id="Closedes">X</button>
            </div>

            <div class="modal-body">
            <p class="NotaCampos"><b><i> Los campos marcados con (*) son obligatorios</i></b></p>
                <div id="GC_CEActual" class="Conferencia_EActual">
                    <form id="MConFE" name="MConFE">
                        <input type="hidden" id="ID_ConEA" value="<?php echo $ID_Conf; ?>">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                                <input type="text" name="NombreC" id="NombreC" class="InputPop"
                                    value="<?php echo $NConferencia ?>">
                                <label>Nombre de la conferencia (*) </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                                <input type="text" name="NombreCF" id="NombreCF" class="InputPop"
                                    value="<?php echo $NConferencista ?>">
                                <label>Nombre del conferencista </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                                <input type="text" name="LugarCF" id="LugarCF" class="InputPop"
                                    value="<?php echo $DetallesConferencia ?>">
                                <label>Detalle del conferencista </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <label>Salón (*): </label>
                                <select class="form-select SelectPOP" name="SalonC" id="SalonC"
                                    onmousedown="if(this.options.length>3){this.size=3;}" onchange='this.size=0;'
                                    onblur="this.size=0;" aria-label="Default select example">
                                    <option hidden selected>Seleccione un salón</option>
                                    <?php echo $ListaSalonC; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                                <input type="time" name="HoraC_I" id="HoraC_I" class="InputPop"
                                    value="<?php echo $Hora_InicioC ?>">
                                <input type="hidden" id="HoraC_IEvento" value="<?php echo $HoraEA; ?>">
                                <label>Hora Inicio : </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-8">
                                <!--<img class="icono1" src="../../Assets/imagenes/Recursos/icono5.png">-->
                                <input type="time" name="HoraC_F" id="HoraC_F" class="InputPop"
                                    value="<?php echo $Hora_FinC ?>">
                                <label>Hora Fin : </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button type="button" class="btnCerrarPOP_CEA" id="btnCerrarPOP_CEA">Cerrar</button>
                        <button type="button" class="btnGuardarPOP_CEA" id="btnGuardarPOP_CEA">Guardar Cambios</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript" src="../../Assets/js/Coordinador/Pop_DetConferencia.js"></script>