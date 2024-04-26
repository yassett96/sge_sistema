<?php
    function funcObtenerUltimoIdRegistrado($vparStrTabla, $vparStrNombreColumnaId){
        require_once('../../Modelo/General/Conexionbd.php');

        $vlocIntIdUltimoRegistro = '';
        
        $vlocQuery = "Select Max(".$vparStrNombreColumnaId.") AS id FROM ".$vparStrTabla;
        $vlocMysqli = Conexiondatabase::ConexionSecurity();
        $vlocResultado = $vlocMysqli->query($vlocQuery);

        if($vlocRow = mysqli_fetch_row($vlocResultado)){
            $vlocIntIdUltimoRegistro = trim($vlocRow[0]);
        }

        return $vlocIntIdUltimoRegistro;
    }

    function funcActivarAlerta($vparStrIcon, $vparStrTitle, $vparStrText){
        echo "<script>Swal.fire({
            icon: '".$vparStrIcon."',
            title: '".$vparStrTitle."',
            text: '".$vparStrText."'
        })</script>";
    }

    function funcObtenerAñoActual(){
        $vlocDateTiempoActual = date("Y");
        return $vlocDateTiempoActual;
    }
?>