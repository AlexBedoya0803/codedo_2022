<?php
//session_start();
require_once('../../login/Session.php');
require_once('../comisiones/UploadFiles.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="" || $session->getVal("rol")!="unidad") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
require_once('../../../configuracion/path.php');
require_once('../../../modelo/clasesDTO.php');
$path=asignarPath(dirname(__FILE__));
require_once($path['modelo'].'criteria.php');
require_once($path['modelo'].'clasesDTO.php');
$numero = count($_GET);
$contenido = "";
if($numero) {
	$id = $_GET['id'];
	$solicitud = new SolicitudDTO();
	$solicitud=$solicitud->find($id);
	
	if( isset($_POST["guardar"])) {
		
		if($_POST["respuesta"]) {
			echo "respuesta";
			//throw new Exception();
			$solicitud->setAvalCF(1);
			$solicitud->setEstadoId(5);
			//echo "si";
		}else{
			$solicitud->setAvalCF("0");
			$solicitud->setEstadoId(5);
			
			//echo "no";
		}
		if(isset($_POST['comentariosUnidad'])){
			$solicitud->setComentariosUnidad($_POST['comentariosUnidad']);	
		}
		$solicitud->setNumeroActaCF($_POST['actaCF']);
		$solicitud->setFechaActaCF($_POST['fechaActaCF']);
		$solicitud->update2();
		
		$ruta = "../../../anexos/".$solicitud->getId();
		UploadFiles::saveAnexos($_FILES['aval'],$ruta);
		if(isset($_FILES['anexos'])){
			UploadFiles::saveAnexos($_FILES['anexos'],$ruta);
		}
		echo '<script>location.href="./listaSinAvalar.php";</script>';	
	}
}
