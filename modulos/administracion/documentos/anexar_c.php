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
//require_once($path['modelo'].'validarMARES/validarUsuario.php');
require_once($path['librerias'].'pdf/concatenar.php');
require_once($path['modelo'].'procedimientos.php');

$id = $_GET['id'];
$docente=new DocenteDTO();
$docente=$docente->find($id);
$documentos=array();
$documentos2=array();
$directorio=$path['upload'].$docente->getCedula();
if(file_exists($directorio)) {
	$handle = opendir($directorio);
	$cont = 0;
	while($file = readdir($handle)) {
		if($file!= "." && $file != ".." && $file!="Thumbs.db" && $file!="resume.pdf" && $file!="_notes") {
			$documentos[$cont]=substr ($file, 0, strlen($file) - 4);
			$cont++;
		}
	}
	$n = $cont+1;
}
if(isset($_POST["anexar"]) && file_exists($directorio)) {
	$anexar_documentos=array();
	$cont = 0;
	foreach ($documentos as $documento) { 
		if($_POST["select".$cont]!="") {
			$anexar_documentos[$cont]=$directorio."/".$documento.".pdf";
			$cont++;
		}
	}
	$pdf =& new concat_pdf();
	$pdf->setFiles($anexar_documentos);
	$pdf->concat();
	$pdf->Output($directorio."/resume.pdf", 'F');
}
 