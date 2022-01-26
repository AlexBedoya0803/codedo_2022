<?php
//session_start();
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/index.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['modelo'].'procedimientos.php');
$id = $_GET['id'];
$solicitud=new SolicitudDTO();
$solicitud=$solicitud->find($id);
//$solicitud->documento($path['imagenes'],$path['upload'],20,20)
//function documento($imagenes,$upload,$w,$h) {
$ruta=$path['upload'].$solicitud->getDocente()->getCedula()."/solicitud".$solicitud->getId().".pdf";
$imagen=$path['imagenes']."iconos/pdf.png ";
if(file_exists($ruta)){
	$documento = '<a href="'.$ruta.'"> <img src="'.$imagen.'" width="20" height="20" border="0" /></a>';
}
//}
if( isset($_POST["guardar"])) {
	$nombre_carpeta = $path['upload'].$solicitud->getDocente()->getCedula();
	if(!is_dir($nombre_carpeta)) {
		@mkdir($nombre_carpeta, 0775);
	}
	$tipo_archivo = $_FILES['file']['type'];
	if ($tipo_archivo=="pdf") {
		echo "La extension no es la correcta";
	}
	else{
		 if (move_uploaded_file($_FILES['file']['tmp_name'],$nombre_carpeta."/solicitud".$solicitud->getId().".pdf"))
			 {echo "El archivo ha sido cargado correctamente.";}
		 else{echo "Ocurrió algún error al subir el fichero. No pudo guardarse. en ".$nombre_carpeta."/solicitud".$solicitud->getId().".pdf";}
    }
}
 