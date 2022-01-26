<?php

$host = "localhost";
$db = "dbDedo";
$user = "dbaAndresD";
$pass = "db4AnD3sClave";
//$user = "admvicedocencia";
//$pass = "YPQVKq8s@d*a`r9)";


$conexion = mysql_pconnect($host,$user, $pass)or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db, $conexion);
//mysql_query("SET NAMES 'ISO-8859-1'");
//mysql_select_db($db, $conexion);

if (isset($_POST["enviar"])){
	//require_once ("functions.php");
	//require_once ("conexion.php");

	$archivo= $_FILES["archivo"]["name"];
	//$archivo_copiado  = $_FILES["archivo"]["tmp_name"];
	$archivo_guardado = "copia_".$archivo;
	
	echo $archivo." original. Esta es la ruta temporal de: ".$archivo_copiado;

	if (copy($archivo, $archivo_guardado)){
		 echo "se copió correctamente el archivo temporal a nuestra carpeta de trabajo <br>";
	}else{
		echo "hubo un error";
	}
	
	if (file_exists($archivo_guardado)){
		$fp = fopen($archivo_guardado, "r");
		while ($datos = fgetcsv($fp, 0, ";")){
			
			$sentencia = "insert into docentes (id, facultad_id, categoria_id, dedicacion_id, cedula, nombre, apellido1, apellido2, fechaVinculacion, sexo, cCosto, nCCosto, correo) values ($id, $facultad_id, $categoria_id, $dedicacion_id, '$cedula', '$nombre', '$apellido1', '$apellido2', '$fechaVinculacion', '$sexo', '$cCosto', '$nCCosto', '$correo')";
	$ejecutar = mysqli_query($conexion, $sentencia);
			
			//$resultado = insertar_datos2($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12]);

			//if ($resultado){
			//	echo " se insertó <br>";
			//}else{
			//	echo "no se insertó <br>";
				echo $datos[0]." ".$datos[1]." ".$datos[2]." ".$datos[3]." ".$datos[4]." ".$datos[5]."<br>";
			//}
		}
	}else{
		echo "No existe el archivo copiado <br>";
	}
	
}

?>

<!DOCTYPE html>
<head>
<meta charset=utf-8">
<title>Subir archivo a BD</title>
</head>
<body>
<div class="formulario">
	<form action ="actualiza_docentes.php" class = "formulariocompleto" method="post" enctype="multipart/form-data">
    <input type = "file" name="archivo" class="form-control"/>
    <input type = "submit" value="subir archivo" class="form-control" name="enviar">
    </form>
    </div>

</body>
</html>
<?php
