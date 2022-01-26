<?php
require_once('../../login/Session.php');
//require_once('../../login/AutocerradoSesion.php');
$session = Session::getInstance();
if($session->getVal("usuario_id")=="") //si no hay ningun usuario registrado muestra la vista general
	echo '<script>location.href="../../login/login.php";</script>'; //muestra la vista general
//require_once('../../../modelo/validarMARES/validarUsuario.php');
require_once('../../../modelo/criteria.php');
$numero = count($_GET);
if($numero) {
	$id = $_GET['id'];
	$acta = new ActaDTO();
	$acta=$acta->find($id);
	if( isset($_POST["cerrar"])) {
		$acta->setAbierta(0);
		$acta->update();
		echo "<script>location.href=\"lista.php\"</script>";
	}
}

?>