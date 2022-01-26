<?php
require_once('../../login/Session.php');
require_once('../../login/AutocerradoSesion.php');
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
	
	if( isset($_POST["borrar"])) {
		$acta->delete();
		$consulta = new Criteria("actas");
		mysql_query("ALTER TABLE actas AUTO_INCREMENT=$id;", $consulta->conexion);
		echo "<script>location.href=\"lista.php\"</script>";
	}
}
?>
