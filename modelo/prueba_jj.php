<?php

$query = "SELECT * FROM docentes WHERE cedula='70063959'";

$host = "localhost";
$db = "dbDedo";
$user = "dbaAndresD";
$pass = "db4AnD3sClave";

$conexion = mysql_pconnect($host,$user, $pass)or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db,$conexion);
mysql_query("SET NAMES 'ISO-8859-1'");
mysql_select_db($db,$conexion);

$resultado = mysql_query($query, $conexion);
$reg= mysql_fetch_array($resultado);
echo "Nombre : ".$reg['nombre']." Pichurrio de mierda";


//C:\wamp64\bin\mysql\mysql5.7.24\data\dbdedo

$host = "C:\wamp64\bin\mysql\mysql5.7.24\data\dbdedo";
$db = "dbDedo";
$user = "root";
$pass = "";

$conexion = mysql_pconnect($host,$user, $pass)or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db,$conexion);
mysql_query("SET NAMES 'ISO-8859-1'");
mysql_select_db($db,$conexion);

$resultado = mysql_query($query, $conexion);
$reg= mysql_fetch_array($resultado);
echo "Nombre : ".$reg['nombre']." ".$reg['correo']." "." Pichurrio de mierda";


//$criteria=new Criteria("Articulos");
//$criteria->operador="OR";
//$criteria->addFiltro("contenido","LIKE","333");
//$criteria->addFiltro("autor","LIKE","yo");
//$criteria->orderBy("fecha","DESC");
//$articulos=$criteria->execute();
//foreach ($articulos as $articulo)
//{
//echo $articulo->getAutor();
//echo " \n ";
//}
?>