<?php

require_once ("../../Modelo/General/Conexionbd.php");
class ModReportes{

    public function Select_ComisionesEventoActual()
    {
        $data = '';
        
        $query = "CAll Listar_ComisionesEvento_Select();";
        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
        if($result){
            while ($valores = $result->fetch_array()){
                $data .= $valores[0];
            }
            $result ->close();
        };
           
        $mysqli->close();
        return $data;
    }

    public function Listar_ReporteIntegrantesComision($IDComisionAsig)
    {
        $data = '';
        $query = "CAll Reporte_IntegranteComision($IDComisionAsig);";  // IMPRIME COMO TABLA*/       

        //echo($query);
        //exit();

        $mysqli= Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);

        
        if ($result) {
            while ($row = $result->fetch_array()) {
                $data .= $row[0];
            }
        }
           
        $mysqli->close();
        return $data;   

    }

    public function ObtenerProyectosConfirmadosEA() {
        $data = array();
        $query = "Call Lista_ProyectosConfirmados_EA();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }
    public function ObtenerProyectosNoConfirmadosEA() {
        $data = array();
        $query = "Call Lista_ProyectosNoConfirmados_EA();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }
    public function ObtenerProyectosAbandonadosEA() {
        $data = array();
        $query = "Call Lista_ProyectosAbandonados_EA();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

    public function TablaIntegrantesProyecto($Nproyecto){

        $data = array();
        $query = "Call Tabla_IntegrantesProyecto($Nproyecto);";
        
        //echo($query);
        //exit();

        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            while ($valores = $result->fetch_array()) {
                $data[] = array(
                    'Participantes' => $valores['NombreParticipante'],
                    'Cédula' => $valores['Cedula'],
                    'Correo electrónico' => $valores['Correo_Electronico'],
                    'Teléfono' => $valores['Telefono'],
                    'Carnet' => $valores['ID_Numero_Carnet'], // Reemplaza 'nombre_participante' con el nombre de la columna que contiene el nombre del participante
                    'Sede' => $valores['Sede'], // Reemplaza 'sede' con el nombre de la columna que contiene el nombre de la sede
                    'Grupo' => $valores['Grupo'], // Reemplaza 'grupo' con el nombre de la columna que contiene el nombre del grupo
                    'Año' => $valores['Año'] // Reemplaza 'año' con el nombre de la columna que contiene el año
                );
            }
            $result->close();
        }
    
        $mysqli->close();
        echo json_encode($data);
    }

    public function TablaIntegrantesProyectoNoConfirmados($Nproyecto){

        $data = array();
        $query = "Call Tabla_IntegrantesProyecto_NoConfirmados($Nproyecto);";
        
        //echo($query);
        //exit();

        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            while ($valores = $result->fetch_array()) {
                $data[] = array(
                    'Participantes' => $valores['NombreParticipante'],
                    'Cédula' => $valores['Cedula'],
                    'Correo electrónico' => $valores['Correo_Electronico'],
                    'Teléfono' => $valores['Telefono'],
                    'Carnet' => $valores['ID_Numero_Carnet'], // Reemplaza 'nombre_participante' con el nombre de la columna que contiene el nombre del participante
                    'Sede' => $valores['Sede'], // Reemplaza 'sede' con el nombre de la columna que contiene el nombre de la sede
                    'Grupo' => $valores['Grupo'], // Reemplaza 'grupo' con el nombre de la columna que contiene el nombre del grupo
                    'Año' => $valores['Año'] // Reemplaza 'año' con el nombre de la columna que contiene el año
                );
            }
            $result->close();
        }
    
        $mysqli->close();
        echo json_encode($data);
    }
    public function TablaIntegrantesProyectoConfirmados($Nproyecto){

        $data = array();
        $query = "Call Tabla_IntegrantesProyecto_Confirmados($Nproyecto);";
        
        //echo($query);
        //exit();

        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            while ($valores = $result->fetch_array()) {
                $data[] = array(
                    'Participantes' => $valores['NombreParticipante'],
                    'Cédula' => $valores['Cedula'],
                    'Correo electrónico' => $valores['Correo_Electronico'],
                    'Teléfono' => $valores['Telefono'],
                    'Carnet' => $valores['ID_Numero_Carnet'], // Reemplaza 'nombre_participante' con el nombre de la columna que contiene el nombre del participante
                    'Sede' => $valores['Sede'], // Reemplaza 'sede' con el nombre de la columna que contiene el nombre de la sede
                    'Grupo' => $valores['Grupo'], // Reemplaza 'grupo' con el nombre de la columna que contiene el nombre del grupo
                    'Año' => $valores['Año'] // Reemplaza 'año' con el nombre de la columna que contiene el año
                );
            }
            $result->close();
        }
    
        $mysqli->close();
        echo json_encode($data);
    }


    public function ObtenerParticipantesNoConfirmadosEA() {
        $data = array();
        $query = "Call Lista_ParticipantesGeneralesNoConfirmados();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

    public function ObtenerParticipantesConfirmadosEA() {
        $data = array();
        $query = "Call Lista_ParticipantesGeneralesConfirmados();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }
    public function ObtenerParticipantesAbandonadosEA() {
        $data = array();
        $query = "Call Lista_ParticipantesAbandonados();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }


    public function ObtenerParticipantesGeneralesEA() {
        $data = array();
        $query = "Call Lista_ParticipantesGenerales();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

    public function ObtenerProyectosGeneralesEA() {
        $data = array();
        $query = "call Lista_ProyectosGenerales();";
    
        $mysqli = Conexiondatabase::ConexionSecurity();
        $result = $mysqli->query($query);
    
        if ($result) {
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_array()) {
                $data[] = $row;
            }
        }
    
        return $data;
    }

}

?>