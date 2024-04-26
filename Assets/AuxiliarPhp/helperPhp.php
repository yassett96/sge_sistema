<?php
    Class helperPhp{        
        /**
         * Agregarle el '+' al teléfono si no lo tiene
         *          
         * @param String $vparStrTelefono Teléfono de la persona
         * @return String
         * @throws Exception si la operación falla
         **/        
        public function FunConvertirAFormatoTelefono($vparStrTelefono){            
            $vlocStrPrimerCaracterTelefono = substr($vparStrTelefono, 1, 0);
            if ($vlocStrPrimerCaracterTelefono != "+"){
                $vparStrTelefono = "+".$vparStrTelefono;                
            }
            
            return $vparStrTelefono;            
        }
            
        /**
         * Para poder probar en el código
         *         
         *
         * @param String $vparStrTitulo Título de la prueba
         * @param String $vparStrVariable Contenido de la variable a visualizar
         * @param Boolean $vparBlnConVariable Para permitir obtener el contenido de la variable
         * @return String
         * @throws Exception si la operación va mal
         **/        
        public function FunPruebaEchoAlert($vparStrTitulo, $vparStrVariable, $vparBlnConVariable){
            $vlocEcho = '';

            if($vparBlnConVariable == true){
                $vlocEcho = "<script>alert('Mensaje de prueba: ".$vparStrTitulo.". Valor de la variable: ".$vparStrVariable."');</script>";
                echo $vlocEcho;
                exit;
            }else{
                $vlocEcho = "<script>alert('Prueba echo, lo que estás probando se pudo ejecutar hasta aquí!!!');</script>";
                echo $vlocEcho;
                exit;
            }
        }

        /**
         * Para obtener el último Id recién Registrado
         *
         * Para obtener el último Id recién Registrado en BD
         *
         * @param String $vparStrTabla Nombre de la tabla el cual se obtiene la tabla
         * @param String $vparStrNombreColumnaId Nombre de la columna el cuál deseamos obtener el último registro
         * @return Integer
         * @throws Exception si la operación va mal
         **/        
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
    
        /**
         * Activar alerta de 'Swal'
         *
         * Activar alerta de 'Swal'
         *
         * @param String $vparStrIcon Icono que mostrará la alerta
         * @param String $vparStrIcon Título de la alerta
         * @param String $vparStrText Texto que mostrará la alerta
         * @return String 'echo'
         * @throws Exception si la operación va mal
         **/        
        function funcActivarAlerta($vparStrIcon, $vparStrTitle, $vparStrText){
            echo "<script>Swal.fire({
                icon: '".$vparStrIcon."',
                title: '".$vparStrTitle."',
                text: '".$vparStrText."'
            })</script>";
        }
    
        /**
         * Obtener el año actual
         *
         * Obtener el año actual
         *         
         * @return Date
         * @throws Exception Si la operación va mal
         **/        
        function funcObtenerAñoActual(){
            $vlocDateTiempoActual = date("Y");
            return $vlocDateTiempoActual;
        }

        /**
         * Obtiene el mes en letras de una fecha                  
         *
         * @param Date $vparDateFecha Fecha en formate 'YY/MM/DD'
         * @return String El mes en letras         
         **/        
        function FunExtraerMesDeFecha($vparDateFecha){
            $vlocStrMesFecha = date("m", strtotime($vparDateFecha));
            return $vlocStrMesFecha;
        }

        /**
         * Devuelve el mes en letra dado en dígito
         *         
         *
         * @param String $vparStrMes mes en dígito
         * @return Strin Mes en letras         
         **/
        function FunConvertirDigitoMesEnLetras($vparStrMes){
            $vlocStrMesLetras = date("F", strtotime($vparStrMes));
            return $vlocStrMesLetras;
        }

        function FunExtraerDiaDeFecha($vparDateFecha){
            $vlocStrDiaFecha = date("d", strtotime($vparDateFecha));
            return $vlocStrDiaFecha;
        }

        //Para poder probar en el código en consola
        
    }
?>