<?php
session_start();
define("APLICACION","dedo");

function asignarPath($ubicacion)
{
$profundidad=0;
$path = array();
$ruta = str_replace("\\", '/', $ubicacion);

$directorios = explode( '/',$ruta);
	 for($i=0;$i<count($directorios);$i++)
	   { 
	   if($directorios[$i]==APLICACION)
		{
		$profundidad=count($directorios)-$i-1;
		}
	  }
	  $cadena="";
	   for($i=0;$i<$profundidad;$i++)
	   {
	   $cadena="../".$cadena;
	   }
 $path['raiz']=$cadena;
 $path['imagenes']=$cadena."imagenes/";
 $path['librerias']=$cadena."librerias/";
 $path['upload']=$cadena."upload/";
 $path['modulos']=$cadena."modulos/";
 $path['modelo']=$cadena."modelo/";
return $path;
}

?>
