<?php

require_once ("../../Modelo/General/Conexionbd.php");

class EditarCuentaModeloA {

    public function ActualizarDatosPA($id, $telefono, $correo){

        $insertp = '';
        $query = "CALL Actualizar_Datos_P_Academico($id,'$telefono', '$correo');";    
        
        

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if(!$result){
            $insertp = $mysqli->error;
        }else{
            $insertp = "1";
        }
        $mysqli->close();
        return $insertp;  
    
    }

    public function ListarDatosAcademico($idpersonaA,$IdTipoUsuario){

        $datos = '';
        $query = "Call Cargar_Acceso_PersonaUsuario('$idpersonaA','$IdTipoUsuario');";

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        if ($result -> num_rows == 1) {
            $datos = $result->fetch_assoc();
        }

        $mysqli->close();
        return $datos;
    }

    public function BuscarRegistro($id,$tel,$correo){
        $dato='';

        if($query = "CALL BuscarRegistroTel('$id','$tel');")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){

                        $dato = "Lo sentimos, este teléfono ya se encuentra registrado";
                    }
                $mysqli->close();
                }
            }
        } 
        
        if($query = "CALL BuscarRegistroC('$id','$correo');")
        {
            $mysqli= Conexiondatabase::ConexionSecurity();
            $result = $mysqli->query($query);
            if($result){
                while($row = $result->fetch_array()){
                    if($row[0] > 0){

                        $dato = "Lo sentimos, este correo ya se encuentra registrado";
                    }
                $mysqli->close();
                }
            }
           
        }

        return $dato;

    }

}


?>