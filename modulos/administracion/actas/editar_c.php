<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login-Copia.php";</script>'; //muestra la vista general
//require_once('../../../modelo/validarMARES/validarUsuario.php');
require_once('../../../modelo/criteria.php');
$numero = count($_GET);
if($numero) {
	$id = $_GET['id'];
	$acta = new ActaDTO();
	$acta=$acta->find($id);
	$formulario=array('fecha'=>$acta->getFecha(),'anexo'=>$acta->getAnexo());
	if(isset($_POST["editar"])) {
		$id = $_GET['id'];
		$acta->setFecha($_POST["fecha"]);
		$acta->setAnexo($_POST["anexo"]);
		$acta->update();
		echo "<script>location.href=\"ver.php?id=$id\";</script>";
	}
}
?>