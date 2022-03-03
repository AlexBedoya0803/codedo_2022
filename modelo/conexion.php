<?php 

    class Conexion{
        
        public static function Conectar(){

            $conexion = mysqli_connect('localhost', 'root', '', 'dbdedo');

            if($conexion->connect_errno){
                echo "Falló la conexión a MySql: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
                exit();
            }

            return $conexion;
        }
    }